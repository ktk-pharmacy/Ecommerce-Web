<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Model\CategoryGroup;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryGroup::with('mainCategories.childCategories')->active()->orderBy('sorting', 'asc')->get();

        return response()->success('Success!', 200, $categories);
    }

    public function getProductsByCategory($id)
    {
        $products = Product::join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('categories as sub_category', 'products.category_id', '=', 'sub_category.id')
        ->join('categories as main_category', 'sub_category.parent_id', '=', 'main_category.id')
        ->join('category_groups', 'main_category.category_group_id', '=', 'category_groups.id')
        ->select('products.id as product_id', 'products.name', 'products.feature_image', 'products.sale_price', 'products.stock', 'products.uom', 'products.net_weight', 'products.gross_weight', 'products.sold_count', 'products.is_new', 'products.discount_amount', 'products.discount_type', 'products.discount_from', 'products.discount_to', DB::raw('CASE WHEN discount_type = "PERCENT" then TRIM((sale_price/100) * discount_amount)+0 ELSE discount_amount END as discount'))->WhereHas('sub_category.parent', function ($query) use ($id) {
            $query->where('id', $id);
        })->orWhere('category_id', $id)->get();

        return response()->success('Success!', 200, $products);
    }
}
