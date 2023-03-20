<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Model\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $locations = Location::parent()->with('townships')
        ->when($request->region_id, function ($q) use ($request) {
            return $q->where('id', $request->region_id);
        })->get();

        return response()->success('Success!', 200, $locations);
    }
}
