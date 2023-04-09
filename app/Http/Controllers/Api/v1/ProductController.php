<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Model\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::select('products.id', 'products.name', 'products.feature_image', 'products.sale_price', 'products.stock', 'products.uom', 'products.net_weight', 'products.gross_weight', 'products.sold_count', 'products.is_new', 'products.discount_amount', 'products.discount_type', 'products.discount_from', 'products.discount_to', DB::raw('CASE WHEN discount_amount IS NOT NULL AND discount_from <= CURDATE() AND DATE_SUB(discount_to, INTERVAL 1 DAY) >= CURDATE() then 1 Else NULL end as promotion'), DB::raw('CASE WHEN discount_type = "PERCENT" then TRIM((sale_price/100) * discount_amount)+0 else discount_amount END as discount'))->publish()->get();

        return response()->success('Success!', 200, $data);
    }

    public function show($id)
    {
        $product = Product::with('brand', 'sub_category.parent.group', 'galleries')->findOrFail($id);
        $data = new ProductResource($product);

        return response()->success('Success!', 200, $data);
    }

    public function showSlug($slug)
    {
        $product = Product::with('brand', 'sub_category.parent.group', 'galleries')->where('slug',$slug)->first();
        $data = new ProductResource($product);
        return response()->success('Success!', 200, $data);
    }

    public function getGalleries($id)
    {
        $galleries = Product::where('products.id', $id)->join('media', function ($join) {
            $join->on('products.id', '=', 'media.mediable_id')->where('media.mediable_type', Product::class);
        })->select('media.image_url', 'media.mediable_id as product_id')->get();

        return response()->success('Success!', 200, $galleries);
    }
}
