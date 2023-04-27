<?php

namespace App\Http\Controllers\Api\v2;

use Carbon\Carbon;
use App\Model\Cart;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartCollection;

class CartController extends Controller
{
    public function store(Request $request, $product_id)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:0|not_in:0',
            'add_to_cart' => 'required|boolean'
        ]);

        $customerId = $request->user()->id;
        $product = Product::active()->findOrFail($product_id);

        $limit_err = [
            'message' => 'fail',
            'sell_limit' => $product->sell_limit
        ];
        $arr = [
            'user_id' => $customerId,
            'product_id' => $product->id
        ];
        $ordered_pdt = DB::table('product_user')->where($arr)->first();
        if ($request->add_to_cart) {
            $existCartProduct = Cart::where([
                'customer_id' => $customerId,
                'product_id' => $product->id
            ])->first();

            if ($existCartProduct) {
                $total_qty = $existCartProduct->quantity + $request->quantity;
                if ($ordered_pdt) {
                    $ordered_pdt->ordered ? $all_total_qty = $existCartProduct->quantity + $ordered_pdt->quantity + $request->quantity:$all_total_qty = $total_qty;
                    if (Carbon::now()->startOfDay()->toDateString() > $ordered_pdt->exp_date) {
                        DB::table('product_user')->where($arr)->delete();
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
                    if (Carbon::now()->startOfDay()->toDateString() > $ordered_pdt->exp_date) {
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
        } else{
            $cartProduct = Cart::where([
                'customer_id' => $customerId,
                'product_id' => $product_id
            ])->firstOrFail();

            $existCartProduct = Cart::where([
                'customer_id' => $customerId,
                'product_id' => $product->id
            ])->first();

            if ($cartProduct->quantity > $request->quantity && $cartProduct->quantity != 1) {
                $cartProduct->decrement('quantity', $request->quantity);
                if ($existCartProduct) {
                    $qty = $existCartProduct->quantity - $request->quantity;
                    DB::table('product_user')
                        ->where('id', $ordered_pdt->id)
                        ->update([
                            'quantity' => $qty
                        ]);
                }
            } else {
                $cartProduct->delete();
                if ($existCartProduct) {
                    DB::table('product_user')
                        ->where('id', $ordered_pdt->id)
                        ->delete();
                }
            }
        }
        $carts = $this->getCart($request);

        return response()->success('Success!', 200, $carts);
    }

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

    private function getCart(Request $request)
    {
        $carts = Cart::has('product')->with('product')->where('customer_id', $request->user()->id)->get();
        $data = CartCollection::collection($carts);
        return $data;
    }
}
