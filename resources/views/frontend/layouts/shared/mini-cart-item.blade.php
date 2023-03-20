
@foreach ($cart_detail['products'] as $cart_product)
<div class="mini-cart-item clearfix">
    <div class="mini-cart-img">
        <a href="{{ route('frontend.products.detail', $cart_product['slug']) }}">
        <img src="{{ $cart_product['feature_image'] }}" alt="Image">
        </a>
        <span class="mini-cart-item-delete" onclick="removeCart(this)"
        data-remove-cart-url="{{ route('frontend.products.remove-from-cart', $cart_product['id']) }}">
        <i class="icon-cancel"></i>
        </span>
    </div>
    <div class="mini-cart-info">
        <h6>
        <a href="{{ route('frontend.products.detail', $cart_product['slug']) }}">
            {{ $cart_product['name'] }}
        </a>
        </h6>
        <span class="mini-cart-quantity">{{ $cart_product['cart_quantity'] }} x {{ $cart_product['price'] }}</span>
    </div>
</div>
@endforeach