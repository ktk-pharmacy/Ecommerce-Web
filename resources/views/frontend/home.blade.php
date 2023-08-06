@extends('frontend.layouts.master', ['title' => 'Home'])
@section('css')
    <link rel="stylesheet" href="asset('assets/theme/css/homepage-slider.css')">
@endsection
@section('main-content')
<style>
    .text-blue {
        color: #27AAE1 !important;
    }
    h4.card-title a:hover {
        color: #710ac2 !important;
    }
    .main-slider {
        height: 60vh;
    }

    .font-san {
        font-family: sans-serif;
    }
    div.container {
        padding-left: 0;
        padding-right: 0;
    }

    /* (A) RESPONSIVE IMAGE */
.fullwrap img { width: 100%; }
.fullwrap {
  max-width: 500px; /* optional */
  position: relative; /* required for (b1) */
}

/* (B) POSITION CAPTION */
.fullcap {
  /* (B1) COVER OVER ENTIRE IMAGE */
  position: absolute; top: 0; left: 0;
  padding-bottom: 6px;
  width: 100%; height: 100%;
  background-color: rgba(0, 0, 0, 0.5);

  /* (B2) CENTER CONTENT */
  display: flex; justify-content: center; align-items: end;
}

/* (C) ONLY SHOW CAPTION ON HOVER */
.fullcap {
  visibility: none; opacity: 0;
  transition: opacity 0.3s;
}
.fullwrap:hover .fullcap {
  visibility: visible; opacity: 1;
}

.fullcap div {
    width: 50px;
    height: 50px;
    background: #fff;
    transition: 0.2s
}

.fullcap div:hover {
    background: var(--ltn__secondary-color);
    color: #fff
}

.fullcap div a:hover {
    color: #fff;
}

h3 {
    text-align: left !important;
    font-size: 16px !important;
    font-family: Arial, Helvetica, sans-serif;
    text-transform: uppercase;
    margin:0;
}

.mb-2cm {
    margin-bottom: 75.6px;
}
.mb-1cm {
    margin-bottom: 37.8px;
}

.mb-0-8cm {
    margin-bottom: 26.5px;
}

.mt-1cm {
    margin-top: 37.8px;
}

