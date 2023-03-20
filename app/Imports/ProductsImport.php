<?php

namespace App\Imports;

use App\Model\Product;
use App\Traits\GenerateSlug;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductsImport implements ToModel, WithHeadingRow, WithMultipleSheets
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
        // dd($row);
        return new Product([
            'name' => $row['name'],
            'slug' => $this->generateSlug($row['name'], 'products'),
            'brand_id' => $row['brand_id'],
            'category_id' => $row['sub_category_id'],
            'description' => $row['description'],
            'price' => $row['price'],
            'sale_price' => $row['sale_price'],
            'discount_amount' => $row['discount_amount'],
            'discount_type' => $row['discount_type'],
            'discount_from' => $row['discount_from'],
            'discount_to' => $row['discount_to'],
            'stock' => $row['stock'],
            'uom' => $row['uom'],
            'is_new' => $row['is_new'] ? true : false,
        ]);
    }
}
