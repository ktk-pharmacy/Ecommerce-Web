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
        $sell_limit = $product->sell_limit - $this->productCountInCart($product,$customer->id) - $this->orderedCountPdt($product,$customer->id);
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
        $customerId = $id;
        $sub_total = 0;
        $data['customer_id'] = $customerId;
        $data['total_quantity'] = 0;
        $data['products'] = [];

        $carts = Cart::with('product')->where('customer_id', $customerId)->orderBy('updated_at', 'DESC')->get();

        foreach ($carts as $cart) {
            $products = [];
            $products['id'] = $cart->product->id;
            $products['name'] = $cart->product->name;
            $products['slug'] = $cart->product->slug;
            $products['price'] = $cart->product->discount ?? $cart->product->sale_price;
            $products['cart_quantity'] = $cart->quantity;
            $products['feature_image'] = $cart->product->feature_image;
            $products['stock'] = $cart->product->stock;

            $data['total_quantity'] += $cart->quantity;
            $sub_total += $cart->quantity * $products['price'];
            $data['products'][] = $products;
        }

        $data['subtotal'] = number_format($sub_total);
        $cart_products = $data['products'];
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

    private function orderedCountPdt($product,$id){
        $customerId = $id;
        $ordered_pdt = DB::table('product_user')->where([
            'user_id' => $customerId,
            'product_id' => $product->id
        ])->first();
        if ($ordered_pdt && $ordered_pdt->ordered && Carbon::now()->startOfDay()->toDateString() <= $ordered_pdt->exp_date) {
            return $ordered_pdt->quantity;
        }
        return 0;
    }
}
