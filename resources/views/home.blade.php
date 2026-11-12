@extends('layouts.app')

@section('content')
<style>
.gallery-container .col-md-3{
    padding: 0px !important;
}
  /* Ensure that the table is responsive and allows horizontal scrolling */
  .table-responsive {
    overflow-x: auto; /* Enables horizontal scrolling */
    white-space: nowrap; /* Prevents text wrapping */
  }

  /* Ensures that the text doesn't wrap within the table cells */
  table th, table td {
    white-space: nowrap; /* Prevent text wrapping */
  }

  /* Optional: Adjusting the width of the table to force horizontal scrolling */
  table {
    table-layout: auto; /* Let the table take as much width as needed */
    width: 100%; /* Optional: Full width table */
  }
</style>
<!-- datatable button CSS -->

<link href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.css" rel="stylesheet">
<main>
        <section class="inner-banner bg_img" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) center">
            <div class="container">
                <div class="inner-banner-content">
                    <h2 class="title">My Bookings</h2>
                </div>
            </div>
        </section>
    
        @include('notifications.notification')
    
        <section class="contact-section padding-top padding-bottom overflow-hidden">
            <div class="container">

        <div class="table-responsive">
            <table id="example" class="table table-striped">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Ticket No.</th>
                    <th>Bus</th>
                    <th>From Stopage</th>
                    <th>To Stopage</th>
                    <th>Passenger Name</th>
                    <th>Passenger Count</th>
                    <th>Travel Date</th>
                    <th>Fare</th>
                    <th>Payment Status</th>
                    <th>Refund Status</th>
                    <th>Refund Amount</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $index=>$ticket)
                <tr>
                    <td>{{ ++$index }}</td>
                    <td>{{ $ticket->ticket_no }}</td>
                    <td>{{ $ticket->bus->name }}</td>
                    <td>{{ $ticket->fromStation->name }}</td>
                    <td>{{ $ticket->toStation->name }}</td>
                    <td>{{ $ticket->passenger_name }}</td>
                    <td>{{ $ticket->passenger_count }}</td>
                    <td>{{ $ticket->travel_date }} {{date('h:iA',strtotime($ticket->bus->from_time))}}</td>
                    <td>{{ $ticket->fare }}</td>
                    <td>{{($ticket->payment)?"PAID " :"NOT PAID"}} @if($ticket->deleted_at) <strong class="text-danger">(Cancelled)</strong> @endif</td>
                    <td>{{($ticket->payment)?$ticket->payment->refund_status:'-'}}</td>
                    <td>{{($ticket->payment)?$ticket->payment->refund_amount:'-'}}</td>
                    <td>
                    <a href="{{ route('payment-process', $ticket->id) }}" class="btn btn-info">View</a>
                   {{--
                   @if($ticket->canTicketBeCancel())
                    <form action="{{url('payment/refund')}}/{{$ticket->id}}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Cancel</button>
                    </form>
                    @endif
                    --}}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>


            </div>
        </section>
    </main>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<!-- datatable button JS -->



<script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.bootstrap5.js"></script>
<!-- datatable button JS -->
<script>

new DataTable('#example');

</script>


@endsection


