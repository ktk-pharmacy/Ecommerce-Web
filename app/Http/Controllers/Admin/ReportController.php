<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\Product;
use App\Model\Category;
use App\Model\CategoryGroup;
use App\Model\OrderProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    
    public function monthlysalereport(Request $request)
    {
        $query = Order::query();

        if ($request->hasAny(['search', 'status', 'filter'])) {
          
            $query = ordersFilter($query, $request);
        }
       
      
        $orders = $query->with('customer')->whereMonth('created_at', Carbon::now()->month)->groupBy('customer_id','payment_method','Month')->orderBy('total', 'DESC')->selectRaw('DATE_FORMAT(created_at,"%M") as Month,customer_id,payment_method,sum(order_total+delivery_charge) as total')->paginate(10);
        // $orders = $query->with('customer')->groupBy('id')->sum('order_total')->get();
        //  dd($orders);
        //  die();
        return view('admin.report.monthlysalereport', compact('orders'))->with('index', (request()->input('page', 1) - 1) * 10);
    }


    public function topcategorysalereport(Request $request)
    {

        // var_dump(Carbon::now()->month('%M'));
    //    dd($request);
        // die();
        $order = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
        ->join('order_products', 'orders.id', '=', 'order_products.order_id')
        ->join('products', 'products.id', '=', 'order_products.product_id')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->join('category_groups', 'category_groups.id', '=', 'categories.parent_id')
        ->select('customers.name As customername', DB::raw('SUM(order_products.quantity) as totalQty'),DB::raw('SUM(order_total+delivery_charge) as totalamount'),DB::raw('DATE_FORMAT(orders.created_at,"%M") as Month'),'category_groups.name as categoryGroup','categories.name as categoryName','categories.parent_id as parentId' )
        ->whereMonth('orders.created_at', Carbon::now()->month)
        ->orWhere( function($query) use ($request)
                {
                    $query->when($request, function ($query, $request) {
                        $date = splitDateRange($request->filter);
                        if($date !=null)
                        {
                            return $query->whereBetween('orders.created_at', [ $date['from'], $date['to']]);    
                        }
                        elseif ($request->search) {

                            $keyword = $request->search;
                            // var_dump($keyword);
                            // die();
                            $query = $query->whereHas('customer', function ($q) use ($keyword) {
                                $q->where('name', 'like', "%$keyword%");
                            })->Where('id', $keyword);
                        }
                        elseif ($request->status) {
                            $query = $query->where('status', $request->status);
                        }
                        else{
                            return $query ->whereMonth('orders.created_at', Carbon::now()->month);
                        }
                    }) ;
                
                })
        
        ->groupBy('customers.name','categoryGroup','categoryName','parentId','orders.created_at')
        ->latest('orders.created_at')
        ->paginate(10);

        return view('admin.report.Topsalescategory', compact('order'))->with('topsalescategory', (request()->input('page', 1) - 1) * 10);
    }

}
