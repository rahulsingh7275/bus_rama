<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusStopage extends Model
{
    use HasFactory;
    protected $fillable = ['bus_id','name'];
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}
