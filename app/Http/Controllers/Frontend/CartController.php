<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Model\Cart;
use App\Model\Product;
use App\Model\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
            $qty = $value['quantity'];
            $product = Product::findOrFail($product_id);
            $arr = [
                'user_id' => $customerId,
                'product_id' => $product->id
            ];
            $ordered_pdt = DB::table('product_user')->where($arr)->first();
            $cart_item = Cart::where([
                'customer_id' => $customerId,
                'product_id' => $product_id
            ])->first();
            if ($ordered_pdt) {
                if ($ordered_pdt->ordered) {
                    $qty = $ordered_pdt->quantity + $value['quantity'];
                }
                if (Carbon::now()->startOfDay() > $ordered_pdt->exp_date) {
                    DB::table('product_user')->where($arr)->delete();
                    if ($product->sell_limit >= $value['quantity']) {
                        $cart_item->quantity = $value['quantity'];
                        $cart_item->save();

                        DB::table('product_user')->insert([
                            'user_id' => $customerId,
                            'product_id' => $product->id,
                            'quantity' => $value['quantity'],
                            'exp_date' => Carbon::now()->startOfDay()
                        ]);
                    } else {
                        return redirect()->back()->with('error', "$product->name can be order $product->sell_limit daily!");
                    }
                } elseif ($qty <= $product->sell_limit) {
                    $cart_item->quantity = $value['quantity'];
                    $cart_item->save();
                    DB::table('product_user')->where($arr)->update([
                        'quantity' => $qty
                    ]);
                } else {
                    return redirect()->back()->with('error', "$product->name can be order $product->sell_limit daily!");
                }
            } else {
                // if ($product->sell_limit >= $value['quantity'] || $product->sell_limit == Null) {
                $cart_item->quantity = $value['quantity'];
                $cart_item->save();
                // } else {
                //     return redirect()->back()->with('error', "Quantity is over existing!");
                // }
            }
        }
        return redirect()->back()->with('success', 'Successfully updated!');
    }

    public function addToCart(Request $request, $id)
    {
        $customerId = session('customerId');
        $product = Product::active()->findOrFail($id);
        $limit_err = [
            'message' => 'fail',
            'sell_limit' => $product->sell_limit
        ];
        $arr = [
            'user_id' => $customerId,
            'product_id' => $product->id
        ];
        $ordered_pdt = DB::table('product_user')->where($arr)->first();
        try {
            $existCartProduct = Cart::where([
                'customer_id' => $customerId,
                'product_id' => $id
            ])->first();

            if ($existCartProduct) {
                if ($ordered_pdt) {
                    $total_qty = $existCartProduct->quantity + $request->quantity;
                    $all_total_qty = $total_qty;
                    if ($ordered_pdt->ordered) {
                        $all_total_qty = $existCartProduct->quantity + $ordered_pdt->quantity + $request->quantity;
                    }
                    if (Carbon::now()->startOfDay() > $ordered_pdt->exp_date) {
                        DB::table('product_user')->where($arr)->delete();
                        $total_qty = $existCartProduct->quantity + $request->quantity;
                        if ($product->sell_limit == Null || $total_qty <= $product->sell_limit) {
                            Cart::findOrFail($existCartProduct->id)
                                ->update([
                                    'quantity' => $total_qty
                                ]);
                            DB::table('product_user')->insert([
                                'user_id' => $customerId,
                                'product_id' => $product->id,
                                'quantity' => $total_qty,
                                'exp_date' => Carbon::now()->startOfDay()
                            ]);
                        } else {
                            return response()->json($limit_err, 200);
                        }
                    } elseif ($all_total_qty <= $product->sell_limit) {
                        Cart::findOrFail($existCartProduct->id)
                            ->update([
                                'quantity' => $total_qty
                            ]);
                        DB::table('product_user')->where($arr)->update([
                            'quantity' => $total_qty
                        ]);
                    } else {
                        return response()->json($limit_err, 200);
                    }
                } else {
                    $total_qty = $existCartProduct->quantity + $request->quantity;
                    if ($product->sell_limit == Null || $total_qty <= $product->sell_limit) {
                        Cart::findOrFail($existCartProduct->id)
                            ->update([
                                'quantity' => $total_qty
                            ]);
                    } else {
                        return response()->json($limit_err, 200);
                    }
                }
            } else {
                if ($ordered_pdt) {
                    $total_qty = $ordered_pdt->quantity + $request->quantity;
                    if (Carbon::now()->startOfDay() > $ordered_pdt->exp_date) {
                        DB::table('product_user')->where($arr)->delete();
                        $this->createCartAndProductUser($customerId, $product->id, $request->quantity, $product);
                    } elseif ($total_qty <= $product->sell_limit) {
                        Cart::create([
                            'customer_id' => $customerId,
                            'product_id' => $product->id,
                            'quantity' => $request->quantity
                        ]);

                        DB::table('product_user')->where($arr)->update([
                            'quantity' => $total_qty
                        ]);
                    } else {
                        return response()->json($limit_err, 200);
                    }
                } else {
                    $this->createCartAndProductUser($customerId, $product->id, $request->quantity, $product);
                }
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

    /**
     * Creates a Cart and a ProductUser record in the database.
     *
     * @param int $customerId The ID of the customer.
     * @param int $productId The ID of the product.
     * @param int $quantity The quantity of the product.
     * @param collection $product The product of $productId
     * @return void
     */
    private function createCartAndProductUser($customerId, $productId, $quantity, $product)
    {
        Cart::create([
            'customer_id' => $customerId,
            'product_id' => $productId,
            'quantity' => $quantity
        ]);

        if ($product->sell_limit) {
            DB::table('product_user')->insert([
                'user_id' => $customerId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'exp_date' => Carbon::now()->startOfDay()
            ]);
        }
    }

    public function removeFromCart($id)
    {
        $customerId = session('customerId');
        $arr = [
            'customer_id' => $customerId,
            'product_id' => $id
        ];
        $ordered_pdt = DB::table('product_user')->where([
            'user_id' => $customerId,
            'product_id' => $id
        ])->first();

        $existCartProduct = Cart::where($arr)->first();

        try {
            Cart::where($arr)->delete();
            if ($ordered_pdt) {
                if ($ordered_pdt->ordered) {
                    DB::table('product_user')
                        ->where('id', $ordered_pdt->id)
                        ->update([
                            'quantity' => $ordered_pdt->quantity - $existCartProduct->quantity
                        ]);
                } else {
                    DB::table('product_user')
                        ->where('id', $ordered_pdt->id)
                        ->delete();
                }
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
