@php
    $lang = app()->getLocale();
    $faqs = App\Models\Faq::where(['lang' => $lang,'is_active'=>true])->get();
@endphp
<div class="faq-area pos-rel black-bg">
    <div class="faq-bg" data-background="{{ asset('assets/img/bg/bg-slider_TranslockIt_5.jpg') }}"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-6 col-lg-6 offset-lg-6">
                <div class="faq-content pl-70 pt-120 pb-120">
                    <div class="sec-wrapper mb-30">
                        <h5>{{ __('landing.faq.title') }}</h5>
                        <h2 class="section-title text-white">{{ __('landing.faq.desc') }}</h2>
                    </div>
                    <div class="accordion" id="accordionExample">
                        @foreach ($faqs as $i => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $i }}">
                                <button class="accordion-button {{ $i != 0 ? 'collapsed':'' }}" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $i }}" aria-expanded="{{ $i == 0 ? 'true':'false' }}" aria-controls="collapse{{ $i }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $i }}" class="accordion-collapse collapse {{ $i == 0?'show':'' }}" aria-labelledby="heading{{ $i }}"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button " type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    {{ __('landing.what are the advantages of our services?') }}
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                                        ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur. </p>
                                </div>
                            </div>
                        </div> --}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
