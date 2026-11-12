<?php
namespace App\Http\Traits;

use App\Models\Bus;
use App\Models\Ticket;
use App\Models\BusOffDay; // Import the BusOffDay model
use Carbon\Carbon;

trait TicketTrait {
    
    public function busTicketCountByDate($bus_id, $travel_date) {
        $formatted_travel_date = Carbon::createFromFormat('d/m/Y', $travel_date)->format('Y-m-d');
        $tickets = Ticket::where('bus_id', $bus_id)
        ->whereDate('travel_date', $formatted_travel_date)
        ->whereNotNull('payment_id')
        ->sum('passenger_count');
        return $tickets;
    }
    public function busTicketSleeperCountByDate($bus_id, $travel_date) {
        $formatted_travel_date = Carbon::createFromFormat('d/m/Y', $travel_date)->format('Y-m-d');
        $tickets = Ticket::where('bus_id', $bus_id)
        ->whereDate('travel_date', $formatted_travel_date)
        ->whereNotNull('payment_id')
        ->sum('sleeper_passenger_count');
        return $tickets;
    }
    public function busTicketNonSleeperCountByDate($bus_id, $travel_date) {
        $formatted_travel_date = Carbon::createFromFormat('d/m/Y', $travel_date)->format('Y-m-d');
        $tickets = Ticket::where('bus_id', $bus_id)
        ->whereDate('travel_date', $formatted_travel_date)
        ->whereNotNull('payment_id')
        ->sum('non_sleeper_passenger_count');
        return $tickets;
    }
    public function cancelTicketValication($id) {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return 0;
        }
    
        $bus = $ticket->bus;
        $currentTime = Carbon::now();
        
        // Combining today's date with the bus's `from_time` to get the full departure time
        $bus_time = $ticket->travel_date . $bus->from_time;
        $departureTime = Carbon::parse($bus_time);
    
        // Calculate the time difference in minutes, returning a negative value if the current time is after the departure time
        $timeDifference = $currentTime->diffInMinutes($departureTime, false);
    
        return $timeDifference; // Will output negative if bus has already departed, positive if still in the future
    }
    

}
