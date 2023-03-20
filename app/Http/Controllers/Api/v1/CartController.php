<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartCollection;
use App\Model\Cart;
use App\Model\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $carts = $this->getCart($request);
        return response()->success('Success!', 200, $carts);
    }

    public function store(Request $request, $product_id)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:0|not_in:0',
            'add_to_cart' => 'required|boolean'
        ]);

        $customer = $request->user();

        try {
            if ($request->add_to_cart) {
                $existCartProduct = Cart::where([
                    'customer_id' => $customer->id,
                    'product_id' => $product_id
                ])->increment('quantity', $request->quantity);

                if (!$existCartProduct) {
                    $product = Product::active()->findOrFail($product_id);

                    Cart::create([
                        'customer_id' => $customer->id,
                        'product_id' => $product->id,
                        'quantity' => $request->quantity
                    ]);
                }
            } else {
                $cartProduct = Cart::where([
                    'customer_id' => $customer->id,
                    'product_id' => $product_id
                ])->firstOrFail();

                if ($cartProduct->quantity > $request->quantity && $cartProduct->quantity != 1) {
                    $cartProduct->decrement('quantity', $request->quantity);
                } else {
                    $cartProduct->delete();
                }
            }

            $carts = $this->getCart($request);

            return response()->success('Success!', 200, $carts);
        } catch (\Throwable $th) {
            return response()->error("Product not found!", 404);
        }
    }

    public function getCart(Request $request)
    {
        $carts = Cart::has('product')->with('product')->where('customer_id', $request->user()->id)->get();
        $data = CartCollection::collection($carts);
        return $data;
    }
}
