<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Easebuzz\PayWithEasebuzzLaravel\PayWithEasebuzzLib;
use App\Http\Traits\TicketTrait;
use App\Models\Payment;
use App\Models\PaymentSetting;

class EasebuzzController extends Controller
{
    use TicketTrait;
    public function initiate_payment_ebz(Request $request)
    {
        if(!$request->phone){
            return response()->json(['status'=>false,'message'=>'Mobile number is required']);
        }
        if(is_numeric($request->phone)==false){
            return response()->json(['status'=>false,'message'=>'Mobile number must be integer value.']);
        }
        if(strlen($request->phone)!=10){
            return response()->json(['status'=>false,'message'=>'Mobile number must be 10 digits.']);
        }
        $ticket = Ticket::find($request->ticket_id);
        if($ticket){
            if($ticket->canMakePayment()==false){
                return response()->json(['status'=>false,'message'=>'You are not allowed for the payment']);
            }
        }
        $param = $request->post();

        $paymentSetting = PaymentSetting::where('gateway','easebuzz')
        ->where('mode',$request->mode)
        ->first();
        $key = $paymentSetting->key_id;
        $salt = $paymentSetting->key_secret;
        $env = $paymentSetting->mode;

        $payebz = new PayWithEasebuzzLib($key, $salt, $env);
        $result = $payebz->initiatePaymentAPI($param, false);
        $payment = Payment::create([
            'gateway' => 'easebuzz',
            'gateway_mode' => $request->mode,
            'ticket_id' => $ticket->id,
            'order_id' => $param['txnid'],
            'contact' => $request->phone,
            'payment_id' => $param['txnid'],
            'amount' => $ticket->fare,
            'receipt' => 'Online',
            'response' => json_encode($param), // Store full payment response as JSON
        ]);
        
        $result = json_decode($result);
        $result->pkey = $ticket->id;
        $result = json_encode($result);
        return response()->json($result);
    }
    public function ebz_savePaymentResponse(Request $request)
    {
        $param = $request->all();
        // $param will contain the response provided to you by Easebuzz. You can handle your success and failed scenarios based on the response.
        
        if($param['status']=='success'){
            $payment = Payment::where('order_id',$param['txnid']);
            $updateData = [
                'payment_id' => $param['easepayid'],
                'status' => 'success',
            ];
            $payment->update($updateData);
            $ticket = Ticket::find($payment->first()->ticket_id);
            if($ticket){
                $ticket->payment_id = $payment->first()->id;
                $ticket->save();
            }
            return response()->json(['message'=>'success']);
        }else{
            return response()->json(['error'=>$param['error']]);
        }
    }
    public function ebz_response(Request $request)
    {
        $ticket = Ticket::find($request->id);
        if($ticket){
            $ticket->payment_id = $request->id;
            $ticket->save();
        }
        return view('payments.easebuzz.ebz_response', compact('payment'));
    }

    // New method to get the payment status
    public function getPaymentStatus(Request $request)
    {
        $txnid = $request->input('txnid');
        $payment = Payment::where('order_id', $txnid)
        ->first();

        if (!$payment) {
            return response()->json(['status' => 0, 'data' => 'Transaction not found'], 404);
        }

        $paymentSetting = PaymentSetting::where('gateway','easebuzz')
        ->where('mode',$payment->gateway_mode)
        ->first();
        $key = $paymentSetting->key_id;
        $salt = $paymentSetting->key_secret;
        $env = $paymentSetting->mode;

        $payebz = new PayWithEasebuzzLib($key, $salt, $env);

        // Retrieve the payment record from the database

        // Ensure amount is formatted to two decimal places
        $formattedAmount = number_format((float) $payment->amount, 2, '.', '');

        $param = [
            'txnid' => $txnid,
            'phone' => $payment->phone,
            'email' => $payment->email,
            'amount' => $formattedAmount, // Use the correctly formatted amount
        ];

        // Call transactionAPI to get the payment status
        $result = $payebz->transactionAPI($param);
        $resultArray = json_decode($result, true); // Convert the JSON response to an array
        
        // If the API call is successful and returns data, save the payment response
        if ($resultArray && isset($resultArray['status']) && ($resultArray['status'] === 1 || $resultArray['status'] == 'true')) {
            $request->merge($resultArray['msg']); // Merge the response data into the request object
            $this->ebz_savePaymentResponse($request); // Call the save payment response method
            $request->merge(['id'=>$payment->id]); // Merge the response data into the request object
            $this->ebz_response($request); // Call the response handling method
        }

        return response()->json($resultArray);
    }

    // Refund function for ticket cancellation
    public function refundPayment(Request $request)
    {
        // Find the ticket and payment details
        $ticket = Ticket::find($request->id);
        if (!$ticket) {
            return back()->with('error','Ticket not found');
            // return response()->json(['status' => false, 'message' => 'Ticket not found'], 404);
        }

        $payment = $ticket->payment;

        // Calculate the time difference between cancellation and departure
        $timeDifference = $this->cancelTicketValication($request->id);

        // Determine if the cancellation is within or outside 2 hours of departure
        if ($ticket->canTicketBeCancel()) {
            $refundAmount = $payment->amount * 0.80; // Deduct 20%
            $refundAmount = number_format((float)$refundAmount, 2, '.', ''); 
        } elseif ($timeDifference <= 120 && $timeDifference >= 0) {
            return back()->with('error','No refund available within 2 hours of departure');
        } else {
            return back()->with('error','No refund available after departure');
        }


        if($payment->card_type=='CASH'){
            $payment->update([
                'refund_status' => 'Refunded',
                'refund_amount' => $refundAmount,
            ]);
            $ticket->delete();
            return back()->with('success','Refund processed successfully');
        }

        $paymentSetting = PaymentSetting::where('gateway','easebuzz')
        ->where('mode','prod')
        ->first();
        $key = $paymentSetting->key_id;
        $salt = $paymentSetting->key_secret;
        $env = $paymentSetting->mode;

        $payebz = new PayWithEasebuzzLib($key, $salt, $env);
        $paid_amount = number_format((float)$payment->amount, 2, '.', ''); 

        $refundParams = [
            'txnid' => $payment->txnid,
            'easepayid' => $payment->easepayid,
            'refund_amount' =>  $refundAmount,
            'amount' => $paid_amount,
            'email' => $ticket->user->email,
            'phone' => website_setting('payment_gateway_contact'),
        ];
        // dd($refundParams);

        // Initiate refund API (replace with actual refund API call if available)
        $refundResponse = $payebz->refundAPI($refundParams);
        $array_response = json_decode($refundResponse);
        // dd($array_response);
        $status = true;

        // if ($array_response && $array_response->status) {
        if ($status) {
            // Update payment with refund status and amount
            $payment->update([
                'refund_status' => 'Refunded',
                'refund_amount' => $refundAmount,
                // 'status' => 'Refunded', // Update payment status
            ]);

            // Mark the ticket as canceled (optional)
            $ticket->delete();
            return back()->with('success','Refund processed successfully');
            // return response()->json(['status' => true, 'message' => 'Refund processed successfully']);
        } else {
            return back()->with('error',$array_response->reason);
            // return response()->json(['status' => false, 'message' => 'Refund failed']);
        }
    }

}
