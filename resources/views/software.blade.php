@extends('app.index')

@section('content')
<style>
    p {
        margin-bottom: 15px !important;
    }

    .image-wrapper {
        max-width: 600px;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
</style>
<section class="page__title p-relative d-flex align-items-center grey-bg-2" data-overlay="dark" data-opacity="7">
    <div class="page__title-bg" data-background="{{ asset('assets/img/bg/bg-slider_TranslockIt_5.jpg') }}"></div>
    <div class="container">

        <div class="row">
            <div class="col-xl-12">
                <div class="page__title-content mt-100 text-center">
                    <h2 style="overflow: hidden; white-space: nowrap;">{{ 'Software' }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('landing.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ 'Software' }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact-area fix">
    {{-- <h3 class="service-title">Some of our products and softwares are:</h3> --}}
    <div class="container">
        @foreach ($software_lists as $i => $item)
        <div class="row align-items-center mb-4 row-product pt-50 pb-50">
            @if ($i % 2 == 0)
            {{-- Gambar di kiri desktop, atas di mobile --}}
            <div class="col-12 col-lg-5 order-1 order-lg-1 image-wrapper">
                <img src="{{ Storage::url($item->logo) }}" alt="image" class="product-image w-100">
            </div>
            <div class="col-12 col-lg-7 order-2 order-lg-2">
                <div class="plan-content description mt-3 mt-lg-0">
                    <h3 class="service-title">{{ $item->name }}</h3>
                    {!! $item->description !!}
                </div>
            </div>
            @else
            {{-- Gambar di kanan desktop, tetap atas di mobile --}}
            <div class="col-12 col-lg-5 order-1 order-lg-2 image-wrapper">
                <img src="{{ Storage::url($item->logo) }}" alt="image" class="product-image w-100">
            </div>
            <div class="col-12 col-lg-7 order-2 order-lg-1">
                <div class="plan-content description mt-3 mt-lg-0">
                    <h3 class="service-title">{{ $item->name }}</h3>
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

@endsection
