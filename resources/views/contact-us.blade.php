@extends('layouts.app')

@section('content')

<main>
        <section class="inner-banner bg_img" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) center">
            <div class="container">
                <div class="inner-banner-content">
                    <h2 class="title">Contact Us</h2>
                </div>
            </div>
        </section>
    
    
    
        <section class="contact-section padding-top padding-bottom overflow-hidden">
            <div class="container">
                <div class="text-center">
                    <h3 class="title mb-2">Let's get in touch</h3>
                    <p class="mb-5">We are open for any suggestion or just to have a chat</p>
                </div>
                <div class="row pb-80 gy-4 justify-content-center">
                    <div class="col-sm-6 col-lg-4">
                        <div class="info-item">
                            <div class="icon">
                                <i class="fa-solid fa-map-location-dot"></i>
                            </div>
                            <div class="content">
                                <h5 class="title">Our Address</h5>
                                Address : {{website_setting('company_address')}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="info-item active">
                            <div class="icon">
                                <i class="fa-solid fa-phone-volume"></i>
                            </div>
                            <div class="content">
                                <h5 class="title">Call Us</h5>
                                <a href="tel:{{website_setting('company_contact')}}">{{website_setting('company_contact')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="info-item">
                            <div class="icon">
                                <i class="fa-solid fa-envelope-open-text"></i>
                            </div>
                            <div class="content">
                                <h5 class="title">Email Us</h5>
                                <a href="#"><span class="__cf_email__">{{website_setting('company_email')}}</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
