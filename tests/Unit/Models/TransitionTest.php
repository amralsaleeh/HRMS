<?php

namespace Tests\Unit\Models;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Employee;
use App\Models\SubCategory;
use App\Models\Transition;
use Tests\TestCase;

class TransitionTest extends TestCase
{

    private function createAsset(): Asset
    {
        $asset = new Asset;
        $asset->serial_number = 'SN1';
        $asset->class = 'Electronic';
        $asset->status = 'Good';
        $asset->in_service = true;
        $asset->is_gpr = true;
        $asset->acquisition_type = 'Directed';
        $asset->created_by = 'System';
        $asset->updated_by = 'System';
        $asset->save();

        return $asset;
    }

    public function test_employee_relationship(): void
    {
        $employee = Employee::factory()->create();
        $asset = $this->createAsset();
        $transition = Transition::create([
            'asset_id' => $asset->id,
            'employee_id' => $employee->id,
            'handed_date' => '2025-01-01',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $this->assertInstanceOf(Employee::class, $transition->employee()->getRelated());
    }

    public function test_asset_relationship(): void
    {
        $employee = Employee::factory()->create();
        $asset = $this->createAsset();
        $transition = Transition::create([
            'asset_id' => $asset->id,
            'employee_id' => $employee->id,
            'handed_date' => '2025-01-01',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $this->assertInstanceOf(Asset::class, $transition->asset()->getRelated());
    }

    public function test_get_category(): void
    {
        $category = Category::create([
            'name' => 'Electronics',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        $assetId = '1' . str_pad((string) $category->id, 4, '0', STR_PAD_LEFT) . '00010001';
        $transition = new Transition;

        $found = $transition->getCategory($assetId);

        $this->assertInstanceOf(Category::class, $found);
        $this->assertSame($category->id, (int) $found->id);
    }

    public function test_get_sub_category(): void
    {
        $category = Category::create([
            'name' => 'Electronics',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        $subCategory = SubCategory::create([
            'category_id' => $category->id,
            'name' => 'Phones',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        $assetId = '1' . str_pad((string) $category->id, 4, '0', STR_PAD_LEFT) . str_pad((string) $subCategory->id, 4, '0', STR_PAD_LEFT) . '0001';
        $transition = new Transition;

        $found = $transition->getSubCategory($assetId);

        $this->assertInstanceOf(SubCategory::class, $found);
        $this->assertSame($subCategory->id, (int) $found->id);
    }
}
