<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusPickupDropPoint extends Model
{
    use HasFactory;

    protected $fillable = ['bus_station_id', 'name', 'address'];

    public function busStation()
    {
        return $this->belongsTo(BusStation::class);
    }
}
