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

class ProductsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents, WithStyles {
    function __construct(protected $products){

    }
    public function headings(): array
    {
        return [
            'Name',
            'Brand',
            'Category',
            'Description',
            ' Price ',
            'Sale_Price',
            'status',
            ' Image ',
        ];
    }

    public function map($item): array
    {

        return [
            $item->name,
            $item->brand->name,
            $item->sub_category->name,
            strip_tags(preg_replace("/&#?[a-z0-9]+;/i","",$item->description)),
            $item->price,
            $item->sale_price ,
            $item->status == 1?'Acitve':'Deleted',
            "",
        ];
    }

    public function collection()
    {
        return $this->products;

    }

    public function setImage($workSheet) {
        $this->collection()->each(function($product,$index) use($workSheet) {
            $orgPath = explode('/',$product['feature_image']);
            $delPath = array_splice($orgPath, 3, 5);
            $realPath = implode('/',$delPath);

            $drawing = new Drawing();
            $drawing->setName($product->name);
            $drawing->setDescription($product->name);
            $drawing->setPath(public_path($realPath));
            $drawing->setWidth(80);
            $drawing->setHeight(80);
            $index+=2;
            $drawing->setCoordinates("H$index");
            $drawing->setWorksheet($workSheet);
        });
    }

    public function registerEvents():array {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDefaultRowDimension()->setRowHeight(60);
                $workSheet = $event->sheet->getDelegate();
                $this->setImage($workSheet);
            },
        ];
    }
    public function styles(Worksheet $sheet) {
        $count = count($this->products);
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000'],
                ],
            ],

        ]);
    }
}
