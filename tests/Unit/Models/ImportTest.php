<?php

namespace Tests\Unit\Models;

use App\Models\Import;
use Tests\TestCase;

class ImportTest extends TestCase
{

    public function test_fillable_attributes(): void
    {
        $import = Import::create([
            'file_name' => 'test.xlsx',
            'file_size' => 1024,
            'file_ext' => 'xlsx',
            'file_type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'status' => 'pending',
            'details' => null,
            'current' => 0,
            'total' => 10,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $this->assertSame('test.xlsx', $import->file_name);
        $this->assertSame('pending', $import->status);
    }
}
