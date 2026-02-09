<?php

namespace Tests\Unit;

use App\Models\Center;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Timeline;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * Failing tests that document known source-code bugs.
 * When the bugs are fixed in app code, these tests should pass.
 *
 * @see tests/TEST_COVERAGE_REPORT.md "Source Bugs Flagged"
 * @group knownSourceBugs
 */
class KnownSourceBugsTest extends TestCase
{

    /**
     * Bug: Center weekends setter expects array but receives string during hydration.
     * When a Center is loaded from DB, the raw 'weekends' value is a string; the setter
     * is invoked with that string and throws TypeError (expects array).
     */
    public function test_center_weekends_can_be_read_after_loading_from_database(): void
    {
        $center = Center::factory()->create(['weekends' => [5, 6]]);
        $id = $center->id;

        $loaded = Center::find($id);

        $this->assertSame(['5', '6'], $loaded->weekends);
    }

    /**
     * Bug: Center::activeEmployees() uses Center::find(100) for "not affiliated" employees.
     * When center id 100 does not exist, find(100) returns null and ->timelines() throws.
     */
    public function test_center_active_employees_does_not_require_center_id_100_to_exist(): void
    {
        $this->seed(RolesSeeder::class);

        $user = User::factory()->create();
        $user->assignRole('Employee');

        $center = Center::factory()->create();
        $department = Department::factory()->create();
        $position = Position::factory()->create();
        $employee = Employee::factory()->create();
        $startDate = now()->subDay()->format('Y-m-d');
        DB::table('timelines')->insert([
            'center_id' => $center->id,
            'department_id' => $department->id,
            'position_id' => $position->id,
            'employee_id' => $employee->id,
            'start_date' => $startDate,
            'end_date' => null,
            'created_by' => 'System',
            'updated_by' => 'System',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->actingAs($user);

        $result = $center->activeEmployees();

        $this->assertNotNull($result);
        $this->assertTrue($result->pluck('employee_id')->contains($employee->id));
    }

    /**
     * Bug: Employee model fillable includes balance_leave_allowed but the employees
     * table migration does not define this column, so mass assignment/insert fails.
     */
    public function test_employee_can_be_created_with_balance_leave_allowed(): void
    {
        $employee = Employee::factory()->create([
            'balance_leave_allowed' => 15,
        ]);

        $this->assertSame(15, $employee->balance_leave_allowed);
    }
}
