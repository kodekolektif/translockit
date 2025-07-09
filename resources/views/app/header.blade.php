@php

$settings = new \App\Settings\AppSettings();
$logo = $settings->logo;

$company_settings = new \App\Settings\CompanySetting();

@endphp
<header class="header-light">
    <div class="top-bar d-none d-md-block pt-15 pb-15">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-xl-8 col-lg-8 col-md-7">
                    <div class="header-info">
                        @if ($company_settings->address)
                            <span class="header-address d-none d-lg-inline"><i class="fa fa-map-marker-alt"></i> <a
                                target="_blank"
                                href="{{ $company_settings->google_map_url??'#' }}">
                                {{ Str::limit($company_settings->address, 30) }}</a>
                            </span>
                        @endif
                        @if ($company_settings->phone)
                            <span class="header-phone"><i class="fas fa-phone"></i> <a href="callto:{{ $company_settings->phone }}">{{ $company_settings->phone }}</a></span>
                        @endif
                        @if ($company_settings->email)
                            <span class="header-email d-none d-xl-inline"><i class="fas fa-envelope"></i> <a
                                    href="mailto:{{ $company_settings->email }}">{{ $company_settings->email }}</a></span>
                        @endif
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-5 text-end d-flex justify-content-end align-items-center gap-3">
                    <!-- Language Dropdown -->
                    <div class="dropdown" style="position: static !important;">
                        @php
                        $active_locale = request()->segment(1) ?? 'en'; // Default to 'en' if no segment is found
                        $flags = [
                            'en' => asset('flag/en.svg'),
                            'es' => asset('flag/es.svg'),
                        ];
                        $languages = [
                        'en' => 'English',
                        'es' => 'Spanish',
                        ];
                        @endphp

                        <!-- Language Dropdown Button -->
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                            id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ $flags[$active_locale] ?? '' }}" alt="flag" style="max-width: 18px"> {{ strtoupper($active_locale) }}
                        </button>

                        <!-- Dropdown Menu -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            @foreach ($languages as $code => $name)
                                @php
                                    $segments = request()->segments();
                                    $segments[0] = $code; // Replace first segment with selected locale
                                    $newUrl = '/' . implode('/', $segments);
                                    $query = request()->getQueryString();
                                    if ($query) {
                                        $newUrl .= '?' . $query;
                                    }
                                @endphp

                                <li>
                                    <a class="dropdown-item {{ $code == $active_locale ? 'active' : '' }}" href="{{ $newUrl }}">
                                        <img src="{{ $flags[$code] ?? '' }}" alt="flag" style="max-width: 18px"> {{ $name }}
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
                        <a href="{{ url('/') }}"><img src="{{ Storage::url($logo) }}" alt="logo"></a>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-10 col-md-6 col-6 d-flex justify-content-end">
                    <div class="main-menu text-center ">
                        <nav id="mobile-menu">
                            <ul>
                                <li>
                                    <a class="active" href="{{ url('/') }}">{{ __('landing.Home') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('about', app()->getLocale()) }}">{{ __('landing.About Us') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('services', app()->getLocale()) }}">{{ __('landing.Services') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('software', app()->getLocale()) }}">{{ __('landing.Software') }}</a>
                                     <ul class="sub-menu">
                                         <li><a href="{{ route('software', app()->getLocale()) }}">{{ __('landing.software_list') }}</a></li>
                                        <li><a href="{{ route('mobile_app', app()->getLocale()) }}">{{ __('landing.mobile_app') }}</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ route('article.list',app()->getLocale()) }}">{{ __('landing.News') }} </a>
                                </li>
                                <li><a href="{{ route('contact', app()->getLocale()) }}">{{ __('landing.Contact') }}</a></li>

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
                <a href="#">
                    <img src="{{ Storage::url((new \App\Settings\AppSettings())->logo_dark) }}" alt="logo">
                </a>
            </div>
            <div class="mobile-menu fix"></div>

            <div class="sidebar__contact mb-45">
                <!-- Language Dropdown -->
                <div class="dropdown">
                    @php
                    $active_locale = request()->segment(1) ?? 'en'; // Default to 'en' if no segment is found
                     $flags = [
                            'en' => asset('flag/en.svg'),
                            'es' => asset('flag/es.svg'),
                        ];
                    $languages = [
                    'en' => 'English',
                    'es' => 'Spanish',
                    ];
                    @endphp

                    <!-- Language Dropdown Button -->
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="languageDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%;">
                       <img src=" {{ $flags[$active_locale] ?? '' }}" alt="flag" style="max-width: 18px"> {{ strtoupper($active_locale) }}
                    </button>

                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                        @foreach ($languages as $code => $name)
                            @php
                                $segments = request()->segments();
                                $segments[0] = $code; // Replace first segment with selected locale
                                $newUrl = '/' . implode('/', $segments);
                                $query = request()->getQueryString();
                                if ($query) {
                                    $newUrl .= '?' . $query;
                                }
                            @endphp

                            <li>
                                <a class="dropdown-item {{ $code == $active_locale ? 'active' : '' }}" href="{{ $newUrl }}">
                                   <img src=" {{ $flags[$code] ?? '' }}" alt="flag" style="max-width: 18px"> {{ $name }}
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
