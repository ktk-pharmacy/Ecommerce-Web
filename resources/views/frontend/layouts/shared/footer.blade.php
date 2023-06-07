<footer class="ltn__footer-area  " id="main_footer">
   <div class="footer-top-area  section-bg-2 plr--5">
      <div class="container-fluid">
         <div class="row">
            <div class="col-xl-3 col-md-6 col-sm-6 col-12">
               <div class="footer-widget footer-about-widget">
                  <div class="footer-logo">
                     <div class="site-logo">
                        <img width=100 height=100 src="{{asset('assets/theme/img/sayaid2.png')}}" alt="Logo">
                     </div>
                  </div>
                  <p>SayAid, founded since 2018 and now 4 years ago, is a retail pharmacy company and we sold the products with reasonable price range. Now we planned to move forward as new step by the name SayAid for e-business in the future. We will sell our product with fair and reasonable price depends on market demand. We aim that people can easily buy medicine, pharmacy and consumer products from this web and app..</p>
                  <div class="footer-address">
                     <ul>
                        <li>
                           <div class="footer-address-icon">
                              <i class="icon-placeholder"></i>
                           </div>
                           <div class="footer-address-info">
                              <p>{{ config('settings.default_address') }}</p>
                           </div>
                        </li>
                        <li>
                           <div class="footer-address-icon">
                              <i class="icon-call"></i>
                           </div>
                           <div class="footer-address-info">
                              <p>
                                 <a href="tel:{{ config('settings.default_phone_number') }}">
                                    {{ config('settings.default_phone_number') }}
                                 </a>
                              </p>
                           </div>
                        </li>
                        <li>
                           <div class="footer-address-icon">
                              <i class="icon-mail"></i>
                           </div>
                           <div class="footer-address-info">
                              <p>
                                 <a href="mailto:example@example.com">
                                    {{ config('settings.default_email') }}
                                 </a>
                              </p>
                           </div>
                        </li>
                     </ul>
                  </div>
                  <div class="ltn__social-media mt-20">
                     <ul>
                        <li>
                           <a href="{{ config('settings.social_facebook') }}" title="Facebook">
                              <i class="fab fa-facebook-f"></i>
                           </a>
                        </li>
                        <li>
                           <a href="{{ config('settings.social_twitter') }}" title="Twitter">
                              <i class="fab fa-twitter"></i>
                           </a>
                        </li>
                        <li>
                           <a href="{{ config('settings.social_linkedin') }}" title="Linkedin">
                              <i class="fab fa-linkedin"></i>
                           </a>
                        </li>
                        <li>
                           <a href="{{ config('settings.social_instagram') }}" title="Instagram">
                              <i class="fab fa-instagram"></i>
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-xl-2 col-md-6 col-sm-6 col-12">
               <div class="footer-widget footer-menu-widget clearfix">
                  <h4 class="footer-title">Company</h4>
                  <div class="footer-menu">
                     <ul>
                        <li><a href="{{ route('frontend.aboutUs') }}">About</a></li>
                        <li><a href="{{ route('frontend.blogs.index') }}">Blog</a></li>
                        <li><a href="{{ route('frontend.products.index') }}">All Products</a></li>
                        {{-- <li><a href="#">Locations Map</a></li> --}}
                        <li><a href="#">FAQ</a></li>
                        <li><a href="{{ route('frontend.info-page', 'contact') }}">Contact Us</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            {{-- <div class="col-xl-2 col-md-6 col-sm-6 col-12">
               <div class="footer-widget footer-menu-widget clearfix">
                  <h4 class="footer-title">Services</h4>
                  <div class="footer-menu">
                     <ul>
                        <li><a href="order-tracking.html">Order tracking</a></li>
                        <li><a href="{{ route('frontend.wishlist') }}">Wish List</a></li>
                        <li><a href="{{ route('frontend.login') }}">Sign In</a></li>
                        <li><a href="{{ route('frontend.myaccount', 1) }}">My account</a></li>
                        <li><a href="about.html">Terms & Conditions</a></li>
                        <li><a href="about.html">Promotional Offers</a></li>
                     </ul>
                  </div>
               </div>
            </div> --}}
            <div class="col-xl-2 col-md-6 col-sm-6 col-12">
               <div class="footer-widget footer-menu-widget clearfix">
                  <h4 class="footer-title">Customer Care</h4>
                  <div class="footer-menu">
                     <ul>
                        <li><a href="{{ route('frontend.login') }}">Login</a></li>
                        <li><a href="{{ route('frontend.myaccount') }}">My account</a></li>
                        <li><a href="{{ route('frontend.wishlist') }}">Wish List</a></li>
                        {{-- <li><a href="#">Order tracking</a></li> --}}
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Promotional Offers</a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 offset-xl-1 col-md-6 col-sm-12 col-12">
               <div class="footer-widget footer-newsletter-widget">
                  <h4 class="footer-title">Newsletter</h4>
                  <p>Subscribe to our weekly Newsletter and receive updates via email.</p>
                  <div class="footer-newsletter">
                     <form action="#">
                        <input type="email" name="email" placeholder="Email*">
                        <div class="btn-wrapper">
                           <button class="theme-btn-1 btn" type="submit"><i class="fas fa-location-arrow"></i></button>
                        </div>
                     </form>
                  </div>
                  <div class="ltn__safe-checkout">
                    <h5 class="mt-30">We Accept</h5>
                    <div class="payment-ft bg-white d-inline-block px-3">
                         <img class="mx-1" src="{{asset('assets/theme/img/icons/visa_icon.png')}}" alt="#">
                         <img class="mx-1" src="{{asset('assets/theme/img/icons/mastercard_icon.png')}}" alt="#">
                         <img class="mx-1" src="{{asset('assets/theme/img/icons/jcb_icon (1).png')}}" alt="#">
                         <img class="mx-1" src="{{asset('assets/theme/img/icons/mpu.jpg')}}" alt="#">
                    </div>
                 </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="ltn__copyright-area ltn__copyright-2 section-bg-7  plr--5">
      <div class="container-fluid ltn__border-top-2">
         <div class="row">
            <div class="col-md-6 col-12">
               <div class="ltn__copyright-design clearfix">
                  <p>All Rights Reserved @ SayAid <span class="current-year"></span></p>
               </div>
            </div>
            <div class="col-md-6 col-12 align-self-center">
               <div class="ltn__copyright-menu text-end">
                  <ul>
                     <li><a href="#">Terms & Conditions</a></li>
                     <li><a href="#">Claim</a></li>
                     <li><a href="#">Privacy & Policy</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>
