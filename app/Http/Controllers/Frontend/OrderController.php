<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailResource;
use App\Model\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $customer_id = $request->user()->id;
        $orders = Order::where('customer_id', $customer_id)
        ->when($request->has('status'), function ($q) use ($request) {
            return $q->where('status', $request->status);
        })->latest()->select('id as order_id', 'order_total', 'created_at', 'status')->get();

        return response()->success('Success!', 200, $orders);
    }

    public function show(Request $request, $id)
    {
        $customer_id = $request->user()->id;
        $orders = Order::with('customer', 'orderProducts.product')->where([
            'id' => $id,
            'customer_id' => $customer_id
        ])->firstOrFail();

        $data = new OrderDetailResource($orders);

        return response()->success('Success!', 200, $data);
    }
}
