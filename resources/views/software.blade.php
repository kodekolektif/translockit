@extends('app.index')
<style>
    p {
        margin-bottom: 15px !important;
    }
</style>

@section('content')
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
        <div class="row align-items-center mb-4 row-product pt-50 pb-50 ">
            @if ($i % 2 == 0)
            {{-- Gambar di kiri --}}
            <div class="col-xxl-5 col-xl-6 col-lg-6">
                <img src="{{ Storage::url($item->logo) }}" alt="image" class="product-image" >
            </div>
            <div class="col-xxl-7 col-xl-6 col-lg-6">
                <div class="plan-content description">
                    <h3 class="service-title">{{ $item->name }}</h3>
                    {!! $item->description !!}
                </div>
            </div>
            @else
            {{-- Gambar di kanan --}}
            <div class="col-xxl-7 col-xl-6 col-lg-6">
                <div class="plan-content description">
                    <h3 class="service-title">{{ $item->name }}</h3>
                    {!! $item->description !!}
                </div>
            </div>
            <div class="col-xxl-5 col-xl-6 col-lg-6">
                <img src="{{ Storage::url($item->logo) }}" alt="image" class="product-image" >
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
