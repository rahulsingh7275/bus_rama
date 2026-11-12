@extends('admin.auth-layouts.app')

@section('title') Add Bus Off Day @endsection

@section('css')
<style>

</style>
@endsection

@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <h5>Add New Off Day</h5>
      <div class="card">
        <div class="card-body">
          
          <!-- Displaying Validation Errors -->
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('bus-off-days.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="bus_id">Bus</label>
              <select name="bus_id" class="form-control" required>
                <option value="">Select</option>
                @foreach($buses as $bus)
                  <option value="{{ $bus->id }}" {{ old('bus_id') == $bus->id ? 'selected' : '' }}>{{ $bus->name }}</option>
                @endforeach
              </select>
              <!-- Show error for bus_id -->
              @error('bus_id')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="off_date">Off Date</label>
              <input type="date" class="form-control" name="off_date" value="{{ old('off_date') }}" required>
              <!-- Show error for off_date -->
              @error('off_date')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add Off Day</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  // Custom scripts if needed
</script>
@endsection
