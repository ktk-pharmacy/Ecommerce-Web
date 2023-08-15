<?php

namespace App\Imports;

use App\Model\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MainCategoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $mainCategory = Category::where('name',$row['main_category'])->first();
        return new Category([
            'name' => $row['name'],
            'parent_id' => $mainCategory->id,
            'status'=>1,
            'deleted_at' => null
        ]);
    }
}
