@extends('admin.auth-layouts.app')

@section('title') Tickets @endsection
@section('content')
<style>
  .container-fluid .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #ced4da;
    border-radius: 4px;
  }
  .container-fluid .select2-container .select2-selection--single {
      height: 37px;
  }
  .container-fluid .select2-container--default .select2-selection--single .select2-selection__arrow {
    top: 5px;
  }
  .select2-selection__choice{
    color: #000 !important;
  }
</style>
<div class="content-wrapper">
   <div class="container-fluid">
      <div class="card mb-3">
         <div class="card-header">
            <div class="row breadcrumb">
               <div class="col-md-9">Add Contractor</div>
            </div>
         </div>
         <div class="card-body">
            <form action="" id="form-data" method="POST" enctype="multipart/form-data">
               {{csrf_field()}}
               <div class="form-row">
                  <div class="col-md-6">
                     @if(session()->has('message'))
                     <div class="alert alert-success">
                        {{ session()->get('message') }}
                     </div>
                     @endif
                  </div>
               </div>
               <div class="form-row">
                  <div class="col-md-6">
                     @if(session()->has('errormsg'))
                     <div class="alert alert-danger">
                        {{ session()->get('errormsg') }}
                     </div>
                     @endif
                  </div>
               </div>
               <div class="form-row ">
                  <div class="col-md-2 ">
                     <b>Name</b> 
                  </div>
                  <div class="col-md-4">
                     <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="enter name">
                     
                  </div>
               </div>
               <br>
               <div class="form-row ">
                  <div class="col-md-2 ">
                     <b>Email</b> 
                  </div>
                  <div class="col-md-4">
                     <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="enter email">
                    
                  </div>
               </div>
               <br>
               
               <div class="form-row ">
                  <div class="col-md-2 ">
                     <b>Mobile</b> 
                  </div>
                  <div class="col-md-4">
                     <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="enter mobile">
                    
                  </div>
               </div>
               <br>
               <div class="form-row ">
                  <div class="col-md-2 ">
                     <b>Password</b> 
                  </div>
                  <div class="col-md-4">
                     <input type="text" name="password" class="form-control" value="{{ old('password') }}" placeholder="enter password">
                    
                  </div>
               </div>
               <br>

                <div class="form-row" id="doc_status">
                    <div class="col-md-2">
                      <b>Status </b>
                    </div>
                    <div class="col-md-4">
                      <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                      </select>
                    </div>
                </div><br>


               <div class="form-row">
                  <div class="col-md-2"></div>
                  <div class="col-md-3">
                     <button class="btn btn-primary"><b>Add Contractor</b></button> 
                  </div>
                  <div class="col-md-1">
                     <a class="text-decoration-none btn btn-primary" href="{{url('admin/contractor')}}"><b>Back</b> </a>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript" charset="utf-8" async defer>

   $('.countryName').change(function(){
      change_country();
   });


    $('#Role').select2({
        allowClear: true,
        placeholder: 'Select Role',
    });

    $('.userRole').change(function(){
        var id=$(this).val();
        var status=false;

        if($.inArray('2', id)!='-1'){
            status=true;
        }else if($.inArray('3', id)!='-1'){
            status=true;
        }else if($.inArray('4', id)!='-1'){
            status=true;
        }
        if(status){
            $('.id_img').show();
         }else{
            
            $(".id_img").hide();
         }
    });
</script>
@endsection