<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\LogisticCollection;
use App\Model\Logistic;
use Illuminate\Http\Request;

class LogisticController extends Controller
{
    public function index()
    {
        $logistics = Logistic::with('city', 'township', 'deliveryFees')->get();
        $data = LogisticCollection::collection($logistics);

        return response()->success('Success!', 200, $data);
    }
}
