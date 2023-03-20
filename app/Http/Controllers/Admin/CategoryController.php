<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\CategoryGroup;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_categories = Category::with('group', 'childs')->onlyParent()->publish()->latest()->get();
        return view('admin.categories.index', compact('main_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = [];

        if ($request->type == 'main-category') {
            $categories = CategoryGroup::publish()->get();
        } elseif ($request->type == 'sub-category') {
            $categories = Category::with('group')->onlyParent()->publish()->get();
        } else {
            abort(404);
        }

        return view('admin.categories.create', compact('categories'));
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
            'category' => 'required'
        ]);

        $requestData['name'] = $request->name;
        $requestData['status'] = $request->status ? true : false;

        if ($request->type == 'main-category') {
            $requestData['category_group_id'] = $request->category;
        } elseif ($request->type == 'sub-category') {
            $requestData['parent_id'] = $request->category;
        } else {
            abort(404);
        }

        Category::create($requestData);
        return redirect()->route('admin.categories.index')->with('success', 'Successfully created!');
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
    public function edit(Request $request, $id)
    {
        $categories = [];
        $category = Category::findOrFail($id);

        if ($request->type == 'main-category') {
            $category_groups = CategoryGroup::publish()->get();

            return view('admin.categories.main-edit', compact('category', 'category_groups'));
        } elseif ($request->type == 'sub-category') {
            $main_categories = Category::onlyParent()->publish()->get();

            return view('admin.categories.sub-edit', compact('category', 'main_categories'));
        } else {
            abort(404);
        }
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

        $requestData = $request->only('name', 'parent_id', 'category_group_id', 'status');
        $requestData['status'] = $request->status ? true : false;

        $category = Category::findOrFail($id);

        $category->update($requestData);
        return redirect()->route('admin.categories.index')->with('success', 'Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->update([
            'status' => false,
            'deleted_at' => now()
        ]);

        return redirect()->back()->with('success', 'Successfully deleted!');
    }
}
