@extends('frontend.layouts.master', ['title' => 'Product Detail'])
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/magnify/jquery.exzoom.css') }}">
    <style>
        .product-price small {
            font-size: 15px;
        }
    </style>
@endsection

@section('main-content')
    @php
        if ($product->sell_limit == null) {
            $sell_limit = 'unlimit';
        } else {
            $sell_limit = $product->sell_limit - productCountInCart($product) - orderedCountPdt($product);
        }
    @endphp
    <!-- SHOP DETAILS AREA START -->
    <div class="ltn__shop-details-area pb-85">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-md-12">
                    <div class="ltn__shop-details-inner mb-60">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="exzoom" id="exzoom">
                                    <!-- Images -->
                                    <div class="exzoom_img_box">
                                        <ul class='exzoom_img_ul'>
                                            <li><img src="{{ $product->feature_image }}" /></li>
                                            @foreach ($product->galleries as $gallery)
                                                <li><img src="{{ $gallery->image_url }}"
                                                        alt="{{ $product->name }}'s Image" /></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="exzoom_nav"></div>
                                </div>
                            </div>
                            <div class="col-md-5 offset-md-1 col-lg-6 offset-lg-0">
                                <div class="modal-product-info shop-details-info pl-0">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                            <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                                        </ul>
                                    </div>
                                    <h3>{{ $product->name }}</h3>
                                    <div class="product-price">
                                        <span>MMK{{ $product->discount ?? $product->sale_price }}</span>
                                        @if ($product->discount)
                                            <del>{{ $product->sale_price }}</del>
                                            <div class="d-flex gap-1 align-items-center">
                                                <small>Discount end in</small>
                                                <small class="day-container">
                                                    <span class="day"></span>d
                                                </small>
                                                <small class="hour-container">
                                                    <span class="hour"></span>h
                                                </small>
                                                <small>
                                                    <span class="minute"></span>m
                                                </small>
                                                <small>
                                                    <span class="second"></span>s
                                                </small>
                                            </div>
                                        @endif

                                    </div>

                                    <div class="modal-product-meta ltn__product-details-menu-1">
                                        <ul>
                                            <li>
                                                <strong>Categories:</strong>
                                                <span>
                                                    <a
                                                        href="javascript:void();">{{ $product->sub_category?->parent?->group?->name }}</a>
                                                    <a
                                                        href="javascript:void();">{{ $product->sub_category?->parent?->name }}</a>
                                                    <a
                                                        href="{{ route('frontend.products.index') . '?category=' . $product->sub_category?->id }}">
                                                        {{ $product->sub_category?->name }}
                                                    </a>
                                                </span>
                                            </li>

                                            <li>
                                                <strong>UOM:</strong>
                                                <span>
                                                    <a href="javascript:void();">{{ $product->uom }}</a>
                                                </span>
                                            </li>

                                            <li>
                                                <strong>Net Weight:</strong>
                                                <span>
                                                    <a href="javascript:void();">{{ $product->net_weight }} Kg</a>
                                                </span>
                                            </li>

                                            @if ($product->stock == 0)
                                                <li class="text-danger row">
                                                    <strong class="col-2">Notic:</strong>
                                                    <span class="col-8">
                                                        {{ $product->name }} is currently out of stock !!
                                                    </span>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="ltn__product-details-menu-2 {{ $product->stock == 0 ? 'd-none' : '' }} ">
                                        <ul class="">
                                            <li>
                                                <div class="cart-plus-minus">
                                                    <input type="text" value="1" name="qtybutton" id="cart-quantity"
                                                        class="cart-plus-minus-box">
                                                </div>
                                            </li>
                                            {{-- @if (productCountInCart($product) !== $product->sell_limit) --}}
                                            <li>
                                                <a href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}"
                                                    class="theme-btn-1 btn btn-effect-1" title="Add to Cart"
                                                    onclick="{{ customerAuth() ? 'addToCart(this)' : '' }}"
                                                    data-type="main"
                                                    data-add-to-cart-url="{{ route('frontend.products.add-to-cart', $product->id) }}">
                                                    <i class="fas fa-shopping-cart"></i>
                                                    <span>ADD TO CART</span>
                                                </a>
                                            </li>
                                            {{-- @endif --}}

                                        </ul>
                                    </div>
                                    <div class="ltn__product-details-menu-3">
                                        <ul>
                                            <li>
                                                <a href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}"
                                                    title="Wishlist"
                                                    onclick="{{ customerAuth() ? 'addToWishlist(this)' : '' }}"
                                                    data-add-to-wishlist-url="{{ route('frontend.products.add-to-wishlist', $product->id) }}">
                                                    <i class="far fa-heart"></i>
                                                    <span>Add to Wishlist</span>
                                                </a>
                                            </li>
                                            {{-- <li>
                                 <a href="#" class="" title="Compare" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                    <i class="fas fa-exchange-alt"></i>
                                    <span>Compare</span>
                                 </a>
                              </li> --}}
                                        </ul>
                                    </div>
                                    <hr>
                                    <div class="ltn__social-media">
                                        <ul>
                                            <li>Share:</li>
                                            <li>
                                                <a href="{{ shareTo('facebook', url()->full()) }}" target="_blank"
                                                    title="Facebook">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ shareTo('twitter', url()->full(), $product->name) }}"
                                                    target="_blank" title="Twitter">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ shareTo('linked_in', url()->full(), $product->name) }}"
                                                    target="_blank" title="Linkedin">
                                                    <i class="fab fa-linkedin"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <hr>
                                    <div class="ltn__safe-checkout">
                                        <h5>Guaranteed Safe Checkout</h5>
                                        <div class="payment">
                                            <img class="" src="{{ asset('assets/theme/img/icons/visa_icon.png') }}"
                                                alt="#">
                                            <img class=""
                                                src="{{ asset('assets/theme/img/icons/mastercard_icon.png') }}"
                                                alt="#">
                                            <img class=""
                                                src="{{ asset('assets/theme/img/icons/jcb_icon (1).png') }}"
                                                alt="#">
                                            <img class="" src="{{ asset('assets/theme/img/icons/mpu.jpg') }}"
                                                alt="#">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Tab Start -->
                    <div class="ltn__shop-details-tab-inner ltn__shop-details-tab-inner-2">
                        <div class="ltn__shop-details-tab-menu">
                            <div class="nav">
                                <a class="active show" data-bs-toggle="tab" href="#liton_tab_details_1_1">Description</a>
                                <a data-bs-toggle="tab" href="#liton_tab_details_1_2" class="">Product Details</a>
                                <a data-bs-toggle="tab" href="#liton_tab_details_1_3" class="">Other
                                    Information</a>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="liton_tab_details_1_1">
                                <div class="ltn__shop-details-tab-content-inner">
                                    <h4 class="title-2">{{ $product->name }}</h4>
                                    {!! $product->description !!}

                                </div>
                            </div>
                            <div class="tab-pane fade active show" id="liton_tab_details_1_2">
                                <div class="ltn__shop-details-tab-content-inner">
                                    {{--  <h4 class="title-2">{{ $product->name }}</h4>  --}}
                                    {!! $product->detail !!}

                                </div>
                            </div>
                            <div class="tab-pane fade active show" id="liton_tab_details_1_3">
                                <div class="ltn__shop-details-tab-content-inner">
                                    {{--  <h4 class="title-2">{{ $product->name }}</h4>  --}}
                                    {!! $product->other_information !!}

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Tab End -->
                </div>
                <div class="col-xl-4">
                    <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
                        <!-- Top Rated Product Widget -->
                        <div class="widget ltn__top-rated-product-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Top Rated Product</h4>
                            <ul>
                                @foreach ($top_related_products as $top_related_product)
                                    <li>
                                        <div class="top-rated-product-item clearfix">
                                            <div class="top-rated-product-img">
                                                <a
                                                    href="{{ route('frontend.products.detail', $top_related_product->slug) }}">
                                                    <img src="{{ $top_related_product->feature_image }}" alt="#">
                                                </a>
                                            </div>
                                            <div class="top-rated-product-info">
                                                <div class="product-ratting d-none">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <h6>
                                                    <a
                                                        href="{{ route('frontend.products.detail', $top_related_product->slug) }}">
                                                        {{ $top_related_product->name }}
                                                    </a>
                                                </h6>
                                                <div class="product-price">
                                                    <span>MMK{{ $top_related_product->discount ?? $top_related_product->sale_price }}</span>
                                                    @if ($top_related_product->discount)
                                                        <del>{{ $top_related_product->sale_price }}</del>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Banner Widget -->
                        {{-- <div class="widget ltn__banner-widget">
                  <a href="shop.html"><img src="img/banner/2.jpg" alt="#"></a>
               </div> --}}
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOP DETAILS AREA END -->

    <!-- PRODUCT SLIDER AREA START -->
    <div class="ltn__product-slider-area ltn__product-gutter pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2">
                        <h4 class="title-2">Related Products<span>.</span></h1>
                    </div>
                </div>
            </div>
            <div class="row ltn__related-product-slider-one-active slick-arrow-1">
                @foreach ($related_products as $related_product)
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item text-center">
                            <div style="overflow: visible !important;" class="product-img">
                                <a href="{{ route('frontend.products.detail', $related_product->slug) }}">
                                    <img src="{{ $related_product->feature_image }}" alt="#">
                                </a>
                                <div class="product-badge text-start">
                                    <ul>
                                        <li class="sale-badge">New</li>
                                    </ul>
                                </div>

                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);" title="Quick View" class="quick-view-btn"
                                                data-quick-view-url="{{ route('frontend.products.quick-view', $related_product->id) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                        <li class="{{ $related_product->stock == 0 ? 'd-none' : '' }}">
                                            <a href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}"
                                                title="Add to Cart"
                                                onclick="{{ customerAuth() ? 'addToCart(this)' : '' }}"
                                                data-add-to-cart-url="{{ route('frontend.products.add-to-cart', $related_product->id) }}">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}"
                                                title="Wishlist"
                                                onclick="{{ customerAuth() ? 'addToWishlist(this)' : '' }}"
                                                data-add-to-wishlist-url="{{ route('frontend.products.add-to-wishlist', $related_product->id) }}">
                                                <i class="far fa-heart"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-ratting d-none">
                                    <ul>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                    </ul>
                                </div>
                                <h2 class="product-title">
                                    <a href="{{ route('frontend.products.detail', $related_product->slug) }}">
                                        {{ $related_product->name }}
                                    </a>
                                    @if ($related_product->stock == 0)
                                        <div><small class="text-danger">{{ $related_product->name }} is currently out of
                                                stock !!</small></div>
                                    @endif
                                </h2>
                                <div class="product-price">
                                    <span>MMK{{ $related_product->discount ?? $related_product->sale_price }}</span>
                                    @if ($related_product->discount)
                                        <del>{{ $related_product->sale_price }}</del>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--  -->
                @endforeach
            </div>
        </div>
    </div>
    <!-- PRODUCT SLIDER AREA END -->
