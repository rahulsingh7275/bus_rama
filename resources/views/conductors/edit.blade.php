@extends('admin.auth-layouts.app')

@section('title') Edit Conductor @endsection

@section('css')
<style>
/* Custom CSS (optional) */
</style>
@endsection

@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- DataTable Code Here -->
      <h5>Edit Conductor</h5>
      <div class="card">
         
      <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden col-md-12">

    <form action="{{ route('conductors.update', $conductor->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Include the PUT method to update the record -->
        
        <div class="form-group">
            <label for="bus_id">Allotted Bus</label>
            <select name="bus_id" class="form-control" required>
                <option value="">Select</option>
                @foreach($buses as $bus)
                    <option value="{{ $bus->id }}" {{ $conductor->bus_id == $bus->id ? 'selected' : '' }}>{{ $bus->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="name">Conductor Name</label>
            <input type="text" name="name" value="{{ old('name', $conductor->user->name) }}" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="email">Conductor Email</label>
            <input type="text" name="email" value="{{ old('email', $conductor->user->email) }}" class="form-control" readonly required>
        </div>

        <div class="form-group">
            <label for="password">Change Conductor Password (Optional)</label>
            <input type="password" name="password" class="form-control" placeholder="Leave blank if not changing">
        </div>

        <button type="submit" class="btn btn-primary">Update Conductor</button>
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
