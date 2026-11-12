@extends('layouts.app')

@section('content')

<main>
        <div class="ticket-search-bar bg_img padding-top" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) left center;">
            <div class="container">
                <div class="bus-search-header">
                    <h4 class="text-center">Search buses</h4>
                    <br>
                    <form class="ticket-form">
                        <!-- <div class="col-md-6">
                            <div class="form--group">
                                <i class="las la-location-arrow"></i>
                                <select class="form--control select2" name="pickup">
                                    <option value="">Pickup Point</option>
                                    <option value="1">Kansas</option>
                                    <option value="2">Dallas</option>
                                    <option value="3">Wichita</option>
                                    <option value="4">Emi Davenport</option>
                                    <option value="5">Echo Bass</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form--group">
                                <i class="las la-map-marker"></i>
                                <select name="destination" class="form--control select2">
                                    <option value="">Dropping Point</option>
                                    <option value="1">Kansas</option>
                                    <option value="2">Dallas</option>
                                    <option value="3">Wichita</option>
                                    <option value="4">Emi Davenport</option>
                                    <option value="5">Echo Bass</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form--group">
                                    <i class="las la-calendar-check"></i>
                                    <input type="text"
                                            class="form--control date-range"
                                            name="travel_date"
                                            placeholder="Departure Date"
                                            autocomplete="off" @if(Request()->travel_date) value="{{Request()->travel_date}}"@endif />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form--group">
                                    <button class="w-100 btn btn--base">Find Buses</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                        @if(Request()->travel_date)
                            @if(website_setting('payment_gateway')=='Website setting is required')
                            <div class="ticket-item">
                                <div class="ticket-item-inner" style="text-align: center;">
                                    <h5><code>Ticket can not be booked. Please contact to admin</code></h5>
                                </div>
                            </div>
                            @else
                                @foreach($buses as $bus)
                                <div class="ticket-item">
                                        <div class="ticket-item-inner">
                                            <h5 class="bus-name" style="max-width: 250px;">{{ $bus->name }}</h5>
                                            <!-- <span class="bus-info">Seat Layout -  2 x 2</span> -->
                                            
                                            <span class="bus-info"
                                                title="
                                                @if($bus->stopages->count()>0)
                                                    {{implode(', ',$bus->stopages->pluck('name')->toArray())}}
                                                @endif"
                                            >
                                                @if($bus->stopages->count()>0)
                                                {{$bus->stopages->count()}} Stop point
                                                @else
                                                No stop
                                                @endif
                                            </span>
                                            <span class="ratting"><i class="las la-bus"></i>{{ $bus->bus_type }}</span>
                                        </div>
                                        <div class="ticket-item-inner travel-time">
                                            <div class="bus-time">
                                                <p class="time">{{ date('h:i A',strtotime($bus->from_time)) }}</p>
                                                <p class="place" title="{{$bus->fromStation->name}}">{{$bus->fromStation->name}}</p>
                                                <p class="place" title="{{$bus->fromStation->address}}">({{ substr($bus->fromStation->address,0,15) }}...)</p>
                                            </div>
                                            <div class=" bus-time">
                                                <i class="las la-arrow-right"></i>
                                                <p>{{ $bus->travel_duration }}</p>
                                            </div>
                                            <div class=" bus-time">
                                                <p class="time">{{ date('h:i A',strtotime($bus->to_time)) }}</p>
                                                <p class="place" title="{{$bus->toStation->name}}">{{$bus->toStation->name}}</p>
                                                <p class="place" title="{{$bus->toStation->address}}">({{ substr($bus->toStation->address,0,15) }}...)</p>
                                            </div>
                                        </div>
                                        <div class="ticket-item-inner book-ticket">
                                            @if($bus->sleeper_fare>0)
                                            <p class="rent mb-0" style="font-size: 15px;">
                                                Sleeper Fare Rs.{{$bus->sleeper_fare}}
                                            </p>
                                            @endif
                                            <p class="rent mb-0" style="font-size: 15px;">
                                            @if($bus->sleeper_fare>0) Non-Sleeper @endif Fare Rs.{{ $bus->fare }}
                                            </p>
                                            <!-- <div class="seats-left mt-2 mb-3 fs--14px">
                                                Off Days: <div class="d-inline-flex flex-wrap" style="gap:5px">
                                                    <span class="badge badge--primary">Thursday</span>
                                                </div>
                                            </div> -->
                                            @if(is_numeric($bus->availableTickets(Request()->travel_date))>0)
                                                <div class="seats-left mt-2 mb-3 fs--17px">

                                                @if($bus->availableTicketsForSleeper(Request()->travel_date)==0 && $bus->availableTicketsForNonSleeper(Request()->travel_date)>0)
                                                    {{$bus->availableTicketsForNonSleeper(Request()->travel_date)}} Seats Available
                                                @elseif($bus->availableTicketsForSleeper(Request()->travel_date)>0 && $bus->availableTicketsForNonSleeper(Request()->travel_date)==0)
                                                    {{$bus->availableTicketsForSleeper(Request()->travel_date)}} Sleeper Seats Available
                                                @elseif($bus->availableTicketsForSleeper(Request()->travel_date)>0 && $bus->availableTicketsForNonSleeper(Request()->travel_date)>0)
                                                    ({{$bus->availableTicketsForSleeper(Request()->travel_date)}}Sleeper + {{$bus->availableTicketsForNonSleeper(Request()->travel_date)}}NonSleeper)
                                                    {{$bus->availableTickets(Request()->travel_date)}}
                                                    Seats Available
                                                @endif

                                                
                                                </div>
                                                <button type="button" class="btn btn--base" data-bs-toggle="modal" data-bs-target="#pickupDropModal{{ $bus->id }}">Book Ticket</button>
                                                <div class="modal fade" id="pickupDropModal{{ $bus->id }}" tabindex="-1" role="dialog" aria-labelledby="pickupDropModalLabel{{ $bus->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form action="{{ route('ticket-details', $bus->id) }}" method="GET">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="pickupDropModalLabel{{ $bus->id }}">Choose Pickup and Drop Locations</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="travel_date" value="{{ Request()->travel_date }}">
                                                                    <div class="form-group">
                                                                        <p for="pickup_id_{{ $bus->id }}" style="text-align: left;">Pickup Location</p>
                                                                        <select name="pickup_id" id="pickup_id_{{ $bus->id }}" class="form-control" required>
                                                                            <option value="">Select Pickup Location</option>
                                                                            @foreach($bus->fromStation->busPickupDropPoints as $pickup)
                                                                                <option value="{{ $pickup->id }}">{{ $pickup->name }} - {{ $pickup->address }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <p for="drop_id_{{ $bus->id }}" style="text-align: left;">Drop Location</p>
                                                                        <select name="drop_id" id="drop_id_{{ $bus->id }}" class="form-control" required>
                                                                            <option value="">Select Drop Location</option>
                                                                            @foreach($bus->toStation->busPickupDropPoints as $drop)
                                                                                <option value="{{ $drop->id }}">{{ $drop->name }} - {{ $drop->address }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn--base" @if($bus->fromStation->busPickupDropPoints->isEmpty() || $bus->toStation->busPickupDropPoints->isEmpty()) disabled @endif>Continue</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($bus->fromStation->busPickupDropPoints->isEmpty() || $bus->toStation->busPickupDropPoints->isEmpty())
                                                    <small class="text-danger d-block mt-2">Pickup or drop locations are not available for this bus.</small>
                                                @endif
                                            @else
                                                <div class="seats-left mt-2 mb-3 fs--14px text-danger">
                                                {!!$bus->availableTickets(Request()->travel_date)!!}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ticket-item-footer">
                                            <div class="d-flex content-justify-center">
                                                <span>
                                                    <strong>Facilities - </strong>
                                                    <span class="facilities">{{$bus->facilites}}</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            @else
                            <div class="ticket-item">
                                <div class="ticket-item-inner" style="text-align: center;">
                                    <h5><code>Please select any date to find the buses</code></h5>
                                </div>
                            </div>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
