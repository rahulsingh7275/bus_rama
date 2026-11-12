@extends('admin.auth-layouts.app')

@section('title') Edit Customer @endsection

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

      <h4 class="m-0">Edit Customer</h4>

      <div class="card">
        <div class="card-body table-responsive">
          <form method="POST" enctype="multipart/form-data">
          @csrf

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
            <div class="input-area relative">
              <label for="largeInput" class="form-label">Select Service</label>
              <select name="service_id" class="form-control" id="service_id" autocomplete="nope" required>
              <option value="">Select</option>
              @foreach($services as $service)
              <option value="{{$service->id}}" @if($service->id==$customer->service_id) selected @endif>{{$service->name}}</option>
              @endforeach
            </select>
            </div>
            <div class="input-area relative">
              <label for="largeInput" class="form-label">Enter Customer Name</label>
              <input type="text" name="name" value="{{$customer->name}}" class="form-control" required>
            </div>
            <div class="input-area relative">
              <label for="largeInput" class="form-label">Select Location</label>
              @php $addresses = \App\Models\Address::all(); @endphp
              <select name="location" class="form-control" required>
                  <option value="">Select</option>
                  @foreach($addresses as $address)
                  <option value="{{$address->name}}" @if($address->name==$customer->location) selected @endif>{{$address->name}}</option>
                  @endforeach
              </select>
            </div>
            <div class="input-area relative">
              <label for="largeInput" class="form-label">Enter Behaviour</label>
              <input type="text" name="behaviour" value="{{$customer->behaviour}}" class="form-control" required>
            </div>
            <div class="input-area relative">
              <label for="largeInput" class="form-label">Enter Price</label>
              <input type="number" name="price" value="{{$customer->price}}" class="form-control" required>
            </div>
            <div class="input-area relative">
              <label for="largeInput" class="form-label">Enter Phone Number</label>
              <input type="text" name="phone" value="{{$customer->phone}}" class="form-control" onchange="isNumber(this)" maxlength="10" required>
            </div>
          </div>
          
          <div class="row">
            <div class="col-12">
              <label for="largeInput" class="form-label">Enter Reviews</label>
              <textarea name="reviews" class="form-control" required>{{$customer->reviews}}</textarea>
            </div>
          </div>
          
          <div class="row" style="width:100%">
            <div class="col-sm-6">
              <label for="largeInput" class="form-label">Upload Photo</label>
              <input type="file" name="photo" class="form-control" id="photo" accept="image/jpeg,image/jpg">
              <div class="col-md-12 validation_error"></div>
            </div>
            <div class="col-sm-6">
              <span class="pull-left" style="font-size: 20px;vertical-align: middle;display: contents;">Photo Preview</span>
              <img class="example-image-link" data-lightbox="example-1" src="{{$customer->photo}}" id="previewHolder" style="width:100px;height: 100px;border-radius: 50%;border: 1px solid;">
            </div>
          </div>
          <div class="row" style="width:100%">
            <div class="col-sm-6">
              <label for="largeInput" class="form-label">Upload Work Photos</label>
              <input type="file" name="workphotos[]" class="form-control" id="workphotos" accept="image/jpeg,image/jpg" multiple>
              <div class="col-md-12 validation_error"></div>
            </div>
            <div class="col-sm-6">
            @foreach($customer->getMedia('workphotos') as $index=>$image)
                <a class="example-image-link" href="{{ $image->getUrl() }}" data-lightbox="example-{{$index}}">
                  <img src="{{ $image->getUrl() }}" alt="Image" style="height: 100px;width: 100px;border: 5px solid transparent;float: left;border-radius: 20px;">
                </a>
            @endforeach
            </div>
          </div>
          <br/>

          <div class="row">
            <div class="col-12">
              <input type="submit" name="Add Customer" class="btn inline-flex justify-center btn-primary">
              <a href="{{url('customers')}}" class="btn inline-flex justify-center btn-danger" >Back</a>  
            </div>
          </div>

          </from>
        </div>
      </div>
      <!-- content area ends -->
    
    </div>
  </div>
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