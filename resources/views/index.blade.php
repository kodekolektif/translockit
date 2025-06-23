<!doctype html>
<html class="no-js" lang="zxx">

<head>
    @php

    $settings = new \App\Settings\AppSettings();
    $favicon = $settings->favicon;
    $APPtitle = $settings->title;

    @endphp
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $APPtitle?? $APPtitle }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ Storage::url($favicon) }}">
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

    <main>

        <!-- slider area start -->
        @include('sections.hero')
        <!-- slider area end -->

        <!-- services -->
        @include('sections.services')
        <!-- services end -->

        <!-- about start -->
        @include('sections.about')
        <!-- about end -->

        <!-- faq  -->
        @include('sections.faq')
        <!-- faq  -->
        <!-- team  -->
        {{-- <div class="team-area pt-120">
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
        </div> --}}
        <!-- team  -->

        <!-- review area start -->
        @include('sections.testimonials')
        <!-- review area end -->

        <!-- START PORTFOLIO DESIGN AREA -->
        @include('sections.project')
        <!-- / END PORTFOLIO DESIGN AREA -->

        <!-- counter -->
        {{-- <section class="cta-area pos-rel black-bg pt-120 pb-120" data-overlay="dark" data-opacity="7">
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
        </section> --}}
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
    @include('app.footer')
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
