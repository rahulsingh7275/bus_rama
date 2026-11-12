@php
$ticket = \App\Models\Ticket::find($ticket->id);
$paymentSetting = \App\Models\PaymentSetting::where('gateway','cashfree')
        ->where('mode',Request()->mode)
        ->first();

@endphp

<div class="payment-gateway-box" id="easebuzz-payment-btn" style="float: left;">
   
    <form action="{{ route('cashfree.store',$ticket->id) }}" method="POST" name="laravel9-cashfree-integration">
        @csrf
        <input type="hidden" class="form-control" name="mode" value="{{$paymentSetting->mode}}" required>
        <input type="hidden" class="form-control" name="key_id" value="{{$paymentSetting->key_id}}" required>
        <input type="hidden" class="form-control" name="key_secret" value="{{$paymentSetting->key_secret}}" required>
        <div class="form-floating py-2 hidden" hidden>
            <input type="hidden" class="form-control" name="name" id="name" value="{{$ticket->user->name}}" placeholder="name" readonly>
            <label for="name">Name</label>
        </div>
        <div class="form-floating py-2 hidden" hidden>
            <input type="hidden" class="form-control" name="email" id="email" value="{{$ticket->user->email}}" placeholder="email" readonly>
            <label for="email">Email Address</label>
        </div>
        <label for="mobile">Mobile number must be 10 digits</label>
        <div class="form-floating py-2">
            <input type="text" class="form-control" name="mobile" id="mobile" value="{{ old('mobile') }}" maxlength="10" placeholder="Mobile Number" required>
            <label for="mobile">Mobile Number</label>
        </div>
        <div class="form-floating py-2 hidden" hidden>
            <input type="hidden" class="form-control" name="amount" id="amount" value="{{$ticket->fare}}" placeholder="amount" readonly>
            <label for="amount">Amount</label>
        </div>
        <button class="cmn--btn btn--lg" type="submit">Pay Now Rs.{{$ticket->fare}}</button>
    </form>

</div>