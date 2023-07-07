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

    .font-san {
        font-family: sans-serif;
    }
    div.container {
        padding-left: 0;
        padding-right: 0;
    }
</style>
    <!-- SLIDER AREA START (slider-3) -->
    <div class=" mt-30 main-slider mb-5">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-md-12 mx-auto px-5 h-100">
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
        <div class="container px-2">
            <div

             class="row ltn__custom-gutter--- justify-content-center px-4">
                @foreach ($banners1 as $banner1)
                    <div
                    style="
                    height:320px
                    "
                     class="col-lg-4 col-sm-6 mb-4">
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
    <div class="ltn__product-area ltn__product-gutter container no-product-ratting pt-20--- pt-65  pb-70">
        <div class="px-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3 class="section-title font-san mb-4">Hot Items</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row ">
                        @foreach ($feature_products as $feature_product)
                            <!-- ltn__product-item -->
                            <div class="col-md-6 p-1 col-lg-3 col-sm-12 mb-3">
                                <div class="card mb-4 shadow px-1" style="height:265px">
                                    <div class="row h-100 g-0 ">
                                      <div class="col-6 pe-0 col-sm-6">
                                        <img src="{{ $feature_product->feature_image }}" class="img-fluid w-100 h-100 rounded-start" alt="...">
                                      </div>
                                      <div class="col-6 col-sm-6 pe-2">
                                        <div class="card-body h-100 pe-1 p-0 d-flex flex-column justify-content-center">
                                          <b>
                                            <p
                                          style="
                                          color: var(--ltn__secondary-color);
                                          "
                                           class="card-title font-san">
                                            <a class='product-name' href="{{ route('frontend.products.detail', $feature_product->slug) }}">
                                                {{ $feature_product->name }}
                                                @if ($feature_product->stock == 0)
                                                    <div><small class="">{{ $feature_product->name }} is currently out of stock</small></div>
                                                @endif
                                            </a>
                                          </p>
                                          </b>
                                          <div class="product-price font-san">
                                            <span class="text-dark">MMK{{ $feature_product->discount ?? $feature_product->sale_price }}</span>
                                            @if ($feature_product->discount)
                                                <del style="color: var(--ltn__secondary-color)">{{ $feature_product->sale_price }}</del>
                                            @endif
                                            </div>
                                            <a
                                                href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}" title="Add to Cart"
                                                onclick="{{ customerAuth() ? 'addToCart(this)' : '' }}"
                                                data-add-to-cart-url="{{ route('frontend.products.add-to-cart', $feature_product->id) }}" style="background-color: var(--ltn__secondary-color)" class="btn mt-auto text-white px-1 py-1 me-1 mb-2 rounded-2">
                                                <small>ADD TO CART</small>
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

    <div class="Container container mb-4">
        {{-- <h3 class="Head">Featured Products <span class="Arrows"></span></h3> --}}
        <!-- Carousel Container -->
        <div class="SlickCarousel px-4">
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

    <div class="Container container">
        {{-- <h3 class="Head">Featured Products <span class="Arrows"></span></h3> --}}
        <!-- Carousel Container -->
        <div class="SlickCarousel px-4">
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
        <div class="container px-2">
        <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area text-center">
                        <h3 class="section-title font-san mb-4">SayAid's Collection</h3>
                    </div>
                </div>
            </div>
            <div class="row ltn__custom-gutter--- justify-content-center mb-5 px-4">
                @foreach ($banners2 as $banner2)
                <div
                style="
                height:320px"
                 class="col-lg-4 col-sm-6 mb-4">
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
