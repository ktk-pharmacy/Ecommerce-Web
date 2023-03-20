@extends('frontend.layouts.master', ['title' => 'Contact Us'])

@section('main-content')

   <!-- CONTACT ADDRESS AREA START -->
   <div class="ltn__contact-address-area mb-90">
      <div class="container">
         <div class="row">
            <div class="col-lg-4">
               <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                  <div class="ltn__contact-address-icon">
                     <img src="{{ asset('assets/theme/img/icons/10.png') }}" alt="Icon Image">
                  </div>
                  <h3>Email Address</h3>
                  <p>{{ config('settings.default_email') }}</p>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                  <div class="ltn__contact-address-icon">
                     <img src="{{ asset('assets/theme/img/icons/11.png') }}" alt="Icon Image">
                  </div>
                  <h3>Phone Number</h3>
                  <p>{{ config('settings.default_phone_number') }}</p>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="ltn__contact-address-item ltn__contact-address-item-3 box-shadow">
                  <div class="ltn__contact-address-icon">
                     <img src="{{ asset('assets/theme/img/icons/12.png') }}" alt="Icon Image">
                  </div>
                  <h3>Office Address</h3>
                  <p>{{ config('settings.default_address') }}</p>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- CONTACT ADDRESS AREA END -->

   <!-- CONTACT MESSAGE AREA START -->
   <div class="ltn__contact-message-area mb-120 mb--100">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <div class="ltn__form-box contact-form-box box-shadow white-bg">
                  <h4 class="title-2">Get A Quote</h4>
                  <form id="contact-form" action="{{ route('frontend.contact-form') }}" method="post">
                     @csrf
                     <div class="row">
                        <div class="col-md-6">
                           <div class="input-item input-item-name ltn__custom-icon">
                              <input type="text" name="name" placeholder="Enter your name">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="input-item input-item-email ltn__custom-icon">
                              <input type="email" name="email" placeholder="Enter email address">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="input-item input-item-subject ltn__custom-icon">
                              <input type="text" name="subject" placeholder="Enter the subject">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="input-item input-item-phone ltn__custom-icon">
                              <input type="text" name="phone" placeholder="Enter phone number">
                           </div>
                        </div>
                     </div>
                     <div class="input-item input-item-textarea ltn__custom-icon">
                        <textarea name="message" placeholder="Enter message"></textarea>
                     </div>
                     <div class="btn-wrapper mt-0">
                        <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">get a free service</button>
                     </div>
                     <p class="form-messege mb-0 mt-20"></p>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- CONTACT MESSAGE AREA END -->

   <!-- GOOGLE MAP AREA START -->
   <div class="google-map">

    {!! config('settings.default_location') !!}

 </div>
 <!-- GOOGLE MAP AREA END -->
@endsection
