<div class="brand-area bg-grey pt-100 pb-100">
    <div class="container">
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
