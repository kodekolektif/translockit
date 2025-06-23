<header class="header-light">
    <div class="top-bar d-none d-md-block pt-15 pb-15">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-xl-8 col-lg-8 col-md-7">
                    <div class="header-info">
                        <span class="header-address d-none d-lg-inline"><i class="fa fa-map-marker-alt"></i> <a
                                target="_blank"
                                href="https://www.google.com/maps/place/Dhaka/@23.7806207,90.3492859,12z/data=!3m1!4b1!4m5!3m4!1s0x3755b8b087026b81:0x8fa563bbdd5904c2!8m2!3d23.8104753!4d90.4119873">58
                                Howard Street #2 San Francisco</a> </span>
                        <span class="header-phone"><i class="fas fa-phone"></i> <a href="callto:+1-800-833-9780">+1
                                800 833 9780</a></span>
                        <span class="header-email d-none d-xl-inline"><i class="fas fa-envelope"></i> <a
                                href="mailto:info@example.com">info@example.com</a></span>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-5 text-end d-flex justify-content-end align-items-center gap-3">
                    <!-- Language Dropdown -->
                    <div class="dropdown">
                        @php
                        $active_locale = request()->segment(1) ?? 'en'; // Default to 'en' if no segment is found
                        $flags = [
                        'en' => '🇺🇸',
                        'es' => '🇪🇸',
                        ];
                        $languages = [
                        'en' => 'English',
                        'es' => 'Spain',
                        ];
                        @endphp

                        <!-- Language Dropdown Button -->
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                            id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ $flags[$active_locale] ?? '' }} {{ strtoupper($active_locale) }}
                        </button>

                        <!-- Dropdown Menu -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            @foreach ($languages as $code => $name)
                            <li>
                                <a class="dropdown-item {{ $code == $active_locale?'active':'' }}" href="/{{ $code }}">
                                    {{ $flags[$code] ?? '' }} {{ $name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div id="header-sticky" class="header-area header-pad-2 sticky-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-2 col-md-6 col-6">
                    <div class="logo logo-border">
                        <a href="index.html"><img src="assets/img/logo/logo-dark.png" alt="logo"></a>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-10 col-md-6 col-6 d-flex justify-content-end">
                    <div class="main-menu text-center ">
                        <nav id="mobile-menu">
                            <ul>
                                <li>
                                    <a class="active" href="index.html">{{ __('landing.Home') }}</a>
                                </li>
                                <li>
                                    <a href="about.html">{{ __('landing.About Us') }}</a>
                                </li>
                                <li>
                                    <a href="services.html">{{ __('landing.Services') }}</a>
                                </li>
                                {{-- <li>
                                    <a href="services.html">{{ __('landing.Mobile Apps') }}</a>
                                </li>
                                <li>
                                    <a href="services.html">{{ __('landing.Software') }}</a>
                                </li> --}}
                                {{-- <li>
                                    <a href="services.html">{{ __('landing.Our Partners') }}</a>
                                </li> --}}
                                {{-- <li>
                                    <a href="services.html">{{ __('landing.We Are Hiring!') }}</a>
                                </li> --}}
                                <li>
                                    <a href="blog.html">{{ __('landing.News') }} </a>
                                </li>
                                <li><a href="contact.html">{{ __('landing.Contact') }}</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="header-right-info d-flex align-items-center justify-content-end">
                        {{-- <div class="header-search">
                            <button class="search-toggle" type="button"><i class="fa fa-search"></i></button>
                        </div> --}}
                        <div class="sidebar__menu d-lg-none">
                            <div class="sidebar-toggle-btn sidebar-toggle-btn-2 ml-30" id="sidebar-toggle">
                                <span class="line"></span>
                                <span class="line"></span>
                                <span class="line"></span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>



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

            <div class="sidebar__contact mb-45">
                <!-- Language Dropdown -->
                <div class="dropdown">
                    @php
                    $active_locale = request()->segment(1) ?? 'en'; // Default to 'en' if no segment is found
                    $flags = [
                    'en' => '🇺🇸',
                    'es' => '🇪🇸',
                    ];
                    $languages = [
                    'en' => 'English',
                    'es' => 'Spain',
                    ];
                    @endphp

                    <!-- Language Dropdown Button -->
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="languageDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%;">
                        {{ $flags[$active_locale] ?? '' }} {{ strtoupper($active_locale) }}
                    </button>

                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        @foreach ($languages as $code => $name)
                        <li>
                            <a class="dropdown-item {{ $code == $active_locale?'active':'' }}" href="/{{ $code }}">
                                {{ $flags[$code] ?? '' }} {{ $name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- sidebar area end -->
<div class="body-overlay transition-3"></div>
