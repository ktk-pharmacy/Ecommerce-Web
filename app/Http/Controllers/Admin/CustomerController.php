<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('completedOrders')->latest()->get();

        return view('admin.customers.index', compact('customers'));
    }

    public function show($id)
    {
        $customer = Customer::with(['orderProducts' => function ($q) {
            $q->where('orders.status', 'Completed');
        }, 'orderProducts.product'])->findOrFail($id);

        return view('admin.customers.show', compact('customer'));
    }
}
