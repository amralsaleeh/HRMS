<?php

namespace App\Exports;

use App\Models\Asset;
use App\Models\Category;
use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportAssets implements FromCollection, ShouldAutoSize, WithEvents, WithHeadings
{
    public function headings(): array
    {
        $product = Asset::first();
        $product['category'] = null;
        $product['subCategory'] = null;

        return array_keys($product->toArray());
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $workSheet = $event->sheet->getDelegate();
                $workSheet->freezePane('A2');
            },
        ];
    }

    public function collection()
    {
        $products = Asset::all();

        foreach ($products as $product) {
            $category = Category::find(substr($product->id, 0, 4));
            $subCategory = SubCategory::find(substr($product->id, 4, 4));

            $product['category'] = $category->name;
            $product['subCategory'] = $subCategory->name;
        }

        return $products;
    }
}
