<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\RazorpayPayment;
use App\Models\Ticket;
use Razorpay\Api\Api;
use Illuminate\Http\Request;

class RazorpayController extends Controller
{

    public function paymentCallback(Request $request)
    {
        $input = $request->all();
        $paymentSetting = \App\Models\PaymentSetting::where('gateway','razorpay')
        ->where('mode',$request->mode)
        ->first();
        $key_id = $paymentSetting->key_id;
        $key_secret = $paymentSetting->key_secret;
        $api = new Api($key_id, $key_secret);

        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if($payment && $payment->status=='captured'){
            $ticket = Ticket::find($request->id);
            $payment_data = Payment::create([
                'gateway' => 'razorpay',
                'gateway_mode' => $request->mode,
                'ticket_id' => $request->id,
                'order_id' => $payment->order_id,
                'contact' => $payment->contact,
                'payment_id' => $payment->id,
                'amount' => $payment->amount/100,
                'receipt' => 'Online',
                'status' => 'success',
                'response' => json_encode($ticket), // Store full payment response as JSON
            ]);
            if($ticket && $payment_data){
                $ticket->payment_id = $payment_data->id;
                $ticket->save();
            }
            // Payment success logic here
            return back()->with('success','Payment Successful');
        } else {
            // Payment failure logic here
            return back()->with('error','Payment Verification Failed');
        }
    }
}
