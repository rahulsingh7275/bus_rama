<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{website_setting('company_name')}}</title>
        <meta name="viewport" content="width=device-width" />
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="title" content="TravelBus - Home" />
        <meta name="description" content="{{website_setting('company_name')}}" />
        <meta name="keywords" content="TravelBus" />
        <link rel="shortcut icon"
              href="{{asset('/')}}Content/Images/favicon.png"
              type="image/x-icon" />
    
        <link rel="apple-touch-icon" href="{{asset('/')}}Content/Images/logo.png" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="apple-mobile-web-app-title" content="TravelBus - Home" />
    
        <meta itemprop="name" content="TravelBus - Home" />
        <meta itemprop="description" content="{{website_setting('company_name')}}" />
    
        <meta property="og:type" content="website" />
        <meta property="og:title" content="TravelBus" />
        <meta property="og:description" content="{{website_setting('company_name')}}" />
        <meta property="og:image:type" content="image/png" />
        <meta property="og:image:width" content="1180" />
        <meta property="og:image:height" content="600" />
        <meta property="og:url" content="#" />
    
        <meta name="twitter:card" content="summary_large_image" />
    
        <!-- BootStrap Link -->
        <link rel="stylesheet" href="{{asset('/')}}Content/css/bootstrap.min.css" />
        <!-- Icon Link -->
        <!-- <link rel="stylesheet" href="{{asset('/')}}Content/css/all.min.css"> -->
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
              integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
              crossorigin="anonymous"
              referrerpolicy="no-referrer" />
        <!-- <link rel="stylesheet" href="{{asset('/')}}Content/css/line-awesome.min.css"> -->
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css" />
    
        <link rel="stylesheet" href="{{asset('/')}}Content/css/flaticon.css" />
    
        <!-- Custom Link -->
        <link rel="stylesheet" href="{{asset('/')}}Content/css/main.css" />
        <link rel="stylesheet" href="{{asset('/')}}Content/css/custom.css" />
        <link rel="stylesheet" href="{{asset('/')}}Content/css/color.css" />
        <link rel="stylesheet" href="{{asset('/')}}Content/css/select2.min.css" />
        <link rel="stylesheet" type="text/css" href="{{asset('/')}}Content/css/daterangepicker.css" />
        <link rel="stylesheet" href="{{asset('/')}}Content/css/slick.css" />
    
        <link href="{{asset('/')}}Content/css/iziToast.min.css" rel="stylesheet" />
        <link href="{{asset('/')}}Content/css/iziToast_custom.css" rel="stylesheet" />
    
    
        <style>
            .language-wrapper {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 12px;
                width: max-content;
                margin-left: 12px;
                padding: 0;
                background-color: transparent;
                border: 0;
            }
    
            .language_flag {
                flex-shrink: 0;
                display: flex;
            }
    
                .language_flag img {
                    height: 20px;
                    width: 20px;
                    object-fit: cover;
                    border-radius: 50%;
                }
    
            .language-wrapper.show .collapse-icon {
                transform: rotate(180deg);
            }
    
            .collapse-icon {
                font-size: 14px;
                display: flex;
                transition: all linear 0.2s;
                color: #111;
            }
    
            .language_text_select {
                font-size: 14px;
                font-weight: 400;
                color: #111;
            }
    
            .language-content {
                display: flex;
                align-items: center;
                gap: 6px;
            }
    
            .language_text {
                color: #111;
            }
    
            .language-list {
                display: flex;
                align-items: center;
                gap: 6px;
                padding: 6px 12px;
                cursor: pointer;
            }
    
                .language-list:hover {
                    background-color: rgba(0, 0, 0, 0.04);
                }
    
            .language .dropdown-menu {
                position: absolute;
                opacity: 0;
                visibility: hidden;
                top: 100%;
                display: unset;
                background: #ffffffea;
                box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.04), 0px 8px 16px 0px rgba(0, 0, 0, 0.08);
                min-width: 150px;
                padding: 7px 0 !important;
                border-radius: 8px;
                border: 1px solid rgb(255 255 255 / 10%);
            }
    
                .language .dropdown-menu.show {
                    visibility: visible;
                    opacity: 1;
                }
                .dropdown-item {
                    padding: 10px;
                }
                @media only screen and (max-width: 600px) {
                    .left-content {
                        display: none !important;
                    }
                    .right-content{
                        float: right;
                    }
                    .header-top-area{
                        display: block;
                    }
                }
        </style>
        
    </head>
