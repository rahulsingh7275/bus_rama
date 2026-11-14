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
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('otp.send') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label>Mobile Number</label>

                            <input type="text"
                                   name="mobile"
                                   class="form-control @error('mobile') is-invalid @enderror"
                                   maxlength="10"
                                   placeholder="Enter mobile number"
                                   value="{{ old('mobile') }}"
                                   required>
                            @error('mobile')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <p id="countdownText" class="text-center" hidden>
                            Send OTP again in <span id="timer"></span> seconds
                        </p>

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

@if (!empty($resendAvailableAt) && !empty($resendMobile))
<script>
    var resendAvailableAt = {{ $resendAvailableAt }} * 1000;
    var resendMobile = @json($resendMobile);
    var mobileInput = document.querySelector('input[name="mobile"]');
    var timerElement = document.getElementById('timer');
    var sendOtpBtn = document.getElementById('sendOtpBtn');
    var countdownText = document.getElementById('countdownText');
    var resendTimer;

    function updateSendOtpState() {
        clearTimeout(resendTimer);
        var matchesLastSentMobile = /^\d{10}$/.test(mobileInput.value) &&
            mobileInput.value === resendMobile;
        var remaining = Math.max(0, Math.ceil((resendAvailableAt - Date.now()) / 1000));

        if (!matchesLastSentMobile || remaining <= 0) {
            countdownText.hidden = true;
            sendOtpBtn.disabled = false;
            return;
        }

        countdownText.hidden = false;
        timerElement.textContent = remaining;
        sendOtpBtn.disabled = true;

        resendTimer = setTimeout(updateSendOtpState, 1000);
    }

    mobileInput.addEventListener('input', updateSendOtpState);
    updateSendOtpState();
</script>
@endif

@include('msg91')
@endsection
