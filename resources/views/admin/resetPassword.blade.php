@extends('layouts.home')
@section('content')

		@if($errorMessage)
	        <h5 style="color:red;"><center>{{$errorMessage}}</center></h5>
	    @endif
		@if(session()->has('message'))
            <div class="alert alert-success">
              {{ session()->get('message') }}
            </div>
        @endif
		<div class="flash-message">
		    @if(session('fail'))
			<div class='alert alert-danger'>
				<p align="center">{{ session('fail')}}</p>
			</div>
			@endif
		</div>
	@if($errorMessage == '')
		<div class="login">
		<a href="#">
			<img src="../../public/assets/images/logo-hcsa.png">
		</a>
		<h4 class="login-heading">HCSA Virtual Christmas Reset Password</h4>
		<form action="{{url('admin/reset-password/save/'.$code)}}" method="post" name="adminLoginForm" class="login-form hcsa-login password-reset" >
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="login-input">
				<label for="password">
					<strong>New Password:</strong>
				</label>
					<input type="password" name="new_pass" placeholder="Enter Your New Password" value="{{old('new_pass')}}" maxlength="50">
					@if ($errors->has('new_pass'))
		             <small class="text-danger error-show" id="errorMessage">{{ $errors->first('new_pass') }}</small>
		            @endif
	            <br/>
	        </div>

	        <div class="login-input">
				<label for="password">
					<strong>Confirm Password:</strong>
				</label>
					<input type="password" name="con_pass" placeholder="Enter Your Confirm Password" value="{{old('con_pass')}}" maxlength="50">
					@if ($errors->has('con_pass'))
		             <small class="text-danger error-show" id="errorMessage">{{ $errors->first('con_pass') }}</small>
		            @endif
            	<br/>
        	</div>

			<div class="submit-button">
		        <input type="submit" value='Submit' name="log_in" id="btn" >
		    
	        </div>

		</form>
	</div>
@endif

<script type="text/javascript">
    window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
           $(this).remove();
       });
    }, 5000);
</script>
@endsection


