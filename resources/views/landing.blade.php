@extends('app.index')

@section('content')
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

        @include('sections.brands')

        <!-- START PORTFOLIO DESIGN AREA -->
        {{-- @include('sections.project') --}}
        <!-- / END PORTFOLIO DESIGN AREA -->

        <!-- blog area start -->
        @include('sections.article')
        <!-- blog area end -->

        <!-- counter -->
        @include('sections.cta')
        <!-- counter -->


@endsection
