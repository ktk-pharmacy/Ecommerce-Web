<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromCollection, WithHeadings, WithMapping {
    function __construct(protected $products){

    }
    public function headings(): array
    {
        return [
            'Name',
            'Brand',
            'Category',
            'Description',
            'Detail',
            'Other Information',
            ' Price ',
            'Sale_Price',
            'Stock',
            'Net Weight',
            'Gross Weight',
            'UOM',
            'Sell Limit',
            'Status',
        ];
    }

    public function map($item): array
    {

        return [
            $item->name,
            $item->brand->name,
            $item->sub_category->name,
            strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$item->description)),
            strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$item->detail)),
            strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$item->other_information)),
            $item->price,
            $item->sale_price ,
            $item->stock,
            $item->net_weight,
            $item->gross_weight,
            $item->uom,
            $item->sell_limit?$item->sell_limit:'Unlimit',
            $item->status == 1?'Acitve':'Deleted',
        ];
    }

    public function collection()
    {
        return $this->products;

    }
}
