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
                   <div class="blog-wrap blog-item mb-50">
                    <div style="width: 100%; max-width: 770px; aspect-ratio: 16 / 9; overflow: hidden; margin: 0 auto;">
                        <img src="{{ Storage::url($article->thumbnail) }}" alt="blog"
                             style="width: 100%; height: 100%; object-fit: cover; display: block;">
                    </div>
                      <div class="blog-details blog-details-2">
                         <ul class="blog-meta">
                            <li><a href="#"><i class="fal fa-clock"></i> {{ $article->published_at->diffForHumans() }}</a></li>
                            {{-- <li><a href="#"><i class="fal fa-user-circle"></i> Tania</a></li>
                            <li><a href="#"><i class="fal fa-comments"></i> 2 Comments</a></li> --}}
                         </ul>
                         <h3 class="blog-title">
                            <a href="#">{{ $article->title }}</a>
                         </h3>
                         <div class="blog-text">
                            {!! $article->content !!}
                        </div>
                         <div class="blog-info d-sm-flex align-items-center justify-content-between mb-40">
                            <div class="blog-tag">
                               <span>Tags: </span>
                               @foreach ($article->tags as $tag)
                               <a href="#" class="tags">{{ $tag }}</a>
                               @endforeach
                            </div>
                            <div class="blog-category">
                            <span>Category: </span>
                               <a href="#"> {{ $article->getLocalizedCategory()?->name}}</a>
                            </div>
                         </div>
                      </div>
                   </div>
                   {{-- <div class="blog__author mb-95 d-md-flex wow fadeInUp" data-wow-delay=".4s">
                      <div class="blog__author-img mr-30">
                            <img src="assets/img/blog/author/author-1.jpg" alt="">
                      </div>
                      <div class="blog__author-content">
                            <h5>Sophie Ianiro</h5>
                            <div class="blog__author-social">
                               <ul>
                                  <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                  <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                  <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                  <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                  <li><a href="#"> <i class="fab fa-linkedin-in"></i></a></li>
                               </ul>
                            </div>
                            <p>I said cracking goal down the pub blag cheeky bugger at public school A bit of how's your father boot.!</p>
                      </div>
                   </div>
                   <div class="post-comments mb-95 wow fadeInUp" data-wow-delay=".6s">
                      <div class="post-comment-title mb-40">
                            <h3>Comments</h3>
                      </div>
                      <div class="latest-comments">
                            <ul>
                               <li>
                                  <div class="comments-box">
                                        <div class="comments-avatar">
                                           <img src="assets/img/blog/comment/comments-1.png" alt="">
                                        </div>
                                        <div class="comments-text">
                                           <div class="avatar-name">
                                              <h5>David Angel Makel</h5>
                                              <span class="post-meta">October 26, 2020</span>
                                           </div>
                                           <p>The bee's knees bite your arm off bits and bobs he nicked it gosh gutted mate blimey, old off his nut argy bargy vagabond buggered dropped.</p>
                                           <a href="#" class="comment-reply"> Reply</a>
                                        </div>
                                  </div>
                               </li>
                               <li class="children">
                                  <div class="comments-box">
                                        <div class="comments-avatar">
                                           <img src="assets/img/blog/comment/comments-rep-1.png" alt="">
                                        </div>
                                        <div class="comments-text">
                                           <div class="avatar-name">
                                              <h5>Bailey Wonger</h5>
                                              <span class="post-meta">October 27, 2020</span>
                                           </div>
                                           <p>Do one say wind up buggered bobby bite your arm off gutted mate, David victoria sponge cup of char chap fanny around.</p>
                                           <a href="#" class="comment-reply"> Reply</a>
                                        </div>
                                  </div>
                               </li>
                               <li class="children">
                                  <div class="comments-box">
                                        <div class="comments-avatar">
                                           <img src="assets/img/blog/comment/comments-rep-2.png" alt="">
                                        </div>
                                        <div class="comments-text">
                                           <div class="avatar-name">
                                              <h5>Hilary Ouse</h5>
                                              <span class="post-meta">October 28, 2020</span>
                                           </div>
                                           <p>Baking cakes is cobblers wellies William geeza bits and bobs what a plonker it's your round,</p>
                                           <a href="#" class="comment-reply">Reply</a>
                                        </div>
                                  </div>
                               </li>
                            </ul>
                      </div>
                   </div>
                   <div class="post-comment-form wow fadeInUp" data-wow-delay=".2s">
                      <h4>Leave a Reply </h4>
                      <span>Your email address will not be published.</span>
                      <form action="#">
                            <div class="row">
                               <div class="col-xl-6 col-md-6">
                                  <div class="post-input">
                                        <input type="text" placeholder="Your Name">
                                  </div>
                               </div>
                               <div class="col-xl-6 col-md-6">
                                  <div class="post-input">
                                        <input type="email" placeholder="Your Email">
                                  </div>
                               </div>
                               <div class="col-xl-12">
                                  <div class="post-input">
                                        <input type="text" placeholder="Website">
                                  </div>
                               </div>
                               <div class="col-xl-12">
                                  <div class="post-input">
                                        <textarea placeholder="Your message..."></textarea>
                                  </div>
                               </div>
                               <div class="col-xl-12">
                                  <div class="post-check mb-40">
                                        <input type="checkbox">
                                        <span>Save my name, email, and website in this browser for the next time I comment.</span>
                                  </div>
                               </div>
                            </div>

                            <button type="submit" class="tp-btn">Send Message</button>
                      </form>
                   </div> --}}
                </div>
             </div>


             <div class="col-xl-4 col-lg-4">
                   <div class="blog__sidebar">
                      <div class="sidebar__widget mb-50 wow fadeInUp" data-wow-delay=".2s">
                         <div class="sidebar__widget-content">
                               <div class="search">
                                  <form action="{{ route('article.list',['locale'=>app()->getLocale()]) }}">
                                     <input type="text" placeholder="Search...">
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
                                         <h6><a href="{{ route('article.detail', ['locale' => app()->getLocale(), 'slug' => $article->slug]) }}">{{ $latest->title }}</a></h6>
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