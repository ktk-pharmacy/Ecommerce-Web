<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {

        $keys = $request->except('_token');

        if ($request->hasFile('frontend_banner')) {
            $keys['frontend_banner']=$this->fileStorage($request,'frontend_banner');
        }
        if ($request->hasFile('frontend_campaing')) {
            $keys['frontend_campaing'] = $this->fileStorage($request,'frontend_campaing');
        }
        if ($request->hasFile('bonous_1_img')) {
            $keys['bonous_1_img'] = $this->fileStorage($request,'bonous_1_img');
        }
        if ($request->hasFile('bonous_2_img')) {
            $keys['bonous_2_img'] = $this->fileStorage($request,'bonous_2_img');
        }
        if ($request->hasFile('bonous_3_img')) {
            $keys['bonous_3_img'] = $this->fileStorage($request,'bonous_3_img');
        }
        if ($request->hasFile('bonous_4_img')) {
            $keys['bonous_4_img'] = $this->fileStorage($request,'bonous_4_img');
        }
        if ($request->hasFile('bonous_5_img')) {
            $keys['bonous_5_img'] = $this->fileStorage($request,'bonous_5_img');
        }
        if ($request->hasFile('bonous_6_img')) {
            $keys['bonous_6_img'] = $this->fileStorage($request,'bonous_6_img');
        }
        foreach ($keys as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->back()->with('success', 'Successfully updated!');
    }

    private function fileStorage($request,$key){
        $path = Setting::UPLOAD_PATH . "/" . date("Y") . "/" . date("m") . "/";
        $fileName = uniqid().time().'.'.$request->file($key)->extension();
        $request->file($key)->move(public_path($path), $fileName);
        return ($path . $fileName);
    }
}
