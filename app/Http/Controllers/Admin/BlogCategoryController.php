<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Post;
use App\Model\Term;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:blog-category-list');
        $this->middleware('permission:blog-category-create', ['only' => ['create','store']]);
        $this->middleware('permission:blog-category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:blog-category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $terms = Term::withCount('publishPosts')->publish()->latest()->get();

        return view('admin.blog-categories.index', compact('terms'));
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
            'name' => 'required|max:100'
        ]);

        Term::create($request->all());
        return redirect()->back()->with('success', 'Successfully created blog category!');
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
            'name' => 'required|max:100'
        ]);

        Term::findOrFail($id)->update($request->only('name'));
        return redirect()->back()->with('success', 'Successfully updated blog category!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == 1) {
            return redirect()->back()->with('error', "Can't delete default blog category");
        }
        
        $term = Term::findOrFail($id);
        $term->update([
            'deleted_at' => now()
        ]);
        $term->posts()->detach();

        $posts = Post::doesnthave('terms')->get();      //get posts that doesn't have any terms
        if ($posts) {
            Term::findOrFail(1)->posts()->attach($posts);       //attach with Uncategoried to posts that doesn't have terms
        }
        
        return redirect()->back()->with('success', 'Successfully deleted blog category!');
    }
}
