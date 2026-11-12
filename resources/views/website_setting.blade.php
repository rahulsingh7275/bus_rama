@extends('layouts.app')

@section('content')

<main>
        <section class="inner-banner bg_img" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) center">
            <div class="container">
                <div class="inner-banner-content">
                    <h2 class="title">Website Setting</h2>
                </div>
            </div>
        </section>
    
    
    
        <section class="about-section padding-top padding-bottom">
        <div class="container">
            
        <form action="" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="company_name">Company Name:</label>
            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', @$setting->company_name) }}">
            @error('company_name') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="company_contact">Company Contact:</label>
            <input type="text" class="form-control" id="company_contact" name="company_contact" value="{{ old('company_contact', @$setting->company_contact) }}">
            @error('company_contact') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="company_email">Company Email:</label>
            <input type="text" class="form-control" id="company_email" name="company_email" value="{{ old('company_email', @$setting->company_email) }}">
            @error('company_email') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="company_address">Company Address:</label>
            <input type="text" class="form-control" id="company_address" name="company_address" value="{{ old('company_address', @$setting->company_address) }}">
            @error('company_address') <div style="color: red;">{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="ticket_prefix">Ticket Prefix:</label>
            <input type="text" class="form-control" id="ticket_prefix" name="ticket_prefix" value="{{ old('ticket_prefix', @$setting->ticket_prefix) }}">
            @error('ticket_prefix') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        
        <div>
            <label for="logo">Website Logo:</label>
            <input type="file" class="form-control" id="logo" name="logo" accept=".jpg, .jpeg, .png">
            @if(@$setting->logo)
                <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" height="100">
            @endif
            @error('logo') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        <br>
        <button type="submit">Save Settings</button>
    </form>

        </div>
    </section>
    </main>

@endsection
