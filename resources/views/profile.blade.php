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
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Edit Profile</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="form-control @error('name') is-invalid @enderror" required maxlength="255" autocomplete="name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                                        <div class="col-md-6">
                                            <input id="email" type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror" required maxlength="255" autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="mobile" class="col-md-4 col-form-label text-md-end">Mobile Number</label>
                                        <div class="col-md-6">
                                            <input id="mobile" type="tel" name="mobile" value="{{ old('mobile', Auth::user()->mobile) }}" class="form-control @error('mobile') is-invalid @enderror" required inputmode="numeric" maxlength="10" autocomplete="tel">
                                            @error('mobile')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
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

