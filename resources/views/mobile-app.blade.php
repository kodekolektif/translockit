@extends('app.index')

@section('content')
<section class="page__title p-relative d-flex align-items-center grey-bg-2" data-overlay="dark" data-opacity="7">
    <div class="page__title-bg" data-background="{{ asset('assets/img/bg/bg-slider_TranslockIt_5.jpg') }}"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="page__title-content mt-100 text-center">
                    <h2 style="overflow: hidden; white-space: nowrap;">{{ __('landing.mobile_app') }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('landing.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('landing.mobile_app') }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-area pt-80 fix">
    <div class="container">
        @foreach ($mobile_apps as $i => $item)
        <div class="row align-items-center mb-4">
            @if ($i % 2 == 0)
            {{-- Gambar di kiri --}}
            <div class="col-xxl-5 col-xl-6 col-lg-6">
                <img src="{{ Storage::url($item->image) }}" alt="image" width="100%">
            </div>
            <div class="col-xxl-7 col-xl-6 col-lg-6">
                <div class="plan-content">
                    <h3 class="service-title">{{ $item->title }}</h3>
                    {!! $item->description !!}
                </div>
            </div>
            @else
            {{-- Gambar di kanan --}}
            <div class="col-xxl-7 col-xl-6 col-lg-6">
                <div class="plan-content">
                    <h3 class="service-title">{{ $item->title }}</h3>
                    {!! $item->description !!}
                </div>
            </div>
            <div class="col-xxl-5 col-xl-6 col-lg-6">
                <img src="{{ Storage::url($item->image) }}" alt="image" style="width: 100%;">
            </div>
            @endif
        </div>

        @if (!$loop->last)
        <hr>
        @endif

        @endforeach

    </div>
</section>

<section class="portfolio-area">
    <div class="container">
          <div class="row mb-60">
            <div class="col-12">
                <div class="sec-wrapper text-center">
                    <h5>{{ __('landing.mobile.offer')  }}</h5>
                    <h2 class="section-title">{{ __('landing.mobile.within') }}</h2>
                </div>
            </div>
        </div>
        <div id="portfolio-grid" class="row row-portfolio">
            @foreach ($mobile_list as $item)
            <div class="col-lg-4 col-md-6 col-sm-6 grid-item cat2 cat4">
                {{-- add border --}}
                <div class="tportfolio mb-30" >
                    <div class="tportfolio__img">
                        <a class="popup-image" href="{{ Storage::url($item->logo) }}" data-fancybox="gallery">
                            <img src="{{ Storage::url($item->logo) }}" alt="" />
                        </a>
                        <div class="tportfolio__text tportfolio__text-2">
                            <h3 class="tportfolio-title"><a href="portfolio-details.html">{{ $item->title }}</a></h3>
                            <h4>{{ $item->description }}</h4>

                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>

@include('sections.testimonials')
@include('sections.brands')

@endsection
