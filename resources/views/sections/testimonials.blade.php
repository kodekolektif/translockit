<section class="review-area review-area-padding grey-bgs pt-150 pb-120 pos-rel pl-50 pr-50">
    <div class="wavify-wrapper">
        <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wavify-item"
            data-wavify-height="140" data-wavify-background="rgba(245,245,245,0.5)" data-wavify-amplitude="80"
            data-wavify-bones="4">
            <path
                d="M 0 141.71042689406383 C 237.875 148.50471572578806 237.875 148.50471572578806 475.75 145.107571309926 C 713.625 141.71042689406383 713.625 141.71042689406383 951.5 165.82491752026056 C 1189.375 189.9394081464571 1189.375 189.9394081464571 1427.25 193.5786122514483 C 1665.125 197.21781635643944 1665.125 197.21781635643944 1903 165.82491752026056 L 1903 7389 L 0 7389 Z"
                fill="rgba(245,245,245,0.5)"></path>
        </svg>

        <svg width="100%" height="100%" version="1.1" xmlns="http://www.w3.org/2000/svg" class="wavify-item"
            data-wavify-height="140" data-wavify-background="#f5f5f5" data-wavify-amplitude="80" data-wavify-bones="3">
            <path
                d="M 0 147.22020568980648 C 317.16666666666663 183.65559797623268 317.16666666666663 183.65559797623268 634.3333333333333 165.43790183301957 C 951.4999999999999 147.22020568980648 951.4999999999999 147.22020568980648 1268.6666666666665 200.09089320557024 C 1585.833333333333 252.96158072133412 1585.833333333333 252.96158072133412 1903 183.26276877337258 L 1903 7389 L 0 7389 Z"
                fill="#f5f5f5"></path>
        </svg>
    </div>
    <div class="container">
        <div class="row mb-40 pt-150 z-index">
            <div class="col-12">
                <div class="sec-wrapper text-center">
                    <h5>Testimonials</h5>
                    <h2 class="section-title">Feedback from our clients.</h2>
                </div>
            </div>
        </div>
        <div class="test-active swiper-container">
            <div class="swiper-wrapper pb-70">

                @foreach ($testimonials as $testimonial)
                <div class="testi-item swiper-slide">
                    <div class="tptestinimail">
                        <div class="tptestinimail__text" >
                            <p>{{ $testimonial->content }}</p>
                        </div>
                        <div class="tptestinimail__author d-sm-flex align-items-center">
                            <div class="tptestinimail__author--img tptestinimail__author--img-2">
                                <img src="{{ Storage::url($testimonial->image) }}" alt="">
                            </div>
                            <div class="tptestinimail__author--bio">
                                <h4>{{ $testimonial->name }}</h4>
                                <h6>{{ $testimonial->title }}</h6>
                            </div>
                        </div>
                        <div class="testimonial-quote text-end">
                            <i class="fa fa-quote-right"></i>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>