</style>
    <!-- SLIDER AREA START (slider-3) -->
    <div class="main-slider mb-1cm">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-md-12 mx-auto px-5 h-100">
                    <div id="carouselExampleIndicators" class="carousel slide h-100" data-bs-ride="carousel">
                        <div class="carousel-inner h-100">
                        @foreach ($sliders as $key => $slider)
                          <div class="carousel-item h-100 {{ $key == 0 ? ' active' : '' }} ltn__slide-item ltn__slide-item-10 section-bg-1  bg-image" data-bs-interval="3500" data-bs-bg="{{ $slider->image_url }}">
                          </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SLIDER AREA END -->

    <!-- BANNER AREA START -->
    <div class="mb-0-8cm">
        <div class="container px-3">
            <div
             class="row px-4">
                @foreach ($banners1 as $banner1)
                    <div
                    style="
                    height:350px
                    "
                     class="col-lg-4 col-sm-6 px-2">
                        <div class="ltn__banner-item w-100 h-100">
                            <div class="ltn__banner-img w-100 h-100">
                                <a href="{{ $banner1->link }}">
                                    <img class=" w-100 h-100" src="{{ $banner1->image_url }}" alt="Banner1 Image">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- BANNER AREA END -->
    <div class="container no-product-ratting">
        <div class="px-4">
            <div class="row mb-0-8cm">
                <div class="col-lg-12">
                    <div class="text-center px-2">
                        <h3 class="section-title font-san">Categories</h3>
                    </div>
                </div>
            </div>
            <div class="row mb-0-8cm">
                <div class="col-lg-12">
                    @php
                         $category_groups = getMenuCategories();
                    @endphp
                    <div class="px-3">
                        <div class="row ">
                            @foreach ($category_groups as $index => $group)
                                <!-- ltn__product-item -->
                                @if ($index != 6)
                                <div class="col-md-2 px-2">
                                    <div class="card " style="">
                                        <div class="fullwrap">
                                            <img src="{{ $group->image_url }}" class="card-img-top" alt="...">
                                        </div>
                                        <div class="card-body d-flex justify-content-center align-items-center">

                                          <a href="{{ route('frontend.products.index') }}?group={{ $group->id }}">
                                            <h6 style="line-height: 15px" class="d-block font-san mb-1">
                                                {{ $group->name}}
                                              </h6>
                                          </a>
                                        </div>
                                    </div>
                                </div>
                                @endif

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PRODUCT AREA START (product-item-3) -->
    @if (count($feature_products)>0)
        <div class="container no-product-ratting">
        <div class="px-4">
            <div class="row mb-0-8cm">
                <div class="col-lg-12">
                    <div class="text-center px-2">
                        <h3 class="section-title font-san">Promotion Items</h3>
                    </div>
                </div>
            </div>
            <div class="px-3 mb-0-8cm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row ">
                            @foreach ($feature_products as $feature_product)
                                <!-- ltn__product-item -->
                                <div class="col-md-2 px-2">
                                    <div class="card " style="
                                    height:275px
                                    ">
                                        <div class="px-4 fullwrap">
                                            <img src="{{ $feature_product->feature_image }}" class="card-img-top" alt="...">
                                            <div class="fullcap">

                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ route('frontend.products.detail', $feature_product->slug) }}">
                                                            <i class="far fa-eye"></i>
                                                        </a>

                                                    </div>
                                                    <div class="{{ $feature_product->stock == 0 ? 'd-none' : '' }} d-flex justify-content-center align-items-center">
                                                        <a href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}"
                                                            title="Add to Cart"
                                                            onclick="{{ customerAuth() ? 'addToCart(this)' : '' }}"
                                                            data-add-to-cart-url="{{ route('frontend.products.add-to-cart', $feature_product->id) }}">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </a>
                                                    </div>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}"
                                                            title="Wishlist"
                                                            onclick="{{ customerAuth() ? 'addToWishlist(this)' : '' }}"
                                                            data-add-to-wishlist-url="{{ route('frontend.products.add-to-wishlist', $feature_product->id) }}"
                                                            data-bs-target="#liton_wishlist_modal">
                                                            <i class="far fa-heart"></i></a>
                                                    </div>

                                            </div>
                                            {{-- <div class="">
                                                <a
                                                    href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}" title="Add to Cart"
                                                    onclick="{{ customerAuth() ? 'addToCart(this)' : '' }}"
                                                    data-add-to-cart-url="{{ route('frontend.products.add-to-cart', $feature_product->id) }}" class="me-2">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </a>

                                                <a href="" title="{{ $feature_product->name }}">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </div> --}}
                                        </div>
                                        <div class="card-body px-2">
                                          <a href="{{ route('frontend.products.detail', $feature_product->slug) }}">
                                            <small style="line-height: 15px" class="d-block font-san mb-1">
                                                {{ $feature_product->name }}
                                              </small>
                                          </a>
                                            <div class="product-price font-san">
                                                <span class="{{ isset($feature_product->discount)?'':'text-blue' }}">MMK{{ $feature_product->discount ?? $feature_product->sale_price }}</span>
                                                @if ($feature_product->discount)
                                                    <del class="text-blue">{{ $feature_product->sale_price }}</del>
                                                @endif
                                            </div>
                                          {{-- <a
                                                    href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}" title="Add to Cart"
                                                    onclick="{{ customerAuth() ? 'addToCart(this)' : '' }}"
                                                    data-add-to-cart-url="{{ route('frontend.products.add-to-cart', $feature_product->id) }}" style="background-color: var(--ltn__secondary-color)" class="btn mt-auto text-white px-1 py-1 me-1 mb-2 rounded-2">
                                                    <i class="fas fa-shopping-cart"></i>
                                            </a> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    </div>
    <!-- PRODUCT AREA END -->

    <!-- PRODUCT AREA START (product-item-3) -->
    <div class="container no-product-ratting">
        <div class="px-4">
            <div class="row mb-0-8cm">
                <div class="col-lg-12">
                    <div class="text-center px-2">
                        <h3 class="section-title font-san">New Arrival Items</h3>
                    </div>
                </div>
            </div>
            <div class="px-3 mb-0-8cm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row ">

                            @foreach ($new_products as $feature_product)
                                <!-- ltn__product-item -->
                                <div class="col-md-2 px-2">
                                    <div class="card " style="
                                    height:275px
                                    ">
                                        <div class="px-4 fullwrap">
                                            <img src="{{ $feature_product->feature_image }}" class="card-img-top" alt="...">
                                            @if ($feature_product->is_new)
                                            <small class=" d-inline-block product-badge">
                                                <ul>
                                                    <li class="sale-badge">New</li>
                                                </ul>
                                            </small>
                                            @endif
                                            <div class="fullcap">

                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ route('frontend.products.detail', $feature_product->slug) }}">
                                                            <i class="far fa-eye"></i>
                                                        </a>

                                                    </div>
                                                    <div class="{{ $feature_product->stock == 0 ? 'd-none' : '' }} d-flex justify-content-center align-items-center">
                                                        <a href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}"
                                                            title="Add to Cart"
                                                            onclick="{{ customerAuth() ? 'addToCart(this)' : '' }}"
                                                            data-add-to-cart-url="{{ route('frontend.products.add-to-cart', $feature_product->id) }}">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </a>
                                                    </div>
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <a href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}"
                                                            title="Wishlist"
                                                            onclick="{{ customerAuth() ? 'addToWishlist(this)' : '' }}"
                                                            data-add-to-wishlist-url="{{ route('frontend.products.add-to-wishlist', $feature_product->id) }}"
                                                            data-bs-target="#liton_wishlist_modal">
                                                            <i class="far fa-heart"></i></a>
                                                    </div>

                                            </div>

                                        </div>
                                        <div class="card-body px-2">
                                          <a href="{{ route('frontend.products.detail', $feature_product->slug) }}">
                                            <small style="line-height: 15px" class="d-block font-san mb-1">
                                                {{ $feature_product->name }}
                                              </small>
                                          </a>
                                            <div class="product-price font-san">
                                                <span class="{{ isset($feature_product->discount)?'':'text-blue' }}">MMK{{ $feature_product->discount ?? $feature_product->sale_price }}</span>
                                                @if ($feature_product->discount)
                                                    <del class="text-blue">{{ $feature_product->sale_price }}</del>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- PRODUCT AREA END -->
    <div class="container no-product-ratting mb-0-8cm">
        <div class="px-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center px-2">
                        <h3 class="section-title font-san ">Best Selling Items</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="Container container mb-1cm">
        <div class="SlickCarousel px-4">
            @foreach ($left_sidebars as $left_sidebar)
            <div class="ProductBlock mx-2">
                <div class="Content">
                  <div class="img-fill">
                    <a href="{{ $left_sidebar->link }}">
                        <img src="{{ $left_sidebar->image_url }}">
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
        </div>
        <!-- Carousel Container -->
    </div>

    <div class="Container container mb-1cm">
        {{-- <h3 class="Head">Featured Products <span class="Arrows"></span></h3> --}}
        <!-- Carousel Container -->
        <div class="SlickCarousel px-4">
          <!-- Item -->
           @foreach ($secondSliders as $secondSlider)
            <div class="ProductBlock mx-2">
                <div class="Content">
                  <div class="img-fill">
                    <a href="{{ $secondSlider->link }}">
                        <img src="{{ $secondSlider->image_url }}">
                    </a>
                  </div>
                </div>
            </div>
            @endforeach
          <!-- Item -->
        </div>
        <!-- Carousel Container -->
    </div>

    <!-- BANNER AREA START -->
    <div class="ltn__banner-area">
        <div class="container px-2">
            <div class="container no-product-ratting mb-0-8cm">
                <div class="px-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h3 class="section-title font-san">SayAid's Collection</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Container container mb-0-8cm">
                {{-- <h3 class="Head">Featured Products <span class="Arrows"></span></h3> --}}
                <!-- Carousel Container -->
                <div class="SlickCarousel px-3">
                    @foreach ($banners2 as $left_sidebar)
                    <div class="ProductBlock mx-2">
                        <div class="Content">
                          <div class="img-fill">
                            <a href="{{ $left_sidebar->link }}">
                                <img src="{{ $left_sidebar->image_url }}">
                            </a>
                          </div>
                        </div>
                      </div>
                    @endforeach
                </div>
                <!-- Carousel Container -->
            </div>

        </div>
    </div>
    <!-- BANNER AREA END -->

    <div class="container no-product-ratting mb-0-8cm">
        <div class="px-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center px-2">
                        <h3 class="section-title font-san">Product Brands</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="Container container mb-2">
        <div class="SlickCarousel2 px-4">
            @foreach (App\Model\Brand::all() as $brand)
            <div class="ProductBlock mx-2">
                <div class="Content">
                  <div class="img-fill">
                    <a
                    href="{{ route('frontend.products.index') }}?brand={{ $brand->id }}"
                    >
                        <img
                        src="{{ $brand->image_url }}"
                        >
                    </a>
                  </div>
                </div>
              </div>
            @endforeach
        </div>
        <!-- Carousel Container -->
    </div>
    <div class="container no-product-ratting mb-0-8cm">
        <div class="px-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-end ">
                        {{-- <h3 class="section-title font-san">Product Brands</h3> --}}
                        <h4 class="font-san text-decoration-underline"><a href="{{ route('frontend.products.index') }}?brand=all">More Brands</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            setTimeout(() => {
                $.ajax({
                    type: "get",
                    url: "/forget-session",
                });
            },100);
        });

        $(document).ready(function(){
            $(".SlickCarousel").slick({
                rtl:false, // If RTL Make it true & .slick-slide{float:right;}
                autoplay:true,
                autoplaySpeed:5000, //  Slide Delay
                speed:800, // Transition Speed
                slidesToShow:4, // Number Of Carousel
                slidesToScroll:1, // Slide To Move
                pauseOnHover:false,
                appendArrows:$(".Container .Head .Arrows"), // Class For Arrows Buttons
                prevArrow:'<span class="Slick-Prev"></span>',
                nextArrow:'<span class="Slick-Next"></span>',
                easing:"linear",
                responsive:[
                {breakpoint:990,settings:{
                    slidesToShow:3,
                }},
                {breakpoint:801,settings:{
                    slidesToShow:2,
                }},
                {breakpoint:641,settings:{
                    slidesToShow:1,
                }},
                ],
            })
        })

        $(document).ready(function(){
            $(".SlickCarousel2").slick({
                rtl:false, // If RTL Make it true & .slick-slide{float:right;}
                autoplay:true,
                autoplaySpeed:5000, //  Slide Delay
                speed:800, // Transition Speed
                slidesToShow:6, // Number Of Carousel
                slidesToScroll:1, // Slide To Move
                pauseOnHover:false,
                appendArrows:$(".Container .Head .Arrows"), // Class For Arrows Buttons
                prevArrow:'<span class="Slick-Prev"></span>',
                nextArrow:'<span class="Slick-Next"></span>',
                easing:"linear",
                responsive:[
                {breakpoint:990,settings:{
                    slidesToShow:3,
                }},
                {breakpoint:801,settings:{
                    slidesToShow:2,
                }},
                {breakpoint:641,settings:{
                    slidesToShow:1,
                }},
                ],
            })
        })
    </script>
@endsection
