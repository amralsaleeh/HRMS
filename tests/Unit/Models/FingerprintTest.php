<?php

namespace Tests\Unit\Models;

use App\Models\Employee;
use App\Models\Fingerprint;
use Tests\TestCase;

class FingerprintTest extends TestCase
{

    public function test_employee_relationship(): void
    {
        $employee = Employee::factory()->create();
        $fingerprint = Fingerprint::create([
            'employee_id' => $employee->id,
            'date' => '2025-01-15',
            'check_in' => '08:00:00',
            'check_out' => '17:00:00',
            'is_checked' => false,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $this->assertInstanceOf(Employee::class, $fingerprint->employee()->getRelated());
        $this->assertSame($employee->id, $fingerprint->employee_id);
    }

    public function test_check_in_formats_as_h_i(): void
    {
        $employee = Employee::factory()->create();
        $fingerprint = Fingerprint::create([
            'employee_id' => $employee->id,
            'date' => '2025-01-15',
            'check_in' => '08:30:00',
            'check_out' => null,
            'is_checked' => false,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $this->assertSame('08:30', $fingerprint->check_in);
    }

    public function test_check_out_returns_empty_when_null(): void
    {
        $employee = Employee::factory()->create();
        $fingerprint = Fingerprint::create([
            'employee_id' => $employee->id,
            'date' => '2025-01-15',
            'check_in' => '08:00:00',
            'check_out' => null,
            'is_checked' => false,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $this->assertSame('', $fingerprint->check_out);
    }

    public function test_scope_filtered_fingerprints(): void
    {
        $employee = Employee::factory()->create();
        Fingerprint::create([
            'employee_id' => $employee->id,
            'date' => '2025-01-15',
            'check_in' => '08:00:00',
            'check_out' => '17:00:00',
            'is_checked' => false,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $query = Fingerprint::query();
        $query->filteredFingerprints($employee->id, '2025-01-01', '2025-01-31', false, false);
        $result = $query->get();

        $this->assertCount(1, $result);
    }
}
