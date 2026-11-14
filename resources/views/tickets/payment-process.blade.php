@extends('layouts.app')

@section('content')
@php 
$availableTickets = $bus->availableTickets(date('d/m/Y',strtotime($ticket->travel_date)),$ticket->id);
$payment_setting_check = \App\Models\PaymentSetting::first();
@endphp

<style>
blockquote{
    border-left: 3px dotted;
    padding-left: 10px;
    margin-top: 15px;
}
.pickup_point,
.drop_point{
    position: relative;
}
.pickup_point::before,
.drop_point::before{
    position: absolute;
    content: '';
    border: 1px solid #000;
    height: 12px;
    width: 12px;
    background: black;
    left: -18px;
    top: 5px;
    border-radius: 50%;
}
.ticket-item-new {
    padding: 25px;
    background: #fff;
    margin-bottom: 15px;
    border-radius: 5px;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}
.ticket_logo{
    max-width: 150px;
}
@media print {
    .header-top,
    .ticket-search-bar,
    .scrollToTop,
    .footer-section,
    .payment_section,
    .header-bottom{
        display: none !important;
    }
    .ticket-section,
    .bus-search-header{
        padding: 0px !important;
    }
    .container{
        max-width: 100% !important;
    }
    .g-5, .gy-5{
        --bs-gutter-y : 0px;
    }
}
hr{
    height: 2px;
    background: #000;
}
</style>
<main>
        <div class="ticket-search-bar bg_img padding-top" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) left center;">
            <div class="container">
                <div class="bus-search-header">
                @if($ticket->payment)
                <h4 class="text-center">Ticket Details</h4>
                @else
                <h4 class="text-center">Ticket Details & Process to Payment</h4>
                @endif
                </div>
            </div>
        </div>
        <!-- Ticket Search Starts -->
        <!-- Ticket Section Starts Here -->
        <section class="ticket-section padding-bottom section-bg">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-sm-12 col-md-12 col-lg-12" style="margin: 0px;">
                        <div class="ticket-wrapper">
    
                            <div class="ticket-item-new">

                                <div class="row">
                                    
                                    <div class="col-md-6">

                                        <div class="ticket-item-inner">
                                            <img src="{{ asset('storage/' . website_setting('logo')) }}" class="ticket_logo" alt="">
                                            <h6 class="bus-name"><code>Ticket No. #{{$ticket->ticket_no}}</code></h6>
                                            <h6 class="bus-name"><code>Booking Date {{date('d/m/Y h:i A',strtotime($ticket->created_at))}}</code></h6>
                                            <h6 class="bus-name"><code>Travel Date {{date('d/m/Y',strtotime($ticket->travel_date))}} {{date('h:i A',strtotime($bus->from_time))}}</code></h6>
                                            <h5 class="bus-name">Boarding & Dropping ({{$bus->name}})</h5>
                                            <span>Journy Duration : {{$bus->travel_duration}}
                                                (@if($bus->stopages->count()>0)
                                                {{$bus->stopages->count()}} Stop point
                                                @else
                                                <code>No stop</code>
                                                @endif)
                                            </span>
                                            <span class="ratting"><i class="las la-bus"></i>{{ $bus->bus_type }}</span>
                                            <span>
                                                <strong>Facilities - </strong>
                                                <span class="facilities">{{$bus->facilites}}</span>
                                            </span>
                                            <blockquote>
                                                <h6 class="pickup_point">{{$bus->fromStation->name}} <span style="float: right;color:green;">{{date('h:i A',strtotime($bus->from_time))}} ({{date('d/m/Y',strtotime($ticket->travel_date))}})</span></h6>
                                            @if($ticket->pickup)
                                            <span class="d-block"><strong>Pickup Location:</strong> {{$ticket->pickup->name}} - {{$ticket->pickup->address}}</span>
                                            @else
                                            <span class="d-block text-muted"><strong>Pickup Location:</strong> Not specified</span>
                                            @endif
                                            @if($bus->stopages->count()>0)
                                                
                                                <ul style="padding: 10px 15px;">
                                                    @foreach($bus->stopages as $index=>$stopage)
                                                    <li class="text-success">Stop {{++$index}}. {{$stopage->name}}</li>
                                                    @endforeach
                                                </ul>
                                                @else
                                                <ul style="padding: 10px 15px;">
                                                    <li><code>No stop</code></li>
                                                </ul>
                                                @endif
                                                <h6 class="drop_point">{{$bus->toStation->name}} <span style="float: right;">{{date('h:i A',strtotime($bus->to_time))}}</span></h6>
                                                
                                                @if($ticket->drop)
                                                <span class="d-block"><strong>Drop Location:</strong> {{$ticket->drop->name}} - {{$ticket->drop->address}}</span>
                                                @else
                                                <span class="d-block text-muted"><strong>Drop Location:</strong> Not specified</span>
                                                @endif
                                            </blockquote>
                                            
                                        </div>
                                        <div class="row alert alert-danger">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-6"><h6>Passenger Name</h6></div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-6"><h6 style="text-align: right;">{{$ticket->passenger_name}}</h6></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-6"><h6>Number of Passengers</h6></div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-6"><h6 style="text-align: right;">
                                                @if($ticket->sleeper_passenger_count>0 && $ticket->non_sleeper_passenger_count==0)
                                                    {{$ticket->sleeper_passenger_count}} Sleeper
                                                @elseif($ticket->sleeper_passenger_count==0 && $ticket->non_sleeper_passenger_count>0)
                                                    {{$ticket->non_sleeper_passenger_count}}
                                                @elseif($ticket->sleeper_passenger_count>0 && $ticket->non_sleeper_passenger_count>0)
                                                    {{$ticket->passenger_count}} 
                                                    ({{$ticket->sleeper_passenger_count}} Sleeper + 
                                                    {{$ticket->non_sleeper_passenger_count}} Non Sleeper)
                                                @endif
                                            </h6></div>
                                        </div>
                                        <div class="ticket-item-footer">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-12"><h6>Fare Details</h6></div>
                                                <div class="col-xl-8 col-lg-8 col-md-8 col-8" style="margin-top: 15px;">
                                                    <h6>Amount 
                                                        <!-- <code>(Rs.{{$bus->fare}}/Passenger)</code> -->
                                                    </h6>
                                                    <span class="bus-info">Taxes will be calculated during payment</span>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-4" style="margin-top: 15px;"><h6 style="text-align: right;">Rs.{{$ticket->fare}}</h6></div>
                                            </div>
                                        </div>
                                        @if($ticket->payment)
                                        <div class="ticket-item-footer">
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                                                    <h6>Payment Status</h6>
                                                    <p>Transaction ID #{{$ticket->payment->payment_id}}</p>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                                                    <h6 style="text-align: right;">
                                                        @if($ticket->deleted_at)
                                                            <span class="text-danger" style="font-size: 15px;">Ticket Cancelled <br> Payment Refunded</span>
                                                        @else
                                                            PAID <img src="{{asset('auth_asset/images/payment-success.gif')}}" style="width: 30px;" alt="">
                                                        @endif
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="ticket-item-footer">
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-6"><h6>Payment Status</h6></div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                                                    <h6 style="text-align: right;">
                                                        NOT PAID <img src="{{asset('auth_asset/images/payment-failed.gif')}}" style="width: 50px;" alt="">
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="ticket-item-footer">
                                            <br>
                                            <div class="row">
                                                <div class="col-12"><h6>Contact Details</h6></div>
                                                <div class="col-md-4 col-xs-12 col-sm-12">
                                                    <strong style="color:#424248;">Our Address</strong>
                                                    <br>
                                                    {{website_setting('company_address')}}
                                                </div>
                                                <div class="col-md-4 col-xs-12 col-sm-12">
                                                    <strong style="color:#424248;">Call Us</strong>
                                                    <br>
                                                    {{website_setting('company_contact')}}
                                                </div>
                                                <div class="col-md-4 col-xs-12 col-sm-12">
                                                    <strong style="color:#424248;">Email Us</strong>
                                                    <br>
                                                    {{website_setting('company_email')}}
                                                </div>
                                            </div>
                                            <hr>
                                        </div>

                                    </div>
                                    @if($ticket->deleted_at)
                                    <div class="col-md-6 payment_section">
                                        <h5 class="text-danger bus-name">Ticket Cancelled & Payment Refunded</h5>
                                    </div>
                                    @elseif($ticket->payment)
                                    <div class="col-md-6 payment_section">
                                        <h5 class="bus-name">Scan QR for for ticket details</h5>
                                        <hr>

                                        <div class="qr_container">
                                        <img src="{{ route('ticket.qrcode', $ticket->id) }}" alt="QR Code">
                                        </div>
                                        <hr>
                                        <!-- <a href="" class="btn btn-dark">Click here to view the payment details</a> -->
                                        <button class="btn btn-success" onclick="return window.print()">Print Ticket</button>
                                        
                                    </div>
                                    @else
                                    <div class="col-md-6">
                                        @if(is_numeric($availableTickets) > 0)
                                            @if($ticket->canMakePayment()==true)
                                                <h5 class="bus-name">Payment Options</h5>
                                                <hr>
                                                <ul>
                                                    @if(Auth::user()->role!='user')
                                                    <li>
                                                        <a href="{{Request::url()}}?gateway=cash&mode=prod">
                                                            <input type="radio" class="form-check-input" id="radio1" name="payment_mothod" value="cash" onclick="$(this).closest('a')[0].click();" @if(Request()->gateway == 'cash') checked @endif><strong> PAY WITH CASH</strong>
                                                            <label class="form-check-label" for="radio1"></label>
                                                        </a>
                                                    </li>
                                                    @endif
                                                    @foreach($payments as $payment)
                                                    <li>
                                                        <a href="{{Request::url()}}?gateway={{$payment->gateway}}&mode={{$payment->mode}}">
                                                            <input type="radio" class="form-check-input" id="radio2" name="payment_mothod" value="{{$payment->gateway}}" onclick="$(this).closest('a')[0].click();" @if($payment->gateway==Request()->gateway && $payment->mode==Request()->mode) checked @endif><strong> PAY WITH {{strtoupper($payment->gateway)}}</strong>
                                                            <label class="form-check-label" for="radio2"></label>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                <hr>
                                                <!-- Buttons for each payment method -->
                                                @if(Auth::user()->role!='user')
                                                    @if(Request()->gateway && Request()->gateway=='cash')
                                                        <form action="{{route('cash-payment',$ticket->id)}}" method="post">
                                                            @csrf
                                                            <input type="text" class="form-control cash-payment-btn" name="mobile" id="mobile" value="{{ old('mobile') }}" maxlength="10" placeholder="Mobile Number" required>
                                                            <br>
                                                            <button type="submit" class="cmn--btn btn--lg cash-payment-btn">Proceed to Pay with Cash</button>
                                                        </form>
                                                    @endif
                                                @endif

                                                @if(Request()->gateway && Request()->gateway!='cash')
                                                    @include('payments.'.Request()->gateway)
                                                @endif

                                            @endif
                                        @else
                                            <h5><span class="text-danger">{!!$availableTickets!!}</span></h5>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                

                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
    
    
@section('scripts')
<script>
$('document').ready(function(){
    $('html, body').animate({
        scrollTop: $(".bus-search-header").first().offset().top
    }, 2000);
});

</script>
@endsection
