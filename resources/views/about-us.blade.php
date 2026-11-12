@extends('layouts.app')

@section('content')

<main>
    <section class="inner-banner bg_img" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) center">
        <div class="container">
            <div class="inner-banner-content">
                <h2 class="title">About</h2>
            </div>
        </div>
    </section>


    <section class="about-section padding-top padding-bottom">
        <div class="container">
            <div class="about-details">
                <div class="item">
                    <h4 class="title">About Us</h4>
                    <p>{{website_setting('company_name')}} is a trusted name in the travel industry, dedicated to offering memorable travel experiences for our clients. With a focus on personalized service, we provide comprehensive travel solutions for individuals, families, and groups, ensuring each trip is unique and tailored to your needs.</p>
                    <br>
                    <h4 class="title">Our Story</h4>
                    <p>Founded in 2024, {{website_setting('company_name')}} was born out of a passion for travel and a desire to make exploring the world hassle-free for everyone. Over the years, we have grown into a full-service travel company that is committed to delivering excellence, with a team of travel experts who work tirelessly to curate the best travel packages, transportation, and accommodations.</p>
                    <br>
                    <h4 class="title">What We Offer</h4>
                    <p>We specialize in a wide range of travel services, including:</p>
                    <p>Tour Packages: Whether you’re seeking adventure, cultural exploration, or a peaceful retreat, we offer custom tour</p>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