@endsection
@section('script')
    <script src="{{ asset('assets/libs/magnify/jquery.exzoom.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            $("#exzoom").exzoom({
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,
                // autoplay
                "autoPlay": false,
            });

            /* --------------------------------------------------------
                Quantity plus minus
            -------------------------------------------------------- */
            let product_limit = "{{ $product->sell_limit }}";
            let sell_limit = "{{ $sell_limit }}";
            if (sell_limit !== "unlimit") sell_limit = Number("{{ $sell_limit }}");

            $(".cart-plus-minus").prepend('<div class="dec qtybutton">-</div>');
            $(".cart-plus-minus").append('<div class="inc qtybutton">+</div>');
            $(".qtybutton").on("click", function() {
                var $button = $(this);
                var oldValue = $button.parent().find("input").val();
                if ($button.text() == "+") {
                    if (sell_limit == "unlimit") {
                        var newVal = parseFloat(oldValue) + 1;
                    } else {
                        if (sell_limit > oldValue) {
                            var newVal = parseFloat(oldValue) + 1;
                        } else {
                            newVal = oldValue;
                            Toast.fire({
                                icon: 'error',
                                title: `This item can be order ${product_limit} daily`
                            })
                        }
                    }
                } else {
                    oldValue > 0 ? var newVal = parseFloat(oldValue) - 1 : newVal = 0;
                }
                $button.parent().find("input").val(newVal);
            });


            let discount = "{{ $product->discount }}";

            if (discount) countdown("{{ $product->discount_to }}");

            function countdown(targetDate) {
                var target = new Date(targetDate).getTime();

                var countdownInterval = setInterval(function() {
                    var now = new Date();
                    var utcNow = Date.UTC(
                        now.getUTCFullYear(),
                        now.getUTCMonth(),
                        now.getUTCDate(),
                        now.getUTCHours(),
                        now.getUTCMinutes(),
                        now.getUTCSeconds(),
                    );
                    var yangonTime = utcNow + 5.5 * 60 * 60 *
                    1000; // Adjusting to Yangon timezone (UTC+5:30)
                    var distance = target - yangonTime;

                    if (distance <= 0) {
                        clearInterval(countdownInterval);
                        return;
                    }

                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    if (days == 0) $('.day-container').hide();
                    if (hours == 0) $('.hour-container').hide();
                    $('.day').html(days);
                    $('.hour').html(hours);
                    $('.minute').html(minutes);
                    $('.second').html(seconds);
                }, 1000);
            }


        });
    </script>
@endsection
