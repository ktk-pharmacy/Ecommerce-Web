<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Cart;
use App\Model\Order;
use App\DeliveryCharge;
use App\Model\Customer;
use App\Model\Location;
use App\Model\Logistic;
use Illuminate\Http\Request;
use App\Helpers\CustomerAuth;
use App\Model\DeliveryInformation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function checkoutForm()
    {
        $customerId = session('customerId');

        if (!$customerId) {
            return redirect()->route('frontend.login')->with('warning', 'Please login!');
        }
        try {
            $carts = Cart::with('product')->where('customer_id', $customerId)->latest()->get();
            $cities = Location::where('parent_id',null)->get();
            return view('frontend.orders.checkout', compact('carts','cities'));
        } catch (\Throwable $th) {
            return redirect()->route('frontend.home')->with('error', 'Something went wrong!');
        }
    }

    public function getTownshipView($id){
        $logistics = Logistic::with('township')->where('city_id',$id)->get();
        return view('frontend.orders.township-select-box', compact('logistics'));
    }

    public function getDeliveryCharge($id){
        $data = [];
        $premiumDeliveryCharges = DeliveryCharge::with('logistic')->onlyPremium()->valid()->get();
        $premiumTownships = [];
        foreach ($premiumDeliveryCharges as $premiumDeliveryCharge) {
            array_push($premiumTownships,$premiumDeliveryCharge->logistic->township_id);
        }
        $logistic = Logistic::with('deliveryCharges')->where('id',$id)->first();
        $data[0]=$premiumTownships;
        $data[1]=$logistic;
        return response()->json($data,200);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'contact_phone_no' => 'required',
            'gender' => 'required',
            'billing_address' => 'required',
            'shipping_address' => 'required',
            'delivery_charge' => 'required',
            'city' => 'required',
            'township'=>'required',
        ]);

        try {
            $carts = Cart::has('product')->with('product')->where('customer_id', session('customerId'))->get();

            $order_total = 0;
            $order_products = [];

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

                    $each_limit_pdt = DB::table('product_user')->where([
                        'user_id'=> session('customerId'),
                        'product_id'=> $cart->product_id
                    ])->first();
                    if ($each_limit_pdt) {
                        $res = DB::table('product_user')
                        ->where('id',$each_limit_pdt->id)
                        ->update([
                            'ordered'=>true
                        ]);
                    }

                    $order_total += $order_product_total;
                    $cart->product()->decrement('stock', $cart->quantity);

                    $cart->delete();
                } else {
                    return redirect()->back()->with('error', $cart->product->name."' quantity is over existing!");
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
            $requestData['customer_id'] = session('customerId');
            $requestData['order_total'] = $order_total;
            $requestData['status'] = Order::PENDING;
            $requestData['delivery_information_id'] = $delivery_info->id;
            $requestData['delivery_charge'] = $request->delivery_charge + $request->extra_gross_weight_charge;

            $order = Order::create($requestData);
            $order->products()->createMany($order_products);

            Customer::findOrFail(session('customerId'))->update([
                'name' => $requestData['name'],
                'email' => $requestData['email'],
                'contact_phone_no' => $requestData['contact_phone_no'],
                'gender' => $requestData['gender'],
                'billing_address' => $requestData['billing_address'],
                'shipping_address' => $requestData['shipping_address'],
                'birthday' => $requestData['birthday'],
                'order_note' => $requestData['order_note'],
            ]);

            return redirect()->route('frontend.home')->with('success', 'Successfully checkout.');
        } catch (\Throwable $th) {
            return redirect()->back()
                        ->withInput($request->input())
                        ->with('error', $th->getMessage());
        }
    }
}
