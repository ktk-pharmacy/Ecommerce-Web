<?php

namespace App\Imports;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Support\Str;
use App\Traits\GenerateSlug;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    use GenerateSlug;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function sheets(): array
    {
        return [
            'Products' => $this
        ];
    }

    public function model(array $row)
    {
        $brand = Brand::where('slug',Str::slug($row['brand'], '-'))->first();
        $category = Category::where('name',$row['category'], '-')->first();
        return new Product([
            'name' => $row['name'],
            'feature_image' => 'assets/theme/img/sayaid2.png',
            'slug' => $this->generateSlug($row['name'], 'products'),
            'brand_id' => $brand?$brand->id:158,
            'category_id' => $category?$category->id:196,
            'description' => $row['description']??null,
            'price' => $row['price']??null,
            'sale_price' => $row['sale_price']??null,
            'discount_amount' => $row['discount_amount']??null,
            'discount_type' => $row['discount_type']??null,
            'discount_from' => $row['discount_from']??null,
            'discount_to' => $row['discount_to']??null,
            'stock' => $row['stock']??30,
            'uom' => $row['uom']??'Each',
            'product_detail' => $row['product_detail']??null,
            'other_information' => $row['other_information']??null,
            'is_new' => $row['is_new'] ?? false,
        ]);
    }
}
