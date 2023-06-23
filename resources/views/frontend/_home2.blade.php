@extends('frontend.layouts.master', ['title' => 'Home'])
@section('css')
    <link rel="stylesheet" href="asset('assets/theme/css/homepage-slider.css')">
@endsection
@section('main-content')
<style>
    h4.card-title a:hover {
        color: #710ac2 !important;
    }
    .main-slider {
        height: 60vh;
    }
</style>
    <!-- SLIDER AREA START (slider-3) -->
    <div class="ltn__slider-area ltn__slider-3---  section-bg-1--- mt-30 main-slider mb-4">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-lg-12 h-100">
                    <div id="carouselExampleIndicators" class="carousel slide h-100 mb-30" data-bs-ride="carousel">
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
    <div class="ltn__banner-area mt-120---">
        <div class="container">
            <div

             class="row ltn__custom-gutter--- justify-content-center">
                @foreach ($banners1 as $banner1)
                    <div
                    style="
                    width: 400px;
                    height:320px
                    "
                     class="col-lg-4 col-sm-6">
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
                <div class="col-lg-12">
                    <div class="row ltn__tab-product-slider-one-active--- slick-arrow-1">
                        @foreach ($feature_products as $feature_product)
                            <!-- ltn__product-item -->
                            <div class="col-lg-3--- col-md-3 col-sm-6 col-6">
                                <div class="card mb-3" style="height:230px">
                                    <div class="row h-100 g-0">
                                      <div class="col-md-4">
                                        <img  src="{{ $feature_product->feature_image }}" class="img-fluid w-100 h-100 rounded-start" alt="...">
                                      </div>
                                      <div class="col-md-8">
                                        <div class="card-body h-100 d-flex flex-column">
                                          <h4
                                          style="
                                          color: #710ac2;
                                          font-family: sans-serif;
                                          "
                                           class="card-title">
                                            <a class='product-name' href="{{ route('frontend.products.detail', $feature_product->slug) }}">
                                                {{ $feature_product->name }}
                                                @if ($feature_product->stock == 0)
                                                    <div><small class="">{{ $feature_product->name }} is currently out of stock</small></div>
                                                @endif
                                            </a>
                                          </h4>
                                          <div class="product-price">
                                            <span class="text-dark">MMK{{ $feature_product->discount ?? $feature_product->sale_price }}</span>
                                            @if ($feature_product->discount)
                                                <del style="color: #710ac2">{{ $feature_product->sale_price }}</del>
                                            @endif
                                            </div>
                                            <a
                                                href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}" title="Add to Cart"
                                                onclick="{{ customerAuth() ? 'addToCart(this)' : '' }}"
                                                data-add-to-cart-url="{{ route('frontend.products.add-to-cart', $feature_product->id) }}" style="background-color: #710ac2" class="btn mt-auto text-white px-2 py-1 rounded-2">
                                                ADD TO CART
                                            </a>
                                        </div>
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
    <!-- PRODUCT AREA END -->

    <div class="Container mb-4 px-5">
        {{-- <h3 class="Head">Featured Products <span class="Arrows"></span></h3> --}}
        <!-- Carousel Container -->
        <div class="SlickCarousel">
            @foreach ($left_sidebars as $left_sidebar)
            <div class="ProductBlock mx-3">
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

    <div class="Container px-5">
        {{-- <h3 class="Head">Featured Products <span class="Arrows"></span></h3> --}}
        <!-- Carousel Container -->
        <div class="SlickCarousel">
          <!-- Item -->
           @foreach ($secondSliders as $secondSlider)
            <div class="ProductBlock mx-3">
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
    <div class="ltn__banner-area pt-50 mt-120---">
        <div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2 text-center">
                        <h1 class="section-title">SayAid's Collection</h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__custom-gutter--- justify-content-center mb-5">
                @foreach ($banners2 as $banner2)
                <div
                style="
                width: 400px;
                height:320px"
                 class="col-lg-4 col-sm-6">
                    <div class="ltn__banner-item w-100 h-100">
                        <div class="ltn__banner-img w-100 h-100">
                            <a href="{{ $banner2->link }}">
                                <img class="w-100 h-100" src="{{ $banner2->image_url }}" alt="Banner2 Image">
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- BANNER AREA END -->


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
                {breakpoint:801,settings:{
                    slidesToShow:3,
                }},
                {breakpoint:641,settings:{
                    slidesToShow:3,
                }},
                {breakpoint:481,settings:{
                    slidesToShow:1,
                }},
                ],
            })
    })
    </script>
@endsection
