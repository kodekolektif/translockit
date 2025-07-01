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
            <!-- START PORTFOLIO FILTER AREA -->
            <div class="col-xl-6 col-lg-6">
                <div class="sec-wrapper text-centers">
                     <h5>{{ __('landing.project.feature_project') }}</h5>
                    <h2 class="section-title">{{ __('landing.project.explore_our_project') }}</h2>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
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
            <div class="col-lg-4 col-md-6 col-sm-6 grid-item {{ $project->service->unique_id }}">
                <div class="tportfolio mb-30">
                    <div class="tportfolio__img">
                        <a class="popup-image" href="{{ Storage::url($project->image) }}"
                            data-fancybox="gallery">
                            <img src="{{ Storage::url($project->image) }}" alt=""
                                style="width:100%; height:370px; object-fit:cover;" />
                        </a>
                        <div class="tportfolio__text tportfolio__text-2">
                            <h3 class="tportfolio-title">
                                <a href="#">
                                {{ $project->name }}
                                </a>
                            </h3>
                            <h4>{{ $project->service->title }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
