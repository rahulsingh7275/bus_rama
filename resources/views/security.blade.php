@extends('layouts.app')

@section('content')

<main>
        <section class="inner-banner bg_img" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) center">
            <div class="container">
                <div class="inner-banner-content">
                    <h2 class="title">Security</h2>
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
                <div class="row gy-5">
                    <div class="col-lg-6">
                        <div class="contact-form-wrapper">
                            <h4 class="title mb-4">Have any Questions?</h4>
                            <form class="contact-form row gy-3" method="post">
                                <input type="hidden" name="_token" value="GMMkMVacYmRowtE2cQRmR7onK6sKg40GaOFsRfAq" autocomplete="off">                        <div class=" col-xl-6 col-lg-12 col-md-6">
                                    <div class="form--group">
                                        <label for="name">Name <span>*</span></label>
                                        <input id="name" name="name" type="text" class="form--control" placeholder="Name" value="" required>
                                    </div>
                                </div>
                                <div class=" col-xl-6 col-lg-12 col-md-6">
                                    <div class="form--group">
                                        <label for="email">Email <span>*</span></label>
                                        <input id="email" name="email" type="email" class="form--control" placeholder="Email" value="" required>
                                    </div>
                                </div>
                                <div class=" col-xl-12">
                                    <div class="form--group">
                                        <label for="subject">Subject <span>*</span></label>
                                        <input id="subject" name="subject" type="text" class="form--control" placeholder="Subject" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form--group">
                                        <label for="msg">Your Message <span>*</span></label>
                                        <textarea id="msg" name="message" class="form--control" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form--group">
                                        <button class="cmn--btn" type="submit">Send Us Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="map-wrapper">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d227821.98710099774!2d80.77769644139205!3d26.848902831205773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399bfd991f32b16b%3A0x93ccba8909978be7!2sLucknow%2C%20Uttar%20Pradesh!5e0!3m2!1sen!2sin!4v1724150933820!5m2!1sen!2sin" width="600" height="450" style="border:0;" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
