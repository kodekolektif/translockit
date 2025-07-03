@extends('app.index')

@section('content')
<main>
    <!-- page title area start -->
    <section class="page__title p-relative d-flex align-items-center grey-bg-2" data-overlay="dark" data-opacity="7">
        <div class="page__title-bg" data-background="{{ asset('assets/img/bg/bg-slider_TranslockIt_5.jpg') }}"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page__title-content mt-100 text-center">
                        <h2 style="overflow: hidden; white-space: nowrap;">{{ __('landing.articles') }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('landing.Home') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('landing.articles') }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page title area end -->

    <!-- blog area start -->
    <section class="blog__area pt-120 pb-120">
       <div class="container">
          <div class="row">
             <div class="col-xl-8 col-lg-8">

                <div class="blog__wrapper pr-50">
                    @forelse ($articles as $article)
                        <div class="blog-wrap blog-item mb-50">
                        <div class="blog-thumb">
                            <img src="{{ Storage::url($article->thumbnail) }}" alt="blog" style="width:770px; height:450px; object-fit:cover;">
                        </div>
                        <div class="blog-details blog-details-2">
                            <ul class="blog-meta">
                                <li><a href="#"><i class="fal fa-clock"></i>{{ $article->published_at->diffForHumans() }}</a></li>
                                {{-- <li><a href="#"><i class="fal fa-user-circle"></i> Tania</a></li>
                                <li><a href="#"><i class="fal fa-comments"></i> 2 Comments</a></li> --}}
                            </ul>
                            <h3 class="blog-title">
                                <a href="{{ route('article.detail', ['locale' => app()->getLocale(), 'slug' => $article->slug]) }}">{{ $article->title }}</a>
                            </h3>
                            {!! Str::limit($article->content,300) !!}
                            <div class="blog-btn mt-25">
                                <a href="{{ route('article.detail', ['locale' => app()->getLocale(), 'slug' => $article->slug]) }}" class="tp-btn">{{ __('landing.read_more') }}</a>
                            </div>
                        </div>
                        </div>
                    @empty
                        <h3 class="text-center">{{ __('landing.no_article') }}</h3>
                    @endforelse
                   {{-- <div class="blog-wrap blog-item mb-50">
                      <div class="blog-thumb blog-video">
                         <img src="{{ asset('assets/img/blog/blog-big-4.jpg') }}" alt="blog">
                         <a data-fancybox="" href="https://www.youtube.com/watch?v=eXQgPCsd83c" class="play-btn" ><i class="fas fa-play"></i></a>
                      </div>
                      <div class="blog-details blog-details-2">
                         <ul class="blog-meta">
                            <li><a href="#"><i class="fal fa-clock"></i> 20 JUN</a></li>
                            <li><a href="#"><i class="fal fa-user-circle"></i> sakil</a></li>
                            <li><a href="#"><i class="fal fa-comments"></i> 2 Comments</a></li>
                         </ul>
                         <h3 class="blog-title">
                            <a href="blog-details.html">Introducing the latest linoor features</a>
                         </h3>
                         <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum.</p>
                         <div class="blog-btn mt-25">
                            <a href="blog-details.html" class="tp-btn">Read More</a>
                         </div>
                      </div>
                   </div>
                   <div class="blog-quote mb-50">
                      <blockquote>
                         <div class="blog-quote-icon mb-20">
                            <img src="{{ asset('assets/img/blog/quote-icon.png') }}" alt="">
                         </div>
                         <div class="blog-quote-text">
                            <p>There are many variations of passages of available but majority have alteration in some by inject humour or random words. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.</p>
                         </div>
                      </blockquote>
                   </div>
                   <div class="blog-wrap blog-item mb-50">
                      <div class="blog-thumb">
                         <img src="{{ asset('assets/img/blog/blog-big-3.jpg') }}" alt="blog">
                      </div>
                      <div class="blog-details blog-details-2">
                         <ul class="blog-meta">
                            <li><a href="#"><i class="fal fa-clock"></i> 20 JUN</a></li>
                            <li><a href="#"><i class="fal fa-user-circle"></i> Tania</a></li>
                            <li><a href="#"><i class="fal fa-comments"></i> 2 Comments</a></li>
                         </ul>
                         <h3 class="blog-title">
                            <a href="blog-details.html">Delivering the best digital marketing </a>
                         </h3>
                         <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum.</p>
                         <div class="blog-btn mt-25">
                            <a href="blog-details.html" class="tp-btn">Read More</a>
                         </div>
                      </div>
                   </div> --}}
                </div>

                {{ $articles->links('vendor.pagination.default') }}

                {{-- <div class="row">
                   <div class="col-xxl-12">
                      <div class="basic-pagination wow fadeInUp mt-30" data-wow-delay=".2s">
                         <ul class="d-flex align-items-center">
                            <li class="prev">
                               <a href="blog.html" class="link-btn link-prev">
                                  Prev
                                  <i class="fal fa-long-arrow-left"></i>
                                  <i class="fal fa-long-arrow-left"></i>
                               </a>
                            </li>
                            <li>
                               <a href="blog.html">
                                  <span>1</span>
                               </a>
                            </li>
                            <li class="active">
                               <a href="blog.html">
                                  <span>2</span>
                               </a>
                            </li>
                            <li>
                               <a href="blog.html">
                                  <span>3</span>
                               </a>
                            </li>
                            <li class="next">
                               <a href="blog.html" class="link-btn">
                                  Next
                                  <i class="fal fa-long-arrow-right"></i>
                                  <i class="fal fa-long-arrow-right"></i>
                               </a>
                            </li>
                         </ul>
                      </div>
                   </div>
                </div> --}}
             </div>


             <div class="col-xl-4 col-lg-4">
                   <div class="blog__sidebar">
                      <div class="sidebar__widget mb-50 wow fadeInUp" data-wow-delay=".2s">
                         <div class="sidebar__widget-content">
                               <div class="search">
                                <form action="{{ route('article.list', ['locale' => app()->getLocale()]) }}" method="GET">
                                    <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
                                    <button type="submit"><i class="far fa-search"></i></button>
                                </form>
                               </div>
                         </div>
                      </div>
                      <div class="sidebar__widget sidebar__widget-padding mb-75 wow fadeInUp grey-bg" data-wow-delay=".4s">
                         <div class="sidebar__widget-title mb-25">
                               <h4>{{ __('landing.recent_article') }}</h4>
                         </div>
                         <div class="sidebar__widget-content">
                            <div class="rc-post">
                               <ul>
                                @foreach ($latest_article as $latest)
                                <li class="d-flex align-items-center mb-20">
                                      <div class="rc-thumb mr-15">
                                         <a href="{{ route('article.detail', ['locale' => app()->getLocale(), 'slug' => $latest->slug]) }}"><img src="{{ Storage::url($latest->thumbnail) }}" alt="rc-post"></a>
                                      </div>
                                      <div class="rc-text">
                                         <h6><a href="{{ route('article.detail', ['locale' => app()->getLocale(), 'slug' => $latest->slug]) }}">{{ $latest->title }}</a></h6>
                                         <span class="rc-meta"><i class="fal fa-clock"></i> {{ date('d M',strtotime($latest->published_at)) }}</span>
                                      </div>
                                </li>
                                @endforeach
                               </ul>
                            </div>
                         </div>
                      </div>
                      <div class="sidebar__widget sidebar__widget-padding mb-75 wow fadeInUp grey-bg" data-wow-delay=".6s">
                         <div class="sidebar__widget-title mb-25">
                               <h4>{{ __('landing.category') }}</h4>
                         </div>
                         <div class="sidebar__widget-content">
                               <div class="cat-link">
                                  <ul>
                                    @foreach ($categories as $category)
                                        <li><a href="{{ route('article.list',['locale'=>app()->getLocale(),'category'=>$category->unique_id]) }}">{{ $category->name }}</a></li>
                                    @endforeach
                                  </ul>
                               </div>
                         </div>
                      </div>
                      {{-- <div class="sidebar__widget sidebar__widget-padding mb-60 wow fadeInUp grey-bg" data-wow-delay=".8s">
                         <div class="sidebar__widget-title mb-25">
                               <h4>Recent Comments</h4>
                         </div>
                         <div class="sidebar__widget-content">
                               <div class="rc__comments">
                                  <ul>
                                     <li class="d-flex mb-25">
                                           <div class="rc__comments-icon mr-30">
                                              <i class="fas fa-comment"></i>
                                           </div>
                                           <div class="rc__comments-content">
                                              <h6>Justin Case</h6>
                                              <p>My lady mush hanky panky young delinquent.!</p>
                                           </div>
                                     </li>
                                     <li class="d-flex mb-25">
                                           <div class="rc__comments-icon mr-30">
                                              <i class="fas fa-comment"></i>
                                           </div>
                                           <div class="rc__comments-content">
                                              <h6>Eric Widget</h6>
                                              <p>My lady mush hanky panky young delinquent.!</p>
                                           </div>
                                     </li>
                                     <li class="d-flex">
                                           <div class="rc__comments-icon mr-30">
                                              <i class="fas fa-comment"></i>
                                           </div>
                                           <div class="rc__comments-content">
                                              <h6>Penny Tool</h6>
                                              <p>My lady mush hanky panky young delinquent.!</p>
                                           </div>
                                     </li>
                                  </ul>
                               </div>
                         </div>
                      </div> --}}
                      {{-- <div class="sidebar__widget sidebar__widget-padding mb-50 wow fadeInUp grey-bg" data-wow-delay="1s">
                         <div class="sidebar__widget-title mb-15">
                               <h4>Popular Tags</h4>
                         </div>
                         <div class="sidebar__widget-content">
                               <div class="tags">
                                  <a href="blog-details.html">The Saas,</a>
                                  <a href="blog-details.html">Pix Saas Blog,</a>
                                  <a href="blog-details.html">Landing,</a>
                                  <a href="blog-details.html">UI/UX Design,</a>
                                  <a href="blog-details.html">Branding,</a>
                                  <a href="blog-details.html">Animation,</a>
                                  <a href="blog-details.html">Design,</a>
                                  <a href="blog-details.html">Ideas</a>
                               </div>
                         </div>
                      </div> --}}
                   </div>
             </div>
          </div>
       </div>
    </section>
    <!-- blog area end -->


 </main>

@endsection