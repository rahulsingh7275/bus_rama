@extends('layouts.app')

@section('content')

<main>
        <section class="inner-banner bg_img" style="background: url({{asset('/')}}Content/Images/AboutBack.jpg) center">
            <div class="container">
                <div class="inner-banner-content">
                    <h2 class="title">Privacy Policy</h2>
                </div>
            </div>
        </section>
    
    
    
    <section class="about-section padding-top padding-bottom">
        <div class="container">
            <div class="about-details">
                <div class="item">
                    
                <h1>Privacy Policy</h1>

    <p>At <strong>{{website_setting('company_name')}}</strong>, we value your privacy and are committed to protecting your personal information. This Privacy Policy outlines the types of information we collect, how we use it, and the measures we take to ensure your data is protected.</p>
    <br>
    <h2>1. Information We Collect</h2>
    <br>
    <ul>
        <li><strong>Personal Information</strong>: When you make a booking or contact us, we may collect personal details such as your name, email address, phone number, and payment information.</li>
        <li><strong>Travel Information</strong>: We collect information related to your travel preferences, including destination, trip dates, and special requests.</li>
        <li><strong>Technical Information</strong>: When you visit our website, we may collect data such as your IP address, browser type, and operating system to improve our services.</li>
    </ul>

    <h2>2. How We Use Your Information</h2>
    <br>
    <ul>
        <li><strong>Booking and Customer Support</strong>: We use your information to process bookings, provide customer support, and communicate important travel-related information.</li>
        <li><strong>Personalization</strong>: To tailor your experience, we may use your travel preferences to offer customized recommendations and special offers.</li>
        <li><strong>Marketing</strong>: With your consent, we may send you promotional emails about new services, discounts, or special travel packages.</li>
        <li><strong>Improving Our Website</strong>: We use technical information to analyze website usage, improve functionality, and enhance user experience.</li>
    </ul>
<br>
    <h2>3. How We Protect Your Information</h2>
    <br>
    <ul>
        <li><strong>Data Security</strong>: We employ various security measures, such as encryption and secure servers, to protect your personal information from unauthorized access or misuse.</li>
        <li><strong>Data Retention</strong>: We retain your information for as long as necessary to fulfill the purposes outlined in this Privacy Policy, or as required by law.</li>
    </ul>
<br>
    <h2>4. Sharing Your Information</h2>
    <br>
    <ul>
        <li><strong>Third-Party Service Providers</strong>: We may share your information with trusted third-party partners (e.g., hotels) to facilitate bookings and services. They are required to keep your information confidential and use it only for the agreed purposes.</li>
        <li><strong>Legal Requirements</strong>: We may disclose your information if required by law or in response to legal processes to protect our rights and comply with governmental regulations.</li>
    </ul>
<br>
    <h2>5. Cookies and Tracking Technologies</h2>
    <br>
    <p>We use cookies to enhance your browsing experience by storing small pieces of data on your device. These help us understand user preferences, track website performance, and provide personalized content.</p>
<br>
    <h2>6. Your Rights</h2>
    <br>
    <ul>
        <li><strong>Access and Update</strong>: You have the right to access and update the personal information you have provided to us.</li>
        <li><strong>Withdraw Consent</strong>: You can withdraw your consent for marketing communications at any time by clicking the “unsubscribe” link in our emails or contacting us directly.</li>
        <li><strong>Data Deletion</strong>: You may request that we delete your personal information, except where we are required to retain it by law.</li>
    </ul>
    <br>
    <h2>7. Third-Party Links</h2>
    <br>
    <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices or content of these external sites. We recommend reviewing their privacy policies before sharing any personal information.</p>
    <br>
    <h2>8. Changes to This Privacy Policy</h2><br>
    <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page, and we encourage you to review it periodically. Your continued use of our services after any changes signifies your acceptance of the updated terms.</p>
    <br>
    <h2>9. Contact Us</h2><br>
    <p>If you have any questions or concerns regarding this Privacy Policy, please contact us at:</p>
    <ul>
        <li><strong>Email</strong>: {{website_setting('company_email')}}</li>
        <li><strong>Phone</strong>: {{website_setting('company_contact')}}</li>
    </ul>



                </div>
            </div>
        </div>
    </section>
    </main>

@endsection
