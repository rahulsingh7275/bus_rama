@extends('admin.auth-layouts.app')

@section('title') Edit Service @endsection

@section('css')
<style>

</style>
@endsection

@include('notifications.notification')

@section('content')
<div class="page-content">
  <div class="transition-all duration-150 container-fluid" id="page_layout">
    <div id="content_layout">
      
      <!-- content area starts -->

      <h4 class="m-0">Edit Service</h4>

      <div class="card">
          <!-- <div class="card-header">
            Edit Service
          </div> -->
          <div class="card-body table-responsive">
              <form method="POST">
				<div class="row">
					<div class="col-md-4 form-group">
						<label style="width: 100%;display:block;">Enter Service Name</label>
						<input type="text" name="name" value="{{$service->name}}" class="form-control" required>
					</div>
					<div class="col-md-4 form-group">
						<label style="width: 100%;display:block;">&nbsp;</label>
						<input type="submit" name="Edit Service" class="btn btn-success">
						<a href="{{url('admin/services')}}" class="btn btn-primary">Back</a>
					</div>
				</div>
			  </form>
          </div>
          </div>
      <!-- content area ends -->
    
    </div>
  </div>
</div>

@endsection