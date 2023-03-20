<div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
   <div class="ltn__utilize-menu-inner ltn__scrollbar">
      <div class="ltn__utilize-menu-head">
         <div class="site-logo">
            <a href="{{ route('frontend.home') }}"><img class="w-50" src="{{ asset('assets/theme/img/orginal2.png') }}" alt="Logo"></a>
         </div>
         <button class="ltn__utilize-close">×</button>
      </div>
      <div class="ltn__utilize-menu-search-form">
        <form id="#" method="get" action="{{ route('frontend.products.index') }}">
            <input type="text" name="search" value="" placeholder="Search here..." />
            <button type="submit">
               <span><i class="icon-search"></i></span>
            </button>
         </form>
      </div>
      <div class="ltn__utilize-menu">
         <ul>
            <li><a href="{{ route('frontend.home') }}">{{ __('header.home') }}</a>
            </li>
            <li><a href="#">{{ __('header.shop') }}</a>
               <ul class="sub-menu">
                  <li><a href="{{ route('frontend.products.index') }}">{{ __('header.all_products') }}</a></li>
               </ul>
            </li>
            <li><a href="{{ route('frontend.blogs.index') }}">{{ __('header.blogs') }}</a>
            </li>
            <li><a href="{{ route('frontend.info-page', 'contact') }}">{{ __('header.contact_us') }}</a>
            </li>
            <li><a href="{{ route('frontend.info-page', 'bonous') }}">{{ __('header.bonous') }}</a></li>
         </ul>
      </div>
      <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
         <ul>
            <li>
               <a href="{{ route('frontend.myaccount') }}" title="My Account">
                  <span class="utilize-btn-icon">
                     <i class="far fa-user"></i>
                  </span>
                  My Account
               </a>
            </li>
            <li>
               <a href="{{ route('frontend.wishlist') }}" title="Wishlist">
                  <span class="utilize-btn-icon">
                     <i class="far fa-heart"></i>
                  </span>
                  Wishlist
               </a>
            </li>
            <li>
               <a href="{{ route('frontend.cart') }}" title="Shoping Cart">
                  <span class="utilize-btn-icon">
                     <i class="fas fa-shopping-cart"></i>
                     <sup>{{  $cart_detail['total_quantity']?? 0 }}</sup>
                  </span>
                  Shoping Cart
               </a>
            </li>
         </ul>
      </div>
      <div class="ltn__social-media-2">
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
