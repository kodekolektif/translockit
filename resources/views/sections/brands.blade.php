@php
    $brands = \App\Models\Brand::where('is_active', true)
    ->get();
@endphp

<div class="brand-area bg-grey pt-50 pb-100 {{ $brands->isEmpty() ? 'd-none' : '' }}">
    <div class="container">
          <div class="row mb-40 mt-n20 z-index">
            <div class="col-12">
                <div class="sec-wrapper text-center">
                    {{-- <h5>Pat</h5> --}}
                    <h2 class="section-title" style="font-size: 40px !important">{{ __('landing.partner_desc') }}</h2>
                </div>
            </div>
        </div>
        {{-- <h1>{{ __('landing.partner_desc') }}</h1> --}}
        <div class="brand-active swiper-container">
            <div class="swiper-wrapper align-items-center">
                @foreach ($brands as $i => $brand)
                    <div class="brand-wrapper swiper-slide wow fadeInUp" data-wow-delay="{{ ($i + 1) * 0.3 }}s" data-swiper-autoplay="10000">
                        <a href="#"><img src="{{ Storage::url($brand->logo) }}" class="img-fluid" alt="img"></a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
