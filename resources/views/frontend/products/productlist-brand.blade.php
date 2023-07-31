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
                        <!-- Category Widget -->
                        <div class="widget ltn__menu-widget">
                            <h4 class="ltn__widget-title ltn__widget-title-border">Product Brands</h4>

                            <ul>
                                <div class="ltn__utilize-menu">
                                    @foreach (App\Model\Brand::all() as $brand)
                                        <ul>
                                            <li><a href="{{ route('frontend.products.index') }}?brand={{ $brand->id }}">{{ $brand->name }} </a>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            </ul>
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

                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- PRODUCT DETAILS AREA END -->
@endsection

