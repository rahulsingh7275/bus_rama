@extends('layouts.app')

@section('content')

<main>
    <section class="inner-banner bg_img" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) center">
        <div class="container">
            <div class="inner-banner-content">
                <h2 class="title">Tickets</h2>
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

    <h2>Your Tickets</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Passenger Name</th>
                <th>Passenger Count</th>
                <th>From Stopage</th>
                <th>To Stopage</th>
                <th>Travel Date</th>
                <th>Fare</th>
                <th>Allotted Seat</th>
                <th>Bus</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->passenger_name }}</td>
                <td>{{ $ticket->passenger_count }}</td>
                <td>{{ $ticket->fromStopage->name }}</td>
                <td>{{ $ticket->toStopage->name }}</td>
                <td>{{ $ticket->travel_date }}</td>
                <td>{{ $ticket->fare }}</td>
                <td>{{ $ticket->allotted_seat_number }}</td>
                <td>{{ $ticket->bus->name }}</td>
                <td>
                    <a href="{{ route('passenger.ticket.print', $ticket->id) }}" class="btn btn-secondary">Print Ticket</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</section>
</main>
@endsection
