<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Bus;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

// QR Codes
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelMedium;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Symfony\Component\HttpFoundation\Response;
// QR Codes

use App\Http\Traits\TicketTrait;
use App\Models\CashfreePayment;
use App\Models\EasebuzzPayment;
use App\Models\Payment;
use App\Models\PaymentSetting;
use App\Models\RazorpayPayment;
use Carbon\Carbon;

class TicketController extends Controller
{
    use TicketTrait;

    public function index(Request $request)
    {
        $user = Auth::user();
        $allowed_buses = $user->conductorBusesList();
        $dateToRules = ['nullable', 'date_format:Y-m-d'];
        if ($request->filled('date_from')) {
            $dateToRules[] = 'after_or_equal:date_from';
        }

        $filters = $request->validate([
            'bus_id' => ['nullable', 'integer', Rule::in($allowed_buses)],
            'date_from' => ['nullable', 'date_format:Y-m-d'],
            'date_to' => $dateToRules,
            'search' => ['nullable', 'string', 'max:255'],
            'payment_status' => ['nullable', Rule::in(['paid', 'unpaid'])],
            'ticket_status' => ['nullable', Rule::in(['active', 'cancelled'])],
        ]);

        // Start building the query
        $query = Ticket::whereIn('bus_id',$allowed_buses)
        ->with(['fromStation', 'toStation', 'bus', 'payment'])
            ->orderBy('travel_date', 'DESC');

        // Apply filters based on request type
        if ($request->type === 'completed_tickets') {
            $query->whereNotNull('payment_id')
                ->whereDate('travel_date', '<', Carbon::now());
        } elseif ($request->type === 'paid_tickets') {
            $query->whereNotNull('payment_id')
            ->whereDate('travel_date', '>=', Carbon::now());
        } elseif ($request->type === 'unpaid_tickets') {
            $query->whereNull('payment_id');
        } elseif ($request->type === 'cancelled_tickets') {
            $query->whereNotNull('deleted_at')->withTrashed();
        }else{
            $query->withTrashed();
        }

        if (!empty($filters['bus_id'])) {
            $query->where('bus_id', $filters['bus_id']);
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('travel_date', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('travel_date', '<=', $filters['date_to']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($ticketQuery) use ($search) {
                $ticketQuery->where('ticket_no', 'like', '%' . $search . '%')
                    ->orWhere('passenger_name', 'like', '%' . $search . '%');
            });
        }

        if (($filters['payment_status'] ?? null) === 'paid') {
            $query->whereNotNull('payment_id');
        } elseif (($filters['payment_status'] ?? null) === 'unpaid') {
            $query->whereNull('payment_id');
        }

        if (($filters['ticket_status'] ?? null) === 'cancelled') {
            $query->withTrashed()->whereNotNull('deleted_at');
        } elseif (($filters['ticket_status'] ?? null) === 'active') {
            $query->whereNull('deleted_at');
        }

        // Execute the query and get results
        $tickets = $query->orderBy('id','DESC')->get();
        $buses = Bus::whereIn('id', $allowed_buses)->orderBy('name')->get();

        // Return the view with tickets
        return view('tickets.index', compact('tickets', 'buses'));
    }

    // public function create() {
    //     $busStations = BusStation::all();
    //     $buses = Bus::all();
    //     return view('tickets.create', compact('busStations', 'buses'));
    // }

    public function store(Request $request) {
        if(Auth::user()->role=='conductor'){
            return back()->with('error','You are not allowed to book a ticket.');
        }
        $validated = $request->validate([
            'passenger_name' => 'required|string|max:255',
            'passenger_count' => 'required|integer|min:1',
            'travel_date' => 'required|date_format:d/m/Y',
            'bus_id' => 'required|exists:buses,id',
            'pickup_id' => 'required|integer',
            'drop_id' => 'required|integer',
            // 'lat' => 'required',
            // 'long' => 'required',
        ]);
        $bus = Bus::with(['fromStation', 'toStation'])->findOrFail($validated['bus_id']);
        $request->validate([
            'pickup_id' => 'exists:bus_pickup_drop_points,id,bus_station_id,' . $bus->from_station_id,
            'drop_id' => 'exists:bus_pickup_drop_points,id,bus_station_id,' . $bus->to_station_id,
        ]);
        $travel_date = DateTime::createFromFormat('d/m/Y', $request->travel_date);
        $formatted_date = $travel_date->format('Y-m-d'); // Convert to 'Y-m-d' format
        $ticket_no = date('dmY').website_setting('ticket_prefix').Auth::user()->id.rand(1111,9999);
        $availableTicketsForSleeper = $bus->availableTicketsForSleeper($request->travel_date);
        $availableTicketsForNonSleeper = $bus->availableTicketsForNonSleeper($request->travel_date);
        if($request->sleeper_passenger_count > $availableTicketsForSleeper){
            return back()->with('error','Sleeper Seat count is not correct');
        }
        if($request->non_sleeper_passenger_count > $availableTicketsForNonSleeper){
            return back()->with('error','Seat count is not correct');
        }
        $data = [
            'ticket_no' => $ticket_no,
            'user_id' => Auth::user()->id,
            'bus_id' => $bus->id,
            'passenger_name' => $request->passenger_name,
            'sleeper_passenger_count' => $request->sleeper_passenger_count,
            'non_sleeper_passenger_count' => $request->non_sleeper_passenger_count,
            'passenger_count' => $request->passenger_count,
            'travel_date' => $formatted_date,
            'from_station_id' => $bus->fromStation->id,
            'to_station_id' => $bus->toStation->id,
            'pickup_id' => $validated['pickup_id'],
            'drop_id' => $validated['drop_id'],
            'fare' => ($bus->sleeper_fare*$request->sleeper_passenger_count) + ($bus->fare*$request->non_sleeper_passenger_count),
            'allotted_seat_number' => 'NA',
            'lat' => $request->lat,
            'long' => $request->long,
            'ip_address' => $request->ip(),
        ];
        // dd($data);
        $ticket = Ticket::create($data);  // Create the ticket
        $ticketId = $ticket->id;  // Retrieve the primary key;
        $payment_setting_check = \App\Models\PaymentSetting::first();
        $queryString = http_build_query([
            'gateway' => $payment_setting_check->gateway,
            'mode' => $payment_setting_check->mode
        ]);
        return redirect('payment-process'.'/'.$ticketId.'?'.$queryString)->with('success', 'Ticket information saved successfully.\nPlease proceed to payment.');
    }

    // public function show(Ticket $ticket) {
    //     return view('tickets.show', compact('ticket'));
    // }

    // public function destroy(Ticket $ticket) {
    //     if($ticket->canTicketBeCancel()){
    //         $ticket->delete();
    //         return back()->with('success', 'Ticket cancelled successfully.');
    //     }else{
    //         return back()->with('error', 'Ticket can not cancelled.');
    //     }
    // }
    public function ticketDetails(Request $request){
        $bus = Bus::with([
            'fromStation.busPickupDropPoints',
            'toStation.busPickupDropPoints',
        ])->find($request->id);
        if(!$bus){
            return back()->with('error','Bus is not available..');
        }
        $request->validate([
            'travel_date' => 'required|date_format:d/m/Y',
            'pickup_id' => 'required|integer|exists:bus_pickup_drop_points,id,bus_station_id,' . $bus->from_station_id,
            'drop_id' => 'required|integer|exists:bus_pickup_drop_points,id,bus_station_id,' . $bus->to_station_id,
        ]);
        return view('tickets.ticket-details', compact('bus'));
    }
    public function paymentProcess(Request $request){
        $payments = PaymentSetting::all();
        $ticket = Ticket::withTrashed()
            ->with(['pickup', 'drop'])
            ->where('id', $request->id)
            ->first();
        if(!$ticket){
            return back()->with('error','Ticket is not available..');
        }
        $user = Auth::user();
        $bus = Bus::with(['fromStation', 'toStation', 'stopages'])->find($ticket->bus_id);
        return view('tickets.payment-process', compact('ticket','bus','payments'));
    }
    public function cashPayment(Request $request){
        if(Auth::user()->role=='user'){
            return back()->with('error','Not Allowed');
        }
        $ticket = Ticket::find($request->id);
        if(!$ticket){
            return back()->with('error','Ticket is not available..');
        }
        $txnid = date('dMY').rand(11111111,999999999);
        $payment = Payment::create([
            'gateway' => 'CASH',
            'gateway_mode' => 'CASH',
            'ticket_id' => $ticket->id,
            'order_id' => $txnid,
            'contact' => $request->mobile,
            'payment_id' => $txnid,
            'amount' => $ticket->fare,
            'receipt' => 'CASH',
            'status' => 'success',
            'response' => json_encode($ticket), // Store full payment response as JSON
        ]);
        if($payment->save()){
            $ticket->payment_id = $payment->id;
            $ticket->save();
        }
        return redirect('payment-success/'.$ticket->id)->with('success','Payment done successfully');
    }
    public function generateQRCode($ticketId)
    {
        // Fetch ticket information from the database
        $ticket = Ticket::findOrFail($ticketId);
        $bus = $ticket->bus;
        $passenger_count = '';
        if($ticket->sleeper_passenger_count>0 && $ticket->non_sleeper_passenger_count==0){
            $passenger_count = $ticket->sleeper_passenger_count.'Sleeper';
        }elseif($ticket->sleeper_passenger_count==0 && $ticket->non_sleeper_passenger_count>0){
            $passenger_count = $ticket->non_sleeper_passenger_count;
        }elseif($ticket->sleeper_passenger_count>0 && $ticket->non_sleeper_passenger_count>0){
            $passenger_count = $ticket->passenger_count.'(';
            $passenger_count .= $ticket->sleeper_passenger_count.' Sleeper +';
            $passenger_count .= $ticket->non_sleeper_passenger_count.' Non Sleeper)'; 
        }
        
        // Prepare the ticket details
        $data = [
            'Ticket No' => $ticket->ticket_no,
            'Booking Date' => date('d/m/Y h:i A',strtotime($ticket->created_at)),
            'Travel Date' => date('d/m/Y',strtotime($ticket->travel_date)).' '.date('h:i A',strtotime($bus->from_time)),
            'Passenger Name' => $ticket->passenger_name,
            'Number of Passengers' => $passenger_count,
            'From' => $ticket->fromStation->name,
            'To' => $ticket->toStation->name,
            'Fare' => 'Rs.' . $ticket->fare,
            'Payment Status' => ($ticket->payment) ? 'PAID' : 'NOT PAID',
            'Transaction ID' => ($ticket->payment) ? $ticket->payment->payment_id : ''
        ];

        $qrCodeData = "Welcome to ".website_setting('company_name')."\n";
        foreach ($data as $key => $value) {
            $qrCodeData .= "$key: $value\n";
        }

        // Generate the QR code
        $qrCode = QrCode::create($qrCodeData)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelMedium())
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin());

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Return the QR code as a PNG image
        return new Response($result->getString(), 200, ['Content-Type' => 'image/png']);
    }
}