<body>
    <!--Content Part-->

    <div class="overlay"></div>
    <!-- Preloader -->
    <div class="preloader">
        <div class="loader-wrapper">
            <div class="truck-wrapper">
                <div class="preloader-content"></div>
                <div class="truck">
                    <div class="truck-container"></div>
                    <div class="glases"></div>
                    <div class="bonet"></div>
  
                    <div class="base"></div>
  
                    <div class="base-aux"></div>
                    <div class="wheel-back"></div>
                    <div class="wheel-front"></div>
                    <div class="smoke"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader -->
    <!-- Header Section Starts Here -->
  
    <div class="header-top">
        <div class="container">
            <div class="header-top-area">
                <ul class="left-content">
                    <li>
                        <i class="las la-phone"></i>
                        <a href="tel:{{website_setting('company_contact')}}"> {{website_setting('company_contact')}}</a>
                    </li>
                    <li>
                        <i class="las la-envelope-open"></i>
                        <a href="#">
                            <span class="__cf_email__">{{website_setting('company_email')}}</span>
                        </a>
                    </li>
                </ul>
  
                <div class="right-content d-flex flex-wrap" style="gap: 10px">
                    <div></div>
                    <ul class="header-login">
                    @guest
                        <li>
                            <a class="sign-in"
                               href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i>Sign In</a>
                        </li>
                        <li>/</li>
                        <li>
                            <a class="sign-up"
                               href="{{ route('register') }}"><i class="fas fa-user-plus"></i>Sign Up</a>
                        </li>
                    @else
                        <li>
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->role=='user')
                                    <a class="dropdown-item" href="{{ route('home') }}">{{ __('My Bookings') }}</a>
                                    <a class="dropdown-item" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                                    @else
                                    <a class="dropdown-item" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                        </li>
                    @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="header-bottom-area">
                <div class="logo">
                    <a href="{{url('/')}}">
                        <img src="{{ asset('storage/' . website_setting('logo')) }}" alt="Logo" />
                    </a>
                </div>
                <!-- Logo End -->
                <ul class="menu">
                    <li>
                        <a href="{{url('/')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{url('about-us')}}">About</a>
                    </li>
                    <li>
                        <a href="{{url('gallery-page')}}">Gallery</a>
                    </li>
                    <li>
                        <a href="{{url('contact-us')}}">Contact</a>
                    </li>
                </ul>
                <div class="d-flex flex-wrap algin-items-center">
                    <a href="{{url('search-buses')}}?travel_date={{date('d/m/Y')}}"
                       class="cmn--btn btn--sm">Buy Tickets</a>
                    <div class="header-trigger-wrapper d-flex d-lg-none ms-4">
                        <div class="header-trigger d-block d-lg-none">
                            <span></span>
                        </div>
                        <div class="top-bar-trigger">
                            <i class="las la-ellipsis-v"></i>
                        </div>
                    </div>
                    <!-- Trigger End-->
                </div>
            </div>
        </div>
    </div>
  
    <!-- Header Section Ends Here -->
  
    <div class="main_content">
        @yield('content')
    </div>
  
    <!-- Footer Section Starts Here -->
    <section class="footer-section">
        <div class="footer-top">
            <div class="container">
                <div class="row footer-wrapper gy-sm-5 gy-4">
                    <div class="col-xl-4 col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <div class="logo">
                                <img src="{{ asset('storage/' . website_setting('logo')) }}"
                                     alt="Logo" />
                            </div>
                            <p>
                            {{website_setting('company_name')}} is a trusted name in the travel industry, dedicated to offering memorable travel experiences for our clients. With a focus on personalized service, we provide comprehensive travel solutions for individuals, families, and groups, ensuring each trip is unique and tailored to your needs.
                            </p>
                            <ul class="social-icons">
                                <li>
                                    <a href="#">
                                        <i class="lab la-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="lab la-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="lab la-vimeo"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="lab la-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-widget">
                            <h4 class="widget-title">Useful Links</h4>
                            <ul class="footer-links">
                                <li>
                                    <a href="{{url('about-us')}}">About</a>
                                </li>
                                <!-- <li>
                                    <a href="{{asset('faqs')}}">FAQs</a>
                                </li> -->
                                <!-- <li>
                                    <a href="#">Blog</a>
                                </li> -->
                                <li>
                                    <a href="{{url('contact-us')}}">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-widget">
                            <h4 class="widget-title">Policies</h4>
                            <ul class="footer-links">
                                <li>
                                    <a href="{{url('privacy-policy')}}">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="{{url('terms-and-conditions')}}">terms And Conditions</a>
                                </li>
                                <li>
                                    <a href="{{url('shipping-and-delivery-policy')}}">Shipping And Delivery Policy</a>
                                </li>
                                <!-- <li>
                                    <a href="#">Ticket Policies</a>
                                </li> -->
                                <li>
                                    <a href="{{url('cancellation-refund')}}">Cancellation and Refund Policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-widget">
                            <h4 class="widget-title">Contact Info</h4>
                            <ul class="footer-contacts">
                                <li>
                                    <i class="las la-map-pin"></i> {{website_setting('company_address')}}
                                </li>
                                <li>
                                    <i class="las la-phone-volume"></i>
                                    <a href="tel:{{website_setting('company_contact')}}"> {{website_setting('company_contact')}}</a>
                                </li>
                                <li>
                                    <i class="las la-envelope"></i>
                                    <a href="#">
                                        <span class="__cf_email__">{{website_setting('company_email')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('notifications.notification')
    <!-- Footer Section Ends Here -->
  
    <a href="javascript::void()" class="scrollToTop active">
        <i class="las la-chevron-up"></i>
    </a>

    <!--Links-->
    <script data-cfasync="false" src="{{asset('/')}}Content/js/email-decode.min.js"></script>
<script src="{{asset('/')}}Content/js/jquery-3.7.1.min.js"></script>
<script src="{{asset('/')}}Content/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('/')}}Content/js/main.js"></script>

<script src="{{asset('/')}}Content/js/select2.min.js"></script>
<script src="{{asset('/')}}Content/js/moment.min.js"></script>
<script src="{{asset('/')}}Content/js/daterangepicker.min.js"></script>
<script src="{{asset('/')}}Content/js/slick.min.js"></script>

<script src="{{asset('/')}}Content/js/iziToast.min.js"></script>

<script>
  "use strict";
  const colors = {
    success: "#28c76f",
    error: "#eb2222",
    warning: "#ff9f43",
    info: "#1e9ff2",
  };

  const icons = {
    success: "fas fa-check-circle",
    error: "fas fa-times-circle",
    warning: "fas fa-exclamation-triangle",
    info: "fas fa-exclamation-circle",
  };

  const notifications = [];
  const errors = [];

  const triggerToaster = (status, message) => {
    iziToast[status]({
      title: status.charAt(0).toUpperCase() + status.slice(1),
      message: message,
      position: "topRight",
      backgroundColor: "#fff",
      icon: icons[status],
      iconColor: colors[status],
      progressBarColor: colors[status],
      titleSize: "1rem",
      messageSize: "1rem",
      titleColor: "#474747",
      messageColor: "#a2a2a2",
      transitionIn: "obunceInLeft",
    });
  };

  if (notifications.length) {
    notifications.forEach((element) => {
      triggerToaster(element[0], element[1]);
    });
  }

  if (errors.length) {
    errors.forEach((error) => {
      triggerToaster("error", error);
    });
  }

  function notify(status, message) {
    if (typeof message == "string") {
      triggerToaster(status, message);
    } else {
      $.each(message, (i, val) => triggerToaster(status, val));
    }
  }
</script>

<script>
  (function ($) {
    "use strict";

    $(".select2").select2();
    const datePicker = $(".date-range").daterangepicker({
        autoUpdateInput: true,
        singleDatePicker: true,
        minDate: new Date(),
        locale: {
            format: 'DD/MM/YYYY'  // Specify the format here
        }
    });

  })(jQuery);
</script>
<script>
  $(function () {
    "use strict";

    $(".amenities-slider").slick({
      fade: false,
      slidesToShow: 6,
      slidesToScroll: 1,
      infinite: true,
      autoplay: true,
      pauseOnHover: true,
      centerMode: false,
      dots: false,
      arrows: false,
      // asNavFor: '.testimonial-img-slider',
      nextArrow: '<i class="las la-arrow-right arrow-right"></i>',
      prevArrow: '<i class="las la-arrow-left arrow-left"></i> ',
      responsive: [
        {
          breakpoint: 1199,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 500,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
      ],
    });
  });
</script>
<script>
  $(function () {
    "use strict";

    $(".testimonial-slider").slick({
      fade: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      infinite: true,
      autoplay: false,
      pauseOnHover: true,
      centerMode: true,
      dots: true,
      arrows: false,
      nextArrow: '<i class="las la-arrow-right arrow-right"></i>',
      prevArrow: '<i class="las la-arrow-left arrow-left"></i> ',
    });
  });
</script>
@yield('scripts')
</body>
</html>