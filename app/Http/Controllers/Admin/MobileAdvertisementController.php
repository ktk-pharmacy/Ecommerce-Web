<?php

namespace App\Http\Controllers\Admin;

use App\Model\Product;
use App\MobileAdsVideo;
use Illuminate\Http\Request;
use App\Model\MobileAdvertisement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class MobileAdvertisementController extends Controller
{
    public function index($type)
    {
        if ($type == MobileAdvertisement::SLIDER) {
            $view = 'admin.mobile-advertisements.sliders.index';
            $data = MobileAdvertisement::publish()->type(MobileAdvertisement::SLIDER)->orderBy('sorting')->get();
        }
        elseif ($type == MobileAdsVideo::VIDEO){
            $view = 'admin.mobile-advertisements.videos.index';
            $data = MobileAdsVideo::publish()->type(MobileAdsVideo::VIDEO)->orderBy('sorting')->get();
        }

        return view($view, compact('data'));
    }

    public function create($type)
    {
        $products = Product::select('id', 'name')->publish()->active()->latest()->get();

        if ($type == MobileAdvertisement::SLIDER) {
            $view = 'admin.mobile-advertisements.sliders.create';
        } elseif ($type == MobileAdsVideo::VIDEO) {
            $view = 'admin.mobile-advertisements.videos.create';
        }
        return view($view, compact('products'));
    }

    public function store(Request $request, $type)
    {
        $data = $this->helperMobileAdvertisement($request, $type);
        if ($type == MobileAdvertisement::SLIDER) {
            MobileAdvertisement::create($data);
        } elseif ($type == MobileAdsVideo::VIDEO) {
            MobileAdsVideo::create($data);
        }

        return redirect()->route('admin.mobile-ads.index', $type)->with('success', 'Successfully created!');
    }

    public function edit(Request $request, $type, $id)
    {

        $products = Product::select('id', 'name')->publish()->active()->latest()->get();
        if ($type == MobileAdvertisement::SLIDER) {
            $ads = MobileAdvertisement::findOrFail($id);
            $view = 'admin.mobile-advertisements.sliders.edit';
        }
        elseif ($type == MobileAdsVideo::VIDEO) {
            $ads = MobileAdsVideo::findOrFail($id);
            $view = 'admin.mobile-advertisements.videos.edit';
        }

        return view($view, compact('ads', 'products'));
    }

    public function update(Request $request, $type, $id)
    {
        $data = $this->helperMobileAdvertisement($request, $type);
        if ($type == MobileAdvertisement::SLIDER) {
            MobileAdvertisement::findOrFail($id)->update($data);

        } elseif ($type == MobileAdsVideo::VIDEO) {
            MobileAdsVideo::findOrFail($id)->update($data);
        }
        return redirect()->route('admin.mobile-ads.index', $type)->with('success', 'Successfully created!');
    }

    public function destroy($type, $id)
    {
        if ($type == MobileAdvertisement::SLIDER) {
            MobileAdvertisement::findOrFail($id)->update([
                'status' => false,
                'deleted_at' => now()
            ]);
        } elseif ($type == MobileAdsVideo::VIDEO) {
            MobileAdsVideo::findOrFail($id)->update([
                'status' => false,
                'deleted_at'=>now()
            ]);
        }

        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    public function updateAdvertisementStatus($type, $id)
    {
        try {
            if ($type == MobileAdvertisement::SLIDER) {
                $ads = MobileAdvertisement::findOrFail($id);
                $ads->status = +!$ads->status;
                $ads->update();
            } elseif ($type == MobileAdsVideo::VIDEO) {
                $ads = MobileAdsVideo::findOrFail($id);
                $ads->status = +!$ads->status;
                $ads->update();
            }

            $data['status'] = 'success';
            $data['msg'] = 'Successfully updated!';
            return $data;
        } catch (\Throwable $th) {
            $data['status'] = 'error';
            $data['msg'] = 'Sometime went wrong!';
            return $data;
        }
    }

    private function helperMobileAdvertisement($request,$type){
        $data = $request->all();
        $data['status'] = $request->has('status');
        $data['type'] = $type;
        if ($type == MobileAdvertisement::SLIDER) {
            if ($request->hasFile('image')) {
                $path = MobileAdvertisement::UPLOAD_PATH . "/" . $type . "/" . date("Y") . "/" . date("m") . "/";
                $fileName = time().'.'.$request->image->extension();
                $request->image->move(public_path($path), $fileName);
                $data['image_url'] = $path . $fileName;
            }
        } elseif ($type == MobileAdsVideo::VIDEO) {
            if ($request->hasFile('video')) {
                $path = MobileAdsVideo::UPLOAD_PATH . "/" . $type . "/" . date("Y") . "/" . date("m") . "/";
                $fileName = time().'.'.$request->file('video')->extension();
                $request->file('video')->move(public_path($path), $fileName);
                $data['video_url'] = $path . $fileName;
            }
        }
        return $data;
    }
}
