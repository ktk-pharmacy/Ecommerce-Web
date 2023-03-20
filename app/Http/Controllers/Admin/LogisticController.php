<?php

namespace App\Http\Controllers\Admin;

use App\DeliveryCharge;
use App\Http\Controllers\Controller;
use App\Model\Location;
use App\Model\Logistic;
use Illuminate\Http\Request;

class LogisticController extends Controller
{
    public function index()
    {
        $logistics = Logistic::with("city", "township")->get();

        return view('admin.logistics.index', compact('logistics'));
    }

    public function create()
    {
        $locations = Location::child()->with('region')->whereDoesntHave('logistic')->get();

        return view('admin.logistics.create', compact('locations'));
    }

    public function store(Request $request)
    {

        $location =  explode(",", $request->location);

        $data = $request->all();
        $data['township_id'] = $location[0];
        $data['city_id'] = $location[1];

        $logistic = Logistic::create($data);

        foreach ($request->delivery_charges as $key => $value) {
            DeliveryCharge::create([
                'logistic_id' => $logistic->id,
                'type' => $key,
                'amount' => (int)$value
            ]);
        }

        return redirect()->route('admin.logistics.index')->with('success', 'Successfully created!');
    }

    public function edit($id)
    {
        $logistic = Logistic::with('deliveryCharges')->findOrFail($id);

        if ($logistic->deliveryCharges->count() < count(config('custom_value.delivery_types'))) {
            $delivery_types = config('custom_value.delivery_types');

            foreach ($delivery_types as $delivery_type) {
                if (!$logistic->deliveryCharges->firstWhere('type', $delivery_type)) {
                    DeliveryCharge::create([
                        'logistic_id' => $logistic->id,
                        'amount' => 0,
                        'type' => $delivery_type,
                    ]);
                }
            }
        }
        $logistic->load('deliveryCharges');

        $locations = Location::child()->with('region')->get();

        return view('admin.logistics.edit', compact('logistic', 'locations'));
    }

    public function update(Request $request, $id)
    {
        $logistic = Logistic::findOrFail($id);
        $logistic->update([
            'min_order_total' => $request->min_order_total,
            'area_description' => $request->area_description,
            'type' => $request->type,
        ]);

        foreach ($request->delivery_charges as $key => $value) {
            DeliveryCharge::findOrFail($key)->update([
                'amount' => $value
            ]);
        }


        return redirect()->route('admin.logistics.index')->with('success', 'Successfully updated!');
    }

    public function destroy($id)
    {
        Logistic::findOrFail($id)->delete();
        return redirect()->route('admin.logistics.index')->with('success', 'Successfully deleted!');
    }
}
