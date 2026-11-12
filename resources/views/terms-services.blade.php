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
            </div>
            <div class="row pb-80 gy-4 justify-content-center">
                <div class="col-lg-12">
                    <div class="terms-content">
                        <p>
                            Thank you for accessing/shopping at <a href="{{url('/')}}">{{url('/')}}</a>. This site is owned by {{website_setting('company_name')}} (hereinafter referred to as “{{url('/')}}”). By accessing, shopping on this site, you indicate your unconditional acceptance of these terms & conditions. We reserve this right, in our sole discretion, to update or revise these terms & conditions. Continued use of the site following the posting of any changes to the ‘terms & conditions’, constitutes your acceptance of those changes. At “{{url('/')}}”, we try our best to create a space where you can explore and shop for all your favorite things in a safe and secure environment. All products servicesand information displayed on “{{url('/')}}” constitutes an "invitation to offer". “{{url('/')}}” reserves the right to accept or reject your offer. Your order for purchaseServices, constitutes your "offer" which shall be subject to the terms and conditions as listed below.
                        </p>
                        <br>
                            <h5>1. Eligibility to use our site</h5>
                            <p>
                                Use of the Site is available only to persons who can legally enter into contracts under applicable laws. Persons who are "incompetent to contract", within the meaning of the Indian Contract Act, 1872 including un-discharged insolvents etc. are not eligible to use the Site. “{{url('/')}}” reserves the right to terminate your access to the Site if it discovers that you are under the age of 18 years or suffers from any other disability, as recognized under Indian Contract Act, 1872.
                            </p>
                        <br>
                            
                            <h5>2. Membership</h5>
                            <p>
                                Although it is essential to have an account to shop with “{{url('/')}}”. As a member, you agree to provide true, accurate, current, and complete information about yourself as prompted by the site's registration form. Registration where prohibited under any law shall be void. “{{url('/')}}” reserves the right to revoke or terminate your registration for any reason at any time, without notice. 
                            </p>
                        <br>
                            <h5>3. Electronic Communications</h5>
                            <p>
                                When you use the site or send emails or other data, information or communicate to us, you agree and understand that you are communicating with us electronically and give your consent to receive communications electronically from us periodically, when required.
                            </p>
                        <br>
                            <h5>4. Reviews, Feedback, Submissions</h5>
                            <p>
                                All reviews, comments, feedback, postcards, suggestions, ideas, and other submissions disclosed, submitted or offered to “{{url('/')}}” directly or otherwise disclosed, submitted or offered in connection with your use of this Site (collectively referred to "Comments") will remain “{{url('/')}}” property. Such disclosure, submission or offer of any comments shall constitute an assignment to “{{url('/')}}” of all worldwide rights, titles and interests in all copyrights and other intellectual properties in the comments,thus, it exclusively owns all such rights, titles and interests and shall not be limited in any way in its use, commercial or otherwise. “{{url('/')}}” will be entitled to use, reproduce, disclose, modify, adapt, create derivative works from, publish, display and distribute any comments you submit for any purpose whatsoever, without restriction and without compensating you in any way. “{{url('/')}}” is and shall be under no obligation (1) to maintain any Comments in confidence; or (2) to pay you any compensation for any Comments; or (3) to respond to any Comments. You agree that any comments submitted by you to the Site will not violate this policy or any right of any third party, including copyright, trademark, privacy or other personal or proprietary right(s), and will not cause injury to any person or entity. You further agree that no comments submitted by you to the site will be libelous or otherwise unlawful, threatening, abusive or obscene material, or contain software viruses, political campaigning, commercial solicitation, chain letters, mass mailings or any form of "spam".
                            </p>
                            <p>
                                “{{url('/')}}” does not regularly review posted comments, but does reserve the right (but not the obligation) to monitor and edit or remove any comment submitted to the Site. You grant “{{url('/')}}” the right to use the name that you submit in connection with any of the posted comments. You agree not to use a false email address, impersonate any person or entity, or otherwise mislead as to the origin of any Comments you submit. You are and shall remain solely responsible for the content of any comments you make and you agree to indemnify “{{url('/')}}” and its affiliates for all claims resulting from any Comments you submit, we take no responsibility and assume no liability for any comments submitted by you or any third party.
                            </p>
                        <br>
                            <h5>5. Accuracy of Content/ Information of Products on the Web Site</h5>
                            <p>
                                While “{{url('/')}}” strives to provide accurate product and pricing information, typographical errors may occur. In the event that a product service is listed at an incorrect price or with incorrect information due to an error in pricing or service product information, “{{url('/')}}” shall have the right, on our sole discretion, to modify the price of the products, or information of the products or to refuse or cancel any orders placed for that product, unless the product has already been dispatched. In the event.
                            </p>
                            
                            

                        {{--<h5 class="mt-4">Contact Information</h5>
                        <p>If you have any questions regarding these terms, please reach out to us at:</p>
                        <ul>
                            <li><strong>Address:</strong> {{website_setting('company_address')}}</li>
                            <li><strong>Phone:</strong> <a href="tel:{{website_setting('company_contact')}}">{{website_setting('company_contact')}}</a></li>
                            <li><strong>Email:</strong> <a href="mailto:{{website_setting('company_email')}}">{{website_setting('company_email')}}</a></li>
                        </ul>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
