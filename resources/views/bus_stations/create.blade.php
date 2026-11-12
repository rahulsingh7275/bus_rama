@extends('admin.auth-layouts.app')

@section('title') Add New Bus Station @endsection

@section('css')
<style>

</style>
@endsection


@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- DataTable Code Here -->
      <h5>Add New Bus Station</h5>
      <div class="card">
         
      <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden col-md-12">
    
    <form action="{{ route('bus_stations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Bus Station Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Bus Station Address</label>
            <input type="text" name="address" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Station</button>
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