<?php

namespace App\Http\Controllers\Admin;

use App\Model\Cart;
use App\Model\Brand;
use App\Model\Media;
use App\Model\Product;
use App\Model\Category;
use App\Traits\GenerateSlug;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderProduct;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    use GenerateSlug;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('galleries', 'brand', 'sub_category.parent')->publish()->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_categories = Category::onlyParent()->publish()->active()->with('childs')->get();
        $brands = Brand::publish()->active()->get();

        return view('admin.products.create', compact('main_categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
            'sale_price' => 'required|gte:price',
            'stock' => 'required',
            'feature_image' => 'required',
        ]);

        $requestData = $this->helperProduct($request);
        $requestData['slug'] = $this->generateSlug($request->name, 'products');

        $product = Product::create($requestData);

        if ($request->hasFile('product_galleries')) {
            $product->galleries()->createMany($requestData['product_galleries']);
        }

        return redirect()->route('admin.products.index')->with('success', 'Successfully created!');
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
        $product = Product::with('galleries', 'brand', 'sub_category.parent')->findOrFail($id);
        if ($product->deleted_at) {
            abort(404);
        }
        $main_categories = Category::onlyParent()->publish()->active()->with('childs')->get();
        $brands = Brand::publish()->active()->get();

        return view('admin.products.edit', compact('product', 'main_categories', 'brands'));
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
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
            'sale_price' => 'required|gte:price',
            'stock' => 'required',
        ]);

        $requestData = $this->helperProduct($request);

        $product = Product::findOrFail($id);
        $product->update($requestData);

        if ($request->hasFile('product_galleries')) {
            $product->galleries()->createMany($requestData['product_galleries']);
        }

        return redirect()->route('admin.products.index')->with('success', 'Successfully created!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::where('product_id',$id)->delete();
        DB::table('product_user')->where('product_id',$id)->delete();
        $orderProducts = OrderProduct::where('product_id',$id)->get();
        if ($orderProducts) {
            foreach ($orderProducts as $item) {
                $order = Order::find($item->order_id);
                $reDefinedPrice = $order->order_total - $item->order_product_total;
                $order->order_total = $reDefinedPrice;
                $order->save();
                OrderProduct::find($item->id)->delete();
            }
        }

        Product::findOrFail($id)->update([
            'status' => false,
            'deleted_at' => now()
        ]);

        return redirect()->back()->with('success', 'Successfully deleted!');
    }

    public function helperProduct($request)
    {
        $data = $request->all();
        $data['is_new'] = $request->is_new ? true : false;

        if ($request->discount_amount) {
            $date = splitDateRange($request->discount_period);
            $data['discount_from'] = $date['from'];
            $data['discount_to'] = $date['to'];
        }


        $path = Product::UPLOAD_PATH . "/" . date("Y") . "/" . date("m") . "/";

        if ($request->hasFile('feature_image')) {
            $fileName = uniqid().time().'.'.$request->feature_image->extension();
            $request->feature_image->move(public_path($path), $fileName);
            $data['feature_image'] = $path . $fileName;
        }

        if ($request->hasFile('product_galleries')) {
            foreach ($request->file('product_galleries') as $key => $file) {
                $file_name = uniqid().time().'.'.$file->extension();

                $data['product_galleries'][$key] = [
                    'image_url' => $path . $file_name,
                    'file_name' => $file_name,
                    'file_path' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_size' => $file->getSize(),
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString(),
                ];

                $file->move(public_path($path), $file_name);
            }
        }

        return $data;
    }

    public function deleteProductMedia($media_id)
    {
        $media = Media::findOrFail($media_id);
        File::delete(public_path($media->image_url));
        $media->delete();

        return redirect()->back();
    }

    public function importForm()
    {
        return view('admin.products.import');
    }

    public function importProducts(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);
        Excel::import(new ProductsImport, $request->file);

        return redirect()->route('admin.products.index')->with('success', 'Successfully imported!');
    }

    public function exportProducts(){
        $products =  Product::all();
        return Excel::download(new ProductsExport($products), 'products.xlsx');
    }
}
