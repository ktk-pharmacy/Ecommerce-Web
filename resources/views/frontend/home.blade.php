@extends('frontend.layouts.master', ['title' => 'Home'])

@section('main-content')
<style>
    h4.card-title a:hover {
        color: #710ac2 !important;
    }
</style>
    <!-- SLIDER AREA START (slider-3) -->
    <div class="ltn__slider-area ltn__slider-3---  section-bg-1--- mt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="carouselExampleIndicators" class="carousel slide  mb-30" data-bs-ride="carousel">
                        <div class="carousel-inner ">
                        @foreach ($sliders as $key => $slider)
                          <div class="carousel-item {{ $key == 0 ? ' active' : '' }} ltn__slide-item ltn__slide-item-10 section-bg-1  bg-image" data-bs-interval="3500" data-bs-bg="{{ $slider->image_url }}">
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

    <!-- COUNTDOWN AREA START -->

    <!-- COUNTDOWN AREA END -->

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
