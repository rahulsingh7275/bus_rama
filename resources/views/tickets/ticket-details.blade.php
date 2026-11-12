@extends('layouts.app')

@section('content')
<style>
blockquote {
    border-left: 3px dotted;
    padding-left: 10px;
    margin-top: 15px;
}
.pickup_point,
.drop_point {
    position: relative;
}
.pickup_point::before,
.drop_point::before {
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
</style>

<main>
    <div class="ticket-search-bar bg_img padding-top" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) left center;">
        <div class="container">
            <div class="bus-search-header">
                <h4 class="text-center">Ticket Details</h4>
            </div>
        </div>
    </div>

    @if(Request()->travel_date)
    <section class="ticket-section padding-bottom section-bg">
        <div class="container">
            <div class="row gy-5">
                <div class="col-sm-12 col-md-12 col-lg-12" style="margin: 0px;">
                    <div class="ticket-wrapper">
                        <div class="ticket-item-new">
                            <div class="row">
                                <div class="col-md-6">
                                    <form class="contact-form row gy-3">
                                        <div class="form--group" @if($bus->number_of_sleeper_seats<1) style="display: none;" @endif>
                                            <div class="row">
                                                <div class="col-md-6">Enter Number of Sleeper Seats</div>
                                                <div class="col-md-3">
                                                    <input type="number" name="nss" @if(Request()->nss) value="{{Request()->nss}}" @else value="0" @endif class="form-control nss" min="0" max="{{$bus->availableTicketsForSleeper(Request()->travel_date)}}" onchange="calculateTotalPassengers()" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <code>Max {{$bus->availableTicketsForSleeper(Request()->travel_date)}} Seats</code>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form--group" @if($bus->number_of_non_sleeper_seats<1) style="display: none;" @endif>
                                            <div class="row">
                                                <div class="col-md-6">Enter Number of @if($bus->number_of_sleeper_seats<1) Seats @else Non-Sleeper Seats @endif </div>
                                                <div class="col-md-3">
                                                    <input type="number" name="nnss" @if(Request()->nnss) value="{{Request()->nnss}}" @else value="0" @endif class="form-control nnss" min="0" max="{{$bus->availableTicketsForNonSleeper(Request()->travel_date)}}" onchange="calculateTotalPassengers()" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <code>Max {{$bus->availableTicketsForNonSleeper(Request()->travel_date)}} Seats</code>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form--group">
                                            <div class="row">
                                                <div class="col-md-6">Total Passengers</div>
                                                <div class="col-md-6">
                                                    <input type="number" name="passenger_count" @if(Request()->passenger_count) value="{{Request()->passenger_count}}" @else value="0" @endif class="form-control total_passengers" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form--group">
                                            <div class="row">
                                                <div class="col-md-6">Enter Passenger Name</div>
                                                <div class="col-md-6">
                                                    <input type="text" name="passenger_name" value="{{ Request()->passenger_name }}" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form--group">
                                            <div class="row">
                                                <div class="col-6" style="text-align: LEFT;">
                                                    <a href="{{ url('search-buses') }}?travel_date={{ Request()->travel_date }}" class="btn btn-dark">Back</a>
                                                </div>
                                                <div class="col-6" style="text-align: right;">
                                                    <input type="hidden" name="travel_date" value="{{ Request()->travel_date }}" required>
                                                    <input type="hidden" name="pickup_id" value="{{ Request()->pickup_id }}" required>
                                                    <input type="hidden" name="drop_id" value="{{ Request()->drop_id }}" required>
                                                    <input type="submit" class="btn btn-success">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                </div>

                                <div class="col-md-6">
                                    <div class="ticket-item-inner">
                                        <h5 class="bus-name">Boarding & Dropping ({{ $bus->name }})</h5>
                                        <span>Journey Duration: {{ $bus->travel_duration }}</span>
                                        <span class="ratting">
                                            <i class="las la-bus"></i>{{ $bus->bus_type }}
                                        </span>
                                        <span><strong>Facilities - </strong><span class="facilities">{{ $bus->facilites }}</span></span>
                                        <blockquote>
                                            <h6 class="pickup_point">{{ $bus->fromStation->name }} <span style="float: right;color:green;">{{ date('h:i A', strtotime($bus->from_time)) }} ({{ Request()->travel_date }})</span></h6>
                                            <span class="d-block">Pickup Location: {{ $bus->fromStation->busPickupDropPoints->firstWhere('id', Request()->pickup_id)->name }}</span>

                                            @if($bus->stopages->count() > 0)
                                            <ul style="padding: 10px 15px;">
                                                @foreach($bus->stopages as $index => $stopage)
                                                <li class="text-success">Stop {{ ++$index }}. {{ $stopage->name }}</li>
                                                @endforeach
                                            </ul>
                                            @else
                                            <ul style="padding: 10px 15px;">
                                                <li><code>No stop</code></li>
                                            </ul>
                                            @endif

                                            <h6 class="drop_point">{{ $bus->toStation->name }} <span style="float: right;">{{ date('h:i A', strtotime($bus->to_time)) }}</span></h6>
                                            <span class="d-block">Drop Location: {{ $bus->toStation->busPickupDropPoints->firstWhere('id', Request()->drop_id)->name }}</span>
                                        </blockquote>
                                    </div>
                                    @if((Request()->nss + Request()->nnss) != Request()->passenger_count)
                                    <div class="text-danger">
                                        Invalue Total Passengers 
                                    </div>
                                    @elseif(Request()->travel_date && Request()->passenger_count > 0 && $bus->availableTickets(Request()->travel_date) < Request()->passenger_count)
                                    <div class="text-danger">
                                        Only {!! $bus->availableTickets(Request()->travel_date) !!} Available Seats
                                        <br>
                                        But You are trying to book {{ Request()->passenger_count }} tickets. Please change Number of Passengers.
                                    </div>
                                    @elseif(Request()->passenger_count > 0 && Request()->passenger_count != '')
                                    <div class="row alert alert-danger">
                                        <div class="col-md-6">
                                            <h6>Passenger Name</h6>
                                        </div>
                                        <div class="col-md-6" style="text-align: right;">
                                            <h6>{{ Request()->passenger_name }}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Number of Passengers</h6>
                                        </div>
                                        <div class="col-md-6" style="text-align: right;">
                                            <h6>{{ Request()->passenger_count }}</h6>
                                        </div>
                                    </div>

                                    <div class="ticket-item-footer">
                                        <div class="row">
                                            <div class="col-md-8" style="margin-top: 15px;">
                                                <h6>Amount 
                                                    <!-- <code>(Rs.{{ $bus->fare }}/Passenger)</code> -->
                                                </h6>
                                                <span class="bus-info">Taxes will be calculated during payment.</span>
                                            </div>
                                            <div class="col-md-4" style="margin-top: 15px;">
                                                <h6 style="text-align: right;">Rs.{{ ((Request()->nnss * $bus->fare) + (Request()->nss * $bus->sleeper_fare)) }}</h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ticket-item-footer" style="text-align: right;">
                                        <form action="{{ url('tickets') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="lat" id="lat">
                                            <input type="hidden" name="long" id="long">
                                            <input type="hidden" name="bus_id" value="{{ $bus->id }}" required>
                                            <input type="hidden" name="travel_date" value="{{ Request()->travel_date }}" required>
                                            <input type="hidden" name="pickup_id" value="{{ Request()->pickup_id }}" required>
                                            <input type="hidden" name="drop_id" value="{{ Request()->drop_id }}" required>
                                            <input type="hidden" name="sleeper_passenger_count" value="{{ Request()->nss }}" required>
                                            <input type="hidden" name="non_sleeper_passenger_count" value="{{ Request()->nnss }}" required>
                                            <input type="hidden" name="passenger_count" value="{{ Request()->passenger_count }}" required>
                                            <input type="hidden" name="passenger_name" value="{{ Request()->passenger_name }}" required>
                                            <button type="submit" class="btn btn-danger">PROCEED TO BOOK</button>
                                        </form>
                                    </div>

                                    @else
                                    <div class="ticket-item-footer">
                                        <code>Please Provide Number of Sleeper and Non-Sleeper Seats</code>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</main>

<script>
navigator.geolocation.getCurrentPosition(function(position) {
    document.getElementById('lat').value = position.coords.latitude;
    document.getElementById('long').value = position.coords.longitude;
});

function calculateTotalPassengers() {
    let sleeperSeats = parseInt($('.nss').val()) || 0;
    let nonSleeperSeats = parseInt($('.nnss').val()) || 0;
    let totalPassengers = sleeperSeats + nonSleeperSeats;
    if (totalPassengers > "{{$bus->availableTickets(Request()->travel_date)}}") {
        alert('You can book a maximum of 6 passengers.');
        $('.nss').val(0);
        $('.nnss').val(0);
        totalPassengers = 0;
    }
    $('.total_passengers').val(totalPassengers);
}
</script>

@endsection
