<?php

namespace App\Http\Controllers\Api\v1;

use Carbon\Carbon;
use App\Model\Cart;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::select('products.id', 'products.name', 'products.feature_image', 'products.sale_price', 'products.stock', 'products.uom', 'products.net_weight', 'products.gross_weight', 'products.sold_count', 'products.is_new', 'products.discount_amount', 'products.discount_type', 'products.discount_from', 'products.discount_to', DB::raw('CASE WHEN discount_amount IS NOT NULL AND discount_from <= CURDATE() AND DATE_SUB(discount_to, INTERVAL 1 DAY) >= CURDATE() then 1 Else NULL end as promotion'), DB::raw('CASE WHEN discount_type = "PERCENT" then TRIM((sale_price/100) * discount_amount)+0 else discount_amount END as discount'))->publish()->get();

        return response()->success('Success!', 200, $data);
    }

    public function show($id,Request $request)
    {
        $customer = $request->user();
        $product = Product::with('brand', 'sub_category.parent.group', 'galleries')->findOrFail($id);
        $data = new ProductResource($product);
        $sell_limit = $product->sell_limit - $this->productCountInCart($product,$customer->id) - orderedCountPdtMain($customer->id,$product->id);
        $product->sell_limit==Null?$data["sell_limit"] = "unlimit":$data["sell_limit"] = $sell_limit;

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

    private function productCountInCart($product,$id){
        $cart_products = getCartDetailsMain($id)['products'];
        if ($cart_products) {
            $same_with_param_product = collect($cart_products)->filter(function ($data) use($product) {
                return $data['id'] == $product->id;
            });
            foreach ($same_with_param_product as $p) {
                return $p['cart_quantity'];
            }
        }
        return 0;
    }
}
