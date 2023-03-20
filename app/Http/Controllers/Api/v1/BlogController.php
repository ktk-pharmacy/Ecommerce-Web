<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogCollection;
use App\Http\Resources\BlogResource;
use App\Model\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('terms', 'author')->publish()
         ->when($request->search, function ($q, $search) {
             $q->whereHas('terms', function ($query) use ($search) {
                 $query->where('name', 'like', "%$search%");
             })->orwhere('name', 'like', "%$search%");
         })
        ->when($request->category_id, function ($q, $category_id) {
            $q->WhereHas('terms', function ($query) use ($category_id) {
                $query->where('term_id', $category_id);
            });
        })->latest()->get();

        $data = BlogCollection::collection($posts);

        return response()->success('Success!', 200, $data);
    }

    public function show($id)
    {
        $post = Post::with('terms', 'author')->findOrFail($id);
        $post->increment('view_count');

        $data = new BlogResource($post);

        return response()->success('Success!', 200, $data);
    }
}
