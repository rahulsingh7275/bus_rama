@extends('admin.auth-layouts.app')

@section('title') Add New Conductor @endsection

@section('css')
<style>

</style>
@endsection


@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- DataTable Code Here -->
      <h5>Add New Conductor</h5>
      <div class="card">
         
      <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden col-md-12">

    <form action="{{ route('conductors.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="bus_id">Allotted Bus</label>
            <select name="bus_id" value="@if(old('bus_id')) {{old('bus_id')}} @endif" class="form-control" required>
                <option value="">Select</option>
                @foreach($buses as $bus)
                    <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Conductor Name</label>
            <input type="text" name="name" value="@if(old('name')) {{old('name')}} @endif" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Conductor email</label>
            <input type="text" name="email" value="@if(old('email')) {{old('email')}} @endif" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Conductor Password</label>
            <input type="text" name="password" value="@if(old('password')) {{old('password')}} @endif" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Conductor</button>
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