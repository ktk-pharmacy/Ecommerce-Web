<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:coupon-list');
        $this->middleware('permission:coupon-create', ['only' => ['create','store']]);
        $this->middleware('permission:coupon-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.coupons.index', );
    }

    public function ajaxDatatable(Request $request)
    {
        $date = null;

        if (isset($request->filter) && $request->filter !== 'undefined') {
            $date = splitDateRange($request->filter);
        }

        $coupons = Coupon::withCount('orders')->publish()->when($date, function ($query, $date) {
            return $query->whereDate('from', '>=', $date['from'])->whereDate('to', '<=', $date['to']);
        })->get();

        return response()->json([
            'data' => $coupons
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required_if:generate_coupon_name,true|unique:coupons'
        ]);
        
        $requestData = $request->all();

        $date = splitDateRange($requestData['valid_date']);
        $requestData['from'] = $date['from'];
        $requestData['to'] = $date['to'];

        if (isset($requestData['generate_coupon_name'])) {
            for ($i=0; $i < $requestData['coupon_quantity']; $i++) {
                $requestData['name'] = Str::random(8);
                Coupon::create($requestData);
            }

            return redirect()->route('admin.coupons.index')->with('success', 'Successfully generated!');
        }

        Coupon::create($requestData);
        return redirect()->route('admin.coupons.index')->with('success', 'Successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Coupon::findOrFail($id)->update([
            'status' => false,
            'deleted_at' => now()
        ]);

        return redirect()->back()->with('success', 'Successfully deleted!');
    }
}
