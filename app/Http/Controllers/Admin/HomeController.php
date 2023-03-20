<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\CategoryGroup;
use App\Model\Customer;
use App\Model\Order;
use App\Model\OrderProduct;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        $request->filter ? $date = splitDateRange($request->filter) : $date = null;

        $orders = Order::status(Order::COMPLETED,Order::DELIVER)->when($date, function ($query, $date) {
            return $this->whereBetweenDate($query, $date);
        })->get();

        $products = Product::publish()->when($date, function ($query, $date) {
            return $this->whereBetweenDate($query, $date);
        })->get();

        $customers = Customer::when($date, function ($query, $date) {
            return $this->whereBetweenDate($query, $date);
        })->get();

        // sale_analytics_by_month chart
        $orders_analytics_by_month = Order::select(DB::raw('MONTHNAME(created_at) as month, YEAR(created_at) as year,
        SUM(case when status in ("Confirm","Completed","Deliver") then 1 else 0 end) as Completed,
        SUM(case when status="Canceled" then 1 else 0 end) as Canceled,
        SUM(case when status in ("Confirm","Completed","Deliver") then order_total else 0 end) as total_revenue'))
        ->when($date, function ($query, $date) {
            return $query->whereBetween('created_at', [ $date['from'], $date['to'] ]);
        })
        ->groupBy('year','month')->get();

        // category_groups_analytics_by_month chart
        $products_analytics_by_month = OrderProduct::has('completeOrder')
        ->join('orders', 'order_products.order_id', '=', 'orders.id')
        ->select(DB::raw(
            'MONTHNAME(orders.created_at) as month, YEAR(orders.created_at) as year,
            SUM(orders.order_total) as total_revenue,
            SUM(order_products.quantity) as total_products'))
        ->when($date, function ($query, $date) {
            return $query->whereBetween('order_products.created_at', [ $date['from'], $date['to'] ]);
        })
        ->groupBy('year','month')
        ->get();
        $category_groups_analytics_by_month = [];
        foreach ($products_analytics_by_month as $key => $data) {
            $to =date_create("$data->year-$data->month");
            date_modify($to,"last day of this month");
            if ($date) {
                $a_date = $date;
            } else {
                $a_date = [
                    "from" => date_create("$data->year-$data->month"),
                    "to" => $to
                ];
            }
            $top_category_groups_by_month = $this->reportQuery('category_groups.name AS label', 'category_groups.name', $a_date);
            array_push($category_groups_analytics_by_month,[
                "month"=> $data->month,
                "year" => $data->year,
                "total_revenue" => $data->total_revenue,
                "total_sale_products" => $data->total_products,
                "top_category_groups" => $top_category_groups_by_month
            ]);
        }
        // Top Category
        $top_categories = $this->reportQuery('main_categories.name AS label', 'main_categories.name', $date);
        // dd($top_categories->toArray());
        // Top Brand
        $top_brands = $this->reportQuery('brands.name AS label', 'brands.name', $date);
        // Top Product
        $top_products = $this->reportQuery('products.name AS label', 'products.name', $date);
        // Top Customer
        $top_customers = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
        ->join('order_products', 'orders.id', '=', 'order_products.order_id')
        ->when($date, function ($query, $date) {
            return $query->whereBetween('order_products.created_at', [ $date['from'], $date['to'] ]);
        })
        ->select('customers.name As label', DB::raw('SUM(order_products.quantity) as value'))
        ->whereIn('orders.status',[Order::COMPLETED,Order::DELIVER])
        ->groupBy('customers.name')
        ->get();
        /////sold category

        $top_customers = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
        ->join('order_products', 'orders.id', '=', 'order_products.order_id')
        ->join('products', 'orders.id', '=', 'order_products.order_id')
        ->when($date, function ($query, $date) {
            return $query->whereBetween('order_products.created_at', [ $date['from'], $date['to'] ]);
        })
        ->select('customers.name As label', DB::raw('SUM(order_products.quantity) as value'))
        // ->where('orders.status', Order::COMPLETED)
        ->whereIn('orders.status',[Order::COMPLETED,Order::DELIVER])
        ->groupBy('customers.name')
        ->get();

        return view('admin.dashboard', compact('orders', 'products', 'customers', 'category_groups_analytics_by_month' , 'orders_analytics_by_month', 'top_categories', 'top_brands', 'top_products', 'top_customers'));
    }

    public function whereBetweenDate($query, $date)
    {
        return $query->whereBetween('created_at', [ $date['from'], $date['to'] ]);
    }

    public function reportQuery($select_name, $group_by, $date)
    {
        $data = OrderProduct::has('completeOrder')
        ->join('orders', 'order_products.order_id', '=', 'orders.id')
        ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->join('products', 'order_products.product_id', '=', 'products.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('categories as sub_categories', 'products.category_id', '=', 'sub_categories.id')
        ->join('categories as main_categories', 'sub_categories.parent_id', '=', 'main_categories.id')
        ->join('category_groups', 'main_categories.category_group_id','=','category_groups.id')
        ->select($select_name, DB::raw('SUM(order_products.quantity) as value'))
        ->when($date, function ($query, $date) {
            return $query->whereBetween('order_products.created_at', [ $date['from'], $date['to'] ]);
        })
        ->groupBy($group_by)
        ->get();

        return $data;
    }
}
