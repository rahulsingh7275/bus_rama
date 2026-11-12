<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusOffDay extends Model
{
    use HasFactory;

    protected $fillable = ['bus_id', 'off_date'];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}