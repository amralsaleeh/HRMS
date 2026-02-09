<?php

namespace Tests\Unit\Imports;

use App\Imports\ImportAssets;
use App\Models\Asset;
use App\Models\Category;
use App\Models\SubCategory;
use Tests\TestCase;

class ImportAssetsTest extends TestCase
{

    private function createAssetWithCategoryAndSubCategory(): void
    {
        Category::insert([
            'id' => 1000,
            'name' => 'Electronics',
            'created_by' => 'System',
            'updated_by' => 'System',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        SubCategory::insert([
            'id' => 1000,
            'category_id' => 1000,
            'name' => 'Phones',
            'created_by' => 'System',
            'updated_by' => 'System',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function test_model_creates_asset_when_no_last_record(): void
    {
        $this->createAssetWithCategoryAndSubCategory();

        $import = new ImportAssets;
        $row = [
            'category_id' => 1000,
            'sub_category_id' => 1000,
            'old_id' => 1,
            'serial_number' => 'SN1',
            'status' => 'Good',
            'description' => 'Test',
            'in_service' => 1,
            'real_price' => 100,
            'expected_price' => 100,
            'acquisition_date' => '2024-01-01',
            'acquisition_type' => 'Directed',
            'funded_by' => 'Test',
            'note' => null,
        ];
        $import->model($row);

        $this->assertDatabaseHas('assets', [
            'serial_number' => 'SN1',
            'status' => 'Good',
        ]);
    }

    public function test_model_creates_asset_with_incremented_quantity_when_last_record_exists(): void
    {
        $this->createAssetWithCategoryAndSubCategory();
        // ID must match ImportAssets logic: 1 + pad(category_id,4) + pad(sub_category_id,4) + pad(1,4) = 11000100001
        Asset::insert([
            'id' => '11000100001',
            'serial_number' => 'SN0',
            'class' => 'Electronic',
            'status' => 'Good',
            'in_service' => 1,
            'is_gpr' => 1,
            'acquisition_type' => 'Directed',
            'created_by' => 'System',
            'updated_by' => 'System',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $import = new ImportAssets;
        $row = [
            'category_id' => 1000,
            'sub_category_id' => 1000,
            'old_id' => 2,
            'serial_number' => 'SN2',
            'status' => 'Good',
            'description' => 'Test',
            'in_service' => 1,
            'real_price' => 100,
            'expected_price' => 100,
            'acquisition_date' => '2024-01-01',
            'acquisition_type' => 'Directed',
            'funded_by' => 'Test',
            'note' => null,
        ];
        $import->model($row);

        $this->assertDatabaseHas('assets', ['serial_number' => 'SN2']);
        $this->assertSame(2, Asset::where('id', 'like', '1100010000%')->count());
    }
}
