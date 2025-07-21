@extends('app.index')

@section('content')
<!-- page title area start -->
<section class="page__title p-relative d-flex align-items-center grey-bg-2" data-overlay="dark" data-opacity="7">
    <div class="page__title-bg" data-background="{{ asset('assets/img/bg/bg-slider_TranslockIt_5.jpg') }}"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="page__title-content mt-100 text-center">
                    <h2 style="overflow: hidden; white-space: nowrap;">{{ __('landing.about.about_us') }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('landing.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('landing.about.about_us') }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-area pt-120 pb-80 fix">

    <div class="container">
        @foreach ($about as $i => $item)
        <div class="row align-items-center mb-4 row-product pt-50 pb-50">
            @if ($i % 2 == 0)
            {{-- Gambar di kiri desktop, atas di mobile --}}
            <div class="col-12 col-lg-5 order-1 order-lg-1">
                <img src="{{ Storage::url($item->image) }}" alt="image" class="product-image w-100">
            </div>
            <div class="col-12 col-lg-7 order-2 order-lg-2">
                <div class="plan-content description mt-3 mt-lg-0">
                    <h3 class="service-title">{{ $item->title }}</h3>
                    {!! $item->description !!}
                </div>
            </div>
            @else
            {{-- Gambar di kanan desktop, tetap atas di mobile --}}
            <div class="col-12 col-lg-5 order-1 order-lg-2">
                <img src="{{ Storage::url($item->image) }}" alt="image" class="product-image w-100">
            </div>
            <div class="col-12 col-lg-7 order-2 order-lg-1">
                <div class="plan-content description mt-3 mt-lg-0">
                    <h3 class="service-title">{{ $item->title }}</h3>
                    {!! $item->description !!}
                </div>
            </div>
            @endif
        </div>

        @if (!$loop->last)
        <hr>
        @endif
        @endforeach
    </div>
</section>
<!-- page title area end -->

@include('sections.brands')
@include('sections.testimonials')
@endsection
