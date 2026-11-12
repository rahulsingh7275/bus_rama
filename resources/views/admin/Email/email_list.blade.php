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
                    <h1 class="subheading pb-3">Email Management</h1>
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
		       <div class="dashobard-content">
            
        		<div class="table-responsive">
    	        	@if(count($email)>0)
                <div class="row">
                    <div class="table-responsive">
                    <table class="table table-bordered table-hover table-width-fix">
                         <thead>
                            <tr>
                              <th style="text-align: center;">Alias</th>
                              <th style="text-align: center;">Subject</th>
                              <th style="text-align: center;">Message</th>
                              <th colspan="2" style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($email as $emailList)
                            <tr>
                              <td style="width:15%"  align="center">{{$emailList->alias}}</td>
                              <td style="width:15%"  align="center">{{$emailList->subject}}</td>
                              <td style="width:30%" >{!! $emailList->message !!}</td>
                              <td style="width:20%;" align="center">
                              <center class="user-list-field"><a href="{{url('admin/email-management/'.$emailList->id)}}">
                                <button class="btn btn-info btn-sm">Edit</button></a></center>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
                @else
                    <div class="row">   
                      <h4 style="text-align:center; font-weight: bold;">No Record(s) Found</h4>        
                    </div>
              @endif
        	    </div>
            </div>
        </div>
    </div>
    </div>
</div>

<script>
	$(".changestatus").click(function(){
	 $.ajax({
        type: 'get',
        url: '{{ URL("admin/change-status") }}',
        data: {
          '_token': '{{ csrf_token() }}',
         // id: id,
        },
        success: function(response) {
        if(response.status){
        	swal({
	                text:"Record Updated Successfully",
	                icon: "success",
	              })
	              .then((willDelete) => {
	              window.location.href= '{{ url('/') }}' + "/admin/updated-user-list";
	        });
                          
        }
        },
      });
	});

    window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
           $(this).remove();
       });
    }, 4000);
</script>
@endsection
