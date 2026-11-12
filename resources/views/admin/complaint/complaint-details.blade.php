@extends('admin.auth-layouts.app')

@section('title') Complaint Detail @endsection

@section('css')
<style>

</style>
@endsection


@section('content')
<!-- <div class="page-content"> -->
  <!-- <div class="transition-all duration-150 container-fluid" id="page_layout"> -->
    <div id="content_layout">
      
    <!-- work area starts-->
    <!-- <title>Complaint details with chatting history</title> -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')



<div class="content-wrapper" style="min-height: 113px;">
    <!-- Content Header (Page header) -->
    <div class="content-header container">
        <div class="row mb-2 pt-2">
          <div class="col-md-8">
            <h3 class="text-left">Complaint details with chatting history</h3>
          </div>
          <div class="col-md-4" style="text-align: right;">
            <a href="{{url('admin/complaints')}}" class="btn btn-success">Complaints List</a>
          </div>
          <div class="col-md-12">
            @include('notifications.notification')
          </div>
          
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->


<section >
  <div class="container">

    <div class="row d-flex justify-content-center">
      <div class="col-md-12 col-lg-12 col-xl-12">


        <div class="card" id="chat1" style="border-radius: 15px;">
          <div class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white border-bottom-0"
            style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
            <p class="mb-0 fw-bold">Ticket history (#{{Request()->complaint_no}}), Contractor : {{$single_chat->user->name}}</p>
            @if($single_chat->status=='Pending')
            <a href="{{url('admin/complaint-closed')}}?complaint_no={{$single_chat->complaint_no}}" class="btn btn-danger" onclick="return conform('Are you sure?\nYou want to close this ticket?');">Close this ticket</a>
            @endif
          </div>
          <div class="card-body">
            <div id="chat-container" style="position: relative; height: 300px;overflow-y: scroll;">
              <div class="chat-container" style="padding: 0px 20px">
              @include('complaint.chatting-messages')
              </div>
          </div>

            <div class="form-outline">
            @if($single_chat->status!='Pending')
            <br/>
            <h5 class="text-center text-success">This Ticket is closed</h5>
            @else
                <form action="" id="save_chattings">
                  @csrf
                    <textarea class="form-control complaint" name="complaint" id="textAreaExample" rows="3"></textarea>
                    <label class="form-label" for="textAreaExample">Type your message</label>
                    <input type="file" id="fileInput" name="attached" style="display: none;">
                    <input type="hidden" name="complaint_no" value="{{Request()->complaint_no}}">
                    <input type="hidden" name="responder_type" value="Admin">
                    <input type="hidden" name="responder_type" value="Admin">
                    <button type="submit" class="btn btn-primary" style="width: 100%;" name="Send">Send</button>
                </form>
            @endif
            </div>
            <div class="lower_view"></div>

          </div>
        </div>



<!-- /.content -->
</div>
<!-- work area ends -->

</div>
<!-- </div> -->
<!-- </div> -->



@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/bootstrap/css/complaint-history.css')}}">
@endsection
@section('scripts')
<script>
     // Bind Enter key press event for the complaint input field
    // $('.complaint').keydown(function(e) {
    //     if (e.keyCode === 13 && !e.shiftKey) {
    //         e.preventDefault();
    //         save_chatting(); // Trigger form submission on Enter key press
    //     }
    // });

$('#save_chattings').submit(function(e) {
		e.preventDefault();
    const fileInput = document.getElementById("fileInput");
    const selectedFile = fileInput.files[0];
    var complaint = $('.complaint').val();
    if (complaint == '' && fileInput.value=='') {
        return false;
    }
		var formData = new FormData(this);
		$.ajax({
			headers: {
				'X-CSRF-Token': $('meta[name=_token]').attr('content')
			},
			type: 'POST',
      url: "{{ url('complaint-details') }}",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			success: function (response) {
          if (response.success === true) {
              // If the message is successfully sent, update the chat
              get_chatting();
              $('#save_chattings').trigger('reset');
          }
      },
			error: function(request, status, error) {
				
			}
		});
	});
    
$(document).ready(function() {
    // Call the get_chatting function every 3 seconds
    setInterval(function() {
        get_chatting();
    }, 3000);
});

function get_chatting() {
    $.ajax({
        url: "{{url('admin/complaint-details?complaint_no=')}}{{Request()->complaint_no}}",
        type: "GET",
        dataType: "json",
        success: function(response) {
            if (response.success == true) {
                $('.chat-container').html(response.html);
                $('#chat-container').scrollTop($('#chat-container')[0].scrollHeight);
            }
        }
    });
}
</script>

</script>
@endsection