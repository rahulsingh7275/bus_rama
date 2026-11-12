@extends('layouts.app')

@section('content')
<style>
.gallery-container .col-md-3{
    padding: 0px !important;
}
</style>
<!-- datatable button CSS -->

<main>
        <section class="inner-banner bg_img" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) center">
            <div class="container">
                <div class="inner-banner-content">
                    <h2 class="title">Profile</h2>
                </div>
            </div>
        </section>
    
    
    
        <section class="contact-section padding-top padding-bottom overflow-hidden">
            <div class="container">

        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th colspan="2"><h5>Profile Details</h5></th>
                </tr>
                <tr>
                    <th>Name</th><td>{{Auth::user()->name}}</td>
                </tr>
                <tr>
                    <th>Email</th><td>{{Auth::user()->email}}</td>
                </tr>
            </table>
           
        </div>


            </div>
        </section>
    </main>


@endsection


