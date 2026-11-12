@extends('layouts.home')
@section('content')

<body class="alert-login">
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
	<div class="login">
		<a href="#">
			<img src="../public/assets/images/logo-hcsa.png">
		</a>
		<h4 class="login-heading">HCSA Virtual Christmas Tree Forgot Password</h4>
		<form name="myForm" action="{{url('/admin/forgot-password/save')}}" method="post" class="login-form hcsa-login">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="login-input">
				<label for="name">Email</label>
				<input type="text" name="email" placeholder="Enter Your Email" value="{{old('email')}}" maxlength="50">
				@if ($errors->has('email'))
			        <span class="text-danger mandatory-field fontincrease">{{ $errors->first('email') }}</span>
			    @endif
			<br/>
			</div>
			
			<div class="submit-button">
		        <button type="submit" name="log_in" id="btn" >Submit
		        </button>
	        </div>

		</form>
		<p align="center" class="admin-forgot-password">
					<a href="{{url('admin')}}" class="back-login">Back to login</a>
				</p>
	</div>
	
    
</body>

<script type="text/javascript">

    window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
           $(this).remove();
           $('.login').hide();
           window.location.href="{{url('admin')}}"
       });
    }, 4000);
</script>
@endsection

