<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Post;
use App\Model\Term;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Post::with('author', 'terms')->publish()->latest()
        ->when($request->search, function ($q, $search) {
            $q->whereHas('terms', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })->orwhere('name', 'like', "%$search%");
        })
        ->when($request->category_id, function ($q, $category_id) {
            $q->WhereHas('terms', function ($query) use ($category_id) {
                $query->where('term_id', $category_id);
            });
        });
        $popular_blogs = collect($blogs->get())->sortByDesc('view_count')->slice(0, 4)->values();
        $latest_blogs = $blogs->paginate(5);

        $terms = Term::withCount('posts')->publish()->latest()->get();

        return view('frontend.blogs.index', compact('latest_blogs', 'popular_blogs', 'terms'));
    }

    public function show($slug)
    {
        $blog = Post::with('terms', 'author')->publish()->where('slug', $slug)->firstOrFail();
        $blog->increment('view_count');

        $terms = Term::withCount('posts')->publish()->latest()->get();
        $related_blogs = Post::whereHas('terms', function ($q) use ($blog) {
            $q->whereIn('term_id', $blog->terms->pluck('id'));
        })->publish()->get()->except($blog->id);

        return view('frontend.blogs.show', compact('blog', 'terms', 'related_blogs'));
    }
}
