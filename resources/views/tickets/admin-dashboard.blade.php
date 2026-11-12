@extends('admin.auth-layouts.app')

@section('title') Admin Dashboard @endsection

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
      <h5>Welcome Mr. {{Auth::user()->name}}<br></h5>
      
      <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white">
                <a href="{{url('tickets?type=completed_tickets')}}" style="text-decoration: none;">
                <div class="card-body">
                    <h5 style="color: unset;">Completed Tickets</h5>
                    <span style="font-size: 20px;">{{$completed_tickets}}</span>
                </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-white">
                <a href="{{url('tickets?type=paid_tickets')}}" style="text-decoration: none;">
                <div class="card-body">
                    <h5 style="color: unset;">Paid Tickets</h5>
                    <span style="font-size: 20px;">{{$paid_tickets}}</span>
                </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-warning text-white">
                <a href="{{url('tickets?type=unpaid_tickets')}}" style="text-decoration: none;">
                <div class="card-body">
                    <h5 style="color: unset;">Unpaid Tickets</h5>
                    <span style="font-size: 20px;">{{$unpaid_tickets}}</span>
                </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-danger text-white">
                <a href="{{url('tickets?type=cancelled_tickets')}}" style="text-decoration: none;">
                <div class="card-body">
                    <h5 style="color: unset;">Cancelled Tickets</h5>
                    <span style="font-size: 20px;">{{$cancelled_tickets}}</span>
                </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-secondary text-white">
                <a href="{{url('tickets?type=all_tickets')}}" style="text-decoration: none;">
                <div class="card-body">
                    <h5 style="color: unset;">All Tickets</h5>
                    <span style="font-size: 20px;">{{$all_tickets}}</span>
                </div>
                </a>
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