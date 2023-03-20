<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Order;
use App\Model\Product;
use App\Model\Customer;
use App\Model\OrderProduct;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Helpers\CustomerAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function myaccount()
    {
        $customerId = session('customerId');
        $customer = Customer::active()->where('id', $customerId)->get()->first();
        $orders = Order::where('customer_id', $customerId)->get();
        return view('frontend.auth.account', compact('customer', 'orders'));
    }

    public function myorderdetail($id){
        $order = Order::with('customer', 'delivery_information', 'products')->findOrFail($id);

        return view('frontend.orders.orderdetail',compact('order'));
    }

    public function updateMyAccount(Request $request)
    {
        $requestData = $request->all();

        $rules = [
            "name" => "required",
            "email" => "required|email",
            "contact_phone_no" => "required",
            "birthday" => "required",
            "gender" => "required",
            "billing_address" => "required",
            "shipping_address" => "required",
        ];

        $customerId = session('customerId');
        $customer = Customer::findOrFail($customerId);

        if ($request->current_password) {
            if (!Hash::check($request->current_password, $customer->password)) {
                return redirect()->back()->withInput($request->input())->with('error', 'The password you entered is hi!');
            }

            $rules['password'] = 'required';
            $rules['confirm_password'] = 'required|same:password';

            $requestData['password'] = Hash::make($requestData['password']);
        } else {
            $requestData = Arr::except($requestData, array('password'));
        }

        $request->validate($rules);

        $customer->update($requestData);
        return redirect()->back()->with('success', 'Successfully updated!');
    }

    public function deactivateMyaccount(Customer $id){
        $id->update(['status'=>false]);
        CustomerAuth::logout();
        session()->put('success','Your Account is successfully deactivated!');
        return response()->json(['status'=>'success'],201);
    }

    public function deleteMyaccount(Customer $id){
        $id->update(['status'=>2]);
        CustomerAuth::logout();
        session()->put('success','Your Account is deleted!');
        return response()->json(['status'=>'success'],201);
    }
}
