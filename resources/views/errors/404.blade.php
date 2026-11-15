@php
    // Error pages run outside the /{locale} route group, so pick the language from the URL.
    $errLocale = in_array(request()->segment(1), config('seo.locales', ['en', 'es']), true) ? request()->segment(1) : 'en';
    app()->setLocale($errLocale);
@endphp
@extends('app.index', ['hideloading' => true])

@section('content')
<section class="page__title p-relative d-flex align-items-center grey-bg-2" data-overlay="dark" data-opacity="7">
    <div class="page__title-bg" data-background="{{ asset('assets/img/bg/bg-slider_TranslockIt_5.jpg') }}"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="page__title-content mt-100 text-center">
                    <h1 style="overflow: hidden; white-space: nowrap;">404</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home', $errLocale) }}">{{ __('landing.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('errors.404.title') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="error-page pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10 text-center">
                <h2 class="section-title mb-25">{{ __('errors.404.heading') }}</h2>
                <p class="mb-45" style="font-size: 18px;">{{ __('errors.404.text') }}</p>
                <div class="d-flex flex-wrap justify-content-center" style="gap: 16px;">
                    <a href="{{ route('home', $errLocale) }}" class="tp-btn">{{ __('errors.home') }}</a>
                    <a href="{{ route('services', $errLocale) }}" class="tp-btn" style="background: #222429; color: #ffffff;">{{ __('errors.services') }}</a>
                    <a href="{{ route('contact', $errLocale) }}" class="tp-btn" style="background: #222429; color: #ffffff;">{{ __('errors.contact') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
