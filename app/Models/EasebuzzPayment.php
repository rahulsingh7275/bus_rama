<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EasebuzzPayment extends Model
{
    use HasFactory, SoftDeletes;

    // Explicitly define the table name if necessary
    protected $table = 'easebuzz_payments';

    // Define the fillable fields to allow mass assignment
    protected $fillable = [
        'ticket_id',
        'sub_merchant_id',
        'txnid',
        'email',
        'firstname',
        'phone',
        'productinfo',
        'amount',
        'easepayid',
        'net_amount_debit',
        'error_Message',
        'cash_back_percentage',
        'deduction_percentage',
        'mode',
        'bank_name',
        'card_type',
        'status',
        'refund_status',
        'refund_amount',
        'transection_date',
    ];

    // Define the relationship with the Ticket model
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // Cast attributes to their respective types
    protected $casts = [
        'amount' => 'float',
        'net_amount_debit' => 'float',
        'cash_back_percentage' => 'float',
        'deduction_percentage' => 'float',
        'transection_date' => 'datetime',
    ];
}
