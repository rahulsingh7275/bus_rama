<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Traits\TicketTrait;
use Illuminate\Support\Facades\Auth;

class Ticket extends Model
{
    use TicketTrait;
    use HasFactory, SoftDeletes; // Add SoftDeletes trait

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ticket_no',
        'user_id',
        'bus_id',
        'passenger_name',
        'sleeper_passenger_count',
        'non_sleeper_passenger_count',
        'passenger_count',
        'from_station_id',
        'to_station_id',
        'pickup_id',
        'drop_id',
        'travel_date',
        'fare',
        'allotted_seat_number',
        'payment_id',
        'lat',
        'long',
        'ip_address',
    ];

    // Relationships
    public function fromStation()
    {
        return $this->belongsTo(BusStation::class, 'from_station_id');
    }

    public function toStation()
    {
        return $this->belongsTo(BusStation::class, 'to_station_id');
    }

    public function pickup()
    {
        return $this->belongsTo(BusPickupDropPoint::class, 'pickup_id');
    }

    public function drop()
    {
        return $this->belongsTo(BusPickupDropPoint::class, 'drop_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }
    public function canTicketBeCancel(){
        $timeDifference = $this->cancelTicketValication($this->id);
        if($this->payment_id==null){
            return false;
        }
        if ($timeDifference > 120) {
            if(Auth::user()->role=='admin' || Auth::user()->id==$this->user_id){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function canMakePayment(){
        $availableTickets = $this->bus->availableTickets(date('d/m/Y',strtotime($this->travel_date)),$this->id);
        $timeDifference = $this->cancelTicketValication($this->id);
        if (is_numeric($availableTickets) > 0 && $timeDifference > 0 && $this->payment_id==null) {
            if(Auth::user()->role=='admin' || Auth::user()->id==$this->user_id){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}
