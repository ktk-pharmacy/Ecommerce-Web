<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image {{ Request::segment(1) == 'home' ? 'd-none' : '' }}" data-bs-bg="{{ asset(config('settings.frontend_banner')??'assets/theme/img/bg/bgNew.png') }}" id="main_breadcrumb">
    <div class="container">
       <div class="row">
          <div class="col-lg-12">
             <div class="ltn__breadcrumb-inner">
                <b>
                    <h1 style="color: #000" class="page-title ">@if (Request::segment(1) == 'products')
                        Product Lists
                    @elseif (Request::segment(1) == 'products' && Request::segment(3) == 'detail')
                        Product Details
                    @elseif (Request::segment(1) == 'blogs')
                        Blogs
                    @elseif (Request::segment(2) == 'contact')
                        Contact Us
                    @elseif (Request::segment(1) == 'cart')
                        Cart
                    @elseif (Request::segment(1) == 'wishlist')
                        Wishlist
                    @elseif (Request::segment(1) == 'myaccount')
                        My Account
                    @elseif (in_array(Request::segment(1),['login','register','request-otp','verify-otp']) )
                        Account
                    @elseif (Request::segment(1) == 'checkout')
                        Checkout
                    @elseif (Request::segment(2) == 'bonous')
                        What We Do
                    @elseif (Request::segment(2) == 'about-us')
                        About Us
                    @endif</h1>
                </b>
                <div class="ltn__breadcrumb-list">
                   <ul>
                      <li><a href="{{ route('frontend.home') }}"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                      <li style="color: #000">@if (Request::segment(1) == 'products' && Request::segment(2) == '')
                        Product Lists
                    @elseif (Request::segment(1) == 'products' && Request::segment(3) == 'detail')
                        Product Details
                    @elseif (Request::segment(1) == 'blogs' && Request::segment(2) == '')
                        Blogs
                    @elseif (Request::segment(1) == 'blogs' && Request::segment(2) <> '')
                        Blog Details
                    @elseif (Request::segment(2) == 'contact')
                        Contact
                    @elseif (Request::segment(1) == 'cart')
                        Cart
                    @elseif (Request::segment(1) == 'wishlist')
                        Wishlist
                    @elseif (Request::segment(1) == 'myaccount')
                        My Account
                    @elseif (Request::segment(1) == 'login')
                        Login
                    @elseif (Request::segment(1) == 'register')
                        Register
                    @elseif (Request::segment(1) == 'request-otp')
                        Request-OTP
                    @elseif (Request::segment(1) == 'verify-otp')
                        Verify-OTP
                    @elseif (Request::segment(1) == 'checkout')
                        Checkout
                    @elseif (Request::segment(2) == 'bonous')
                        Service
                    @elseif (Request::segment(2) == 'about-us')
                        About Us
                    @endif</li>
                   </ul>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>

