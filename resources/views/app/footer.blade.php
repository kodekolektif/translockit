@php

$settings = new \App\Settings\AppSettings();
$logodark = $settings->logo_dark;

$company_settings = new \App\Settings\CompanySetting();


@endphp

<footer data-background="{{ asset('assets/img/bg/footer-bg.jpg') }}" class="footer-2 pt-95 position-relative">
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
                            <a href="{{ url('/') }}"><img src="{{ Storage::url($logodark) }}" class="img-fluid"
                                    alt="footer-logo"></a>
                        </div>
                        <p class="mb-20 pr-35">{{ $settings->description }}</p>
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
                            <li><a href="{{ route('about', app()->getLocale()) }}">{{ __('landing.About Us') }}</a></li>
                            <li><a href="{{ route('services', app()->getLocale()) }}">{{ __('landing.Services') }}</a></li>
                            <li><a href="{{ route('software', app()->getLocale()) }}">{{ __('landing.mobile_app') }}</a></li>
                            <li><a href="{{ route('article.list', app()->getLocale()) }}">{{ __('landing.News') }}</a></li>
                            <li><a href="{{ route('contact', app()->getLocale()) }}">{{ __('landing.Contact') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="widget widget-contact mb-30">
                        <h4 class="widget-title mb-35">Contact</h4>
                        <ul>
                            <li class="pb-10 d-flex">
                                <div style="margin-top: 2px">
                                    <i class="fal fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <a target="_blank" href="{{ $company_settings->google_map_url }}">{{ $company_settings->address }}</a>
                                </div>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="fal fa-envelope-open"></i>
                                <a href="mailto:{{ $company_settings->email }}">{{ $company_settings->email }}</a>
                            </li>
                            <li class="d-flex align-items-center">
                                <i class="fal fa-phone-alt me-2"></i>
                                <a href="tel:{{ $company_settings->phone }}">{{ $company_settings->phone }}</a>
                            </li>
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
                            <span>Copyright ©{{ date('Y') }} {{ config('app.name') }}. {{ __('landing.All rights reserved.') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="privacy-text text-md-end">
                            <ul>
                                <li>
                                    <a href="{{ route('legal_notice', app()->getLocale()) }}">{{ __('landing.legal_notice') }}</a>
                                    <a href="{{ route('cookie_policy', app()->getLocale()) }}">{{ __('landing.cookie_policy') }}</a>
                                    <a href="{{ route('privacy_policy', app()->getLocale()) }}">{{ __('landing.privacy_policy') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
