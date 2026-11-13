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

                    <form method="POST" action="{{ route('otp.verify') }}">
                        @csrf

                        <input type="hidden"
                               name="user_id"
                               value="{{ $userId }}">

                        <div class="form-group mb-3">
                            <label>Enter 6 Digit OTP</label>

                            <input type="text"
                                   name="otp"
                                   class="form-control"
                                   maxlength="6"
                                   placeholder="Enter OTP"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-check-circle"></i> Verify & Login
                        </button>

                        

                    </form>

                    <div class="text-center mt-3">

                            <p id="countdownText">
                                Resend OTP in <span id="timer">60</span> seconds
                            </p>

                            <form method="POST"
                                action="{{ route('otp.resend', $userId) }}">

                                @csrf

                                <button type="submit"
                                        id="resendBtn"
                                        class="btn btn-link"
                                        disabled>
                                    Resend OTP
                                </button>

                            </form>

                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
</section>
</main>

<script>

    var resendAvailableAt = {{ $resendAvailableAt }} * 1000;

    var timerElement = document.getElementById('timer');
    var resendBtn = document.getElementById('resendBtn');
    var countdownText = document.getElementById('countdownText');

    function startCountdown() {

        function updateTimer() {

            var remaining = Math.max(
                0,
                Math.ceil((resendAvailableAt - Date.now()) / 1000)
            );

            timerElement.innerHTML = remaining;

            if (remaining <= 0) {

                resendBtn.disabled = false;

                countdownText.innerHTML = 'You can resend OTP now.';

                return;
            }

            resendBtn.disabled = true;

            setTimeout(updateTimer, 1000);
        }

        updateTimer();
    }

    startCountdown();

</script>

@endsection
