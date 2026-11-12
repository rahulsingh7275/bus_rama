<!DOCTYPE html>
<!-- Template Name: DashCode - HTML, React, Vue, Tailwind Admin Dashboard Template Author: Codeshaper Website: https://codeshaper.net Contact: support@codeshaperbd.net Like: https://www.facebook.com/Codeshaperbd Purchase: https://themeforest.net/item/dashcode-admin-dashboard-template/42600453 License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project. -->
<html lang="zxx" dir="ltr" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('frontend_assets')}}/images/favicon/apple-touch-icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" href="{{asset('auth_asset')}}/css/rt-plugins.css">
    <link rel="stylesheet" href="{{asset('auth_asset')}}/css/app.css">
    <link rel="stylesheet" href="{{asset('lightbox/dist/css/lightbox.min.css')}}">
    <link rel="icon" type="image/png" href="{{asset('frontend_assets')}}/images/favicon/fevicon.png" sizes="32x32">
    <link rel="icon" type="image/png" href="{{asset('frontend_assets')}}/images/favicon/fevicon.png" sizes="16x16">

    <!-- End : Theme CSS-->
    <script src="{{asset('auth_asset')}}/js/settings.js" sync></script>

<!-- datatable button CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
<style>
.dt-search label{
    width: 150px;
}
</style>
<!-- datatable button CSS -->

    @yield('css')

</head>

<body class=" font-inter dashcode-app" id="body_class">
    <!-- [if IE]> <p class="browserupgrade"> You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security. </p> <![endif] -->
    <main class="app-wrapper">
        <!-- BEGIN: Sidebar -->
        <!-- BEGIN: Sidebar -->

        @include('admin.auth-layouts.sidebar')

        <div class="flex flex-col justify-between min-h-screen">

            <div>
                @include('admin.auth-layouts.header')

                <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
                    @yield('content')
                </div>

            </div>

            <!--Start footer area-->  
            @include('admin.auth-layouts.footer')
            <!--End footer bottom area-->   

        </div>
    </main>
  <!-- scripts -->
  <script src="{{asset('auth_asset')}}/js/jquery-3.6.0.min.js"></script>
  <script src="{{asset('auth_asset')}}/js/rt-plugins.js"></script>
  <script src="{{asset('auth_asset')}}/js/app.js"></script>
  <script src="{{asset('lightbox/dist/js/lightbox-plus-jquery.min.js')}}"></script>

  @include('notifications.notification')

<!-- datatable button JS -->
<script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<!-- datatable button JS -->

@yield('scripts')

<script>
function fresh_chat_notifications(){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : "{{ url('admin/chat-notifications') }}",
        data : {'_token' : "{{csrf_token()}}"},
        type : 'POST',
        dataType : 'json',
        success : function(result){
            if(result.success==true){
                $('.chat-notifications').html(result.html);
                var chat_count = parseInt($('.chat-notifications-count').text());
                if(chat_count != result.chat_count){
                    $('.chat-notifications-count').animate({zoom: '200%'}, "fast");
                    $('.chat-notifications-count').animate({zoom: '100%'}, "slow");
                }
                $('.chat-notifications-count').html(result.chat_count);
            }
        },
        error: function (request, status, error) {
            // alert(error);
        }
    });
}
setInterval(function(){fresh_chat_notifications();}, 10000);
//  fresh_chat_notifications();
</script>
</body>
</html>