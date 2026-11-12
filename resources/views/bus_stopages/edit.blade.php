@extends('admin.auth-layouts.app')

@section('title') Edit Bus Stopage @endsection

@section('css')
<style>

</style>
@endsection


@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- DataTable Code Here -->
      <h5>Edit Bus Stopage</h5>
      <div class="card">
         
      <div class="card-body px-6 pb-6">
        <div class="overflow-x-auto -mx-6 dashcode-data-table">
          <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden col-md-12">
    
    <form action="{{ route('bus_stopages.update', $busStopage->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Select Bus</label>
            <select name="bus_id" id="bus_id" class="form-control" required>
            <option value="">Select Bus</option>
            @foreach($buses as $bus)
              <option value="{{$bus->id}}" @if($bus->id==$busStopage->user_id) select @endif>{{$bus->name}}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Bus Stopage Name</label>
            <input type="text" name="name" class="form-control" value="{{ $busStopage->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Stopage</button>
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