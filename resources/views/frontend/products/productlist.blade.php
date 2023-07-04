@extends('frontend.layouts.master', ['title' => 'Product List'])
@section('main-content')
    <!-- PRODUCT DETAILS AREA START -->
    <div class="ltn__product-area ltn__product-gutter mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 order-lg-2 mb-120">
                    <div class="ltn__shop-options">
                        <ul>
                            <li>
                                <div class="ltn__grid-list-tab-menu ">
                                    <div class="nav">
                                        <a class="active show" data-bs-toggle="tab" href="#liton_product_grid"><i
                                                class="fas fa-th-large"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_product_list"><i class="fas fa-list"></i></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="showing-product-number text-right">
                                    <span>Showing {{ $products->currentPage() }}-{{ $products->total() }} of
                                        {{ $products->count() }} results</span>
                                </div>
                            </li>
                            <li>
                                <div class="short-by text-center">
                                    <div class="dropdown">
                                        <button class="bg-white border-dark border py-0 px-3 dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            @if (request('sorting'))
                                                @if (request('sorting') == 'asc')
                                                    Sort by price: low to high
                                                @else
                                                    Sort by price:high to low
                                                @endif
                                            @else
                                                Default Sorting
                                            @endif
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('frontend.products.index') }}">Default Sorting</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('frontend.products.index') }}?sorting=asc">Sort by
                                                    price: low to high</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('frontend.products.index') }}?sorting=desc">Sort by
                                                    price:
                                                    high to low</a></li>
                                        </ul>
                                    </div>
                                    {{-- <select class="nice-select" id="product-sorting-opt">

                                        <option value="default">
                                            <a href="{{ route('frontend.products.index') }}">
                                                Default Sorting
                                            </a>
                                        </option>

                                        <option value="price-desc">Sort by price: low to high</option>
                                        <option value="price-asc">Sort by price: high to low</option>
                                    </select> --}}
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="liton_product_grid">
                            <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                                <div class="row product-grid">
                                    <!-- ltn__product-item -->

                                    @foreach ($products as $product)
                                        <div style="" class="col-xl-4 col-sm-6 col-6 p-grid-item "
                                            data-product-id="{{ $product->id }}"
                                            data-product-price="{{ $product->discount ?? $product->sale_price }}">
                                            <div class="ltn__product-item  text-center">
                                                <div class="product-img ">
                                                    <a href="{{ route('frontend.products.detail', $product->slug) }}"><img
                                                            src="{{ $product->feature_image }}" alt="#"></a>
                                                    @if ($product->is_new)
                                                        <div class="product-badge text-start">
                                                            <ul>
                                                                <li class="sale-badge">New</li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <div class="product-hover-action">
                                                        <ul>
                                                            <li>
                                                                <a href="javascript:void(0);" title="Quick View"
                                                                    class="quick-view-btn"
                                                                    data-quick-view-url="{{ route('frontend.products.quick-view', $product->id) }}">
                                                                    <i class="far fa-eye"></i>
                                                                </a>
                                                            </li>
                                                            <li class="{{ $product->stock == 0 ? 'd-none' : '' }}">
                                                                <a href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}"
                                                                    title="Add to Cart"
                                                                    onclick="{{ customerAuth() ? 'addToCart(this)' : '' }}"
                                                                    data-add-to-cart-url="{{ route('frontend.products.add-to-cart', $product->id) }}">
                                                                    <i class="fas fa-shopping-cart"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}"
                                                                    title="Wishlist"
                                                                    onclick="{{ customerAuth() ? 'addToWishlist(this)' : '' }}"
                                                                    data-add-to-wishlist-url="{{ route('frontend.products.add-to-wishlist', $product->id) }}"
                                                                    data-bs-target="#liton_wishlist_modal">
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
                                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a>
                                                            </li>
                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <h2 class="product-title"><a
                                                            href="{{ route('frontend.products.detail', $product->slug) }}">{{ $product->name }}</a>
                                                        @if ($product->stock == 0)
                                                            <div><small class="text-danger">{{ $product->name }} is
                                                                    currently out of stock !!</small></div>
                                                        @endif
                                                    </h2>

                                                    <div class="product-price">
                                                        <span>MMK{{ $product->discount ?? $product->sale_price }}</span>
                                                        @if ($product->discount)
                                                            <del>{{ $product->sale_price }}</del>
                                                        @endif
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    @endforeach


                                    <!--  -->
                                </div>
                            </div>
                        </div>
                        <!--grid start-->
                        <div class="tab-pane fade" id="liton_product_list">
                            <div class="ltn__product-tab-content-inner ltn__product-list-view">
                                <div class="row product-list">
                                    <!-- ltn__product-item -->
                                    @foreach ($products as $product)
                                        <div class="col-lg-12 p-list-item" data-product-id="{{ $product->id }}"
                                            data-product-price="{{ $product->discount ?? $product->sale_price }}">
                                            <div class="ltn__product-item ltn__product-item-3">
                                                <div class="product-img">
                                                    <a href="{{ route('frontend.products.detail', $product->slug) }}"><img
                                                            src="{{ $product->feature_image }}" alt="#"></a>
                                                    <div class="product-badge">
                                                        <ul>
                                                            <li class="sale-badge">New</li>
                                                        </ul>
                                                    </div>

                                                </div>
                                                <div class="product-info">
                                                    <h2 class="product-title"><a
                                                            href="{{ route('frontend.products.detail', $product->slug) }}">{{ $product->name }}</a>
                                                    </h2>
                                                    <div class="product-ratting">
                                                        <ul>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a>
                                                            </li>
                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product-price">
                                                        <span>MMK{{ $product->discount ?? $product->sale_price }}</span>
                                                        @if ($product->discount)
                                                            <del>{{ $product->sale_price }}</del>
                                                        @endif
                                                    </div>
                                                    @php
                                                        $product->description = preg_replace('/&#?[a-z0-9]+;/i', '', $product->description);
                                                    @endphp
                                                    <div class="product-brief">
                                                        <a href="{{ route('frontend.products.detail', $product->slug) }}">
                                                            <p>{{ Str::words(strip_tags($product->description), 13, '....') }}
                                                            </p>
                                                        </a>
                                                    </div>

                                                    <div class="product-hover-action">
                                                        <ul>
                                                            <li>
                                                                <a href="javascript:void(0);" title="Quick View"
                                                                    class="quick-view-btn"
                                                                    data-quick-view-url="{{ route('frontend.products.quick-view', $product->id) }}">
                                                                    <i class="far fa-eye"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}"
                                                                    title="Add to Cart"
                                                                    onclick="{{ customerAuth() ? 'addToCart(this)' : '' }}"
                                                                    data-add-to-cart-url="{{ route('frontend.products.add-to-cart', $product->id) }}">
                                                                    <i class="fas fa-shopping-cart"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login') . '?redirect=' . url()->full() }}"
                                                                    title="Wishlist"
                                                                    onclick="{{ customerAuth() ? 'addToWishlist(this)' : '' }}"
                                                                    data-add-to-wishlist-url="{{ route('frontend.products.add-to-wishlist', $product->id) }}"
                                                                    data-bs-target="#liton_wishlist_modal">
                                                                    <i class="far fa-heart"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!--  -->
                                </div>
                            </div>
                        </div>
                        <!--grid end-->
                    </div>
                    <div class="ltn__pagination-area text-center">
                        <div class="ltn__pagination">
                            @include('frontend.layouts.shared.pagination', [
                                'paginator' => $products,
                                $products->links(),
                                'link_limit' => 4,
                            ])
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  mb-120">
                    <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
                        <!-- Search Widget -->
                        {{-- <div class="widget ltn__search-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Search Objects</h4>
                        <form action="{{ route('frontend.products.index') }}" id="product-filter-form">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search your keyword...">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div> --}}

                        <!-- Category Widget -->
                        <div class="widget ltn__menu-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Product categories</h4>

                            <ul>
                                <div class="ltn__utilize-menu">
                                    @foreach ($main_categories as $index => $main_category)
                                        <ul>
                                            <li><a href="#">{{ $main_category->name }} </a>
                                                @foreach ($main_category->childs as $sub_category)
                                                    <ul class="sub-menu">
                                                        <li><a
                                                                href="{{ route('frontend.products.index') . '?category=' . $sub_category->id }}">-
                                                                - {{ $sub_category->name }}</a></li>
                                                    </ul>
                                                @endforeach
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            </ul>

                            {{-- <ul>
                        @foreach ($main_categories as $index => $main_category)
                            <li>
                                <a href="{{ route('frontend.products.index').'?category='.$main_category->id }}">
                                    {{ $main_category->name }}
                                    <span><i class="fas fa-long-arrow-alt-right"></i></span>
                                </a>
                            </li>
                            @foreach ($main_category->childs as $sub_category)
                                <li>
                                    <a href="{{ route('frontend.products.index').'?category='.$sub_category->id }}">
                                        - - {{ $sub_category->name }}
                                        <span><i class="fas fa-long-arrow-alt-right"></i></span>
                                    </a>
                                </li>
                            @endforeach
                        @endforeach
                        </ul> --}}
                        </div>

                        <!-- Price Filter Widget -->
                        <div class="widget ltn__price-filter-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Filter by price</h4>
                            <div class="price_filter row">
                                <div class="col-9 pt-1">
                                    <div class="price_slider_amount">
                                        <input type="submit" value="Your range:" />
                                        <input form="product-filter-form" type="text" class="amount" name="price"
                                            placeholder="Add Your Price" />
                                    </div>
                                    <div class="slider-range"></div>
                                </div>
                                <div class="col-3">
                                    <div class="btn-wrapper pt-lg-5">
                                        <form action="{{ route('frontend.products.index') }}" id="product-filter-form">
                                            <button
                                                class="theme-btn-1 w-100 float-end btn py-1 px-2 rounded-1 btn-effect-1"
                                                type="submit">Filter</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <!-- Top Rated Product Widget -->
                        {{-- <div class="widget ltn__top-rated-product-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Top Rated Product</h4>
                        <ul>
                            <li>
                                <div class="top-rated-product-item clearfix">
                                    <div class="top-rated-product-img">
                                        <a href="product-details.html"><img src="img/product/1.png" alt="#"></a>
                                    </div>
                                    <div class="top-rated-product-info">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <h6><a href="product-details.html">Mixel Solid Seat Cover</a></h6>
                                        <div class="product-price">
                                            <span>$49.00</span>
                                            <del>$65.00</del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="top-rated-product-item clearfix">
                                    <div class="top-rated-product-img">
                                        <a href="product-details.html"><img src="img/product/2.png" alt="#"></a>
                                    </div>
                                    <div class="top-rated-product-info">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <h6><a href="product-details.html">Thermometer Gun</a></h6>
                                        <div class="product-price">
                                            <span>$49.00</span>
                                            <del>$65.00</del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="top-rated-product-item clearfix">
                                    <div class="top-rated-product-img">
                                        <a href="product-details.html"><img src="img/product/3.png" alt="#"></a>
                                    </div>
                                    <div class="top-rated-product-info">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <h6><a href="product-details.html">Coil Spring Conversion</a></h6>
                                        <div class="product-price">
                                            <span>$49.00</span>
                                            <del>$65.00</del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> --}}

                        <!-- Tagcloud Widget -->
                        {{-- <div class="widget ltn__tagcloud-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Popular Tags</h4>
                        <ul>
                            <li><a href="#">Body</a></li>
                            <li><a href="#">Doctor</a></li>
                            <li><a href="#">Drugs</a></li>
                            <li><a href="#">Eye</a></li>
                            <li><a href="#">Face</a></li>
                            <li><a href="#">Hand</a></li>
                            <li><a href="#">Mask</a></li>
                            <li><a href="#">Medicine</a></li>
                            <li><a href="#">Price</a></li>
                            <li><a href="#">Sanitizer</a></li>
                            <li><a href="#">Virus</a></li>
                        </ul>
                    </div> --}}
                        <!-- Size Widget -->
                        {{-- <div class="widget ltn__tagcloud-widget ltn__size-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Product Size</h4>
                        <ul>
                            <li><a href="#">S</a></li>
                            <li><a href="#">M</a></li>
                            <li><a href="#">L</a></li>
                            <li><a href="#">XL</a></li>
                            <li><a href="#">XXL</a></li>
                        </ul>
                    </div> --}}
                        <!-- Color Widget -->
                        {{-- <div class="widget ltn__color-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Product Color</h4>
                        <ul>
                            <li class="black"><a href="#"></a></li>
                            <li class="white"><a href="#"></a></li>
                            <li class="red"><a href="#"></a></li>
                            <li class="silver"><a href="#"></a></li>
                            <li class="gray"><a href="#"></a></li>
                            <li class="maroon"><a href="#"></a></li>
                            <li class="yellow"><a href="#"></a></li>
                            <li class="olive"><a href="#"></a></li>
                            <li class="lime"><a href="#"></a></li>
                            <li class="green"><a href="#"></a></li>
                            <li class="aqua"><a href="#"></a></li>
                            <li class="teal"><a href="#"></a></li>
                            <li class="blue"><a href="#"></a></li>
                            <li class="navy"><a href="#"></a></li>
                            <li class="fuchsia"><a href="#"></a></li>
                            <li class="purple"><a href="#"></a></li>
                            <li class="pink"><a href="#"></a></li>
                            <li class="nude"><a href="#"></a></li>
                            <li class="orange"><a href="#"></a></li>

                            <li><a href="#" class="orange"></a></li>
                            <li><a href="#" class="orange"></a></li>
                        </ul>
                    </div> --}}
                        <!-- Banner Widget -->
                        {{-- <div class="widget ltn__banner-widget">
                        <a href="shop.html"><img src="img/banner/banner-2.jpg" alt="#"></a>
                    </div> --}}

                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT DETAILS AREA END -->
@endsection

{{-- @section('script')
    <script>
        $(function() {
            $("#product-sorting-opt").change(function(e) {
                e.preventDefault();
                sortByPrice(".product-grid > .p-grid-item", ".product-grid", this.value)
                sortByPrice(".product-list > .p-list-item", ".product-list", this.value)
            });
        })

        function sortByPrice(selector, appendTo, sortBy) {
            $(selector)
                .sort((a, b) => {
                    if (sortBy == 'price-desc') {
                        console.log($(a).data("product-price"));
                        if ($(a).data("product-price") < $(b).data("product-price")) {
                            return -1;
                        }
                    } else if (sortBy == 'price-asc') {
                        if ($(a).data("product-price") > $(b).data("product-price")) {
                            return -1;
                        }
                    } else {
                        if ($(a).data("product-id") > $(b).data("product-id")) {
                            return -1;
                        }
                    }

                }).appendTo(appendTo);
        }
    </script>
@endsection --}}
