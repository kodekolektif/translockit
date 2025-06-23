<div class="latest-news-area pt-120 pb-90">
    <div class="container">
        <div class="row mb-60">
            <div class="col-12">
                <div class="sec-wrapper">
                    <h5>Features News</h5>
                    <h2 class="section-title">Latest news & articles.</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($articles as $article)
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="latest-blog latest-blog-2 mb-30">
                    <div class="latest-blog-img pos-rel">
                        <img src="{{ Storage::url($article->thumbnail) }}" alt="">
                        <div class="top-date top-date-2">
                            <a href="#">{{ $article->published_at->diffforhumans() }}</a>
                        </div>
                    </div>
                    <div class="latest-blog-content latest-blog-content-2">
                        <div class="latest-post-meta mb-15">
                            <span><a href="#"><i class="far fa-eye"></i> 10 Reads </a></span>
                            <span><a href="#"><i class="far fa-comments"></i> 23 Comments</a></span>
                        </div>
                        <h3 class="latest-blog-title">
                            <a href="{{ route('article.detail', ['locale' => app()->getLocale(), 'slug' => $article->slug]) }}">{{ $article->title }}</a>
                        </h3>
                        <div class="blog-btn-2">
                            <a href="{{ route('article.detail', ['locale' => app()->getLocale(), 'slug' => $article->slug]) }}" class="link-btn">
                                read more
                                <i class="fal fa-long-arrow-right"></i>
                                <i class="fal fa-long-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
