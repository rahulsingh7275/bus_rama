@extends('admin.layouts.app')
@section('content')

<div class="content-wrapper" style="min-height: 113px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
          <div class="col-md-12">
            
          <h1 class="m-0">Add Customer</h1>

          @include('notifications.notification')
          </div><!-- /.col -->
          
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      
      <!-- DataTable Code Here -->
      <div class="card">
          
    <div class="card-body table-responsive">
      <form method="POST" enctype="multipart/form-data">
        @csrf
				<div class="row">
					<div class="col-md-4 mb-3">
						<label style="width: 100%;display:block;">Select Service</label>
						<select name="service_id" class="form-control" id="service_id" autocomplete="nope" required>
              <option value="">Select</option>
              @foreach($services as $service)
              <option value="{{$service->id}}">{{$service->name}}</option>
              @endforeach
            </select>
					</div>
					<div class="col-md-4 mb-3">
						<label style="width: 100%;display:block;">Enter Customer Name</label>
						<input type="text" name="name" class="form-control" required>
					</div>
					<div class="col-md-4 mb-3">
						<label style="width: 100%;display:block;">Select Location</label>
            @php $addresses = \App\Models\Address::all(); @endphp
            <select name="location" class="form-control" required>
                <option value="">Select</option>
                @foreach($addresses as $address)
                <option value="{{$address->name}}">{{$address->name}}</option>
                @endforeach
            </select>
					</div>
					<div class="col-md-4 mb-3">
						<label style="width: 100%;display:block;">Enter Behaviour</label>
						<input type="text" name="behaviour" class="form-control" required>
					</div>
					<div class="col-md-4 mb-3">
						<label style="width: 100%;display:block;">Enter Price</label>
						<input type="number" name="price" class="form-control" required>
					</div>
					<div class="col-md-4 mb-3">
						<label style="width: 100%;display:block;">Enter Phone Number</label>
						<input type="text" name="phone" class="form-control" onchange="isNumber(this)" maxlength="10" required>
					</div>
					<div class="col-md-12 mb-3">
						<label style="width: 100%;display:block;">Enter Reviews</label>
						<textarea name="reviews" class="form-control" required></textarea>
					</div>
          <div class="col-md-12"></div>
          <div class="col-md-8">
            <strong for="">Upload Photo</strong>
            <input type="file" name="photo" class="form-control" id="photo" accept="image/jpeg,image/jpg">
            <div class="col-md-12 validation_error"></div>
          </div>
          <div class="col-md-4 text-right">
            <span class="pull-left" style="font-size: 20px;vertical-align: middle;display: contents;">Photo Preview</span>
            <img src="{{asset('assets/images/demo-user.jpg')}}" id="previewHolder" style="width:100px;height: 100px;border-radius: 50%;border: 1px solid;">
          </div>
          
					<div class="col-md-4 mb-3">
						<label style="width: 100%;display:block;">&nbsp;</label>
						<input type="submit" name="Add Customer" class="btn btn-success">
						<a href="{{url('customers')}}" class="btn btn-primary">Back</a>
					</div>
				</div>
			  </form>
          </div>
        </div>
      <!-- DataTable Code Here -->
      
    </section>
    <!-- /.content -->
  </div>
@endsection



@section('scripts')
<script>

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#previewHolder').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  } else {
    alert('select a file to see preview');
    $('#previewHolder').attr('src', '');
  }
}

$("#photo").change(function() {
  readURL(this);
});

</script>
@endsection