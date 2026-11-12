@extends('layouts.app')

@section('content')

<main>
    <section class="inner-banner bg_img" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) center">
        <div class="container">
            <div class="inner-banner-content">
                <h2 class="title">Shipping and Delivery Policy</h2>
            </div>
        </div>
    </section>

    <section class="policy-section padding-top padding-bottom overflow-hidden">
        <div class="container">
            <div class="text-center">
                <h3 class="title mb-2">Shipping and Delivery Policy</h3>
                <p class="mb-5">Learn about our delivery process, timelines, and other policy details.</p>
            </div>
            <div class="row pb-80 gy-4 justify-content-center">
                <div class="col-sm-6 col-lg-4">
                    <div class="info-item">
                        <div class="icon">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </div>
                        <div class="content">
                            <h5 class="title">Our Office Address</h5>
                            <p>{{website_setting('company_address')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="info-item active">
                        <div class="icon">
                            <i class="fa-solid fa-phone-volume"></i>
                        </div>
                        <div class="content">
                            <h5 class="title">Contact Us</h5>
                            <p><a href="tel:{{website_setting('company_contact')}}">{{website_setting('company_contact')}}</a></p>
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
                            <p><a href="mailto:{{website_setting('company_email')}}">{{website_setting('company_email')}}</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gy-5">
                <div class="col-lg-12">
                    <div class="policy-content">
                        <h4 class="title mb-4">Delivery Information</h4>
                        <p>At {{website_setting('company_name')}}, we are committed to providing efficient and timely service for all bookings and ticket deliveries. Please review the following details for our delivery policy:</p>
                        <ul>
                            <li><strong>Booking Confirmation:</strong> All bookings are confirmed instantly upon payment. A confirmation email will be sent to the provided email address.</li>
                            <li><strong>Delivery Method:</strong> E-tickets and booking confirmations are sent via email. Physical ticket delivery is not provided as all our services are digital.</li>
                            <li><strong>Delivery Timing:</strong> Emails are typically sent within minutes. In case of delays, please contact us for assistance.</li>
                            <li><strong>Support:</strong> For any questions or issues, feel free to reach out through our contact details provided.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
