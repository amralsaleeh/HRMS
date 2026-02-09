<?php

namespace Tests\Unit\Exports;

use App\Exports\ExportLeaves;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PHPUnit\Framework\TestCase;

class ExportLeavesTest extends TestCase
{
    public function test_collection_returns_given_data_as_collection(): void
    {
        $data = [
            (object) ['employee' => 'John', 'from_date' => '2025-01-01', 'to_date' => '2025-01-05'],
            (object) ['employee' => 'Jane', 'from_date' => '2025-01-10', 'to_date' => '2025-01-12'],
        ];
        $export = new ExportLeaves($data);

        $collection = $export->collection();

        $this->assertCount(2, $collection);
        $this->assertSame('John', $collection->first()->employee);
    }

    public function test_headings_with_data_returns_keys_of_first_row(): void
    {
        $data = [
            (object) ['employee' => 'John', 'from_date' => '2025-01-01', 'to_date' => '2025-01-05'],
        ];
        $export = new ExportLeaves($data);

        $headings = $export->headings();

        $this->assertContains('employee', $headings);
        $this->assertContains('from_date', $headings);
        $this->assertContains('to_date', $headings);
    }

    public function test_headings_with_empty_data_returns_arabic_message(): void
    {
        $export = new ExportLeaves([]);

        $headings = $export->headings();

        $this->assertSame(['لا يوجد اجازات ضمن الفترة المحددة'], $headings);
    }

    public function test_styles_returns_first_row_style(): void
    {
        $export = new ExportLeaves([(object) ['a' => 1]]);
        $sheet = $this->createMock(Worksheet::class);

        $styles = $export->styles($sheet);

        $this->assertArrayHasKey(1, $styles);
        $this->assertArrayHasKey('font', $styles[1]);
        $this->assertTrue($styles[1]['font']['bold']);
        $this->assertArrayHasKey('alignment', $styles[1]);
    }
}
