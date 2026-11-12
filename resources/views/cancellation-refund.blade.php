@extends('layouts.app')

@section('content')

<main>
        <section class="inner-banner bg_img" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) center">
            <div class="container">
                <div class="inner-banner-content">
                    <h2 class="title">Cancellation & Refund</h2>
                </div>
            </div>
        </section>
    
    
    
        <section class="about-section padding-top padding-bottom">
        <div class="container">
            <div class="about-details">
                <div class="item">
                    
                
                <h1>Refund Policy and Ticket Cancellation</h1><br>
    <p>At <strong>{{website_setting('company_name')}}</strong>, we strive to provide a hassle-free experience for our customers. Please read the following guidelines regarding our refund and ticket cancellation policy.</p>
<br>
    <h2>Cancellation Policy</h2>
    <br>
    <ul>
        <li><strong>Cancellations Before 2 Hours of Departure</strong>
            <ul>
                <li>If you wish to cancel your ticket, you can do so up to <strong>2 hours before the scheduled departure time</strong> of the bus.</li>
                <li>In case of cancellation, a <strong>refund will be provided</strong> after deducting a <strong>20% cancellation fee</strong> from the total ticket amount.</li>
            </ul>
        </li>
        <li><strong>Cancellations Within 2 Hours of Departure or After Departure</strong>
            <ul>
                <li>Tickets cancelled within <strong>2 hours of departure</strong> or after the bus has departed are <span class="important">non-refundable</span>.</li>
                <li>No refund will be issued for last-minute cancellations or if the passenger does not board the bus.</li>
            </ul>
        </li>
    </ul>
    <br>
    <h2>Refund Process</h2><br>
    <ul>
        <li>Refunds will be processed within <strong>7-10 business days</strong> after the cancellation request is confirmed.</li>
        <li>Refunds will be credited back to the original mode of payment used during booking.</li>
        <li>In the case of third-party payment platforms, delays may occur based on their processing times.</li>
    </ul>
    <br>
    <h2>How to Cancel Your Ticket</h2><br>
    <ul>
        <li>You can cancel your ticket through the following methods:</li>
        <ul>
            <li><strong>Online</strong>: Log in to your account on our website and navigate to the "My Bookings" section to initiate a cancellation request.</li>
            <li><strong>Customer Support</strong>: Contact our customer support team at [{{website_setting('company_email')}}] to assist you with the cancellation process.</li>
        </ul>
    </ul>
    <br>
    <h2>Important Points to Note</h2><br>
    <ul>
        <!-- <li><strong>Partial Cancellations</strong>: Partial cancellations (for multiple passengers under a single booking) are allowed only if the request is made 2 hours before departure.</li> -->
        <li><strong>Non-Refundable Situations</strong>: If the cancellation request is made after the bus has departed, no refund will be provided.</li>
        <li><strong>Force Majeure</strong>: In case of unforeseen circumstances such as natural disasters, strikes, or other events beyond our control, the refund policy may be adjusted according to the situation.</li>
    </ul>

    <p>We appreciate your understanding and cooperation with these policies. Should you have any questions or need assistance, please reach out to our customer service team.</p>



                </div>
            </div>
        </div>
    </section>
    </main>

@endsection
