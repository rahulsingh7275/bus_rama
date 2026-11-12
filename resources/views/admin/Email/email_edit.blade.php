@extends('layouts.adminDashboard')
@section('pageContent')
<div class="content-wrapper pt-2">
    <!--container-fluid-->
    <div class="container-fluid">
      
        <!-- Breadcrumbs-->
         <ol class="breadcrumb">
            <li class="breadcrumb-item active">Welcome! {{Auth::guard('admin')->user()->first_name}}</li>
        </ol>
        <div class="row"> 
                <div class="col-md-12"> 
                    <h1 class="subheading pb-3 headi-center">Edit Template</h1>
                </div>
            </div>
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
		      
              <form role="form" autocomplete="off" action="{{url('admin/email-management/'.$email->id)}}" method="post">
                @method('PATCH')
                {{ csrf_field() }}
                    <div class="form-row">
                        <div class="col-md-3">
                            <label class="leble-center">Alias:</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="alias" class="form-control" value="{{ $email->alias }}" readonly="readonly">
                            @if ($errors->has('alias'))
                                <span class="text-danger">{{ $errors->first('alias') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div class="form-row">
                        <div class="col-md-3">
                            <label>Subject:</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" maxlength="100" name="subject" class="form-control" required="required" placeholder="Enter Subject" value="{{ $email->subject }}">
                            @if ($errors->has('subject'))
                                <span class="text-danger">{{ $errors->first('subject') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div class="form-row">
                        <div class="col-md-3">
                            <label>Message:</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="message" required="required" class="form-control summernote" placeholder="Enter Message">{{$email->message}}</textarea>
                            @if ($errors->has('message'))
                                <span class="text-danger">{{ $errors->first('message') }}</span>
                            @endif
                        </div>
                    </div><br/>
                     
                    <div class="form-row">
                      <div class="col-md-3"></div>
                      <div class="col-lg-2 col-md-3 col-sm-3 col-5">
                        <button class="btn btn-primary"><b>Submit</b></button> 
                      </div>
                      <div class="col-lg-2 col-md-3 col-sm-3 col-5">
                        <a class="text-decoration-none btn btn-primary" href="{{url('admin/email-management')}}"><b>Back</b> </a>
                      </div>
                    </div> 
                </form>
        		
            </div>
        </div>
    </div>
</div>

<script>
	 window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
           $(this).remove();
       });
    }, 4000);
</script>
@endsection
