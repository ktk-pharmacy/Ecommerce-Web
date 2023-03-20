<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Traits\GenerateSlug;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use GenerateSlug;

    public function __construct()
    {
        $this->middleware('permission:brand-list');
        $this->middleware('permission:brand-create', ['only' => ['create','store']]);
        $this->middleware('permission:brand-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:brand-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::publish()->latest()->get();
        return view('admin.brands.index', compact('brands'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand_image' => 'required|mimes:jpg,jpeg,png,JPG,JPEG,PNG|max:1024',
        ]);

        $data = $this->helperBrand($request);
        $data['slug'] = $this->generateSlug($request->name, 'brands');
        Brand::create($data);
        
        return redirect()->back()->with('success', 'Successfully created brand!');
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
        $request->validate([
            'name' => 'required',
        ]);

        $data = $this->helperBrand($request);

        $brand = Brand::findOrFail($id);
        //Regenerate slug if name is changed
        if ($brand->name != $request->name) {
            $data['slug'] = $this->generateSlug($request->name, 'brands');
        }

        $brand->update($data);
        
        return redirect()->back()->with('success', 'Successfully updated brand!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::findOrFail($id)->update([
            'status' => false,
            'deleted_at' => now()
        ]);

        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    public function helperBrand($request)
    {
        $data['name'] = $request->name;
        $data['status'] = $request->status ? true : false;

        if ($request->hasFile('brand_image')) {
            $fileName = time().'.'.$request->brand_image->extension();
            $path = Brand::UPLOAD_PATH . "/" . date("Y") . "/" . date("m") . "/";
            $request->brand_image->move(public_path($path), $fileName);
            $data['image_url'] = $path . $fileName;
        }

        return $data;
    }
}
