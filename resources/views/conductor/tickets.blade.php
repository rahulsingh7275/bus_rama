@extends('admin.auth-layouts.app')

@section('title') Passenger Bus Tickets @endsection

@section('css')
<style>

</style>
@endsection


@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- DataTable Code Here -->
      <h5>Passenger Bus Tickets</h5>
      <div class="card">
         
      <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden col-md-12">
    
    <table id="example1" class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700" aria-describedby="example1_info">
        <thead class="bg-slate-200 dark:bg-slate-700">
            <tr>
                <th>Passenger Name</th>
                <th>Passenger Count</th>
                <th>From Stopage</th>
                <th>To Stopage</th>
                <th>Travel Date</th>
                <th>Fare</th>
                <th>Allotted Seat</th>
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
                <td>
                    <a href="{{ route('conductor.ticket.print', $ticket->id) }}" class="btn btn-secondary">Print Ticket</a>
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



@endsection

@section('scripts')
<script>

$(function () {
  $("#example1").DataTable({
      layout: {
          topStart: {
              buttons: ['excel', 'pdf', 'print']
          }
      }
  });
  });
</script>
@endsection