<header id="main_header" class="ltn__header-area ltn__header-3 section-bg-6---">
    <!-- ltn__header-top-area start -->
    <div class="ltn__header-top-area border-bottom top-area-color-white---">
       <div class="container">
          <div class="row">
             <div class="col-md-8">
                <div class="ltn__top-bar-menu">
                   <marquee>
                      <b>{{ config('settings.header_text') }}</b>
                   </marquee>
                   {{-- <ul>
                      <li><a href="mailto:info@webmail.com?Subject=Flower%20greetings%20to%20you"><i class="icon-mail"></i>
                            myanmsan.buh@gmail.com</a></li>
                      <li><a href="{{ route('frontend.info-page', 'contact') }}"><i class="icon-placeholder"></i> 30 Street between 56 and 57, Chan Aye Thar Zan,
                      Mandalay</a></li>
                   </ul> --}}
                </div>

             </div>
             <div class="col-md-4">
                <div class="top-bar-right text-end">
                   <div class="ltn__top-bar-menu">
                      <ul>
                         <li>
                            @php
                                $current_lang = session()->get('locale');
                            @endphp
                            <!-- ltn__language-menu -->
                            <div class="ltn__drop-menu ltn__currency-menu ltn__language-menu">
                               <ul>
                                  <li>
                                     <a
                                        href="javascript:void(0);"
                                        class="dropdown-toggle"

                                     >
                                        <span class="active-currency">
                                           {{ $current_lang == 'en' ? "English" : "Myanmar" }}
                                        </span>
                                     </a>
                                     <ul>
                                        <li>
                                                         <a
                                                             href="javascript:void(0);"
                                                             class="change-language"
                                                             data-url="{{ route('frontend.change-language', 'en') }}"
                                                         >
                                                             English
                                                         </a>
                                                     </li>
                                        <li>
                                                         <a
                                                             href="javascript:void(0);"
                                                             class="change-language"
                                                             data-url="{{ route('frontend.change-language', 'mm') }}"
                                                         >
                                                             မြန်မာ
                                                         </a>
                                                     </li>
                                     </ul>
                                  </li>
                               </ul>
                            </div>
                         </li>
                         <li>
                            <!-- ltn__social-media -->
                            <div class="ltn__social-media">
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
                         </li>
                      </ul>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    <!-- ltn__header-top-area end -->
    <!-- ltn__header-middle-area start -->
    <div class="ltn__header-middle-area">
       <div class="container px-5">
          <div class="row">
             <div class="col">
                <div class="site-logo">
                   <!-- <a href="{{route('frontend.home')}}"><img src="https://dummyimage.com/159x38/ffffff/000000.png&text=SayAid" alt="Logo"></a> -->
                   <a href="{{route('frontend.home')}}"><img width="100" height="100" src="{{asset('assets/theme/img/sayaid2.png')}}" alt="Logo"></a>
                </div>
             </div>
             <div class="col header-contact-serarch-column d-none d-xl-block">
                <div class="header-contact-search">
                   <!-- header-feature-item -->
                   <div class="header-feature-item d-none">
                      <div class="header-feature-icon">
                         <i class="icon-phone"></i>
                      </div>
                      <div class="header-feature-info">
                         <h6>Phone</h6>
                         <p>
                            <a href="tel:{{ config('settings.default_phone_number') }}">
                                @if (session()->get('locale') == 'mm')
                                    {{ config('settings.default_phone_number_mm') }}
                                @else
                                    {{ config('settings.default_phone_number') }}
                                @endif

                            </a>
                         </p>
                      </div>
                   </div>
                   <!-- header-search-2 -->
                   <div class="header-search-2">
                      <form method="get" action="{{ route('frontend.products.index') }}">
                         <input type="text" name="search" value="" placeholder="{{ __('header.search_here') }}" />
                         <button type="submit">
                            <span><i class="icon-search"></i></span>
                         </button>
                      </form>
                   </div>
                </div>
             </div>
             <div class="col">
                <!-- header-options -->
                <div class="ltn__header-options">
                   <ul>
                      <li class="d-none">
                         <!-- ltn__currency-menu -->
                         <div class="ltn__drop-menu ltn__currency-menu">
                            <ul>
                               <li><a href="#" class="dropdown-toggle"><span class="active-currency">MMK</span></a>
                                  <ul>
                                  <li><a href="wishlist.html">MMK - Myanmar Kyat</a></li>
                                  <li><a href="login.html">USD - US Dollar</a></li>
                                  </ul>
                               </li>
                            </ul>
                         </div>
                      </li>
                      <li class="d-none--- ">
                         <!-- header-search-1 -->
                         <div class="header-search-wrap d-block d-xl-none">
                            <div class="header-search-1">
                               <div class="search-icon">
                                  <i class="icon-search  for-search-show"></i>
                                  <i class="icon-cancel  for-search-close"></i>
                               </div>
                            </div>
                            <div class="header-search-1-form">
                               <form id="#" method="get" action="{{ route('frontend.products.index') }}">
                                  <input type="text" name="search" value="" placeholder="Search here..." />
                                  <button type="submit">
                                     <span><i class="icon-search"></i></span>
                                  </button>
                               </form>
                            </div>
                         </div>
                      </li>
                      <li class="d-none---">
                         <!-- user-menu -->
                         <div class="ltn__drop-menu user-menu">
                            <ul>
                               <li>
                                  <a href="#"><i class="icon-user"></i></a>
                                  <ul>
                                     @if (customerAuth())
                                        <li><a href="{{ route('frontend.myaccount') }}">My Account</a></li>
                                        <li><a href="{{ route('frontend.wishlist') }}">Wishlist</a></li>
                                        <li><a href="{{ route('frontend.logout') }}">Logout</a></li>
                                     @else
                                        <li><a href="{{ route('frontend.login') }}">Sign in</a></li>
                                        <li><a href="{{ route('frontend.requestOtpForm') }}">Register</a></li>
                                     @endif
                                  </ul>
                               </li>
                            </ul>
                         </div>
                      </li>
                      <li>
                         <!-- mini-cart 2 -->
                         @if (customerAuth())
                             <div class="mini-cart-icon mini-cart-icon-2">
                               <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">
                                  <span class="mini-cart-icon" id="cart-count-icon">
                                     <i class="icon-shopping-cart"></i>
                                     <sup id="cart-count">{{ $cart_detail['total_quantity'] }}</sup>
                                  </span>
                                  <h6>
                                     <span>Your Cart</span>
                                     <span class="ltn__secondary-color cart-subtotal">{{ $cart_detail['subtotal'] }}</span>
                                  </h6>
                               </a>
                            </div>
                         @endif
                      </li>
                   </ul>
                </div>
             </div>
          </div>
       </div>
    </div>
    <!-- ltn__header-middle-area end -->

    <!-- MOBILE MENU START -->
    <div class="mobile-header-menu-fullwidth mb-20 d-block d-lg-none">
       <div class="container">
          <div class="row">
             <div class="col-lg-12">
                <!-- Mobile Menu Button -->
                <div class="mobile-menu-toggle d-lg-none">
                   <span>MENU</span>
                   <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                      <svg viewBox="0 0 800 600">
                         <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top">
                         </path>
                         <path d="M300,320 L540,320" id="middle"></path>
                         <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom"
                            transform="translate(480, 320) scale(1, -1) translate(-480, -318) ">
                         </path>
                      </svg>
                   </a>
                </div>
             </div>
          </div>
       </div>
    </div>
    <!-- MOBILE MENU END -->

    <!-- header-bottom-area start -->
    <div
       class="header-bottom-area ltn__border-top--- ltn__header-sticky  ltn__sticky-bg-white ltn__primary-bg---- menu-color-white---- d-none--- d-lg-block">
       <div class="container px-4">
          <div class="row px-2">
             <div class="col-lg-3 align-self-center">
                <!-- CATEGORY-MENU-LIST START -->
                <div class="ltn__category-menu-wrap ltn__category-dropdown-hide ltn__category-menu-with-header-menu">
                   <div class="ltn__category-menu-title">
                      <h2 class="section-bg-1--- ltn__secondary-bg text-color-white">
                                 {{ __('header.categories') }}
                             </h2>
                   </div>
                   <div class="ltn__category-menu-toggle ltn__one-line-active">
                      @php
                         $category_groups = getMenuCategories();

                      @endphp
                      <ul>
                         @foreach ($category_groups as $index => $category_group)
                            @if ($index > 7)
                               @php
                                  $menu_class = "ltn__category-menu-more-item-child";
                               @endphp
                            @else
                               @php
                                  $menu_class = "ltn__category-menu-item ltn__category-menu-drop";
                               @endphp
                            @endif
                            @php
                               $column_count = count($category_group->mainCategories);
                               if (count($category_group->mainCategories) > 7) {
                                  $column_count = 7;
                               }
                            @endphp
                            <!-- Submenu Column - unlimited <i class="icon-tag"></i>-->
                            {{-- <li class="{{ $menu_class }} d-lg-none">
                               <a href="javascript:void();">@if ($category_group->image_url !== Null)
                                <img class="category-img" src="{{asset($category_group->image_url)}}" alt="">
                            @endif {{ $category_group->name }} </a>
                               <ul class="ltn__category-submenu ltn__category-column-no-{{ $column_count }}">
                                  @foreach ($category_group->mainCategories as $main_category)
                                      <li class="ltn__category-submenu-title ltn__category-menu-drop">
                                        <a href="javascript:void();">
                                           {{ $main_category->name }}
                                        </a>
                                        <ul class="ltn__category-submenu-children">
                                           @foreach ($main_category->childCategories as $sub_category)
                                               <li>
                                                 <a href="{{ route('frontend.products.index').'?category='.$sub_category->id }}">
                                                    {{ $sub_category->name }}
                                                 </a>
                                              </li>
                                           @endforeach
                                        </ul>
                                     </li>
                                  @endforeach
                               </ul>
                            </li> --}}

                            <li class="{{ $menu_class }} ">
                                <a href="javascript:void();">
                                    @if ($category_group->image_url !== Null)
                                        <img class="category-img" src="{{asset($category_group->image_url)}}" alt="">
                                    @endif
                                    {{ $category_group->name }} </a>
                                <ul class="ltn__category-submenu ltn__category-column-no-{{ $column_count }} d-lg-flex flex-lg-wrap {{ $column_count==1?'w-500':'' }}">
                                   @foreach ($category_group->mainCategories as $main_category)
                                       <li class=" ltn__category-submenu-title ltn__category-menu-drop overflow-hidden">
                                         <a href="javascript:void();">
                                            {{ $main_category->name }}
                                         </a>
                                         <ul class="ltn__category-submenu-children d-lg-flex gap-lg-1 flex-lg-wrap">
                                            @foreach ($main_category->childCategories as $sub_category)
                                                <li class="sub-category-container mx-2">
                                                  <a href="{{ route('frontend.products.index').'?category='.$sub_category->id }}">
                                                     {{ $sub_category->name }} /
                                                  </a>
                                               </li>
                                            @endforeach
                                         </ul>
                                      </li>
                                   @endforeach
                                </ul>
                            </li>

                         @endforeach
                         @if (count($category_groups) > 8)
                             <li class="ltn__category-menu-more-item-parent">
                               <a class="rx-default">
                                  More categories <span class="cat-thumb  icon-plus"></span>
                               </a>
                               <a class="rx-show">
                                  close menu <span class="cat-thumb  icon-remove"></span>
                               </a>
                            </li>
                         @endif
                         <!-- Single menu end -->
                      </ul>
                   </div>
                </div>
                <!-- END CATEGORY-MENU-LIST -->
             </div>
             <div class="col-lg-9 col-xl-7">
                <div class="col--- header-menu-column justify-content-center---">
                     <div class="header-menu header-menu-2 text-start">
                         <nav>
                             <div class="ltn__main-menu">
                                 <ul>
                                     <li class="menu-icon">
                                        <a href="{{route('frontend.home')}}">
                                                         {{ __('header.home') }}
                                                     </a>
                                     </li>
                                     <li class="menu-icon">
                                                     <a href="#">
                                                         {{ __('header.shop') }}
                                                     </a>
                                                     <ul>
                                                         <li>
                                                             <a href="{{ route('frontend.products.index') }}">
                                                                 {{ __('header.all_products') }}
                                                             </a>
                                                         </li>
                                                     </ul>
                                     </li>
                                     <li>
                                        <a href="{{ route('frontend.blogs.index') }}">
                                                         {{ __('header.blogs') }}
                                                     </a>
                                     </li>
                                     <li>
                                                     <a href="{{ route('frontend.info-page', 'contact') }}">
                                                         {{ __('header.contact_us') }}
                                                     </a>
                                                 </li>
                                     <li>
                                                     <a href="{{ route('frontend.info-page', 'bonous') }}">
                                                         {{ __('header.bonous') }}
                                                     </a>
                                                 </li>
                                     @if (customerAuth())
                                     <li class="menu-icon">
                                         <a href="{{ route('frontend.myaccount') }}">My Account</a>
                                         <ul>
                                             <li>
                                                 <a href="{{ route('frontend.cart') }}">Cart</a>
                                             </li>
                                             <li>
                                                 <a href="{{ route('frontend.wishlist') }}">Wishlist</a>
                                             </li>
                                             <li>
                                                 <a href="{{ route('frontend.myaccount', 1) }}">Account</a>
                                             </li>
                                         </ul>
                                     </li>
                                     @endif
                                 </ul>
                             </div>
                         </nav>
                     </div>
                </div>

             </div>
             <div class="col-lg-2 align-self-center d-none d-xl-block">
                <div class="header-contact-info text-end">
                   <a class="font-weight-6 ltn__primary-color" href="tel:{{ config('settings.default_phone_number') }}"><span class="ltn__secondary-color"><i
                            class="icon-call font-weight-7"></i></span>
                            @if (session()->get('locale') == 'mm')
                            {{ config('settings.default_phone_number_mm') }}
                        @else
                            {{ config('settings.default_phone_number') }}
                        @endif</a>
                </div>
             </div>
          </div>
       </div>
    </div>
    <!-- header-bottom-area end -->
 </header>

