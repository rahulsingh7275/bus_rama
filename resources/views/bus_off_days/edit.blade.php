@extends('admin.auth-layouts.app')

@section('title') Edit Bus Off Day @endsection

@section('css')
<style>

</style>
@endsection

@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <h5>Edit Off Day</h5>
      <div class="card">
        <div class="card-body">
          <form action="{{ route('bus-off-days.update', $busOffDay->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
              <label for="bus_id">Bus</label>
              <select name="bus_id" class="form-control" required>
                @foreach($buses as $bus)
                <option value="{{ $bus->id }}" {{ $bus->id == $busOffDay->bus_id ? 'selected' : '' }}>{{ $bus->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="off_date">Off Day</label>
              <input type="date" class="form-control" name="off_date" value="{{ $busOffDay->off_date }}" required>
            </div>

            <button type="submit" class="btn btn-success">Update Off Day</button>
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
