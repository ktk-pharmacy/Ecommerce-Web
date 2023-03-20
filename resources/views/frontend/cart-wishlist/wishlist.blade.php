@extends('frontend.layouts.master', ['title' => 'Wishlist'])
@section('css')
    <style>
        .shoping-cart-table td
        {
            padding: 20px 5px !important;
        }
    </style>
@endsection
@section('main-content')

<!-- WISHLIST AREA START -->
<div class="liton__wishlist-area mb-105 {{ count($wishlists) ? '' : 'd-none' }}">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="shoping-cart-inner">
               <div class="shoping-cart-table table-responsive">
                  <table class="table">
                     <!-- <thead>
                                    <th class="cart-product-remove">X</th>
                                    <th class="cart-product-image">Image</th>
                                    <th class="cart-product-info">Title</th>
                                    <th class="cart-product-price">Price</th>
                                    <th class="cart-product-quantity">Quantity</th>
                                    <th class="cart-product-subtotal">Subtotal</th>
                        </thead> -->
                     <tbody>
                        @foreach ($wishlists as $wishlist)
                            <tr>
                              <td
                                 class="cart-product-remove"
                                 style="width: 10px;"
                                 onclick="removeWishlist(this)"
                                 data-remove-wishlist-url={{ route('frontend.products.remove-from-wishlist', $wishlist->product->id) }}
                                 >
                                 x
                              </td>
                              <td class="cart-product-image">
                                 <a class="mx-auto" href="{{ route('frontend.products.detail', $wishlist->product->slug) }}">
                                    <img src="{{ $wishlist->product->feature_image }}" alt="#">
                                 </a>
                              </td>
                              <td class="cart-product-info" >
                                 <h4>
                                    <a href="{{ route('frontend.products.detail', $wishlist->product->slug) }}">
                                       {{ $wishlist->product->name }}
                                    </a>
                                 </h4>
                              </td>
                              <td class="cart-product-price">MMK{{ $wishlist->product->discount ?? $wishlist->product->sale_price }}</td>
                              <td class="cart-product-stock">@if ($wishlist->product->stock == 0)
                                  <small class="text-danger">{{ $wishlist->product->name }} is currently out of stock !!</small>
                              @else
                              In Stock
                              @endif</td>
                              <td class="cart-product-add-cart  {{ $wishlist->product->stock == 0?'d-none':"" }}" >
                                 <a
                                    href="javascript:void(0);"
                                    class="submit-button-1 float-lg-end"
                                    title="Add to Cart"
                                    onclick="addToCart(this)"
                                    data-add-to-cart-url="{{ route('frontend.products.add-to-cart', $wishlist->product->id) }}"
                                    >
                                    Add to Cart
                                 </a>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- WISHLIST AREA START -->

<!-- CALL TO ACTION START (call-to-action-6) -->
<div class="ltn__call-to-action-area no-wishlist-action-area call-to-action-6 before-bg-bottom {{ count($wishlists) ? 'd-none' : '' }}" data-bs-bg="img/1.jpg--">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
               <div class="coll-to-info text-color-white">
                  <h1>There is no products <br> in your wishlist.</h1>
               </div>
               <div class="btn-wrapper">
                  <a class="btn btn-effect-3 btn-white" href="{{ route('frontend.home') }}">Explore Products <i class="icon-next"></i></a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- CALL TO ACTION END -->
@endsection
