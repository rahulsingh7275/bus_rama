@extends('admin.auth-layouts.app')

@section('title') Booked Ticket List @endsection

@section('css')
<style>
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
@endsection




@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- DataTable Code Here -->
      <h5>Booked Ticket List</h5>
      <div class="card">
         
      <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden col-md-12">
            <div class="table-responsive">
  <table id="example1" class="table table-striped table-bordered">
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
        <td>{{($ticket->payment)?"PAID" : "NOT PAID"}} @if($ticket->deleted_at) <strong class="text-danger">(Cancelled)</strong> @endif</td>
        <td>{{($ticket->payment)?$ticket->payment->refund_status:'-'}}</td>
        <td>{{($ticket->payment)?$ticket->payment->refund_amount:'-'}}</td>
        <td>
        <a href="{{ route('payment-process', $ticket->id) }}" class="btn btn-info">View</a>
        @if($ticket->canTicketBeCancel())
          <form action="{{url('payment/refund')}}/{{$ticket->id}}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Cancel</button>
          </form>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>



              
              </div>
            </div>
          </div>
        </div>
</div>
</div>
</div>
</div>



@endsection

@section('scripts')
<script>

$(function () {
  $("#example1").DataTable({
    responsive: true,  // Enable responsive mode
    layout: {
      topStart: {
        buttons: ['excel', 'pdf', 'print']
      }
    }
  });
});

</script>
@endsection