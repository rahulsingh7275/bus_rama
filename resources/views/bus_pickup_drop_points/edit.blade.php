@extends('admin.auth-layouts.app')

@section('title') Edit Bus Pickup/Drop Point @endsection

@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      <h5>Edit Bus Pickup/Drop Point</h5>
      <div class="card">
        <div class="card-body px-6 pb-6">
          <form action="{{ route('bus_pickup_drop_points.update', $busPickupDropPoint->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="bus_station_id">Bus Station</label>
              <select name="bus_station_id" id="bus_station_id" class="form-control" required>
                <option value="">Select Bus Station</option>
                @foreach($stations as $station)
                  <option value="{{ $station->id }}" {{ old('bus_station_id', $busPickupDropPoint->bus_station_id) == $station->id ? 'selected' : '' }}>{{ $station->name }}</option>
                @endforeach
              </select>
              @error('bus_station_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="name">Pickup/Drop Point Name</label>
              <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $busPickupDropPoint->name) }}" required>
              @error('name')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $busPickupDropPoint->address) }}" required>
              @error('address')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Point</button>
            <a href="{{ route('bus_pickup_drop_points.index') }}" class="btn btn-secondary">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
