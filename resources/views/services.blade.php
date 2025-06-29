@extends('app.index')

@section('content')
<section class="page__title p-relative d-flex align-items-center grey-bg-2" data-overlay="dark" data-opacity="7">
    <div class="page__title-bg" data-background="{{ asset('assets/img/bg/bg-slider_TranslockIt_5.jpg') }}"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="page__title-content mt-100 text-center">
                    <h2 style="overflow: hidden; white-space: nowrap;">{{ __('landing.services.services') }}</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('landing.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('landing.services.services') }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="main-services grey-bg pt-120 pb-90" data-background="{{ asset('assets/img/pattern/pt1.png') }}">
    <div class="container">
        <div class="row mb-60">
            <div class="col-12">
                <div class="sec-wrapper text-center">
                    <h5>{{ __('landing.Services')  }}</h5>
                    <h2 class="section-title">{{ __('landing.explore our services') }}</h2>
                </div>
            </div>
        </div>
        <div class="row text-center">
            @foreach ($services as $service)
            <div class="col-xl-3 col-lg-3 col-md-6 mb-30 d-flex justify-content-center">
                <div class="mfbox mfbox-white">
                    <div class="mf-shape"></div>
                    <div class="mfbox__icon mb-15">
                        <img src="{{ Storage::url($service->icon) }}" alt="icon" class="img-fluid">
                    </div>
                    <div class="mfbox__text">
                        <h3 class="mf-title">{{ $service->title }}</h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<style>
    .portfolio_description ul li {
        list-style: disc;
        margin-left: 20px;
        color: #686777;
    }
</style>

<section class="portfolio-area pt-120 pb-70">
    <div class="container">
        <div class="row mb-40 d-none">
            <div class="col-12">
                <div class="sec-wrapper text-center">
                    <h5>{{ __('landing.project.feature_project') }}</h5>
                    <h2 class="section-title">{{ __('landing.project.explore_our_project') }}</h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center mb-50">
            <div class="col-xl-12 col-lg-12">
                <div class="text-lg-end">
                    <div class="portfolio-filter">
                        <button class="active" data-filter="*" style="font-size: 18px">Show all</button>
                        @foreach ($services as $service)
                        <button style="font-size: 18px" data-filter=".{{ $service->unique_id }}">
                            {{ $service->title }}
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- END PORTFOLIO FILTER AREA -->
        </div>
        <div id="portfolio-grid" class="row row-portfolio">
            @foreach ($projects as $project)
            <div class="col-lg-12 col-md-12 col-sm-12 grid-item {{ $project->service->unique_id }}">
                <div class="tportfolio mb-30 row">
                    <div class="tportfolio__img col-lg-4 col-md-4 col-sm-12">
                            <a class="popup-image" href="{{ Storage::url($project->image) }}"
                                data-fancybox="gallery">
                                <img src="{{ Storage::url($project->image) }}" alt=""
                                    style="width:100%; height:370px; object-fit:cover;" />
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <h3>{{ $project->name }}</h3>
                            <h5 style="color:#60b5ff">{{ $project->service->title }}</h5>
                           <div style="text-align: justify; font-size: 16px; color:#000;" class="portfolio_description">
                             {!! $project->description !!}
                           </div>
                        </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
