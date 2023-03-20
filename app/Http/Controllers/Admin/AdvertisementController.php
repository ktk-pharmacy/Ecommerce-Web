<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function __construct(Request $request)
    {
        if (php_sapi_name() != 'cli') {
            $_type = $request->route()->parameter('type');

            if (!$this->isValidType($_type)) {
                abort(404);
            }
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        if ($type == Advertisement::SLIDER) {
            $view = 'admin.advertisements.sliders.index';
            $data = Advertisement::publish()->type(Advertisement::SLIDER)->orderBy('sorting')->get();
        } else {
            $view = 'admin.advertisements.sidebars.index';
            $data = Advertisement::publish()->type($type)->orderBy('sorting')->get();
        }

        return view($view, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        if ($type == Advertisement::SLIDER) {
            return view('admin.advertisements.sliders.create');
        }

        if ($type == Advertisement::LEFT_SIDEBAR) {
            return view('admin.advertisements.sidebars.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $type)
    {
        $data = $request->all();
        $data['status'] = $request->has('status');
        $data['type'] = $type;

        $path = Advertisement::UPLOAD_PATH . "/" . $type . "/" . date("Y") . "/" . date("m") . "/";

        if ($request->hasFile('image')) {
            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path($path), $fileName);
            $data['image_url'] = $path . $fileName;
        }

        Advertisement::create($data);
        return redirect()->route('admin.ads.index', $type)->with('success', 'Successfully created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $type, $id)
    {
        $ads = Advertisement::findOrFail($id);

        if ($type == Advertisement::SLIDER) {
            return view('admin.advertisements.sliders.edit', compact('ads'));
        }

        return view('admin.advertisements.sidebars.edit', compact('ads'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type, $id)
    {
        $data = $request->all();
        $data['status'] = $request->has('status');
        $data['type'] = $type;

        $path = Advertisement::UPLOAD_PATH . "/" . $type . "/" . date("Y") . "/" . date("m") . "/";

        if ($request->hasFile('image')) {
            $fileName = time().'.'.$request->image->extension();
            $request->image->move(public_path($path), $fileName);
            $data['image_url'] = $path . $fileName;
        }

        Advertisement::findOrFail($id)->update($data);
        return redirect()->route('admin.ads.index', ['type' => $request->type])->with('success', 'Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($type, $id)
    {
        Advertisement::findOrFail($id)->update([
            'status' => false,
            'deleted_at' => now()
        ]);

        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    public function updateAdvertisementStatus($type, $id)
    {
        try {
            $ads = Advertisement::findOrFail($id);
            $ads->status = +!$ads->status;
            $ads->update();

            $data['status'] = 'success';
            $data['msg'] = 'Successfully updated!';
            return $data;
        } catch (\Throwable $th) {
            $data['status'] = 'error';
            $data['msg'] = 'Sometime went wrong!';
            return $data;
        }
    }

    public function isValidType($type)
    {
        return in_array($type, Advertisement::TYPES);
    }
}
