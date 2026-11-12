@extends('layouts.app')

@section('content')

<main>
    <section class="inner-banner bg_img" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) center">
        <div class="container">
            <div class="inner-banner-content">
                <h2 class="title">Terms and Conditions</h2>
            </div>
        </div>
    </section>

    <section class="terms-section padding-top padding-bottom overflow-hidden">
        <div class="container">
            <div class="text-center">
                <h3 class="title mb-2">Terms and Conditions</h3>
                <p class="mb-5">Please read these terms carefully before using our services.</p>
            </div>
            <div class="row pb-80 gy-4 justify-content-center">
                <div class="col-lg-12">
                    <div class="terms-content">
                        <h4 class="title mb-4">Welcome to {{website_setting('company_name')}}</h4>
                        <p>These terms and conditions outline the rules and regulations for the use of {{website_setting('company_name')}}' website and services. By accessing this website, we assume you accept these terms. Do not continue to use our services if you do not agree to all of the terms and conditions stated on this page.</p>
                        
                        <h5 class="mt-4">1. Terms of Service</h5>
                        <p>Our services are subject to availability, and we reserve the right to modify or discontinue services without notice. By booking with us, you agree to the terms related to payments, cancellations, and refunds.</p>

                        <h5 class="mt-4">2. Privacy Policy</h5>
                        <p>We prioritize the privacy of our customers. All personal information collected will be handled in accordance with our <a href="{{ url('privacy-policy') }}">Privacy Policy</a>.</p>

                        <h5 class="mt-4">3. Limitation of Liability</h5>
                        <p>{{website_setting('company_name')}} shall not be held liable for any damages arising from the use or inability to use our services. This includes any direct, indirect, incidental, or consequential damages.</p>

                        <h5 class="mt-4">4. Contact Information</h5>
                        <p>If you have any questions regarding these terms, please reach out to us at:</p>
                        <ul>
                        <li><strong>Address:</strong> {{website_setting('company_address')}}</li>
                            <li><strong>Phone:</strong> <a href="tel:{{website_setting('company_contact')}}">{{website_setting('company_contact')}}</a></li>
                            <li><strong>Email:</strong> <a href="mailto:{{website_setting('company_email')}}">{{website_setting('company_email')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
