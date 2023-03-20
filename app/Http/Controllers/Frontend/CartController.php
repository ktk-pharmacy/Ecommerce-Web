<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Product;
use App\Model\Wishlist;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = getCartDetails();
        // dd($cart);
        return view('frontend.cart-wishlist.cart', compact('cart'));
    }

    public function update(Request $request)
    {
        $customerId = session('customerId');

        foreach ($request->cart_products as $product_id => $value) {
            Cart::where([
                'customer_id' => $customerId,
                'product_id' => $product_id
            ])->update([
                'quantity' => $value['quantity']
            ]);
        }
        return redirect()->back()->with('success', 'Successfully updated!');
    }

    public function addToCart(Request $request, $id)
    {
        $customerId = session('customerId');

        try {
            $existCartProduct = Cart::where([
                'customer_id' => $customerId,
                'product_id' => $id
            ])->increment('quantity', $request->quantity);

            if (!$existCartProduct) {
                $product = Product::active()->findOrFail($id);

                Cart::create([
                    'customer_id' => $customerId,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity
                ]);
            }

            $carts = getCartDetails();

            return response()->json([
                'message' => 'Success',
                'carts' => $carts,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Product not found"
            ], 404);
        }
    }

    public function removeFromCart($id)
    {
        $customerId = session('customerId');

        try {
            Cart::where([
                'customer_id' => $customerId,
                'product_id' => $id
            ])->delete();

            $carts = getCartDetails();

            return response()->json([
                'message' => 'Success',
                'carts' => $carts,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Product not found"
            ], 404);
        }
    }

    public function addToWishlist($id)
    {
        $customerId = session('customerId');

        try {
            $existWishlistProduct = Wishlist::where([
                'customer_id' => $customerId,
                'product_id' => $id
            ])->first();
            $message = '<i class="fa fa-exclamation-circle"></i><span>Already added to wishlist!</span>';

            if (!$existWishlistProduct) {
                $product = Product::active()->findOrFail($id);

                Wishlist::create([
                    'customer_id' => $customerId,
                    'product_id' => $product->id
                ]);

                $message = '<i class="fa fa-exclamation-circle"></i><span>Successfully added to wishlist.</span>';
            }

            return response()->json([
                'success' => true,
                'message' => $message
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => "Product not found"
            ], 404);
        }
    }

    public function wishlist()
    {
        $customerId = session('customerId');
        $wishlists = Wishlist::has('product')->with('product')->where('customer_id', $customerId)->get();

        return view('frontend.cart-wishlist.wishlist', compact('wishlists'));
    }

    public function removeFromWishlist($id)
    {
        $customerId = session('customerId');

        try {
            Wishlist::where([
                'customer_id' => $customerId,
                'product_id' => $id
            ])->delete();
            $wishlist_count = Wishlist::has('product')->where('customer_id', $customerId)->count();

            return response()->json([
                'message' => 'Success',
                'wishlist_count' => $wishlist_count
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Product not found"
            ], 404);
        }
    }
}
