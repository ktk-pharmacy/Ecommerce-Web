<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Post;
use App\Model\Term;
use App\Traits\GenerateSlug;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use GenerateSlug;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::with('terms', 'author')->publish()->latest()->get();
        $posts_count = $posts->count();

        return view('admin.blogs.index', compact('posts', 'posts_count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $terms = Term::publish()->get();
        return view('admin.blogs.create', compact('terms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->helperPost($request);
        $data['slug'] = $this->generateSlug($data['name'], 'posts');     // Generate Blog Unique Slug

        $post = Post::create($data);
        $post->terms()->attach($data['terms']);

        return redirect()->route('admin.blogs.index')->with('success', 'Successfully created blog!');
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
        $post = Post::with('author', 'terms')->findOrFail($id);
        $terms = Term::publish()->get();
        return view('admin.blogs.edit', compact('post', 'terms'));
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
        $post = Post::findOrFail($id);
        $data = $this->helperPost($request);
        $post->terms()->sync($data['terms']);
        $post->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Successfully updated blog!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->update([
            'status' => false,
            'deleted_at' => now()
        ]);

        return redirect()->back()->with('success', 'Successfully deleted blog!');
    }

    public function helperPost($request)
    {
        $data = $request->all();
        $data['description'] = saveSummernote('blog', $data['description']);
        $data['user_id'] = auth()->user()->id;
        $data['status'] = $request->status ? true : false;

        if ($request->hasFile('feature_image')) {
            $fileName = time().'.'.$request->feature_image->extension();
            $path = Post::UPLOAD_PATH . "/" . date("Y") . "/" . date("m") . "/";
            $request->feature_image->move(public_path($path), $fileName);
            $data['feature_image'] = $path . $fileName;
        }

        return $data;
    }
}
