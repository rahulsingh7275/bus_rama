@extends('admin.auth-layouts.app')

@section('title') Ticket Details @endsection

@section('css')
<style>

</style>
@endsection


@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- DataTable Code Here -->
      <h5>Ticket Details</h5>
      <div class="card">
         
      <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden col-md-12">
    
    <table class="table table-bordered">
        <tr>
            <th>Passenger Name:</th>
            <td>{{ $ticket->passenger_name }}</td>
        </tr>
        <tr>
            <th>Passenger Count:</th>
            <td>{{ $ticket->passenger_count }}</td>
        </tr>
        <tr>
            <th>From Stopage:</th>
            <td>{{ $ticket->fromStopage->name }}</td>
        </tr>
        <tr>
            <th>To Stopage:</th>
            <td>{{ $ticket->toStopage->name }}</td>
        </tr>
        <tr>
            <th>Travel Date:</th>
            <td>{{ $ticket->travel_date }}</td>
        </tr>
        <tr>
            <th>Fare:</th>
            <td>{{ $ticket->fare }}</td>
        </tr>
        <tr>
            <th>Allotted Seat Number:</th>
            <td>{{ $ticket->allotted_seat_number }}</td>
        </tr>
        <tr>
            <th>Bus:</th>
            <td>
                @if($ticket->bus)
                    {{ $ticket->bus->name }} ({{ $ticket->bus->number }})
                @else
                    Not Assigned
                @endif
            </td>
        </tr>
    </table>

    <!-- Back Button -->
    <a href="{{ route('tickets.index') }}" class="btn btn-secondary">Back to List</a>

    <!-- Print Ticket Button -->
    <a href="#" class="btn btn-primary">Print Ticket</a>

    </div>
            </div>
          </div>
        </div>
</div>
</div>
</div>
</div>



@endsection