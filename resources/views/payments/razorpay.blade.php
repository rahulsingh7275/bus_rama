@php
    $paymentSetting = \App\Models\PaymentSetting::where('gateway','razorpay')
        ->where('mode',Request()->mode)
        ->first();
    $key_id = $paymentSetting->key_id;
    $key_secret = $paymentSetting->key_secret;
    $api = new \Razorpay\Api\Api($key_id, $key_secret);

    // Amount in INR paisa (e.g., 100 INR is 10000 paisa)
    $order = $api->order->create([
        'receipt'         => 'order_rcptid_11',
        'amount'          => $ticket->fare*100, // Amount in paisa
        'currency'        => 'INR',
        'payment_capture' => 1
    ]);
@endphp
<style>
    .razorpay-payment-button{
        text-transform: uppercase;
        font-size: 14px;
        padding: 12px 25px;
        border-color: var(--secondary-color);
        background: var(--main-color);
        color: #fff;
        position: relative;
        border-radius: 5px;
        overflow: hidden;
        font-weight: 600;
        border: 1px solid transparent;
    }
</style>
<div class="payment-gateway-box" id="easebuzz-payment-btn" style="float: left;">
<form action="{{url('razorpay-callback')}}/{{$ticket->id}}?mode={{$paymentSetting->mode}}" method="POST">
    @csrf
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="{{$key_id}}"
        data-amount="{{$ticket->fare*100}}" 
        data-currency="INR"
        data-order_id="{{ $order->id }}"
        data-buttontext="PAY NOW Rs.{{$ticket->fare}}"
        data-name="Bus Ticket Booking"
        data-description="Payment for bus tickets"
        data-theme.color="#900990">
    </script>
</form>
</div>