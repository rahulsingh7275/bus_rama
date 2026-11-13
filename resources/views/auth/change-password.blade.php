@extends('layouts.app')

@section('content')
<main>
    <section class="inner-banner bg_img" style="background: url({{ asset('/') }}Content/Images/AboutBack.jpg) center">
        <div class="container">
            <div class="inner-banner-content">
                <h2 class="title">Change Password</h2>
            </div>
        </div>
    </section>

    <section class="contact-section padding-top padding-bottom overflow-hidden">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Change Password</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.change.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label for="current_password" class="col-md-4 col-form-label text-md-end">Current Password</label>
                                    <div class="col-md-6">
                                        <input id="current_password" type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required autocomplete="current-password">
                                        @error('current_password')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">New Password</label>
                                    <div class="col-md-6">
                                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required minlength="8" autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-end">Confirm New Password</label>
                                    <div class="col-md-6">
                                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required minlength="8" autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
