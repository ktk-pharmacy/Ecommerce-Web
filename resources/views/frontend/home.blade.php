@extends('frontend.layouts.master', ['title' => 'Home'])
@section('main-content')
    <!-- SLIDER AREA START (slider-3) -->
    <div class="ltn__slider-area ltn__slider-3---  section-bg-1--- mt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    {{-- <div class="ltn__slide-active-2 slick-slide-arrow-1 slick-slide-dots-1 mb-30">
                        @foreach ($sliders as $slider)
                        <!-- ltn__slide-item -->
                        <div class="ltn__slide-item ltn__slide-item-10 section-bg-1 bg-image"
                            data-bs-bg="{{ $slider->image_url }}">
                            <div class="ltn__slide-item-inner">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-7 col-md-7 col-sm-7 align-self-center">
                                            <div class="slide-item-info">
                                                <div class="slide-item-info-inner ltn__slide-animation">
                                                    <h6 class="slide-sub-title ltn__secondary-color animated">
                                                        {{ $slider->slider_text1 }}
                                                    </h6>
                                                    <h1 class="slide-title  animated">
                                                        {{ $slider->slider_text2 }}
                                                    </h1>
                                                    <div class="btn-wrapper  animated">
                                                        <a href="{{ $slider->link }}" class="theme-btn-1 btn btn-effect-1">
                                                            {{ $slider->btn_txt }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-5 align-self-center">
                                            <div class="slide-item-img">
                                                <!-- <a href="shop.html"><img src="img/product/1.png" alt="Image"></a> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div> --}}

                    <div id="carouselExampleIndicators" class="carousel slide  mb-30" data-bs-ride="carousel">
                        <div class="carousel-indicators ">
                        @for($i=0;$i<count($sliders);$i++)
                          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $i }}" class="carousel-button {{ $i == 0 ? ' active' : '' }}" aria-current="{{ $i == 0 ? 'true' : '' }}" aria-label="Slide {{ $i+1 }}"></button>
                          @endfor
                        </div>
                        <div class="carousel-inner ">
                        @foreach ($sliders as $key => $slider)
                          <div class="carousel-item {{ $key == 0 ? ' active' : '' }} ltn__slide-item ltn__slide-item-10 section-bg-1  bg-image" data-bs-interval="3500" data-bs-bg="{{ $slider->image_url }}">
                            {{-- <div class="row ">
                                <div class="">
                                    <div class="slide-item-info">
                                        <div class="slide-item-info-inner ">
                                            <h6 class="slide-sub-title ltn__secondary-color animated">
                                                {{ $slider->slider_text1 }}
                                            </h6>
                                            <h1 class="slide-title  animated">
                                                {{ $slider->slider_text2 }}
                                            </h1>
                                            <div class="btn-wrapper  animated">
                                                <a href="{{ $slider->link }}" class="theme-btn-1 btn btn-effect-1">
                                                    {{ $slider->btn_txt }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <img src="{{ $slider->image_url }}" class="d-block w-100" alt="..."> --}}
                          </div>
                        @endforeach
                        </div>

                    </div>
                </div>
                <div class="col-lg-5">
                    @foreach ($slider_sidebars as $slider_sidebar)
                        <div class="ltn__banner-item">
                            <div class="ltn__banner-img">
                                <a href="{{ $slider_sidebar->link }}">
                                    <img src="{{ $slider_sidebar->image_url }}" alt="Slider Sidebar Image">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- SLIDER AREA END -->

    <!-- CATEGORY AREA START -->
    {{-- <div class="ltn__category-area section-bg-1-- pt-30 pb-50">
        <div class="container">
            <div class="row ltn__category-slider-active-six slick-arrow-1 border-bottom">
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-6 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="fas fa-notes-medical"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h6><a href="shop.html">Best Deals</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-6 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="fas fa-box-tissue"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h6><a href="shop.html">Germs Pads</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-6 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="fas fa-pump-medical"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h6><a href="shop.html">Accessories</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-6 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="fas fa-bong"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h6><a href="shop.html">Medicine Cap</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-6 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="fas fa-tooth"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h6><a href="shop.html">Dental Item</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-6 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="fas fa-microscope"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h6><a href="shop.html">Best Deals</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-6 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="fas fa-syringe"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h6><a href="shop.html">All Products</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-6 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="fas fa-stethoscope"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h6><a href="shop.html">Germs Pads</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-6 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="fas fa-hand-holding-medical"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h6><a href="shop.html">Accessories</a></h6>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="ltn__category-item ltn__category-item-6 text-center">
                        <div class="ltn__category-item-img">
                            <a href="shop.html">
                                <i class="fas fa-procedures"></i>
                            </a>
                        </div>
                        <div class="ltn__category-item-name">
                            <h6><a href="shop.html">Medicine Cap</a></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- CATEGORY AREA END -->

    <!-- BANNER AREA START -->
    <div class="ltn__banner-area mt-120---">
        <div class="container">
            <div class="row ltn__custom-gutter--- justify-content-center">
                @foreach ($banners1 as $banner1)
                    <div class="col-lg-4 col-sm-6">
                        <div class="ltn__banner-item">
                            <div class="ltn__banner-img">
                                <a href="{{ $banner1->link }}">
                                    <img src="{{ $banner1->image_url }}" alt="Banner1 Image">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- BANNER AREA END -->

    <!-- PRODUCT AREA START (product-item-3) -->
    <div class="ltn__product-area ltn__product-gutter  no-product-ratting pt-20--- pt-65  pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h1 class="section-title">Big Sales</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        @foreach ($left_sidebars as $left_sidebar)
                            <div class="col-lg-12 col-sm-6">
                                <div class="ltn__banner-item">
                                    <div class="ltn__banner-img">
                                        <a href="{{ $left_sidebar->link }}">
                                            <img src="{{ $left_sidebar->image_url }}" alt="Left Sidebar Image">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row ltn__tab-product-slider-one-active--- slick-arrow-1">
                        @foreach ($feature_products as $feature_product)
                            <!-- ltn__product-item -->
                            <div class="col-lg-3--- col-md-4 col-sm-6 col-6">
                                <div class="ltn__product-item ltn__product-item-2 text-center">

                                    <div style="overflow: visible !important;" class="product-img">
                                        <a href="{{ route('frontend.products.detail', $feature_product->slug) }}">
                                            <img src="{{ $feature_product->feature_image }}" alt="#">
                                        </a>
                                        @if ($feature_product->is_new)
                                            <div class="product-badge">
                                                <ul>
                                                    <li class="sale-badge">New</li>
                                                </ul>
                                            </div>
                                        @endif

                                    </div>
                                    <div class="product-info">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <h2 class="product-title">
                                            <a href="{{ route('frontend.products.detail', $feature_product->slug) }}">
                                                {{ $feature_product->name }}
                                                @if ($feature_product->stock == 0)
                                                    <div><small class="text-danger">{{ $feature_product->name }} is currently out of stock</small></div>
                                                @endif
                                            </a>
                                        </h2>
                                        <div class="product-price">
                                            <span>MMK{{ $feature_product->discount ?? $feature_product->sale_price }}</span>
                                            @if ($feature_product->discount)
                                                <del>{{ $feature_product->sale_price }}</del>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- <div class="product-hover-action">
                                            <ul>
                                                <li>
                                                    <a
                                                        href="javascript:void(0);"
                                                        title="Quick View"
                                                        class="quick-view-btn"
                                                        data-quick-view-url="{{ route('frontend.products.quick-view', $feature_product->id) }}"
                                                    >
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login').'?redirect='.route('frontend.home') }}"
                                                        title="Add to Cart"
                                                        onclick="{{ customerAuth() ? 'addToCart(this)' : '' }}"
                                                        data-add-to-cart-url="{{ route('frontend.products.add-to-cart', $feature_product->id) }}"
                                                    >
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login').'?redirect='.route('frontend.home') }}"
                                                        title="Wishlist"
                                                        onclick="{{ customerAuth() ? 'addToWishlist(this)' : '' }}"
                                                        data-add-to-wishlist-url="{{ route('frontend.products.add-to-wishlist', $feature_product->id) }}"
                                                        data-bs-target="#liton_wishlist_modal">
                                                        <i class="far fa-heart"></i></a>
                                                </li>
                                            </ul>
                                    </div> -->
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT AREA END -->

    <!-- COUNTDOWN AREA START -->
    <div class="ltn__call-to-action-area section-bg-1 bg-image pt-120 pb-120" data-bs-bg="{{ asset(config('settings.frontend_campaing')??'assets/theme/img/bg/campaing.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="call-to-action-inner text-color-white--- text-center---">
                        <div class="section-title-area ltn__section-title-2--- text-center---">
                            <h6 class="ltn__secondary-color"></h6>
                            <h1 class="section-title"><br></h1>
                            <p> <br>
                                 </p>
                        </div>
                        <div class="ltn__countdown ltn__countdown-3 bg-white--" ></div>
                        <div class="btn-wrapper animated">
                            <a href="#" class="theme-btn-1 btn btn-effect-1 text-uppercase">Book Now</a>
                            <a href="#" class="ltn__secondary-color text-decoration-underline">Deal of The Day</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- <img src="img/banner/15.png" alt="#"> -->
                </div>
            </div>
        </div>
    </div>
    <!-- COUNTDOWN AREA END -->

    <!-- PRODUCT AREA START (product-item-3) -->
    {{-- <div class="ltn__product-area ltn__product-gutter  no-product-ratting pt-115 pb-70---">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h1 class="section-title">Trending Products</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
                <!-- ltn__product-item -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__product-item ltn__product-item-3 text-center">
                        <div class="product-img">
                            <a href="product-details.html"><img src="https://tunatheme.com/tf/html/vicodin-preview/vicodin/img/product/1.png" alt="#"></a>
                            <div class="product-badge">
                                <ul>
                                    <li class="sale-badge">New</li>
                                </ul>
                            </div>
                            <div class="product-hover-action">
                                <ul>
                                    <li>
                                        <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                            <i class="far fa-heart"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h2 class="product-title"><a href="product-details.html">Antiseptic Spray</a></h2>
                            <div class="product-price">
                                <span>$32.00</span>
                                <del>$46.00</del>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ltn__product-item -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__product-item ltn__product-item-3 text-center">
                        <div class="product-img">
                            <a href="product-details.html"><img src="https://tunatheme.com/tf/html/vicodin-preview/vicodin/img/product/2.png" alt="#"></a>
                            <div class="product-hover-action">
                                <ul>
                                    <li>
                                        <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                            <i class="far fa-heart"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h2 class="product-title"><a href="product-details.html">Digital Stethoscope</a></h2>
                            <div class="product-price">
                                <span>$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ltn__product-item -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__product-item ltn__product-item-3 text-center">
                        <div class="product-img">
                            <a href="product-details.html"><img src="https://tunatheme.com/tf/html/vicodin-preview/vicodin/img/product/3.png" alt="#"></a>
                            <div class="product-badge">
                                <ul>
                                    <li class="sale-badge">New</li>
                                </ul>
                            </div>
                            <div class="product-hover-action">
                                <ul>
                                    <li>
                                        <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                            <i class="far fa-heart"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h2 class="product-title"><a href="product-details.html">Cosmetic Containers</a></h2>
                            <div class="product-price">
                                <span>$75.00</span>
                                <del>$92.00</del>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ltn__product-item -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__product-item ltn__product-item-3 text-center">
                        <div class="product-img">
                            <a href="product-details.html"><img src="https://tunatheme.com/tf/html/vicodin-preview/vicodin/img/product/4.png" alt="#"></a>
                            <div class="product-badge">
                                <ul>
                                    <li class="sale-badge">New</li>
                                </ul>
                            </div>
                            <div class="product-hover-action">
                                <ul>
                                    <li>
                                        <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                            <i class="far fa-heart"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h2 class="product-title"><a href="product-details.html">Cosmetic Containers</a></h2>
                            <div class="product-price">
                                <span>$78.00</span>
                                <del>$85.00</del>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ltn__product-item -->
                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="ltn__product-item ltn__product-item-3 text-center">
                        <div class="product-img">
                            <a href="product-details.html"><img src="https://tunatheme.com/tf/html/vicodin-preview/vicodin/img/product/5.png" alt="#"></a>
                            <div class="product-hover-action">
                                <ul>
                                    <li>
                                        <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                            <i class="far fa-eye"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                            <i class="far fa-heart"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h2 class="product-title"><a href="product-details.html">Digital Stethoscope</a></h2>
                            <div class="product-price">
                                <span>$25.00</span>
                                <del>$35.00</del>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
    </div> --}}
    <!-- PRODUCT AREA END -->

    <!-- BANNER AREA START -->
    <div class="ltn__banner-area pt-50 mt-120---">
        <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h1 class="section-title">SayAid's Collection</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__custom-gutter--- justify-content-center">
                @foreach ($banners2 as $banner2)
                <div class="col-lg-4 col-sm-6">
                    <div class="ltn__banner-item">
                        <div class="ltn__banner-img">
                            <a href="{{ $banner2->link }}">
                                <img src="{{ $banner2->image_url }}" alt="Banner2 Image">
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- BANNER AREA END -->

    <!-- PRODUCT AREA START (product-item-3) -->
    <div class="ltn__product-area ltn__product-gutter pt-50 pb-70 d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h1 class="section-title">The Best For The Week</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__tab-product-slider-one-active--- slick-arrow-1">
                @foreach ($new_products as $new_product)
                    <!-- ltn__product-item -->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                        <div class="ltn__product-item ltn__product-item-3 text-left">
                            <div class="product-img">
                                <a href="{{ route('frontend.products.detail', $new_product->slug) }}">
                                    <img src="{{ $new_product->feature_image }}" alt="#">
                                </a>
                                @if ($new_product->is_new)
                                <div class="product-badge">
                                    <ul>
                                        <li class="sale-badge">New</li>
                                    </ul>
                                </div>
                                @endif
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a
                                                href="javascript:void(0);"
                                                title="Quick View"
                                                class="quick-view-btn"
                                                data-bs-target="#quick_view_modal"
                                                data-quick-view-url="{{ route('frontend.products.quick-view', $new_product->id) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>

                                            <a
                                                href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login').'?redirect='.route('frontend.home') }}"
                                                title="Add to Cart"
                                                onclick="{{ customerAuth() ? 'addToCart(this)' : '' }}"
                                                data-add-to-cart-url="{{ route('frontend.products.add-to-cart', $new_product->id) }}"
                                            >
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login').'?redirect='.route('frontend.home') }}"
                                                title="Wishlist"
                                                onclick="{{ customerAuth() ? 'addToWishlist(this)' : '' }}"
                                                data-add-to-wishlist-url="{{ route('frontend.products.add-to-wishlist', $new_product->id) }}"
                                                data-bs-target="#liton_wishlist_modal">
                                                <i class="far fa-heart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-ratting">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                    </ul>
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ route('frontend.products.detail', $new_product->slug) }}">
                                        {{ $new_product->name }}
                                    </a>
                                </h2>
                                <div class="product-price">
                                    <span>MMK{{ $new_product->discount ?? $new_product->sale_price }}</span>
                                    @if ($new_product->discount)
                                        <del>{{ $new_product->sale_price }}</del>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- PRODUCT AREA END -->

    <!-- BLOG AREA START (blog-3) -->
    <div class="ltn__blog-area section-bg-1 pt-50 pb-70 d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color d-none">News & Blogs</h6>
                        <h1 class="section-title">Leatest Blogs</h1>
                    </div>
                </div>
            </div>
            <div class="row  ltn__blog-slider-one-active slick-arrow-1 ltn__blog-item-3-normal">
                @foreach ($blogs as $blog)
                    <!-- Blog Item -->
                    <div class="col-lg-12">
                        <div class="ltn__blog-item ltn__blog-item-3">
                            <div class="ltn__blog-img">
                                <a href="blog-details.html">
                                    <img src="{{ $blog->feature_image }}" alt="#">
                                </a>
                            </div>
                            <div class="ltn__blog-brief">
                                <div class="ltn__blog-meta">
                                    <ul>
                                        <li class="ltn__blog-author">
                                            <a href="#"><i class="far fa-user"></i>by: {{ $blog->author?->name }}</a>
                                        </li>
                                        <br>
                                        <li class="ltn__blog-tags">
                                            @foreach ($blog->terms as $term)
                                                <a href="#">
                                                    <i class="fas fa-tags"></i>{{ $term->name }}
                                                </a>
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                                <h3 class="ltn__blog-title">
                                    <a href="blog-details.html">
                                        {{ $blog->name }}
                                    </a>
                                </h3>
                                <div class="ltn__blog-meta-btn">
                                    <div class="ltn__blog-meta">
                                        <ul>
                                            <li class="ltn__blog-date">
                                                <i class="far fa-calendar-alt"></i>{{ $blog->updated_at->format('M d, Y') }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ltn__blog-btn">
                                        <a href="blog-details.html">Read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- BLOG AREA END -->

    <!-- FEATURE AREA START ( Feature - 3) -->
    <div class="ltn__feature-area section-bg-1 mt-90--- pt-30 pb-30 mt--65---">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ltn__feature-item-box-wrap ltn__feature-item-box-wrap-2 ltn__border--- section-bg-1">
                        <div class="ltn__feature-item ltn__feature-item-8">
                            <div class="ltn__feature-icon">
                                <img src="{{ asset('assets/theme/img/icons/svg/8-trolley.svg') }}" alt="#">
                            </div>
                            <div class="ltn__feature-info">
                                <h4>Free shipping</h4>
                                <p>On all orders over $49.00</p>
                            </div>
                        </div>
                        <div class="ltn__feature-item ltn__feature-item-8">
                            <div class="ltn__feature-icon">
                                <img src="{{ asset('assets/theme/img/icons/svg/9-money.svg') }}" alt="#">
                            </div>
                            <div class="ltn__feature-info">
                                <h4>15 days returns</h4>
                                <p>Moneyback guarantee</p>
                            </div>
                        </div>
                        <div class="ltn__feature-item ltn__feature-item-8">
                            <div class="ltn__feature-icon">
                                <img src="{{ asset('assets/theme/img/icons/svg/10-credit-card.svg') }}" alt="#">
                            </div>
                            <div class="ltn__feature-info">
                                <h4>Secure checkout</h4>
                                <p>Protected by Paypal</p>
                            </div>
                        </div>
                        <div class="ltn__feature-item ltn__feature-item-8">
                            <div class="ltn__feature-icon">
                                <img src="{{ asset('assets/theme/img/icons/svg/11-gift-card.svg') }}" alt="#">
                            </div>
                            <div class="ltn__feature-info">
                                <h4>Offer & gift here</h4>
                                <p>On all orders over</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FEATURE AREA END -->
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
    </script>
@endsection
