@extends('layouts.app')

@section('content')

<main>
    <section class="inner-banner bg_img" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) center">
        <div class="container">
            <div class="inner-banner-content">
                <h2 class="title">Sign In</h2>
            </div>
        </div>
    </section>


<section class="contact-section padding-top padding-bottom overflow-hidden">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                   

                    <form method="GET" action="{{ url('otp-login') }}">

                        <div class="form-group mb-3">
                            <label>Mobile Number</label>

                            <input type="text"
                                   name="mobile"
                                   class="form-control @error('mobile') is-invalid @enderror"
                                   maxlength="10"
                                   placeholder="Enter mobile number"
                                   value="{{ old('mobile') }}"
                                   required>
                        </div>

                        <button type="submit" id="sendOtpBtn" class="btn btn-success btn-block">
                            <i class="fas fa-mobile-alt"></i> Send OTP
                        </button>
                        <a href="{{url('login')}}" class="btn btn-info btn-block"><i class="fas fa-envelope"></i> Login with Email</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
</main>

@if(Request()->mobile)
    @include('msg91')
@endif



@endsection
