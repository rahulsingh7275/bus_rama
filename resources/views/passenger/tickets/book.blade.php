@extends('layouts.app')

@section('content')

<main>
    <section class="inner-banner bg_img" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) center">
        <div class="container">
            <div class="inner-banner-content">
                <h2 class="title">Book a Ticket</h2>
            </div>
        </div>
    </section>


<section class="contact-section padding-top padding-bottom overflow-hidden">
    <div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2>Book a Ticket</h2>
    <form action="{{ route('passenger.tickets.book') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="passenger_count">Passenger Count</label>
            <input type="number" name="passenger_count" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="from_stopage_id">From Stopage</label>
            <select name="from_stopage_id" class="form-control">
                @foreach($busStopages as $stopage)
                    <option value="{{ $stopage->id }}">{{ $stopage->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="to_stopage_id">To Stopage</label>
            <select name="to_stopage_id" class="form-control">
                @foreach($busStopages as $stopage)
                    <option value="{{ $stopage->id }}">{{ $stopage->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="travel_date">Travel Date</label>
            <input type="date" name="travel_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fare">Fare</label>
            <input type="text" name="fare" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="allotted_seat_number">Allotted Seat Number</label>
            <input type="number" name="allotted_seat_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="bus_id">Bus</label>
            <select name="bus_id" class="form-control">
                @foreach($buses as $bus)
                    <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Book Ticket</button>
    </form>
</div>
</section>
</main>
@endsection
