@extends('admin.layouts.app')
@section('content')

@section('styles')

@endsection

<div class="content-wrapper" style="min-height: 113px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

          <h1 class="m-0">Edit Admin User</h1>

          @include('notifications.notification')
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <form id="form-data">
         @csrf
      <div class="container-fluid">
        
      
      <!-- DataTable Code Here -->
      <div class="card">
          <div class="card-header">
              <h3 class="card-title">Edit Admin User</h3>
          </div>
          
   <div class="card-body">
      <div class="row">
         <div class="col-md-6">

            <div class="form-group">
               <label for="name_id">Enter Name</label>
               <input type="text" class="form-control" name="name" value="{{$admin->name}}" placeholder="Enter Name" required>
               <span class="text-danger name_error error"></span>
            </div>
            <div class="form-group">
               <label for="user_name_id">Enter User Name</label>
               <input type="text" class="form-control" name="user_name" value="{{$admin->user_name}}" placeholder="Enter User Name" readonly required>
               <span class="text-danger user_name_error error"></span>
            </div>
            <div class="form-group">
               <label for="email_id">Enter Email</label>
               <input type="text" class="form-control" name="email" value="{{$admin->email}}" placeholder="Enter Email" required>
               <span class="text-danger email_error error"></span>
            </div>
            <div class="form-group">
               <label for="mobile_id">Enter Mobile</label>
               <input type="text" class="form-control" name="mobile" value="{{$admin->mobile}}" placeholder="Enter Mobile" required>
               <span class="text-danger mobile_error error"></span>
            </div>
            <div class="form-group">
               <label for="password_id">Enter Password <br> <code>You can also leave it blank or follow the password format</code></label>
               <input type="password" class="form-control" name="password" placeholder="Enter Password">
               <span class="text-danger password_error error"></span>
            </div>
            <div class="col-md-12 text-danger">
						<br>
						Note : Password must be contain
						<ol>
							<li>Min 8 chars long</li>
							<li>Min One Digit</li>
							<li>Min One Uppercase</li>
							<li>Min One Lower Case</li>
							<li>Min One Special Chars</li>
						</ol>
					</div>

         </div>
         <div class="col-md-6">

            {{--<div class="form-group">
               <label for="role_id">Select Role</label>
               <select class="form-control" name="role" required>
				  @if($admin->role==4)
                  <option value="4">HO ACR</option>
				  @elseif($admin->role==5)
                  <option value="5">HO FC</option>
				  @else
                  <option value="" @if($admin->role=='') selected @endif >Select Role</option>
                  <option value="2" @if($admin->role==2) selected @endif >Dealer</option>
                  <option value="3" @if($admin->role==3) selected @endif >ARTO</option>
				  @endif
               </select>
               <span class="text-danger role_error error"></span>
            </div>
            <div class="form-group">
               <label for="district_id_id">Select District</label>
               <select class="form-control" name="district_id" required>
                  <option value="" @if($admin->district_id=='') selected @endif >Select District</option>
                  @foreach($disctricts as $disctrict)
                  <option value="{{$disctrict->id}}" @if($admin->district_id==$disctrict->id) selected @endif >{{$disctrict->rto_office_name}}</option>
                  @endforeach
               </select>
               <span class="text-danger district_id_error error"></span>
            </div>--}}

         </div>
      </div>
   </div>

   <div class="card-footer">
      <input type="button" name="Save" value="Update User Details" class="btn-lg btn-success user_add">
   </div>



          
        </div>
      <!-- DataTable Code Here -->
      


      </div><!-- /.container-fluid -->
      </form>
    </section>
    <!-- /.content -->
  </div>

@section('scripts')
<script>
$(document).ready(function() {

  $('.user_add').click(function(){
   $('.error').text('');
   $('.ajaxloader').show();
   $_token = "{{ csrf_token() }}";
   $.ajax({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
      type:'POST',
      dataType:  "json",
      url : "{{url('admin/user-edit')}}/{{Request()->id}}",
      data : $('#form-data').serialize(),
      success:function(data) {
        // grecaptcha.reset();
        if(data.status==true){
            Swal.fire({
              title: data.message,
              icon: 'success',
              showDenyButton: false,
              showCancelButton: false,
              confirmButtonText: 'OK',
              confirmButtonColor: '#198754',
            }).then((result) => {
				location.reload();
            });
        }else{
            $.each(data.all_error, function( index, value ) {
               // console.log(index,value[0]);
               $('.'+index+'_error').text(value[0]);
            });
            Swal.fire(
              'FAILED!',
              data.message,
              'error'
            )
        }
        $('.ajaxloader').hide();
      },
      error: function (request, status, error) {
        $('.ajaxloader').hide();
        $('.login_login').text(error).css({'display':'block'});
      }
    });
  });

   $('.form-control').click(function(){
      $(this).closest('.form-group').find('.error').text('');
   });
});
</script>
@endsection

@endsection