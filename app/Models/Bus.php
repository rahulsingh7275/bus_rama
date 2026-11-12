<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\TicketTrait;
use Illuminate\Support\Facades\Log;

class Bus extends Model
{
    use HasFactory, TicketTrait;

    protected $fillable = [
        'name',
        'number',
        'route_name',
        'from_station_id',
        'to_station_id',
        'from_time',
        'to_time',
        'travel_duration',
        'number_of_sleeper_seats',
        'number_of_non_sleeper_seats',
        'number_of_seats',
        'sleeper_fare',
        'fare',
        'bus_type',
        'facilites',
    ];

    protected static function booted()
    {
        static::updated(function ($bus) {
            Log::info('Bus model updated');
        });

        static::deleting(function ($bus) {
            Log::info('Bus model deleting');
        });
    }

    // Relationships
    public function fromStation()
    {
        return $this->belongsTo(BusStation::class, 'from_station_id');
    }

    public function toStation()
    {
        return $this->belongsTo(BusStation::class, 'to_station_id');
    }

    public function stopages()
    {
        return $this->hasMany(BusStopage::class, 'bus_id');
    }

    public function stopage()
    {
        return $this->belongsTo(BusStopage::class, 'id', 'bus_id');
    }

    public function offDays()
    {
        return $this->hasMany(BusOffDay::class);
    }

    // Check availability considering bus off days
    public function availableTickets($travel_date,$ticket_id=0)
    {
        $ticket = Ticket::find($ticket_id);
        // Check if the given date is an off day
        $formatted_travel_date = \Carbon\Carbon::createFromFormat('d/m/Y', $travel_date)->format('Y-m-d');
        $offDay = $this->offDays()->where('off_date', $formatted_travel_date)->exists();
        
        if ($offDay) {
            // return 'Bus is not available on this date due to an off day.';
            return "Off Day";
        }


        // Check if the current date and bus time have exceeded
        // Convert travel date from 'd/m/Y' to 'Y-m-d' format
        $formatted_travel_date = \Carbon\Carbon::createFromFormat('d/m/Y', $travel_date)->format('Y-m-d');
        
        // Combine travel date and bus departure time (`from_time`) for comparison
        $bus_travel_datetime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $formatted_travel_date . ' ' . $this->from_time);
    
        // Get the current time in 'Asia/Kolkata' timezone
        $current_datetime = \Carbon\Carbon::now('Asia/Kolkata');
    
        // Check if bus travel date and time have already passed
        if ($current_datetime->greaterThan($bus_travel_datetime)) {
            return "Date & Time Exceeded";
        }



        // Calculate available tickets if the bus is operating
        $tickets1 = $this->busTicketSleeperCountByDate($this->id, $travel_date);
        $tickets2 = $this->busTicketNonSleeperCountByDate($this->id, $travel_date);
        $tickets = ($tickets1 + $tickets2);
        $availableTickets = ($this->number_of_sleeper_seats + $this->number_of_non_sleeper_seats) - $tickets;
        if($availableTickets<0){
            return ('Invalid total ticket count'.$ticket);
        }
        if($ticket){
            if($availableTickets < $ticket->passenger_count){
                return "You have ".$availableTickets." Available Seats.<br>But you are trying to book ".$ticket->passenger_count." tickets.";
            }
        }
        return $availableTickets > 0 ? $availableTickets : "Ticket Fully Booked";
        // return $availableTickets > 0 ? $availableTickets.' Available Seats' : 'No available tickets';
    }
    public function availableTicketsForSleeper($travel_date,$ticket_id=0)
    {
        $ticket = Ticket::find($ticket_id);
        // Calculate available tickets if the bus is operating
        $tickets = $this->busTicketSleeperCountByDate($this->id, $travel_date);
        $availableTickets = $this->number_of_sleeper_seats - $tickets;
        if($availableTickets<0){
            return ('Invalid sleeper ticket count'.$ticket);
        }
        return $availableTickets;
    }
    public function availableTicketsForNonSleeper($travel_date,$ticket_id=0)
    {
        $ticket = Ticket::find($ticket_id);
        // Calculate available tickets if the bus is operating
        $tickets = $this->busTicketNonSleeperCountByDate($this->id, $travel_date);
        $availableTickets = $this->number_of_non_sleeper_seats - $tickets;
        if($availableTickets<0){
            return ('Invalid non sleeper ticket count'.$ticket);
        }
        return $availableTickets;
    }
}
