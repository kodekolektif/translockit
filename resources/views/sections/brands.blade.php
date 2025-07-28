@php
    use Illuminate\Support\Facades\Storage;
    use App\Models\Brand;

    $brands = Brand::where('is_active', true)
        ->get()
        ->map(function ($brand) {
            $brand->logo_url = Storage::url($brand->logo);
            return $brand;
        });
@endphp

<div class="brand-area bg-grey pt-50 pb-100 {{ $brands->isEmpty() ? 'd-none' : '' }}">
    <div class="container">
        <div class="row mb-40 mt-n20 z-index">
            <div class="col-12">
                <div class="sec-wrapper text-center">
                    <h2 class="section-title" style="font-size: 40px !important">
                        {{ __('landing.partner_desc') }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="brand-active swiper-container">
            <div class="swiper-wrapper align-items-center">
                @foreach ($brands as $i => $brand)
                    <div class="brand-wrapper swiper-slide wow fadeInUp"
                         data-wow-delay="{{ min(($i + 1) * 0.1, 0.5) }}s"
                         data-swiper-autoplay="10000">
                        <a href="#">
                            <img src="{{ $brand->logo_url }}"
                                 class="img-fluid"
                                 alt="Brand Logo"
                                 loading="lazy">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
