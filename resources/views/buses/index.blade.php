@extends('admin.auth-layouts.app')

@section('title') Bus List @endsection

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
      <h5>Bus List</h5>
      <div class="card">
         
      <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden col-md-12">

    <a href="{{ route('buses.create') }}" class="btn btn-primary mb-3">Add New Bus</a>
      <table id="example" class="table table-striped">
          <thead class="bg-slate-200 dark:bg-slate-700">
            <tr>
                <th>Name</th>
                <th>Number</th>
                <th>Route</th>
                <th>From Stopage</th>
                <th>To Stopage</th>
                <th>From Time</th>
                <th>To Time</th>
                <th>Travel Duration</th>
                <th>Sleeper Seats</th>
                <th>Non-Sleeper Seats</th>
                <th>Total Seats</th>
                <th>Sleeper Fare in Rs.</th>
                <th>Fare in Rs.</th>
                <th>Bus Type</th>
                <th>Facilites</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buses as $bus)
            <tr>
                <td>{{ $bus->name }}</td>
                <td>{{ $bus->number }}</td>
                <td>{{ $bus->route_name }}</td>
                <td>{{ $bus->fromStation->name }}</td>
                <td>{{ $bus->toStation->name }}</td>
                <td>{{ date('h:i A',strtotime($bus->from_time)) }}</td>
                <td>{{ date('h:i A',strtotime($bus->to_time)) }}</td>
                <td>{{ $bus->travel_duration }}</td>
                <td>{{ $bus->number_of_sleeper_seats }}</td>
                <td>{{ $bus->number_of_non_sleeper_seats }}</td>
                <td>{{ $bus->number_of_seats }}</td>
                <td>Rs.{{ $bus->sleeper_fare }}</td>
                <td>Rs.{{ $bus->fare }}</td>
                <td>{{ $bus->bus_type }}</td>
                <td>{{ $bus->facilites }}</td>
                <td>
                    <a href="{{ route('buses.edit', $bus->id) }}" class="btn btn-success">Edit</a>
                    <form action="{{ route('buses.destroy', $bus->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
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
  $("#example").DataTable({
      layout: {
          topStart: {
              buttons: ['excel', 'pdf', 'print']
          }
      }
  });
  });
</script>
@endsection