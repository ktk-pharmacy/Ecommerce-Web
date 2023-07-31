<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\CategoryGroup;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $category_id = $request->category;
        $price_range = explode("~", $request->price);
        $sorting = $request->sorting;

        $products = Product::when($search, function ($q, $search) {
            $q->whereHas('sub_category', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })->orWhereHas('sub_category.parent', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })->orWhereHas('brand', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })->orwhere('name', 'like', "%$search%")->orWhere('price', 'like', "%$search%");
        })->when($category_id, function ($q, $category_id) {
            $q->orWhereHas('sub_category.parent', function ($query) use ($category_id) {
                $query->where('id', $category_id);
            })->orwhere('category_id', $category_id);
        })->when($request->price, function ($q) use ($price_range) {
            $q->whereBetween('sale_price', $price_range);
        })->when($sorting, function ($q) use ($sorting) {
            if ($sorting == 'asc') {
                return $q->orderBy('sale_price', 'asc');
            } else {
                return $q->orderBy('sale_price', 'desc');
            }
        })->publish()->latest()->paginate(12)->withQueryString();

        $main_categories = Category::has('categoryProducts')->with(['childs' => function ($q) {
            $q->has('products');
        }])->get();

        if ($request->group) {
            $products = Product::whereHas('sub_category.parent.group', function ($query) use ($request) {
                $query->where('id', $request->group);
            })->publish()->latest()->paginate(12)->withQueryString();
            $main_categories = CategoryGroup::find($request->group)->mainCategories;
        }

        if ($request->brand) {
            $products = Product::where('brand_id',$request->brand)->publish()->latest()->paginate(12)->withQueryString();
            return view('frontend.products.productlist-brand', compact('products', 'main_categories'));
        }

        return view('frontend.products.productlist', compact('products', 'main_categories'));
    }

    public function detail($slug)
    {
        $product = Product::with('galleries', 'sub_category.parent')->where('slug', $slug)->firstOrFail();

        $category = Category::with('products')->findOrFail($product->category_id);
        $top_related_products = $category->products()->limit(config('custom_value.related_product_limit'))->get()->except($product->id);

        $category = Category::with('categoryProducts')->findOrFail($product->sub_category->parent_id);
        $related_products = $category->categoryProducts()->limit(config('custom_value.related_product_limit'))->get()->except($product->id);


        return view('frontend.products.detail', compact('product', 'top_related_products', 'related_products'));
    }

    public function quickView($id)
    {
        $product = Product::with('sub_category.parent.group')->findOrFail($id);

        return view('frontend.layouts.modals.quick-view-modal-content', compact('product'));
    }
}
