<div class="main-services black-bg pt-120 pb-90" data-background="assets/img/pattern/pt1.png">
    <div class="container">
        <div class="row mb-60">
            <div class="col-12">
                <div class="sec-wrapper text-center">
                    <h5>{{ __('landing.Services') }}</h5>
                    <h2 class="section-title text-white">{{ __('landing.explore our services') }}</h2>
                </div>
            </div>
        </div>
        <div class="row text-center">
            @foreach ($services as $service)
            <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                <div class="mfbox ">
                    <div class="mf-shape"></div>
                    <div class="mfbox__icon mb-15">
                        {{-- <i class="flaticon-technical-support"></i> --}}
                        <img src="{{ Storage::url($service->icon) }}" alt="icon" class="img-fluid">
                    </div>
                    <div class="mfbox__text">
                        <h3 class="mf-title">{{ $service->title }}</h3>
                        <p>{{ $service->description }}</p>
                    </div>
                    <div class="mf-btn">
                        <a class="squire-btn" href="services-details.html"><i class="fal fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
