@extends('admin.auth-layouts.app')

@section('title') Edit Bus @endsection

@section('css')
<style>

</style>
@endsection


@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- DataTable Code Here -->
      <h5>Edit Bus</h5>
      <div class="card">
         
      <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden col-md-12">
    <form action="{{ route('buses.update', $bus->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Bus Name</label>
            <input type="text" name="name" class="form-control" value="{{ $bus->name }}" required>
        </div>
        <div class="form-group">
            <label for="number">Bus Number</label>
            <input type="text" name="number" class="form-control" value="{{ $bus->number }}" required>
        </div>
        <div class="form-group">
            <label for="route_name">Bus Route</label>
            <input type="text" name="route_name" class="form-control" value="{{ $bus->route_name }}" required>
        </div>
        <div class="form-group">
            <label for="from_station_id">From Stopage</label>
            <select name="from_station_id" class="form-control">
                @foreach($busStations as $station)
                    <option value="{{ $station->id }}" {{ $bus->from_station_id == $station->id ? 'selected' : '' }}>{{ $station->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="to_station_id">To Stopage</label>
            <select name="to_station_id" class="form-control">
                @foreach($busStations as $station)
                    <option value="{{ $station->id }}" {{ $bus->to_station_id == $station->id ? 'selected' : '' }}>{{ $station->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="from_time">From Time</label>
            <input type="time" name="from_time" class="form-control" value="{{ $bus->from_time }}" required>
        </div>
        <div class="form-group">
            <label for="to_time">To Time</label>
            <input type="time" name="to_time" class="form-control" value="{{ $bus->to_time }}" required>
        </div>
        <div class="form-group">
            <label for="travel_duration">Travel Duration</label>
            <input type="text" name="travel_duration" class="form-control" value="{{ $bus->travel_duration }}" required>
        </div>
        <div class="form-group">
            <label for="number_of_sleeper_seats">Number of Sleeper Seats</label>
            <input type="number" name="number_of_sleeper_seats" class="form-control number_of_sleeper_seats" value="{{ $bus->number_of_sleeper_seats }}" min="0" required>
        </div>
        <div class="form-group">
            <label for="number_of_non_sleeper_seats">Number of Non-Sleeper Seats</label>
            <input type="number" name="number_of_non_sleeper_seats" class="form-control number_of_non_sleeper_seats" value="{{ $bus->number_of_non_sleeper_seats }}" min="0" required>
        </div>
        <div class="form-group">
            <label for="number_of_seats">Total Number of Seats</label>
            <input type="number" name="number_of_seats" class="form-control number_of_seats" value="{{ $bus->number_of_seats }}" readonly min="0" required>
        </div>
        <div class="form-group">
            <label for="sleeper_fare">Sleeper Fare in Rs.</label>
            <input type="number" name="sleeper_fare" class="form-control" value="{{ $bus->sleeper_fare }}" required>
        </div>
        <div class="form-group">
            <label for="fare">Normal Fare in Rs.</label>
            <input type="number" name="fare" class="form-control" value="{{ $bus->fare }}" required>
        </div>
        <div class="form-group">
            <label for="bus_type">Bus Type</label>
            <input type="text" name="bus_type" class="form-control" value="{{ $bus->bus_type }}" required>
        </div>
        <div class="form-group">
            <label for="facilites">Facilites</label>
            <input type="text" name="facilites" class="form-control" value="{{ $bus->facilites }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Bus</button>
    </form>

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
$(document).ready(function() {
    // Function to calculate the total seats based on AC and Non-Sleeper Seats
    function calculateTotalSeats() {
        let acSeats = parseInt($('.number_of_sleeper_seats').val()) || 0;  // Get the AC seat value
        let nonAcSeats = parseInt($('.number_of_non_sleeper_seats').val()) || 0;  // Get the Non-AC seat value

        // Calculate the sum and set the total seats
        let totalSeats = acSeats + nonAcSeats;
        $('.number_of_seats').val(totalSeats);  // Set the total in the number_of_seats input
    }

    // Trigger calculation when Sleeper Seats change
    $('.number_of_sleeper_seats').on('input', function() {
        // Ensure Sleeper Seats are not less than 0
        if (parseInt($(this).val()) < 0) {
            $(this).val(0);
        }
        calculateTotalSeats();  // Recalculate total seats
    });

    // Trigger calculation when Non-Sleeper Seats change
    $('.number_of_non_sleeper_seats').on('input', function() {
        // Ensure Non-Sleeper Seats are not less than 0
        if (parseInt($(this).val()) < 0) {
            $(this).val(0);
        }
        calculateTotalSeats();  // Recalculate total seats
    });
});
</script>
@endsection
