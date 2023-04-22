<?php

use Carbon\Carbon;
use App\Model\Cart;
use App\Model\Order;
use App\Model\Customer;
use App\Model\CategoryGroup;
use Illuminate\Support\Facades\DB;

function splitDateRange($date)
{
    $date_range = explode(" to ", $date);
    $end_date = new DateTime(array_key_exists(1, $date_range) ? $date_range[1] : $date_range[0], new DateTimeZone('Asia/Yangon'));
    $data['to'] = $end_date->modify('+1 day');
    $data['from'] = new DateTime($date_range[0], new DateTimeZone('Asia/Yangon'));
    return $data;
}

function statusBadge($status, $statusType)
{
    if ($statusType == 'ACTIVEORINACTIVE') {
        switch ($status) {
            case 1:
                return '<h5><span class="badge badge-soft-success">Active</span></h5>';
                break;

            case 0:
                return '<h5><span class="badge badge-soft-danger">Inactive</span></h5>';
                break;

            default:
                return;
                break;
        }
    }

    if ($statusType == 'ORDERSTATUS') {
        switch ($status) {
            case Order::PENDING:
                return '<span class="badge badge-warning">Pending</span>';
                break;

            case Order::PROCESSING:
                return '<span class="badge badge-primary">Processing</span>';
                break;

            case Order::COMPLETED:
                return '<span class="badge badge-success">Confirm</span>';
                break;

            case Order::DELIVER:
                return '<span class="badge badge-info">Deliver</span>';
                break;

            case Order::CANCELED:
                return '<span class="badge badge-danger">Canceled</span>';
                break;

            default:
                return;
                break;
        }
    }

    return '<h5><span class="badge badge-info">Unknown</span></h5>';
}

function saveSummernote($module, $description)
{
    libxml_use_internal_errors(true);
    $des = $description;
    $dom = new \domdocument();
    $dom->loadHtml(mb_convert_encoding($des, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $images = $dom->getelementsbytagname('img');

    foreach ($images as $k => $img) {
        $data = $img->getattribute('src');

        if (substr($img->getattribute('src'), 0, 4) != 'http') {
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $upload_path = public_path().'/upload/'. $module .'/'.date("Y") . '/' . date("m");

            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0775, true);
            }

            $path = $upload_path.'/'.$image_name;
            file_put_contents($path, $data);

            $img->removeattribute('src');
            $img->setattribute('src', url('/').'/upload/'. $module .'/'.date("Y") . '/' . date("m").'/'.$image_name);
        }
    }

    $des = $dom->savehtml();

    return $des;
}

function customerAuth()
{
    $customer_id = session('customerId');
    if (session('customerId')) {
        $customer = Customer::active()->where('id', $customer_id)->get()->first();
        if ($customer) {
            return $customer;
        }
    }

    return null;
}

function ordersFilter($query, $request)
{
    if ($request->search) {
        $keyword = $request->search;
        $query = $query->whereHas('customer', function ($q) use ($keyword) {
            $q->where('name', 'like', "%$keyword%");
        })->orWhere('id', $keyword);
    }
    if ($request->filter) {
        $date = splitDateRange($request->filter);
        $query = $query->whereBetween('created_at', [ $date['from'], $date['to'] ]);
    }
    if ($request->status) {
        $query = $query->where('status', $request->status);
    }
    return $query;
}



function getDiscount($sale_price, $discount_amount, $discount_type)
{
    if ($discount_type == "PERCENT") {
        $discount = ($sale_price / 100) * $discount_amount;
    } else {
        $discount = $discount_amount;
    }

    return $discount;
}

function getMenuCategories()
{
    $category_groups = CategoryGroup::has('mainCategories')->with('mainCategories.childCategories')->active()->orderBy('sorting', 'asc')->get();

    return $category_groups;
}

function getCartDetails()
{
    $customerId = session('customerId');
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

    $data['subtotal'] = number_format($sub_total);//string to
    // dd($data);
    return $data;
}

function shareTo($platform, $link, $title = '')
{
    switch ($platform) {
        case 'facebook':
            $shareable_link = 'https://www.facebook.com/sharer/sharer.php?u='.$link;
            break;
        case 'twitter':
            $shareable_link = "http://twitter.com/intent/tweet?text=$title".$link;
            break;
        case 'linked_in':
            $shareable_link = "https://www.linkedin.com/shareArticle?url=$link&title=$title";
            break;
        default:
            $shareable_link = '#';
            break;
    }

    return $shareable_link;
}

function calculateCouponAmount($totalCart, $coupon)
{
    $coupon_amount = $coupon->type == 'percent' ? $totalCart * ($coupon->amount/100) : $coupon->amount;
    return $coupon_amount;
}

function productCountInCart($product){
    $cart_products = getCartDetails()['products'];
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

function orderedCountPdt($product){
    $customerId = session('customerId');
    $ordered_pdt = DB::table('product_user')->where([
        'user_id' => $customerId,
        'product_id' => $product->id
    ])->first();
    if ($ordered_pdt && $ordered_pdt->ordered && Carbon::now()->startOfDay() <= $ordered_pdt->exp_date) {
        return $ordered_pdt->quantity;
    }
    return 0;
}

