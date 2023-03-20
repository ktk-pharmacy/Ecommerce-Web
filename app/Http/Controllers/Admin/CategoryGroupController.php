<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\CategoryGroup;
use Illuminate\Http\Request;

class CategoryGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:categorygroup-list');
        $this->middleware('permission:categorygroup-create', ['only' => ['create','store']]);
        $this->middleware('permission:categorygroup-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:categorygroup-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category_groups = CategoryGroup::publish()->orderBy('sorting', 'asc')->get();

        return view('admin.category-groups.index', compact('category_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|max:100',
            'category_group_image' => 'required|mimes:jpg,jpeg,png,JPG,JPEG,PNG|max:1024',
            'sorting' => 'required'
        ]);
        $data = $this->helperCategoryGroup($request);

        CategoryGroup::create($data);

        return redirect()->back()->with('success', 'Successfully created!');
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
        $this->validate($request, [
            'name' => 'required|max:100',
            'sorting' => 'required'
        ]);

        $category_group = CategoryGroup::findOrFail($id);

        $data = $this->helperCategoryGroup($request);
        $category_group->update($data);

        return redirect()->back()->with('success', 'Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CategoryGroup::findOrFail($id)->update([
            'status' => false,
            'deleted_at' => now()
        ]);

        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    public function helperCategoryGroup($request)
    {
        $data['name'] = $request->name;
        $data['sorting'] = $request->sorting;
        $data['status'] = $request->status ? true : false;

        if ($request->hasFile('category_group_image')) {
            $fileName = time().'.'.$request->category_group_image->extension();
            $path = CategoryGroup::UPLOAD_PATH . "/" . date("Y") . "/" . date("m") . "/";
            $request->category_group_image->move(public_path($path), $fileName);
            $data['image_url'] = $path . $fileName;
        }

        return $data;
    }
}
