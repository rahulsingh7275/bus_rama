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

  .ticket-filter-dialog {
    width: min(540px, calc(100% - 2rem));
    max-height: calc(100% - 2rem);
    padding: 0;
    border: 0;
    border-radius: 0.5rem;
  }

  .ticket-filter-dialog::backdrop {
    background: rgba(0, 0, 0, 0.5);
  }
</style>
@endsection




@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- DataTable Code Here -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Booked Ticket List</h5>
        <button type="button" class="btn btn-primary" id="openTicketFilters">
          Filters
          @if(request()->hasAny(['bus_id', 'date_from', 'date_to', 'search', 'payment_status', 'ticket_status']))
            <span class="badge badge-light">Applied</span>
          @endif
        </button>
      </div>

      <dialog class="ticket-filter-dialog" id="ticketFilterDialog" aria-labelledby="ticketFilterTitle">
        <div class="card mb-0">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0" id="ticketFilterTitle">Filter booked tickets</h5>
            <button type="button" class="close" id="closeTicketFilters" aria-label="Close">&times;</button>
          </div>
          <form method="GET" action="{{ route('tickets.index') }}">
            @if(request()->filled('type'))
              <input type="hidden" name="type" value="{{ request('type') }}">
            @endif
            <div class="card-body">
              <div class="form-group">
                <label for="filterBus">Bus</label>
                <select class="form-control" id="filterBus" name="bus_id">
                  <option value="">All buses</option>
                  @foreach($buses as $bus)
                    <option value="{{ $bus->id }}" {{ (string) request('bus_id') === (string) $bus->id ? 'selected' : '' }}>
                      {{ $bus->name }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="filterDateFrom">Travel date from</label>
                  <input class="form-control" type="date" id="filterDateFrom" name="date_from" value="{{ request('date_from') }}">
                </div>
                <div class="form-group col-md-6">
                  <label for="filterDateTo">Travel date to</label>
                  <input class="form-control" type="date" id="filterDateTo" name="date_to" value="{{ request('date_to') }}">
                </div>
              </div>
              <div class="form-group">
                <label for="filterSearch">Ticket number or passenger name</label>
                <input class="form-control" type="search" id="filterSearch" name="search" value="{{ request('search') }}" maxlength="255">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="filterPaymentStatus">Payment status</label>
                  <select class="form-control" id="filterPaymentStatus" name="payment_status">
                    <option value="">All payment statuses</option>
                    <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="unpaid" {{ request('payment_status') === 'unpaid' ? 'selected' : '' }}>Not paid</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="filterTicketStatus">Ticket status</label>
                  <select class="form-control" id="filterTicketStatus" name="ticket_status">
                    <option value="">All ticket statuses</option>
                    <option value="active" {{ request('ticket_status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="cancelled" {{ request('ticket_status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
              <a class="btn btn-light" href="{{ route('tickets.index', request()->only('type')) }}">Clear filters</a>
              <div>
                <button type="button" class="btn btn-secondary" id="dismissTicketFilters">Close</button>
                <button type="submit" class="btn btn-primary">Apply filters</button>
              </div>
            </div>
          </form>
        </div>
      </dialog>

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
  const filterDialog = document.getElementById('ticketFilterDialog');
  $('#openTicketFilters').on('click', function () {
    filterDialog.showModal();
  });
  $('#closeTicketFilters, #dismissTicketFilters').on('click', function () {
    filterDialog.close();
  });

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