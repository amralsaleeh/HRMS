<?php

namespace Tests\Unit\Exports;

use App\Exports\ExportAssets;
use App\Models\Asset;
use App\Models\Category;
use App\Models\SubCategory;
use Tests\TestCase;

class ExportAssetsTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->createAssetWithCategoryAndSubCategory();
    }

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
        Asset::insert([
            'id' => 1000100010001,
            'serial_number' => 'SN1',
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
    }

    public function test_headings_returns_keys_including_category_and_sub_category(): void
    {
        $export = new ExportAssets;

        $headings = $export->headings();

        $this->assertContains('category', $headings);
        $this->assertContains('subCategory', $headings);
        $this->assertIsArray($headings);
    }

    public function test_collection_returns_assets_with_category_and_sub_category_names(): void
    {
        $export = new ExportAssets;

        $collection = $export->collection();

        $this->assertCount(1, $collection);
        $first = $collection->first();
        $this->assertSame('Electronics', $first['category']);
        $this->assertSame('Phones', $first['subCategory']);
    }

    public function test_register_events_includes_after_sheet(): void
    {
        $export = new ExportAssets;
        $events = $export->registerEvents();

        $this->assertArrayHasKey(\Maatwebsite\Excel\Events\AfterSheet::class, $events);
        $this->assertIsCallable($events[\Maatwebsite\Excel\Events\AfterSheet::class]);
    }

    public function test_after_sheet_closure_freezes_pane(): void
    {
        $workSheet = $this->getMockBuilder(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::class)
            ->onlyMethods(['freezePane'])
            ->getMock();
        $workSheet->expects($this->once())->method('freezePane')->with('A2');

        $sheet = $this->createMock(\Maatwebsite\Excel\Sheet::class);
        $sheet->method('getDelegate')->willReturn($workSheet);

        $event = $this->createMock(\Maatwebsite\Excel\Events\AfterSheet::class);
        $event->sheet = $sheet;

        $export = new ExportAssets;
        $events = $export->registerEvents();
        $events[\Maatwebsite\Excel\Events\AfterSheet::class]($event);
    }
}
