<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusStation extends Model
{
    use HasFactory;
    protected $fillable = ['name','address'];

    public function busPickupDropPoints()
    {
        return $this->hasMany(BusPickupDropPoint::class, 'bus_station_id');
    }
}
