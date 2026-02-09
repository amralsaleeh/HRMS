<?php

namespace Tests\Unit\Exports;

use App\Exports\ExportFingerprints;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class ExportFingerprintsTest extends TestCase
{
    public function test_headings_with_empty_data_returns_empty_array(): void
    {
        $export = new ExportFingerprints(collect());

        $this->assertSame([], $export->headings());
    }

    public function test_headings_with_data_returns_keys_of_first_item(): void
    {
        $item = new class {
            public function toArray(): array
            {
                return ['employee_id' => 1, 'date' => '2025-01-15', 'check_in' => '08:00'];
            }
        };
        $data = collect([$item]);
        $export = new ExportFingerprints($data);

        $ref = new \ReflectionClass($export);
        $dataProp = $ref->getProperty('data');
        $dataProp->setAccessible(true);
        $dataProp->setValue($export, $data);
        $method = $ref->getMethod('generateHeadings');
        $method->setAccessible(true);
        $headings = $method->invoke($export);

        $this->assertContains('employee_id', $headings);
        $this->assertContains('date', $headings);
        $this->assertContains('check_in', $headings);
    }

    public function test_collection_returns_given_data_as_collection(): void
    {
        $item = new \stdClass;
        $item->employee_id = 1;
        $item->date = '2025-01-15';
        $data = collect([$item]);
        $export = new ExportFingerprints($data);

        $collection = $export->collection();

        $this->assertInstanceOf(Collection::class, $collection);
        $this->assertCount(1, $collection);
    }
}
