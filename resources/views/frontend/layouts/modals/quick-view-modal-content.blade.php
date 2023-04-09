<div class="modal-header">
   <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      <!-- <i class="fas fa-times"></i> -->
   </button>
</div>
@php
    $sell_limit_related_product = $product->sell_limit - productCountInCart($product);
@endphp
<div class="modal-body">
   <div class="ltn__quick-view-modal-inner">
      <div class="modal-product-item">
         <div class="row">
            <div class="col-lg-6 col-12">
               <div class="modal-product-img">
                  <img id="qw-product-image" src="{{ $product->feature_image }}" alt="#">
               </div>
            </div>
            <div class="col-lg-6 col-12">
               <div class="modal-product-info">
                  <div class="product-ratting d-none">
                     <ul>
                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                        <li><a href="#"><i class="far fa-star"></i></a></li>
                        <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                     </ul>
                  </div>
                  <h3 id="qw-product-name">{{ $product->name }}</h3>
                  <div id="qw-product-price" class="product-price">

                  </div>
                  <div class="modal-product-meta ltn__product-details-menu-1">
                     <ul>
                        <li>
                           <strong>Categories:</strong>
                           <span>
                              <a href="#">{{ $product->sub_category?->parent?->group?->name }}</a>
                              <a href="#">{{ $product->sub_category?->parent?->name }}</a>
                              <a href="#">{{ $product->sub_category?->name }}</a>
                           </span>
                        </li>
                     </ul>
                  </div>
                  <div class="text-danger">
                    @if ($product->stock == 0)
                        {{ $product->name }} is currently out of stock !!
                    @endif
                  </div>
                  <div class="ltn__product-details-menu-2 {{ $product->stock == 0 ? "d-none" : '' }}">
                     <ul>
                        <li>
                           <div class="cart-plus-minus-2">
                              <input type="text" value="1" name="qtybutton" class="cart-plus-minus-box-2">
                           </div>
                        </li>
                        @if (productCountInCart($product) !== $product->sell_limit)
                            <li>
                                <a
                                href="{{ customerAuth() ? 'javascript:void(0);' : route('frontend.login').'?redirect='.route('frontend.products.detail', $product->slug) }}"
                                class="theme-btn-1 btn btn-effect-1"
                                title="Add to Cart"
                                onclick="{{ customerAuth() ? 'addToCart(this)' : '' }}"
                                data-add-to-cart-url="{{ route('frontend.products.add-to-cart', $product->id) }}">
                                <i class="fas fa-shopping-cart"></i>
                                <span>ADD TO CART</span>
                                </a>
                            </li>
                        @endif
                     </ul>
                  </div>
                  <div class="ltn__product-details-menu-3">
                     <ul>
                        <li>
                           <a href="#" class="" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
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
                           <a href="{{ shareTo('facebook', url()->full()) }}" target="_blank" title="Facebook">
                              <i class="fab fa-facebook-f"></i>
                           </a>
                        </li>
                        <li>
                           <a href="{{ shareTo('twitter', url()->full(), $product->name) }}" target="_blank" title="Twitter">
                              <i class="fab fa-twitter"></i>
                           </a>
                        </li>
                        <li>
                           <a href="{{ shareTo('linked_in', url()->full(), $product->name) }}" target="_blank" title="Linkedin">
                              <i class="fab fa-linkedin"></i>
                           </a>
                        </li>

                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
    $(document).ready(function () {
        var sell_limit_related_product = Number("{{ $sell_limit_related_product }}");
        $(".cart-plus-minus-2").prepend('<div class="dec qtybtn">-</div>');
        $(".cart-plus-minus-2").append('<div class="inc qtybtn">+</div>');
        $(".qtybtn").on("click", function () {
                var $button = $(this);
                var oldValue = $button.parent().find("input").val();
                if ($button.text() == "+") {
                    if (sell_limit_related_product>oldValue) {
                        var newVal = parseFloat(oldValue) + 1;
                    } else {
                        newVal = oldValue;
                    }
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
