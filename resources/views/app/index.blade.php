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
    <title>{{ $APPtitle ?? ''}} {{ isset($title) ? ' - '.$title:'' }}</title>
    <meta name="description" content="{{ $description??$settings->description }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ Storage::url($favicon) }}">
    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/backToTop.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontAwesome5Pro.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/elegenticons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->

    <!-- Add your site or application content here -->

    <!-- pre loader area start -->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="loading-icon text-center d-sm-flex align-items-center">
                    <img class="loading-logo mr-10" src="{{ asset('assets/img/loading.png') }}" alt="">
                    {{-- <img src="{{ Storage::url($settings->logo) }}" alt=""> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- pre loader area end -->

    <!-- header  -->
    @include('app.header')
    <!-- header end -->

    <main>

        @yield('content')

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

    <div id="cookie-banner" class="fixed-bottom bg-light border-top shadow p-3" style="display: none; z-index: 1050;">
        <div class="container text-muted small">
            <div class="mb-3 " style="text-align: justify">
                {!! __('landing.cookie') !!}
            </div>
            <div class="d-flex flex-wrap gap-2 justify-content-end">
                <a href="{{ route('cookie_policy', app()->getLocale()) }}" class="btn btn-outline-secondary btn-sm">Read
                    More</a>
                <button id="accept-cookies" class="btn btn-primary btn-sm">Accept</button>
                <button id="cookie-settings" class="btn btn-outline-info btn-sm">Settings</button>
                <button id="reject-cookies" class="btn btn-outline-danger btn-sm">Reject</button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="cookieSettingsModal" tabindex="-1" aria-labelledby="cookieSettingsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cookieSettingsLabel">Use of Cookies:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Usted permite o rechaza el uso de las cookies para las siguientes finalidades:</p>

                    <!-- Necessary Cookies -->
                    <div class="accordion" id="cookieAccordion">

                        <!-- Necessary Cookies -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingNecessary">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseNecessary" aria-expanded="true"
                                    aria-controls="collapseNecessary">
                                    Necessary <span class="badge bg-warning ms-2">Siempre activado</span>
                                </button>
                            </h2>
                            <div id="collapseNecessary" class="accordion-collapse collapse show"
                                aria-labelledby="headingNecessary" data-bs-parent="#cookieAccordion">
                                <div class="accordion-body small text-white">
                                    Necessary cookies are absolutely essential for the website to function properly.
                                    This category only includes cookies that ensure basic functionalities and security
                                    features of the website. These cookies do not store any personal information.
                                </div>
                            </div>
                        </div>

                        <!-- Non-Necessary Cookies -->
                        <div class="accordion-item">
                            <h2 class="accordion-header d-flex justify-content-between align-items-center p-3">
                                <span class="text-white" style="font-size: large">Non-Necessary</span>
                                <div class="form-check form-switch" style="display: flex; justify-content: end; align-items: center; margin-top: -5px;">
                                    <input class="form-check-input" type="checkbox" id="nonNecessaryToggle" style="width: 40px; height: 20px;">
                                </div>
                            </h2>
                        </div>

                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="saveCookies">Save and Accept</button>
                </div>
            </div>
        </div>
    </div>


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
    <script src="{{ asset('assets/js/ajax-form.js') }}s"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/TweenMax.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.wavify.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        $(function () {
                if (!localStorage.getItem('cookieAccepted')) {
                    $('#cookie-banner').slideDown();
                }

                $('#accept-cookies').on('click', function () {
                    localStorage.setItem('cookieAccepted', 'true');
                    $('#cookie-banner').slideUp();
                });

                $('#reject-cookies').on('click', function () {
                    $('#cookie-banner').slideUp();
                });
                $('#saveCookies').on('click', function () {
                    // Here you can save the cookie preferences to localStorage or send them to your server
                    var nonNecessaryEnabled = document.getElementById('nonNecessaryToggle').checked;
                    localStorage.setItem('nonNecessaryCookies', nonNecessaryEnabled);
                    localStorage.setItem('cookieAccepted', 'true');
                    $('#cookie-banner').slideUp();
                });

                // $('#cookie-settings').on('click', function () {
                //     alert("Settings clicked — you can open a modal or redirect to preferences page.");
                // });
                document.getElementById('cookie-settings').addEventListener('click', function () {
                    var myModal = new bootstrap.Modal(document.getElementById('cookieSettingsModal'));
                    myModal.show();
                });

            });
    </script>
</body>

</html>
