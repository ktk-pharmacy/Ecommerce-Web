<?php

namespace App\Imports;

use App\Model\Category;
use App\Model\CategoryGroup;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class CategoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $category_group = CategoryGroup::where('name',$row['category_group'])->first();
        return new Category([
           'name' => $row['name'],
           'category_group_id' => $category_group->id,
           'status' => 1,
           'deleted_at' => null
        ]);
    }
}
