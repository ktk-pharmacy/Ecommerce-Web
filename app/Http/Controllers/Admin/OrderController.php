<?php

namespace App\Http\Controllers\Admin;

use App\Model\Order;
use App\Model\Product;
use App\DeliveryCharge;
use App\Model\Location;
use App\Model\Logistic;
use App\Mail\OrderStatus;
use App\Traits\SendSMSTrait;
use Illuminate\Http\Request;
use App\Model\DeliveryInformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    use SendSMSTrait;
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->hasAny(['search', 'status', 'filter'])) {
            $query = ordersFilter($query, $request);
        }

        $orders = $query->with('customer')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'))->with('index', (request()->input('page', 1) - 1) * 10);
    }

    public function edit($id)
    {
        $order = Order::with('customer', 'delivery_information', 'products', 'coupon')->findOrFail($id);
        $order_status = [
            Order::PENDING,
            Order::PROCESSING,
            Order::COMPLETED,
            Order::DELIVER,
            Order::CANCELED
        ];
        $cities = Location::where('parent_id',null)->get();
        if ($order->status != "PENDING") {
            unset($order_status[0]);
        }
        $logistics = Logistic::with('township')->where('city_id',$order->delivery_information->city)->get();
        return view('admin.orders.edit', compact('order', 'order_status','cities','logistics'));
    }

    public function update(Request $request, $id)
    {
        $requestData = $request->only('delivery_charge', 'status', 'cancel_remark','delivery_ref_no','delivery_type');

        $order = Order::with('products.product')->findOrFail($id);
        $delivery_info = DeliveryInformation::findOrFail($order->delivery_information_id);
        $requestData['status'] = $requestData['status'] ?? "Processing";
        if ($requestData['status'] == Order::CANCELED || $requestData['status'] == Order::COMPLETED) {
            foreach ($order->products as $order_product) {
                $qty = $order_product->quantity;
                if ($requestData['status'] == Order::CANCELED) {
                    $order_product->product->increment('stock', $qty);
                    Mail::to($order->customer->username)->send(new OrderStatus('Canceled'));
                }
                if ($requestData['status'] == Order::COMPLETED) {
                    $order_product->product->increment('sold_count', $qty);
                    // if (filter_var($order->customer->username, FILTER_VALIDATE_EMAIL)) {
                    //     //Send OTP by Mail
                    //     Mail::to($order->customer->username)->send(new OrderStatus('Confirm'));
                    // } else {
                    //     $msg = "Your Order is Confirm. Please wait for Deliver.";
                    //     //Send OTP by SMS
                    //     $result = $this->sendBySMSPoh($order->customer->username, $msg);
                    //     $resultArr = json_decode($result, true);

                    //     if (!$resultArr['status']) {
                    //         return redirect()->back()->with('error','Something went wrong while sending sms');
                    //     }
                    // }
                }
            }
        }
        $requestData['delivery_type'] = $requestData['delivery_type'] ?? $order->delivery_type;
        $order->update($requestData);

        $delivery_info->update([
            'city'=>$request->city?? $delivery_info->city,
            'township'=>$request->township?? $delivery_info->township,
            'billing_address'=>$request->billing_address,
            'shipping_address'=>$request->shipping_address,
            'order_note'=>$request->order_note
        ]);
        return redirect()->route('admin.orders.index')->with('success', 'Successfully updated.');
    }

    public function detail($id)
    {
        $order = Order::with('customer', 'delivery_information', 'products')->findOrFail($id);

        return view('admin.orders.detail', compact('order'));
    }

    public function deliveryDetail($id){
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
    public function getTownshipView($id){
        $logistics = Logistic::with('township')->where('city_id',$id)->get();
        return view('admin.orders.township-select', compact('logistics'));
    }
}
