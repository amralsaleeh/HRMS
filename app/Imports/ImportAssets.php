<?php

namespace App\Imports;

use App\Models\Asset;
use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportAssets implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // 👉 Category
        // Category::firstOrCreate([
        //     'id' => $row['code'],
        //     'name' => $row['name'],
        // ]);

        // 👉 SubCategory
        // SubCategory::firstOrCreate([
        //     'id' => $row['sub_category_id'],
        //     'name' => $row['sub_category'],
        // ]);

        // 👉 Category_Sub_Category
        // $category = Category::find($row['category_id']);
        // if ($category) {
        //     $category->subCategory()->syncWithoutDetaching([
        //         $row['sub_category_id'] => [
        //             'created_by' => Auth::user()->name,
        //             'updated_by' => Auth::user()->name,
        //             'created_at' => Carbon::now(),
        //             'updated_at' => Carbon::now(),
        //         ],
        //     ]);
        // } else {
        //     dd($row);
        // }

        // 👉 Assets
        $quantity = 0;

        $init = 1;
        $category_id = str_pad($row['category_id'], 4, '0', STR_PAD_LEFT);
        $subCategory_id = str_pad($row['sub_category_id'], 4, '0', STR_PAD_LEFT);
        $quantity = str_pad(1, 4, '0', STR_PAD_LEFT);

        $lastRecord = Asset::where('id', $init.$category_id.$subCategory_id.$quantity)->first();

        if (! $lastRecord) {
            Asset::firstOrCreate([
                'id' => $init.$category_id.$subCategory_id.$quantity,
                'old_id' => $row['old_id'],
                'serial_number' => $row['serial_number'],
                'status' => $row['status'],
                'description' => $row['description'],
                'in_service' => $row['in_service'],
                'is_gpr' => 0,
                'real_price' => $row['real_price'],
                'expected_price' => $row['expected_price'],
                'acquisition_date' => $row['acquisition_date'],
                'acquisition_type' => $row['acquisition_type'],
                'funded_by' => $row['funded_by'],
                'note' => $row['note'],
            ]);
        } else {
            $quantity = Asset::where('id', 'like', $init.$category_id.$subCategory_id.'%')->count();
            $quantity++;
            $quantity = str_pad($quantity, 4, '0', STR_PAD_LEFT);

            Asset::firstOrCreate([
                'id' => $init.$category_id.$subCategory_id.$quantity,
                'old_id' => $row['old_id'],
                'serial_number' => $row['serial_number'],
                'status' => $row['status'],
                'description' => $row['description'],
                'in_service' => $row['in_service'],
                'is_gpr' => 0,
                'real_price' => $row['real_price'],
                'expected_price' => $row['expected_price'],
                'acquisition_date' => $row['acquisition_date'],
                'acquisition_type' => $row['acquisition_type'],
                'funded_by' => $row['funded_by'],
                'note' => $row['note'],
            ]);
        }

        return null;
    }
}
