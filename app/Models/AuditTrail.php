<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    protected $fillable = [
        'event',
        'table_name',
        'record_id',
        'old_data',
        'new_data',
        'user_id',
        'action_time'
    ];

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
    ];
}
