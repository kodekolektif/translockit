<div class="about-area pt-120 pb-90">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6">
                <div class="ab-box pl-50 mb-30">
                    <div class="sec-wrapper">
                        <h5>{{ __('landing.About Us') }}</h5>
                        <h2 class="section-title">{{ __('landing.top_notch') }}</h2>
                        <p>{{ __('landing.high_specialization') }}</p>
                    </div>
                    <div class="abs-item-box mt-40 mb-30">
                        <div class="row">
                            <div class="col-6">
                                <div class="abs-items mb-20">
                                    <div class="abs-icon mb-15">
                                        <i class="icon_ribbon_alt"></i>
                                    </div>
                                    <div class="abs-item-text fix">
                                        <h3 class="abs-item-title">{{ __('landing.Customized mobile applications.') }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="abs-items mb-20">
                                    <div class="abs-icon mb-15">
                                        <i class="icon_lightbulb_alt"></i>
                                    </div>
                                    <div class="abs-item-text fix">
                                        <h3 class="abs-item-title">{{ __('landing.Artificial Intelligence (AI).') }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ab-btn">
                        <a href="{{ route('about',['locale'=>app()->getLocale()]) }}" class="tp-btn">{{
                            __('landing.Learn More') }}</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6">
                <div class="abs-images abs-images-2 pl-50">
                    <div class="row">
                        <div class="col-12">
                            <div class="abs-img img-filter mb-30">
                                <img src="{{ asset('assets/img/about/About-TranslockIt_1.jpg') }}" alt=""
                                    style="width: 100%; height: auto;">
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="ab-line-shape w-100 mb-20"></div>
                            <div class="ab-line-shape w-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
