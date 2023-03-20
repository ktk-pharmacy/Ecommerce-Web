<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Coupon;
use App\Model\Customer;
use App\Model\DeliveryInformation;
use App\Model\Order;
use App\Model\Product;
use App\Traits\ValidityCoupon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    use ValidityCoupon;

    public function checkout(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'contact_phone_no' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'billing_address' => 'required',
        ]);

        $customer_id = $request->user()->id;

        $carts = Cart::has('product')->with('product')->where('customer_id', $request->user()->id)->get();

        if (!count($carts)) {
            return response()->error("Empty cart!", 422, ['carts' => ['There is no products in your cart!']]);
        }

        try {
            $order_total = 0;
            $order_products = [];
            $cart_ids = [];
            $product_ids = [];

            foreach ($carts as $cart) {
                if ($cart->product->stock >= $cart->quantity) {
                    $sale_price = $cart->product->sale_price;
                    $order_product_total = ($cart->product->discount ?? $cart->product->sale_price) * $cart->quantity;

                    $discount_amount = $cart->product->discount ? $cart->product->discount_amount : null;
                    $discount_type = $cart->product->discount ? $cart->product->discount_type : null;
                    $discount_total = $cart->product->discount ? getDiscount($sale_price, $discount_amount, $discount_type) * $cart->quantity : null;
                    
                    $order_products[] = [
                        'product_id' => $cart->product_id,
                        'price' => $cart->product->price,
                        'sale_price' => $sale_price,
                        'quantity' => $cart->quantity,
                        'discount_amount' => $discount_amount,
                        'discount_type' => $discount_type,
                        'discount_total' => $discount_total,
                        'order_product_total' => $order_product_total,
                    ];

                    $cart_ids[] = $cart->id;
                    $product_ids[] = $cart->product_id;

                    $order_total += $order_product_total;
                } else {
                    return response()->error($cart->product->name . "' quantity is over existing!", 422);
                }
            }

            $delivery_info = DeliveryInformation::create([
                'name' => $request->name,
                'contact_phone_no' => $request->contact_phone_no,
                'city' => $request->city,
                'township' => $request->township,
                'billing_address' => $request->billing_address,
                'shipping_address' => $request->shipping_address,
                'order_note' => $request->order_note
            ]);

            $requestData = $request->all();
            $requestData['customer_id'] = $customer_id;
            $requestData['order_total'] = $order_total;
            $requestData['status'] = Order::PENDING;
            $requestData['delivery_information_id'] = $delivery_info->id;

            if ($request->coupon) {
                $coupon = $this->checkCoupon($request->coupon, $order_total, $customer_id);
                if ($coupon->status() != 200) {
                    return $coupon;
                }
                $requestData['coupon_id'] = $coupon->getData()->data->id;
            }
            
            $order = Order::create($requestData);
            $order->products()->createMany($order_products);

            Customer::findOrFail($customer_id)->update([
                'name' => $requestData['name'],
                'email' => $requestData['email'],
                'contact_phone_no' => $requestData['contact_phone_no'],
                'gender' => $requestData['gender'],
                'billing_address' => $requestData['billing_address'],
                'shipping_address' => $requestData['shipping_address'],
                'birthday' => $requestData['birthday'],
                'order_note' => $requestData['order_note'],
            ]);

            foreach ($carts as $cart) {
                $qty = $cart->quantity;
                $cart->product->decrement('stock', $qty);
            }
            Cart::whereIn('id', $cart_ids)->delete();
            
            return response()->success('Success!', 200);
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 404);
        }

        return response()->success('Success!', 200);
    }

    public function validateCoupon(Request $request, $name)
    {
        $request->validate([
            'cart_total' => 'required|numeric'
        ]);

        $customer_id = $request->user()->id;
        $response = $this->checkCoupon($name, $request->cart_total, $customer_id);

        return $response;
    }
}
