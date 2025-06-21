<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $title??'Title this' }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/') }}assets/img/favicon.png">
    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/preloader.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/meanmenu.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/swiper-bundle.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/backToTop.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/fontAwesome5Pro.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/flaticon.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/elegenticons.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/default.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/css/style.css">
</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->

    <!-- Add your site or application content here -->

    <!-- pre loader area start -->
    {{-- <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="loading-icon text-center d-sm-flex align-items-center">
                    <img class="loading-logo mr-10" src="{{ asset('assets/img/preloader/preloader-icon.png') }}" alt="">
                    <img src="{{ asset('assets/img/preloader/preloader-logo.png') }}" alt="">
                </div>
            </div>
        </div>
    </div> --}}
    <!-- pre loader area end -->

    <!-- header  -->
    @include('app.header')
    <!-- header end -->


    <!-- search popup area start -->
    <div class="search__popup transition-3">
        <div class="search__popup-close">
            <button type="button" class="search-popup-close-btn"><i class="fal fa-times"></i></button>
        </div>
        <div class="search__popup-wrapper">
            <form action="#">
                <div class="search__popup-input">
                    <input type="text" placeholder="Enter Your Keyword...">
                    <button type="submit"><i class="far fa-search"></i> </button>
                </div>
            </form>
        </div>
    </div>
    <!-- search popup area end -->

    <!-- sidebar area start -->
    <div class="sidebar__area">
        <div class="sidebar__wrapper">
            <div class="sidebar__close">
                <button class="sidebar__close-btn" id="sidebar__close-btn">
                    <i class="fal fa-times"></i>
                </button>
            </div>
            <div class="sidebar__content">
                <div class="logo mb-40">
                    <a href="index.html">
                        <img src="assets/img/logo/logo-dark.png" alt="logo">
                    </a>
                </div>
                <div class="mobile-menu fix"></div>

                <div class="sidebar__search p-relative mt-40 mb-20 ">
                    <form action="#">
                        <input type="text" placeholder="Search...">
                        <button type="submit"><i class="fad fa-search"></i></button>
                    </form>
                </div>
                <div class="sidebar__contact mb-45">
                    <ul>
                        <li class="wow fadeInUp" data-wow-delay="1s">
                            <div class="icon theme-color ">
                                <i class="fal fa-envelope"></i>
                            </div>
                            <div class="text theme-color ">
                                <span><a href="mailto:support@zibber.com">support@zibber.com</a></span>
                            </div>
                        </li>
                        <li class="wow fadeInUp" data-wow-delay="1s">
                            <div class="icon theme-color">
                                <i class="fas fa-phone-volume"></i>
                            </div>
                            <div class="text theme-color">
                                <span><a href="tel:(+642)-394-396-432">(+642) 394 396 432</a></span>
                            </div>
                        </li>
                        <li class="wow fadeInUp" data-wow-delay="1s">
                            <div class="icon">
                                <i class="fal fa-map-marker-alt"></i>
                            </div>
                            <div class="text">
                                <a target="_blank"
                                    href="https://www.google.com/maps/place/Dhaka/@23.7806207,90.3492859,12z/data=!3m1!4b1!4m5!3m4!1s0x3755b8b087026b81:0x8fa563bbdd5904c2!8m2!3d23.8104753!4d90.4119873">Ave
                                    14th Street, Mirpur 210, <br> San Franciso, USA 3296.</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- sidebar area end -->
    <div class="body-overlay transition-3"></div>


    <main>

        <!-- slider area start -->
        <div class="slider-area  fix">
            <div class="slider-active swiper-container">
                <div class="swiper-wrapper">
                    <div class="slider-list slider-height-2 swiper-slide d-flex align-items-center pt-70">
                        <div class="slider-shape "></div>
                        <div class="slider-shape-line"></div>
                        <div class="slider-shape-line2"></div>
                        <div class="slider-bg img-zoom" data-background="assets/img/slider/slider3.jpg"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-12 position-relative">
                                    <div class="slider-circle-shape slider-circle-shape-2"></div>
                                    <div class="slider-text slider-text-2 z-index">
                                        <span class="slider-sub-title" data-animation="fadeInUp"
                                            data-delay="0.3s">welcome to Binifox Pro agency</span>
                                        <h2 class="slider-title" data-animation="fadeInUp" data-delay="0.5s">Plan Create
                                            <br> Grow.
                                        </h2>
                                        <div class="slide-btn mt-30 d-flex align-items-center" data-animation="fadeInUp"
                                            data-delay="0.7s">
                                            <a href="about.html" class="tp-btn">Discover More</a>
                                            <a class="play-btn" data-fancybox=""
                                                href="https://www.youtube.com/watch?v=eXQgPCsd83c">
                                                <i class="fas fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="slider-list slider-height-2 swiper-slide d-flex align-items-center pt-70">
                        <div class="slider-shape"></div>
                        <div class="slider-shape-line"></div>
                        <div class="slider-shape-line2"></div>
                        <div class="slider-bg img-zoom" data-background="assets/img/slider/slider4.jpg"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-12 position-relative">
                                    <div class="slider-circle-shape slider-circle-shape-2"></div>
                                    <div class="slider-text slider-text-2 z-index">
                                        <span class="slider-sub-title" data-animation="fadeInUp"
                                            data-delay="0.3s">welcome to Binifox Pro agency</span>
                                        <h2 class="slider-title" data-animation="fadeInUp" data-delay="0.5s">Smart Think
                                            <br> So Easy.
                                        </h2>
                                        <div class="slide-btn mt-30 d-flex align-items-center" data-animation="fadeInUp"
                                            data-delay="0.7s">
                                            <a href="about.html" class="tp-btn">Discover More</a>
                                            <a class="play-btn" data-fancybox=""
                                                href="https://www.youtube.com/watch?v=eXQgPCsd83c">
                                                <i class="fas fa-play"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- If we need pagination -->
                <!-- <div class="swiper-pagination"></div> -->

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev sp-arrow"> <i class="far fa-angle-left"></i></div>
                <div class="swiper-button-next sp-arrow"> <i class="far fa-angle-right"></i></div>
            </div>
        </div>
        <!-- slider area end -->

        <!-- services -->
        @include('sections.services')
        <!-- services end -->

        <!-- about start -->
        <div class="about-area pt-120 pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6">
                        <div class="ab-box pl-50 mb-30">
                            <div class="sec-wrapper">
                                <h5>About Us</h5>
                                <h2 class="section-title">We are certified financial design.</h2>
                                <p>He nicked it fantastic well on your bike mate have it a I bum bag I twit easy peasy
                                    that, chimney pot amongst are you taking the piss daft show off show off pick.</p>
                            </div>
                            <div class="abs-item-box mt-40 mb-30">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="abs-items mb-20">
                                            <div class="abs-icon mb-15">
                                                <i class="icon_ribbon_alt"></i>
                                            </div>
                                            <div class="abs-item-text fix">
                                                <h3 class="abs-item-title">Acquisitions Finance Consulting</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="abs-items mb-20">
                                            <div class="abs-icon mb-15">
                                                <i class="icon_lightbulb_alt"></i>
                                            </div>
                                            <div class="abs-item-text fix">
                                                <h3 class="abs-item-title">Private Placement Consulting</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ab-btn">
                                <a href="about.html" class="tp-btn">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6">
                        <div class="abs-images abs-images-2 pl-50">
                            <div class="row">
                                <div class="col-7">
                                    <div class="abs-img img-filter mb-30">
                                        <img src="assets/img/about/achievement-1.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="abs-img img-filter mb-30">
                                        <img src="assets/img/about/achievement-2.jpg" alt="">
                                    </div>
                                    <div class="ab-line-shape w-100 mb-20"></div>
                                    <div class="ab-line-shape w-50"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- about end -->

        <!-- faq  -->
        <div class="faq-area pos-rel black-bg">
            <div class="faq-bg" data-background="assets/img/bg/faq-1.jpg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-xl-6 col-lg-6 offset-lg-6">
                        <div class="faq-content pl-70 pt-120 pb-120">
                            <div class="sec-wrapper mb-30">
                                <h5>Thinking</h5>
                                <h2 class="section-title text-white">Knowledge is
                                    the best investment.</h2>
                            </div>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            How can we help your business?
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                                ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                                pariatur. </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            What are the advantages of Binifox?
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                                ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                                pariatur. </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Let’s find an office near you?
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                                ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                                pariatur. </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree1">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree1"
                                            aria-expanded="false" aria-controls="collapseThree1">
                                            Binifox WordPress theme for business?
                                        </button>
                                    </h2>
                                    <div id="collapseThree1" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree1" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                                ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                                reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                                pariatur. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- faq  -->
        <!-- team  -->
        <div class="team-area pt-120">
            <div class="container">
                <div class="row mb-60">
                    <div class="col-12">
                        <div class="sec-wrapper text-center">
                            <h5>Our Team</h5>
                            <h2 class="section-title">Expert Members.</h2>
                        </div>
                    </div>
                </div>
                <div class="rows">
                    <div class="team-active swiper-container pb-30">
                        <div class="swiper-wrapper">
                            <div class="team-item swiper-slide">
                                <div class="tpteam text-center mb-30">
                                    <div class="tpteam__img">
                                        <img src="assets/img/team/team-member-1.jpg" alt="">
                                        <div class="tpteam__social">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-behance"></i></a>
                                            <a href="#"><i class="fab fa-pinterest"></i></a>
                                            <a href="#"><i class="fab fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <div class="tpteam__text">
                                        <h3 class="tpteam-title"><a href="team-details.html">Philimia Darwin</a></h3>
                                        <h5>Designer</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="team-item swiper-slide">
                                <div class="tpteam text-center mb-30">
                                    <div class="tpteam__img">
                                        <img src="assets/img/team/team-member-2.jpg" alt="">
                                        <div class="tpteam__social">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-behance"></i></a>
                                            <a href="#"><i class="fab fa-pinterest"></i></a>
                                            <a href="#"><i class="fab fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <div class="tpteam__text">
                                        <h3 class="tpteam-title"><a href="team-details.html">Hilixa Maria</a></h3>
                                        <h5>Designer</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="team-item swiper-slide">
                                <div class="tpteam text-center mb-30">
                                    <div class="tpteam__img">
                                        <img src="assets/img/team/team-member-3.jpg" alt="">
                                        <div class="tpteam__social">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-behance"></i></a>
                                            <a href="#"><i class="fab fa-pinterest"></i></a>
                                            <a href="#"><i class="fab fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <div class="tpteam__text">
                                        <h3 class="tpteam-title"><a href="team-details.html">Willamson Hilai</a></h3>
                                        <h5>Designer</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="team-item swiper-slide">
                                <div class="tpteam text-center mb-30">
                                    <div class="tpteam__img">
                                        <img src="assets/img/team/team-member-7.jpg" alt="">
                                        <div class="tpteam__social">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-behance"></i></a>
                                            <a href="#"><i class="fab fa-pinterest"></i></a>
                                            <a href="#"><i class="fab fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <div class="tpteam__text">
                                        <h3 class="tpteam-title"><a href="team-details.html">Limonda Pwedie</a></h3>
                                        <h5>Designer</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="team-item swiper-slide">
                                <div class="tpteam text-center mb-30">
                                    <div class="tpteam__img">
                                        <img src="assets/img/team/team-member-8.jpg" alt="">
                                        <div class="tpteam__social">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-behance"></i></a>
                                            <a href="#"><i class="fab fa-pinterest"></i></a>
                                            <a href="#"><i class="fab fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <div class="tpteam__text">
                                        <h3 class="tpteam-title"><a href="team-details.html">Limonda Pwedie</a></h3>
                                        <h5>Designer</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="team-item swiper-slide">
                                <div class="tpteam text-center mb-30">
                                    <div class="tpteam__img">
                                        <img src="assets/img/team/team-member-9.jpg" alt="">
                                        <div class="tpteam__social">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                            <a href="#"><i class="fab fa-behance"></i></a>
                                            <a href="#"><i class="fab fa-pinterest"></i></a>
                                            <a href="#"><i class="fab fa-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <div class="tpteam__text">
                                        <h3 class="tpteam-title"><a href="team-details.html">Limonda Pwedie</a></h3>
                                        <h5>Designer</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination team-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- team  -->

        <section class="review-area review-area-padding grey-bgs pt-150 pb-120 pos-rel pl-50 pr-50">
            <div class="wavify-wrapper">
                <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wavify-item"
                    data-wavify-height="140" data-wavify-background="rgba(245,245,245,0.5)" data-wavify-amplitude="80"
                    data-wavify-bones="4">
                    <path
                        d="M 0 141.71042689406383 C 237.875 148.50471572578806 237.875 148.50471572578806 475.75 145.107571309926 C 713.625 141.71042689406383 713.625 141.71042689406383 951.5 165.82491752026056 C 1189.375 189.9394081464571 1189.375 189.9394081464571 1427.25 193.5786122514483 C 1665.125 197.21781635643944 1665.125 197.21781635643944 1903 165.82491752026056 L 1903 7389 L 0 7389 Z"
                        fill="rgba(245,245,245,0.5)"></path>
                </svg>

                <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wavify-item"
                    data-wavify-height="140" data-wavify-background="#f5f5f5" data-wavify-amplitude="80"
                    data-wavify-bones="3">
                    <path
                        d="M 0 147.22020568980648 C 317.16666666666663 183.65559797623268 317.16666666666663 183.65559797623268 634.3333333333333 165.43790183301957 C 951.4999999999999 147.22020568980648 951.4999999999999 147.22020568980648 1268.6666666666665 200.09089320557024 C 1585.833333333333 252.96158072133412 1585.833333333333 252.96158072133412 1903 183.26276877337258 L 1903 7389 L 0 7389 Z"
                        fill="#f5f5f5"></path>
                </svg>
            </div>
            <div class="container">
                <div class="row mb-40 pt-150 z-index">
                    <div class="col-12">
                        <div class="sec-wrapper text-center">
                            <h5>Testimonials</h5>
                            <h2 class="section-title">Feedback from our clients.</h2>
                        </div>
                    </div>
                </div>
                <div class="test-active swiper-container">
                    <div class="swiper-wrapper pb-70">
                        <div class="testi-item swiper-slide">
                            <div class="tptestinimail">
                                <div class="tptestinimail__text">
                                    <p>Lorem ipsum dolor sit amet, coning
                                        ctetur adipisicing elit, sed do it on
                                        eiusmod tempor incididunt me
                                        ut labore et dolore.</p>
                                </div>
                                <div class="tptestinimail__author d-sm-flex align-items-center">
                                    <div class="tptestinimail__author--img tptestinimail__author--img-2">
                                        <img src="assets/img/testimonial/client-2.png" alt="">
                                    </div>
                                    <div class="tptestinimail__author--bio">
                                        <h4>Mr. Habib Hemel</h4>
                                        <h6>HR Admin</h6>
                                    </div>
                                </div>
                                <div class="testimonial-quote text-end">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="testi-item swiper-slide">
                            <div class="tptestinimail">
                                <div class="tptestinimail__text">
                                    <p>Lorem ipsum dolor sit amet, coning
                                        ctetur adipisicing elit, sed do it on
                                        eiusmod tempor incididunt me
                                        ut labore et dolore.</p>
                                </div>
                                <div class="tptestinimail__author d-sm-flex align-items-center">
                                    <div class="tptestinimail__author--img tptestinimail__author--img-2">
                                        <img src="assets/img/testimonial/client-3.png" alt="">
                                    </div>
                                    <div class="tptestinimail__author--bio">
                                        <h4>Mr. Salim Dawn</h4>
                                        <h6>Developer</h6>
                                    </div>
                                </div>
                                <div class="testimonial-quote text-end">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="testi-item swiper-slide">
                            <div class="tptestinimail">
                                <div class="tptestinimail__text">
                                    <p>Lorem ipsum dolor sit amet, coning
                                        ctetur adipisicing elit, sed do it on
                                        eiusmod tempor incididunt me
                                        ut labore et dolore.</p>
                                </div>
                                <div class="tptestinimail__author d-sm-flex align-items-center">
                                    <div class="tptestinimail__author--img tptestinimail__author--img-2">
                                        <img src="assets/img/testimonial/client-4.png" alt="">
                                    </div>
                                    <div class="tptestinimail__author--bio">
                                        <h4>Mr. Suhan Dol</h4>
                                        <h6>Designer</h6>
                                    </div>
                                </div>
                                <div class="testimonial-quote text-end">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="testi-item swiper-slide">
                            <div class="tptestinimail">
                                <div class="tptestinimail__text">
                                    <p>Lorem ipsum dolor sit amet, coning
                                        ctetur adipisicing elit, sed do it on
                                        eiusmod tempor incididunt me
                                        ut labore et dolore.</p>
                                </div>
                                <div class="tptestinimail__author d-sm-flex align-items-center">
                                    <div class="tptestinimail__author--img tptestinimail__author--img-2">
                                        <img src="assets/img/testimonial/client-5.png" alt="">
                                    </div>
                                    <div class="tptestinimail__author--bio">
                                        <h4>Mr. Williamson</h4>
                                        <h6>Pure Founder</h6>
                                    </div>
                                </div>
                                <div class="testimonial-quote text-end">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="testi-item swiper-slide">
                            <div class="tptestinimail">
                                <div class="tptestinimail__text">
                                    <p>Lorem ipsum dolor sit amet, coning
                                        ctetur adipisicing elit, sed do it on
                                        eiusmod tempor incididunt me
                                        ut labore et dolore.</p>
                                </div>
                                <div class="tptestinimail__author d-sm-flex align-items-center">
                                    <div class="tptestinimail__author--img tptestinimail__author--img-2">
                                        <img src="assets/img/testimonial/client-1.png" alt="">
                                    </div>
                                    <div class="tptestinimail__author--bio">
                                        <h4>Mr. Jonota Gilai</h4>
                                        <h6>BDevs Officer</h6>
                                    </div>
                                </div>
                                <div class="testimonial-quote text-end">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                            </div>
                        </div>
                        <div class="testi-item swiper-slide">
                            <div class="tptestinimail">
                                <div class="tptestinimail__text">
                                    <p>Lorem ipsum dolor sit amet, coning
                                        ctetur adipisicing elit, sed do it on
                                        eiusmod tempor incididunt me
                                        ut labore et dolore.</p>
                                </div>
                                <div class="tptestinimail__author d-sm-flex align-items-center">
                                    <div class="tptestinimail__author--img tptestinimail__author--img-2">
                                        <img src="assets/img/testimonial/client-6.png" alt="">
                                    </div>
                                    <div class="tptestinimail__author--bio">
                                        <h4>Mr. Shewkh Kamal</h4>
                                        <h6>ThemePure</h6>
                                    </div>
                                </div>
                                <div class="testimonial-quote text-end">
                                    <i class="fa fa-quote-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        <!-- START PORTFOLIO DESIGN AREA -->
        <section class="portfolio-area pt-120 pb-70">
            <div class="container">
                <div class="row mb-40 d-none">
                    <div class="col-12">
                        <div class="sec-wrapper text-center">
                            <h5>Features Project</h5>
                            <h2 class="section-title">Explore Our Project.</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center mb-50">
                    <!-- START PORTFOLIO FILTER AREA -->
                    <div class="col-xl-6 col-lg-6">
                        <div class="sec-wrapper text-centers">
                            <h5>Features Project</h5>
                            <h2 class="section-title">Explore Our Project.</h2>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="text-lg-end">
                            <div class="portfolio-filter">
                                <button class="active" data-filter="*">Show all</button>
                                <button data-filter=".cat1">Design</button>
                                <button data-filter=".cat2">Logo</button>
                                <button data-filter=".cat3">Business</button>
                                <button data-filter=".cat4">Agency</button>
                            </div>
                        </div>
                    </div>
                    <!-- END PORTFOLIO FILTER AREA -->
                </div>
                <div id="portfolio-grid" class="row row-portfolio">
                    <div class="col-lg-4 col-md-6 col-sm-6 grid-item cat2 cat4">
                        <div class="tportfolio mb-30">
                            <div class="tportfolio__img">
                                <a class="popup-image" href="{{ asset('/') }}assets/img/portfolio/port-1.jpg"
                                    data-fancybox="gallery">
                                    <img src="assets/img/portfolio/port-1.jpg" alt="" />
                                </a>
                                <div class="tportfolio__text tportfolio__text-2">
                                    <h3 class="tportfolio-title"><a href="portfolio-details.html">Binifox Busines</a>
                                    </h3>
                                    <h4>Busines, Agency</h4>

                                    <div class="portfolio-plus">
                                        <a href="{{ asset('/') }}assets/img/portfolio/port-1.jpg"
                                            data-fancybox="gallery">
                                            <i class="fal fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 grid-item cat3 cat1">
                        <div class="tportfolio mb-30">
                            <div class="tportfolio__img">
                                <a class="popup-image" href="{{ asset('/') }}assets/img/portfolio/port-2.jpg"
                                    data-fancybox="gallery">
                                    <img src="assets/img/portfolio/port-2.jpg" alt="" />
                                </a>
                                <div class="tportfolio__text tportfolio__text-2">
                                    <h3 class="tportfolio-title"><a href="portfolio-details.html">Marketing Analysis</a>
                                    </h3>
                                    <h4>Consultation, Idea</h4>
                                    <div class="portfolio-plus">
                                        <a href="{{ asset('/') }}assets/img/portfolio/port-2.jpg"
                                            data-fancybox="gallery">
                                            <i class="fal fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 grid-item cat4 cat3">
                        <div class="tportfolio mb-30">
                            <div class="tportfolio__img">
                                <a class="popup-image" href="{{ asset('/') }}assets/img/portfolio/port-3.jpg"
                                    data-fancybox="gallery">
                                    <img src="assets/img/portfolio/port-3.jpg" alt="" />
                                </a>
                                <div class="tportfolio__text tportfolio__text-2">
                                    <h3 class="tportfolio-title"><a href="portfolio-details.html">Busines Idea</a></h3>
                                    <h4>Deaign, Brand</h4>
                                    <div class="portfolio-plus">
                                        <a href="{{ asset('/') }}assets/img/portfolio/port-3.jpg"
                                            data-fancybox="gallery">
                                            <i class="fal fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 grid-item cat1 cat4">
                        <div class="tportfolio mb-30">
                            <div class="tportfolio__img">
                                <a class="popup-image" href="{{ asset('/') }}assets/img/portfolio/port-4.jpg"
                                    data-fancybox="gallery">
                                    <img src="assets/img/portfolio/port-4.jpg" alt="" />
                                </a>
                                <div class="tportfolio__text tportfolio__text-2">
                                    <h3 class="tportfolio-title"><a href="portfolio-details.html">Logo Design</a></h3>
                                    <h4>Print, Market</h4>
                                    <div class="portfolio-plus">
                                        <a href="{{ asset('/') }}assets/img/portfolio/port-4.jpg"
                                            data-fancybox="gallery">
                                            <i class="fal fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 grid-item cat2 cat1">
                        <div class="tportfolio mb-30">
                            <div class="tportfolio__img">
                                <a class="popup-image" href="{{ asset('/') }}assets/img/portfolio/port-5.jpg"
                                    data-fancybox="gallery">
                                    <img src="assets/img/portfolio/port-5.jpg" alt="" />
                                </a>
                                <div class="tportfolio__text tportfolio__text-2">
                                    <h3 class="tportfolio-title"><a href="portfolio-details.html">Digital Marketing</a>
                                    </h3>
                                    <h4>Logo, Busines</h4>
                                    <div class="portfolio-plus">
                                        <a href="{{ asset('/') }}assets/img/portfolio/port-5.jpg"
                                            data-fancybox="gallery">
                                            <i class="fal fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 grid-item cat4 cat1">
                        <div class="tportfolio mb-30">
                            <div class="tportfolio__img">
                                <a class="popup-image" href="{{ asset('/') }}assets/img/portfolio/port-6.jpg"
                                    data-fancybox="gallery">
                                    <img src="assets/img/portfolio/port-6.jpg" alt="" />
                                </a>
                                <div class="tportfolio__text tportfolio__text-2">
                                    <h3 class="tportfolio-title"><a href="portfolio-details.html">Super Experience</a>
                                    </h3>
                                    <h4>Market, Idea</h4>
                                    <div class="portfolio-plus">
                                        <a href="{{ asset('/') }}assets/img/portfolio/port-6.jpg"
                                            data-fancybox="gallery">
                                            <i class="fal fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- / END PORTFOLIO DESIGN AREA -->

        <!-- counter -->
        <section class="cta-area pos-rel black-bg pt-120 pb-120" data-overlay="dark" data-opacity="7">
            <div class="fact-bg slider-bg" data-background="assets/img/slider/slider2.jpg"></div>
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="single-couter counter-box mb-30 z-index d-none">
                            <div class="fact-icon">
                                <i class="flaticon-airplane"></i>
                            </div>
                        </div>
                        <div class="sec-wrapper z-index">
                            <h5>Get to Know Binifox</h5>
                            <h2 class="section-title text-white">Do you have any question? Feel free to contact us.</h2>
                            <div class="ab-btn mt-30">
                                <a href="about.html" class="tp-btn">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- counter -->

        <!-- blog area start -->
        <div class="latest-news-area pt-120 pb-90">
            <div class="container">
                <div class="row mb-60">
                    <div class="col-12">
                        <div class="sec-wrapper">
                            <h5>Features News</h5>
                            <h2 class="section-title">Latest news & articles.</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="latest-blog latest-blog-2 mb-30">
                            <div class="latest-blog-img pos-rel">
                                <img src="assets/img/blog/sm1.jpg" alt="">
                                <div class="top-date top-date-2">
                                    <a href="#">15 March 21</a>
                                </div>
                            </div>
                            <div class="latest-blog-content latest-blog-content-2">
                                <div class="latest-post-meta mb-15">
                                    <span><a href="#"><i class="far fa-user"></i> Diboli </a></span>
                                    <span><a href="#"><i class="far fa-comments"></i> 23 Comments</a></span>
                                </div>
                                <h3 class="latest-blog-title">
                                    <a href="blog-details.html">Time is money but its not full demand.</a>
                                </h3>
                                <div class="blog-btn-2">
                                    <a href="blog-details.html" class="link-btn">
                                        read more
                                        <i class="fal fa-long-arrow-right"></i>
                                        <i class="fal fa-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="latest-blog latest-blog-2 mb-30">
                            <div class="latest-blog-img pos-rel">
                                <img src="assets/img/blog/sm2.jpg" alt="">
                                <div class="top-date top-date-2">
                                    <a href="#">22 March 21</a>
                                </div>
                            </div>
                            <div class="latest-blog-content latest-blog-content-2">
                                <div class="latest-post-meta mb-15">
                                    <span><a href="#"><i class="far fa-user"></i> Diboli </a></span>
                                    <span><a href="#"><i class="far fa-comments"></i> 23 Comments</a></span>
                                </div>
                                <h3 class="latest-blog-title">
                                    <a href="blog-details.html">We Are Trying To Do Best Work.</a>
                                </h3>
                                <div class="blog-btn-2">
                                    <a href="blog-details.html" class="link-btn">
                                        read more
                                        <i class="fal fa-long-arrow-right"></i>
                                        <i class="fal fa-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="latest-blog latest-blog-2 mb-30">
                            <div class="latest-blog-img pos-rel">
                                <img src="assets/img/blog/sm3.jpg" alt="">
                                <div class="top-date top-date-2">
                                    <a href="#">28 March 21</a>
                                </div>
                            </div>
                            <div class="latest-blog-content latest-blog-content-2">
                                <div class="latest-post-meta mb-15">
                                    <span><a href="#"><i class="far fa-user"></i> Diboli </a></span>
                                    <span><a href="#"><i class="far fa-comments"></i> 23 Comments</a></span>
                                </div>
                                <h3 class="latest-blog-title">
                                    <a href="blog-details.html">Nature is The best place for fresh mind.</a>
                                </h3>
                                <div class="blog-btn-2">
                                    <a href="blog-details.html" class="link-btn">
                                        read more
                                        <i class="fal fa-long-arrow-right"></i>
                                        <i class="fal fa-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog area end -->

    </main>

    <!-- footer area start here -->
    <footer data-background="assets/img/bg/footer-bg.jpg" class="footer-2 pt-95 position-relative">
        <div class="common-shape-wrapper wow slideInRight animated" data-wow-delay="0ms" data-wow-duration="1500ms">
            <div class="common-shape-inner wow slideInRight animated" data-wow-delay="0ms" data-wow-duration="1500ms">
            </div>
        </div>
        <div class="footer-area pb-60">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="widget mb-30">
                            <div class="footer-logo mb-25">
                                <a href="index.html"><img src="assets/img/logo/logo.png" class="img-fluid"
                                        alt="footer-logo"></a>
                            </div>
                            <p class="mb-20 pr-35">There are many vari of pass of lorem ipsum availab but the majority
                                have suffered in some form by injected humour or words.</p>
                            <div class="footer-social footer-social-2">
                                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="widget mb-30">
                            <h4 class="widget-title mb-35">Links</h4>
                            <ul>
                                <li><a href="service.html">Our Services</a></li>
                                <li><a href="about.html">Meet Our Team</a></li>
                                <li><a href="project.html">Our Portfolio</a></li>
                                <li><a href="contact.html">Contact</a></li>
                                <li><a href="contact.html">Help</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget widget-contact mb-30">
                            <h4 class="widget-title mb-35">Contact</h4>
                            <ul>
                                <li class="pb-10"><a target="_blank"
                                        href="https://www.google.com/maps/place/Dhaka/@23.7806207,90.3492859,12z/data=!3m1!4b1!4m5!3m4!1s0x3755b8b087026b81:0x8fa563bbdd5904c2!8m2!3d23.8104753!4d90.4119873">86
                                        Road Broklyn Street, 600 <br>New York, USA</a></li>
                                <li><i class="fal fa-envelope-open"></i><a
                                        href="mailto:needhelp@company.com">needhelp@company.com</a></li>
                                <li><i class="fal fa-phone-alt"></i><a href="tel:926668880000">92 666 888 0000</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="widget mb-30">
                            <h4 class="widget-title mb-30">Newsletter</h4>
                            <p class="mb-20">Subscribe to Our Newsletter for Daily News and Updates</p>
                            <div class="widget-newsletter">
                                <form action="#">
                                    <input type="email" placeholder="Email Address">
                                    <button type="submit">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="copyright-bg">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="copyright">
                                <span>Copyright ©2021 Themepure. All Rights Reserved</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="privacy-text text-md-end">
                                <ul>
                                    <li>
                                        <a href="contact.html">Terms & Condition</a>
                                        <a href="contact.html">Privacy Policy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end here -->



    <!-- back to top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- back to top end -->


    <!-- JS here -->
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.meanmenu.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/parallax.min.js') }}"></script>
    <script src="{{ asset('assets/js/backToTop.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/TweenMax.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.wavify.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
