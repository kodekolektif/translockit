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
        <div class="row justify-content-center text-center">
            @foreach ($services as $service)
            <a href="{{ route('services', [app()->getLocale(), 'category' => $service->unique_id]) }}#project" class="col-xl-3 col-lg-3 col-md-6 mb-30 d-flex">
                <div class="mfbox w-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="mf-shape"></div>
                        <div class="mfbox__icon mb-15 text-center">
                            <img src="{{ Storage::url($service->icon) }}" alt="icon" class="img-fluid" style="width:80px; height:80px; object-fit:contain;">
                        </div>
                        <div class="mfbox__text text-center">
                            <h3 class="mf-title">{{ $service->title }}</h3>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
