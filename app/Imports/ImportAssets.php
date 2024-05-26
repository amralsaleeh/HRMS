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
        // dd($row);
        // 👉 Assets
        Asset::firstOrCreate([
            'id' => $row['id'],
            'old_id' => null,
            'serial_number' => $row['serial_number'],
            'status' => $row['status'],
            'description' => null,
            'in_service' => $row['in_service'],
            'is_gpr' => $row['is_gpr'],
            'real_price' => $row['real_price'],
            'expected_price' => null,
            'acquisition_date' => null,
            'acquisition_type' => $row['acquisition_type'],
            'funded_by' => $row['funded_by'],
            'note' => $row['note'],
        ]);

        // $assetsText = $row[3];
        // $parts = explode('_-_', $assetsText);

        // $categoryText = $parts[0];
        // $subCategoryText = $parts[1];

        // $old_code = $row[5];
        // $quantity = $row[4];

        // $category = Category::where('name', $categoryText)->first();
        // if (! $category) {
        //     info($categoryText.' Category - NOT FOUND!!');
        // }

        // $subCategory = SubCategory::where('name', $subCategoryText)->first();
        // if (! $subCategory) {
        //     info($subCategory.$row.' SubCategory - NOT FOUND!!');
        // }

        // $category_id = str_pad($category->id, 4, '0', STR_PAD_LEFT);
        // $subCategory_id = str_pad($subCategory->id, 4, '0', STR_PAD_LEFT);

        // for ($i = 1; $i <= $quantity; $i++) {
        //     $loop = str_pad($i, 4, '0', STR_PAD_LEFT);
        //     $new_code = "$category_id$subCategory_id$loop";

        //     Asset::firstOrCreate([
        //         'id' => $new_code,
        //         'old_id' => $old_code,
        //         'serial_number' => null,
        //         'status' => 'Good',
        //         'description' => null,
        //         'in_service' => 1,
        //         'real_price' => null,
        //         'expected_price' => null,
        //         'acquisition_date' => Carbon::now(),
        //         'acquisition_type' => 'Directed',
        //         'funded_by' => null,
        //         'note' => null,
        //     ]);
        // }

        // 👉 Category
        // Category::firstOrCreate([
        //     'id' => $row[3],
        //     'name' => $row[1],
        // ]);

        // 👉 SubCategory
        // SubCategory::firstOrCreate([
        //     'id' => $row[3],
        //     'name' => $row[1],
        // ]);
        // $category = Category::find($row[2]);
        // if ($category) {
        //     $category->subCategory()->syncWithoutDetaching([$row[3] => [
        //         'created_by' => Auth::user()->name,
        //         'updated_by' => Auth::user()->name,
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]]);
        // } else {
        //     dd($row);
        // }

        return null;
    }
}
