@extends('admin.auth-layouts.app')

@section('title') Contractor Profile Update @endsection

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

      <h4 class="m-0">Contractor Profile Update</h4>

      <div class="card">
          <!-- <div class="card-header">Contractor Profile Update</div> -->
          <div class="card-body table-responsive">
              <form class="p-3 mt-3" enctype="multipart/form-data" method="POST" id="form-data" action="" autocomplete="off">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <strong for="">Name</strong>
                    <input type="text" name="name" class="form-control" id="name" value="{{$contractor->name}}" autocomplete="nope" required>
                    <div class="col-md-12 validation_error"></div>
                  </div>
                  <div class="col-md-6">
                    <strong for="">Email</strong>
                    <input type="email" name="email" class="form-control" value="{{$contractor->email}}">
                    <div class="col-md-12 validation_error"></div>
                  </div>
                  <div class="col-md-6">
                  <strong for="">Contractor State License Number <span style="color:red">*</span></strong>
                    <input type="text" name="contractor_id" class="form-control" id="contractor_id" value="{{$contractor->contractor_id}}" autocomplete="nope" required>
                    <div class="col-md-12 validation_error"></div>
                  </div>
                  <div class="col-md-6">
                      <strong for="">Location</strong>
                      @php $addresses = \App\Models\Address::all(); @endphp
                      <select name="location" class="form-control" required>
                          <option value="">Select</option>
                          @foreach($addresses as $address)
                          <option value="{{$address->name}}" @if($address->name==$contractor->location) selected @endif>{{$address->name}}</option>
                          @endforeach
                      </select>
                      <input type="hidden" name="longitude" class="form-control" value="NA" required>
                      <input type="hidden" name="latitude" class="form-control" value="NA" required>
                    <div class="col-md-12 validation_error"></div>
                  </div>
                  <div class="col-md-6">
                    <strong for="">Services</strong>
                    <select name="service_ids[]" class="form-control" id="service_ids" autocomplete="nope" multiple required>
                      <option value="">Select</option>
                      @foreach($services as $service)
                      <option value="{{$service->id}}" @if(in_array($service->id, $contractor->services_ids())) selected @endif>{{$service->name}}</option>
                      @endforeach
                    </select>
                    <div class="col-md-12 validation_error"></div>
                  </div>
                  <div class="col-md-12"></div>
                  <div class="col-md-6">
                    <strong for="">Upload Photo</strong>
                    <input type="file" name="photo" class="form-control" id="photo" accept="image/jpeg,image/jpg">
                    <div class="col-md-12 validation_error"></div>
                  </div>
                  <div class="col-md-6 text-right">
                    <span class="pull-left" style="font-size: 20px;vertical-align: middle;display: contents;float: left;">Photo Preview</span>
                    <img class="example-image-link" data-lightbox="example-1" src="{{$contractor->photo}}" id="previewHolder" style="max-height: 100px;border-radius: 50%;border: 1px solid;float: right;">
                  </div>
                </div>
                <div class="col-md-12 text-center"><button type="submit" class="btn btn-danger signIn mt-3" style="max-width: 200px;">Update</button></div>
            </form>
          </div>
          </div>
      <!-- content area ends -->
    
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
$( "#form-data" ).validate({
  errorPlacement: function (error, element) {
    error.appendTo( element.closest(".col-md-6").find(".validation_error") );
    element.closest('.form-field').addClass('error');
  }
});
$(".form-field input").change(function(){
  $(this).closest('.form-field').removeClass('error');
});

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