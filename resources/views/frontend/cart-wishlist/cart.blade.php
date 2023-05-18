@extends('frontend.layouts.master', ['title' => 'Cart'])

@section('main-content')
    <!-- SHOPING CART AREA START -->
    <div class="liton__shoping-cart-area mb-120 {{ count($cart['products']) ? '' : 'd-none' }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping-cart-inner">
                        <div class="shoping-cart-table table-responsive">
                            <form action="{{ route('frontend.cart.update') }}" method="post">
                                @csrf
                                <table class="table">
                                    <!-- <thead>
                                               <th class="cart-product-remove">Remove</th>
                                               <th class="cart-product-image">Image</th>
                                               <th class="cart-product-info">Product</th>
                                               <th class="cart-product-price">Price</th>
                                               <th class="cart-product-quantity">Quantity</th>
                                               <th class="cart-product-subtotal">Subtotal</th>
                                         </thead> -->
                                    <tbody>
                                        @foreach ($cart['products'] as $product)
                                            <tr>
                                                <td class="cart-product-remove" style="width: 10px;"
                                                    onclick="removeViewCart(this)"
                                                    data-remove-cart-url="{{ route('frontend.products.remove-from-cart', $product['id']) }}">
                                                    x
                                                </td>
                                                <td class="cart-product-image">
                                                    <a href="{{ route('frontend.products.detail', $product['slug']) }}">
                                                        <img src="{{ $product['feature_image'] }}" alt="#">
                                                    </a>
                                                </td>
                                                <td class="cart-product-info" style="width: 100%;">
                                                    <h4>
                                                        <a href="{{ route('frontend.products.detail', $product['slug']) }}">
                                                            {{ $product['name'] }}
                                                        </a>
                                                        @if ($product['stock'] == 0)
                                                            /
                                                            <small>(<span class="text-danger">This item is currently out of
                                                                    stock !!</span>)</small>
                                                        @elseif ($product['cart_quantity'] > $product['stock'])
                                                            / <small>(<span class="text-danger">We have only
                                                                    {{ $product['stock'] }}stock of this item
                                                                    !!</span>)</small>
                                                        @endif
                                                    </h4>

                                                </td>
                                                <td class="cart-product-price">{{ $product['price'] }}</td>
                                                <td class="cart-product-quantity">
                                                    <div class="cart-plus-minus">
                                                        <input type="text" value="{{ $product['cart_quantity'] }}"
                                                            name="cart_products[{{ $product['id'] }}][quantity]"
                                                            class="cart-plus-minus-box">
                                                    </div>
                                                </td>
                                                <td class="cart-product-subtotal">
                                                    {{ $product['price'] * $product['cart_quantity'] }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="cart-coupon-row">
                                            {{-- <td colspan="6">
                                                <div class="cart-coupon">
                                                    <input type="text" class="coupon" name="coupon"
                                                        placeholder="Coupon code">
                                                    <button type="button" class="btn theme-btn-2 btn-effect-2 apply-coupon"
                                                        data-url="{{ route('frontend.coupon-data') }}">Apply
                                                        Coupon</button>
                                                </div>
                                            </td> --}}
                                            <td>
                                                <button type="submit" class="btn theme-btn-2 btn-effect-2">Update
                                                    Cart</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </form>
                        </div>
                        <div style="max-width: 450px;" class="shoping-cart-total mt-50">
                            <h4>Cart Totals</h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Cart Subtotal</td>
                                        <td>MMK{{ $cart['subtotal'] }}</td>
                                    </tr>
                                    {{-- <tr>
                           <td>Shipping and Handing</td>
                           <td>$15.00</td>
                        </tr>
                        <tr>
                           <td>Vat</td>
                           <td>$00.00</td>
                        </tr> --}}
                        {{-- <tr>
                            <td>
                                Discount
                            </td>
                            <td class="coupon-discount"></td>
                        </tr> --}}
                                    <tr>
                                        <td><strong>Order Total</strong></td>
                                        <td><strong >MMK<span class="order-total">{{ $cart['subtotal'] }}</span></strong></td>
                                    </tr>

                                </tbody>

                            </table>
                            <div class="btn-wrapper text-right">
                                <a href="{{ route('frontend.checkout') }}" class="theme-btn-1 btn btn-effect-1">Proceed to
                                    checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- SHOPING CART AREA END -->

    <!-- CALL TO ACTION START (call-to-action-6) -->
    <div class="ltn__call-to-action-area no-cart-action-area call-to-action-6 before-bg-bottom {{ count($cart['products']) ? 'd-none' : '' }}"
        data-bs-bg="img/1.jpg--">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div
                        class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
                        <div class="coll-to-info text-color-white">
                            <h1>There is no products <br> in your cart.</h1>
                        </div>
                        <div class="btn-wrapper">
                            <a class="btn btn-effect-3 btn-white" href="{{ route('frontend.home') }}">Explore Products <i
                                    class="icon-next"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CALL TO ACTION END -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(".cart-plus-minus").prepend('<div class="dec qtybutton">-</div>');
            $(".cart-plus-minus").append('<div class="inc qtybutton">+</div>');
            $(".qtybutton").on("click", function() {
                var $button = $(this);
                var oldValue = $button.parent().find("input").val();
                if ($button.text() == "+") {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    if (oldValue > 0) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 0;
                    }
                }
                $button.parent().find("input").val(newVal);
            });
        });
    </script>
@endsection
