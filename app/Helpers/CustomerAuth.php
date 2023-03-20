<?php

namespace App\Helpers;

use App\Model\Customer;

class CustomerAuth
{
    public static function login(Customer $customer)
    {
        session()->put('LoggedIn', true);
        session()->put('customerId', $customer->id);
        session()->put('customerName', $customer->name);
        $customer->status==false?$customer->update(['status'=>true]):$customer;
    }

    public static function logout()
    {
        session()->forget([
            'LoggedIn',
            'customerId',
            'customerName'
        ]);
    }

    public static function auth()
    {
        $customer_id = session('customerId');
        if (session('customerId')) {
            return Customer::findOrFail($customer_id);
        }

        return false;
    }
}
