@extends('app.index')

@section('content')



     <!-- page title area start -->
         <section class="page__title p-relative d-flex align-items-center grey-bg-2" data-overlay="dark" data-opacity="7">
            <div class="page__title-bg" data-background="{{ asset('assets/img/bg/bg-slider_TranslockIt_5.jpg') }}"></div>
            <div class="container">
                  <div class="row">
                     <div class="col-xl-12">
                        <div class="page__title-content mt-100 text-center" >
                              <h2 style="overflow: hidden; white-space: nowrap;">{{ __('landing.Contact') }}</h2>
                              <nav aria-label="breadcrumb">
                                 <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('landing.Home') }}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ __('landing.Contact') }}</li>
                                 </ol>
                              </nav>
                        </div>
                     </div>
                  </div>
            </div>
         </section>
         <!-- page title area end -->

         <!-- contact area  -->
         <section class="contact-area pt-120 pb-80 fix">
         <div class="container">
             <div class="row">
                 <div class="col-xxl-5 col-xl-6 col-lg-6">
                     <div class="section-title-wrapper mb-15">
                         <h5 class="section-subtitle mb-20" style="overflow: hidden; white-space: nowrap;">{{ __('landing.contact.keep_in_touch') }}</h5>
                         <h2 class="section-title" style="overflow: hidden;">
                            {{ __('landing.contact.lets_work_together') }}
                            </h2>
                     </div>
                     <div class="contact-info mr-50 mr-xs-0  mr-md-0">
                         <div class="single-contact-info d-flex align-items-center">
                             <div class="contact-info-icon">
                                 <a href="#"><i class="fad fa-comments"></i></a>
                             </div>
                             <div class="contact-info-text mt-10">
                                 <span>{{ __('landing.contact.call_anytime') }}</span>
                                 <h5><a href="tell:926668880000">{{ $phone }}</a></h5>
                             </div>
                         </div>
                         <div class="single-contact-info d-flex align-items-center">
                             <div class="contact-info-icon">
                                 <a href="#"><i class="fal fa-envelope"></i></a>
                             </div>
                             <div class="contact-info-text mt-10">
                                 <span>{{ __('landing.contact.send_email') }}</span>
                                 <h5><a href="mailto:{{ $email }}">{{ $email }}</a> </h5>
                             </div>
                         </div>
                         <div class="single-contact-info d-flex align-items-center">
                             <div class="contact-info-icon">
                                 <a href="#"><i class="fal fa-map-marker-alt"></i></a>
                             </div>
                             <div class="contact-info-text mt-10">
                                 <span>{{ __('landing.contact.visit_office') }}</span>
                                 <h5><a target="_blank" href="{{ $google_map_url }}">{{ $address }}</a></h5>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-xxl-7 col-xl-6 col-lg-6">
                     <div class="contact-form">
                         <form action="{{ route('contact.send') }}" id="contact-form" method="POST">
                                @csrf
                             <div class="row">
                                 <div class="col-xxl-6 col-xl-6 col-lg-6 mb-20">
                                     <input name="name" type="text" placeholder="{{ __('landing.contact.your_name') }}" required>
                                 </div>
                                 <div class="col-xxl-6 col-xl-6 col-lg-6 mb-20">
                                     <input name="email" type="email" placeholder="{{ __('landing.contact.email_address') }}" required>
                                 </div>
                                 <div class="col-xxl-6 col-xl-6 col-lg-6 mb-20">
                                     <input name="phone" type="text" placeholder="{{ __('landing.contact.phone_number') }}" required>
                                 </div>
                                 <div class="col-xxl-6 col-xl-6 col-lg-6 mb-20">
                                     <input name="subject" type="text" placeholder="{{ __('landing.contact.subject') }}" required>
                                 </div>
                                 <div class="col-xxl-12 col-xl-12 col-lg-12 mb-20">
                                     <textarea placeholder="{{ __('landing.contact.write_message') }}" name="message" required></textarea>
                                 </div>
                                 <div class="ajax-response mb-2"></div>
                                 <div class="col-xxl-12 col-xl-12 mb-20">
                                     <button type="submit" class="tp-btn">{{ __('landing.contact.send_email') }}</button>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
         </section>
         <!-- contact area end -->

         <!-- contact map area  -->
         <div class="contact-map">
            <div id="contact-map">
                <iframe
                    width="600"
                    height="450"
                    style="border:0"
                    loading="lazy"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    src="{{ $embed_google_url??'https://www.google.com/maps/embed/v1/place?q=spain&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8' }}">
                </iframe>

            </div>
         </div>
         <!-- contact map area end  -->
    <!-- contact area end -->

@endsection
