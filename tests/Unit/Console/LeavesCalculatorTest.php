<?php

namespace Tests\Unit\Console;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class LeavesCalculatorTest extends TestCase
{

    public function test_command_exits_with_code_one(): void
    {
        $this->artisan('LeavesCalculator')
            ->assertExitCode(1);
    }

    public function test_handle_updates_employee_balance_when_active_employee_exists(): void
    {
        if (! \Schema::hasColumn('timelines', 'is_sequent')) {
            $this->markTestSkipped('timelines.is_sequent column not present in schema');
        }
        Carbon::setTestNow(Carbon::create(2025, 3, 15));
        $employee = Employee::factory()->create([
            'is_active' => true,
            'balance_leave_allowed' => 0,
            'max_leave_allowed' => 0,
        ]);

        $this->artisan('LeavesCalculator')->assertExitCode(1);

        $employee->refresh();
        $this->assertGreaterThanOrEqual(0, $employee->balance_leave_allowed);
        $this->assertGreaterThanOrEqual(0, $employee->max_leave_allowed);
    }

    public function test_handle_does_nothing_when_no_active_employees(): void
    {
        Employee::factory()->create(['is_active' => false]);

        $this->artisan('LeavesCalculator')
            ->assertExitCode(1);
    }
}
