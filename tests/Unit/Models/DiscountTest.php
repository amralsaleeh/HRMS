<?php

namespace Tests\Unit\Models;

use App\Models\Discount;
use App\Models\Employee;
use Tests\TestCase;

class DiscountTest extends TestCase
{

    public function test_employee_relationship(): void
    {
        $employee = Employee::factory()->create();
        $discount = Discount::create([
            'employee_id' => $employee->id,
            'rate' => 10,
            'date' => '2025-01-15',
            'reason' => 'Late',
            'is_auto' => true,
            'is_sent' => false,
            'batch' => '2025-01',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $this->assertInstanceOf(Employee::class, $discount->employee()->getRelated());
    }

    public function test_date_attribute_formats_as_y_m_d(): void
    {
        $employee = Employee::factory()->create();
        $discount = Discount::create([
            'employee_id' => $employee->id,
            'rate' => 10,
            'date' => '2025-01-15',
            'reason' => 'Late',
            'is_auto' => false,
            'is_sent' => false,
            'batch' => '2025-01',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $this->assertSame('2025-01-15', $discount->date);
    }
}
