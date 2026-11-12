@php
$paymentSetting = \App\Models\PaymentSetting::where('gateway','easebuzz')
        ->where('mode',Request()->mode)
        ->first();
@endphp

@if($paymentSetting)

<div class="payment-gateway-box" id="easebuzz-payment-btn" style="float: left;">
    <form>
        @csrf

        <!-- Payment Success Modal -->
        <div class="modal fade" id="payment_success_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center" style="background-color: #f8faf7;">
                        <img src="{{asset('auth_asset/images/payment-success.gif')}}" alt="" style="width: 100px;">
                        <br/>
                        <h5>Payment success</h5>
                    </div>
                    <div class="modal-footer text-center" style="background-color: #f8faf7;">
                        <span style="text-align: center;display: block;width: 100%;">Please wait...</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Payment Failed Modal -->
        <div class="modal fade" id="payment_failed_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center" style="background-color: #f8faf7;">
                        <img src="{{asset('auth_asset/images/payment-failed.gif')}}" alt="" style="width: 100px;">
                        <br/>
                        <h5>Your payment is failed</h5>
                    </div>
                    <div class="modal-footer text-center" style="background-color: #f8faf7;">
                        <span style="text-align: center;display: block;width: 100%;">Please wait...</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div id='loading1' style="max-width: 300px;"></div>
        <div class="mandatory-data">
            <input type="hidden" id="txnid" class="txnid" name="txnid" value="{{date('dMY').rand(11111111,999999999)}}" placeholder="T31Q6JT8HB">
            <input type="hidden" id="amount" class="amount" name="amount" value="{{$ticket->fare}}" placeholder="125.25">
            <input type="hidden" id="firstname" class="firstname" name="firstname" value="{{Auth::user()->name}}" placeholder="Easebuzz Pvt. Ltd.">
            <input type="hidden" id="email" class="email" name="email" value="{{Auth::user()->email}}" placeholder="initiate.payment@easebuzz.in">
            <input type="text" class="form-control" name="phone" id="mobile" maxlength="10" placeholder="Mobile Number" required>
            <br>
            <input type="hidden" id="productinfo" class="productinfo" name="productinfo" value="{{website_setting('ticket_prefix').' Payment'}}" placeholder="Apple Laptop">
            <input type="hidden" id="surl" class="surl" name="surl" value="{{url('payment-success')}}" placeholder="http://localhost:3000/response.php">
            <input type="hidden" id="furl" class="furl" name="furl" value="{{url('payment-success')}}" placeholder="http://localhost:3000/response.php">
            <input type="hidden" id="udf1" class="udf1" name="ticket_id" value="{{$ticket->id}}" placeholder="User description1">
        </div>
        <div class="row">
            <div class="col-6">
                <button type="button" class="cmn--btn btn--lg" onclick="onclick_iframe()">Pay Now Rs.{{$ticket->fare}}</button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-warning" onclick="location.reload();">Reload the page if Pay Now button is not working</button>
            </div>
        </div>
    </form> 
</div>

<!-- payment setting code here -->
<script src='https://ebz-static.s3.ap-south-1.amazonaws.com/easecheckout/easebuzz-checkout.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script> 
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script>

function onclick_iframe() {
    $.ajax({
        type: 'POST',
        url: "{{url('easebuzz/initiate_payment_ebz')}}?mode={{$paymentSetting->mode}}",
        dataType: "JSON",
        data: $('form').serialize(),
        success: function (response) {
            if(response['status']==false){
                alert(response['message']);
                return false;
            }
            var json_response = JSON.parse(response);
            // console.log(json_response['status']);
            // console.log(json_response['key']);
            // console.log(json_response['access_key']);
            if (json_response['status']==1){
                var easebuzzCheckout = new EasebuzzCheckout(json_response['key'],"{{$paymentSetting->mode}}")
                var options = {
                    access_key: json_response['access_key'] , // access key received via Initiate Payment
                    onResponse: (response_data) => {
                    // document.getElementById('loading1').innerText=JSON.stringify(response_data);
                    response_data['_token'] = "{{ csrf_token() }}";
                    console.log(response_data);
                    // Send the response data to the server for saving
                    $.ajax({
                            type: 'POST',
                            url: "{{ route('ebz_savePaymentResponse') }}?mode={{$paymentSetting->mode}}",
                            data: response_data,
                            success: function(response) {
                                setTimeout(function() {
                                     window.location.href = "{{url('payment-success')}}/"+json_response['pkey'];
                                }, 2000);
                                if(response_data['status'] == 'success'){
                                    $('#payment_success_modal').modal('show');
                                }else{
                                    $('#payment_failed_modal').modal('show');
                                }
                                console.log('Payment response saved successfully.');
                            },
                            error: function(err) {
                                console.error('Error saving payment response:', err);
                            }
                        });
                    },
                    theme: '#123456' // color hex
                    }
                    easebuzzCheckout.initiatePayment(options);
            }
            else {loading
                document.getElementById('loading1').innerText=JSON.stringify(json_response);
                alert(JSON.stringify(json_response));
            } 
        }
    });
}
</script>

@endif