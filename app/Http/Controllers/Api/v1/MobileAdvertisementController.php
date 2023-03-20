<?php

namespace App\Http\Controllers\Api\v1;

use App\MobileAdsVideo;
use Illuminate\Http\Request;
use App\Model\MobileAdvertisement;
use App\Http\Controllers\Controller;

class MobileAdvertisementController extends Controller
{
    public function index(Request $request)
    {

        if ($request->type == MobileAdvertisement::SLIDER) {
            $data = MobileAdvertisement::select('reference_id', 'reference_type', 'image_url')->publish()->type($request->type)->orderBy('sorting')->get();
        } elseif ($request->type == MobileAdsVideo::VIDEO) {
            $data = MobileAdsVideo::select('reference_id', 'reference_type', 'video_url')->publish()->type($request->type)->orderBy('sorting')->get();
        }
        return response()->success('Success!', 200, $data);
    }
}
