<div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu" id="cart">
   <div class="ltn__utilize-menu-inner ltn__scrollbar">
      <div class="ltn__utilize-menu-head">
         <span class="ltn__utilize-menu-title">Cart</span>
         <button class="ltn__utilize-close">×</button>
      </div>
      <div class="mini-cart-product-area ltn__scrollbar">
         @if (count($cart_detail['products']))
            @foreach ($cart_detail['products'] as $cart_product)
               <div class="mini-cart-item clearfix">
                  <div class="mini-cart-img">
                     <a href="{{ route('frontend.products.detail', $cart_product['slug']) }}">
                        <img src="{{ $cart_product['feature_image'] }}" alt="Image">
                     </a>
                     @if (!Route::is('frontend.cart'))
                         <span class="mini-cart-item-delete" onclick="removeCart(this)"
                           data-remove-cart-url="{{ route('frontend.products.remove-from-cart', $cart_product['id']) }}">
                           <i class="icon-cancel"></i>
                        </span>
                     @endif
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
         @endif
      </div>
      <h4 id="no-cart-item" class="{{ count($cart_detail['products']) > 0 ? 'd-none' : '' }}">
         There is no items in your cart!
      </h4>
      <div class="mini-cart-footer {{ count($cart_detail['products']) == 0 ? 'd-none' : '' }}">
         <div class="mini-cart-sub-total">
            <h5>Subtotal: <span class="cart-subtotal">{{ $cart_detail['subtotal'] }}</span></h5>
         </div>
         <div class="btn-wrapper">
            <a href="{{ route('frontend.cart') }}" class="theme-btn-1 btn btn-effect-1">View Cart</a>
            <a href="{{ route('frontend.checkout') }}" class="theme-btn-2 btn btn-effect-2">Checkout</a>
         </div>
         {{-- <p>Free Shipping on All Orders Over $100!</p> --}}
      </div>

   </div>
</div>
