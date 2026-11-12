@extends('contractor.layouts.app')

@section('title') Admin Login @endsection

@section('css')
<style>

</style>
@endsection

@section('breadcrumb')
Admin Login
@endsection

@section('content')

@include('notifications.notification')
<!--Start login register area-->
<section class="login-register-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                <div class="form">
                    <div class="shop-page-title">
                        <div class="title">Admin Login</div>
                    </div>
            <form method="POST" id="form-data" action="{{url('admin/login')}}" autocomplete="off">
            @csrf
            <div class="row">
             <div class="col-xl-12">
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Enter email address" required>
                        <div class="icon-holder">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </div>
                    </div>    
                </div>
                <div class="col-xl-12">
                    <div class="input-field">
                        <input type="password" name="password" class="pass_style" placeholder="Enter Password" autocomplete="new-password" required>
                        <div class="icon-holder">
                            <i class="fa fa-eye show_password" style="cursor: pointer;" aria-hidden="true"></i>
                        </div>
                    </div>    
                </div>
            </div>
            <button class="shop-btn" type="submit">Login Now</button>
        </form>
        </div>    
            </div>
            
           
        </div>
    </div>
</section>      
<!--End login register area-->

<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAR3ZzWZ0rM9TaJr5OQyXOln4h9dcaTahY&loading=async&libraries=places"></script> -->
<!-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAR3ZzWZ0rM9TaJr5OQyXOln4h9dcaTahY&loading=async&callback=initMap"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwYbCsVIHL__55hO7Fu9W7LMzl4JOKpwU&libraries=places"></script>
<!-- <input id="searchTextField" type="text" size="50"> -->

@endsection

@section('scripts')
<script>
function init() {
                var input = document.getElementById('searchTextField');
                var autocomplete = new google.maps.places.Autocomplete(input);
            }
            window.addEventListener('load', init);
            // google.maps.event.addDomListener(window, 'load', init);


$('.show_password').click(function(){
    if('password' == $('.pass_style').attr('type')){
        $(this).css({'color':'blue'});
         $('.pass_style').prop('type', 'text');
    }else{
        $(this).css({'color':'#999999'});
         $('.pass_style').prop('type', 'password');
    }
});
</script>
@endsection