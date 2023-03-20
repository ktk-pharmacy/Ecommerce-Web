<!doctype html>
<html class="no-js" lang="zxx">

<head>
   @include('frontend.layouts.shared.title-meta')

   @include('frontend.layouts.shared.head-css')
</head>

<body>
   <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

   <!-- Add your site or application content here -->

   <!-- Body main wrapper start -->
   <div class="body-wrapper">

      @php
         $cart_detail = getCartDetails();
      @endphp
      <!-- HEADER AREA START (header-3) -->
      @include('frontend.layouts.shared.header')
      <!-- HEADER AREA END -->

      <!-- Utilize Cart Menu Start -->
      @include('frontend.layouts.shared.cart-menu')
      <!-- Utilize Cart Menu End -->

      <!-- Utilize Mobile Menu Start -->
      @include('frontend.layouts.shared.mobile-menu')
      <!-- Utilize Mobile Menu End -->

      <div class="ltn__utilize-overlay"></div>

      <!-- BREADCRUMB AREA START -->
      @include('frontend.layouts.shared.breadcrumb-area')
      <!-- BREADCRUMB AREA END -->

      <!-- Main Content -->
      @yield('main-content')

      <!-- CALL TO ACTION START (call-to-action-6) -->
      @include('frontend.layouts.shared.call-to-action')
      <!-- CALL TO ACTION END -->

     <!-- MODAL AREA START -->
      @include('frontend.layouts.modals.master-modals')
      <!-- MODAL AREA END -->

   </div>
   <!-- Body main wrapper end -->

   <!-- preloader area start -->
   <div class="preloader d-none" id="preloader">
      <div class="preloader-inner">
         <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
         </div>
      </div>
   </div>
   <input type="hidden" id="get-cart-items-url" value="{{ route('frontend.get-cart-items') }}">
   <!-- preloader area end -->

   @include('frontend.layouts.shared.footer-script')
</body>
    @yield('script')
</html>
