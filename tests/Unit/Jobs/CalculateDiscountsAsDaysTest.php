<?php

namespace Tests\Unit\Jobs;

use App\Jobs\CalculateDiscountsAsDays;
use App\Models\Center;
use App\Models\Contract;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Fingerprint;
use App\Models\Position;
use App\Models\Timeline;
use App\Models\User;
use App\Notifications\DefaultNotification;
use Database\Seeders\RolesSeeder;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

/**
 * Tests for CalculateDiscountsAsDays (app custom logic only).
 *
 * Current coverage:
 * - Instantiation, handle() with no centers, handle() with center but no employees.
 * - One integration test: one employee with one "absent" fingerprint (log null) in batch range
 *   exercises the fingerprint loop and creates a discount when max_leave_allowed is 0.
 *
 * Not covered by these tests: leave-type branches (1101, 1103, 1104, 1201, 21xx), delay/early/late
 * logic, partial attendance, holiday checks, splitLeaves, etc. Those would need more test data and cases.
 */
class CalculateDiscountsAsDaysTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolesSeeder::class);
    }

    public function test_job_can_be_instantiated_with_user_and_batch(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Admin');

        $job = new CalculateDiscountsAsDays($user, '2024-01-01 to 2024-01-31');

        $this->assertInstanceOf(CalculateDiscountsAsDays::class, $job);
    }

    public function test_handle_runs_and_sends_notification_when_no_active_centers(): void
    {
        Notification::fake();

        $user = User::factory()->create();
        $user->assignRole('Admin');

        $job = new CalculateDiscountsAsDays($user, '2024-01-01 to 2024-01-31');
        $job->handle();

        Notification::assertSentTo($user, DefaultNotification::class);
    }

    public function test_handle_runs_and_sends_notification_when_one_center_has_no_employees(): void
    {
        Notification::fake();

        $user = User::factory()->create();
        $user->assignRole('Admin');
        Center::factory()->create([
            'is_active' => true,
            'start_work_hour' => '08:00',
            'end_work_hour' => '17:00',
            'weekends' => [5, 6],
        ]);

        $job = new CalculateDiscountsAsDays($user, '2024-01-01 to 2024-01-31');
        $job->handle();

        Notification::assertSentTo($user, DefaultNotification::class);
    }

    public function test_handle_creates_discount_when_employee_has_absent_fingerprint_and_no_leave_balance(): void
    {
        Notification::fake();

        $user = User::factory()->create();
        $user->assignRole('Admin');

        $center = Center::factory()->create([
            'is_active' => true,
            'start_work_hour' => '08:00:00',
            'end_work_hour' => '17:00:00',
            'weekends' => [5, 6],
        ]);
        $contract = Contract::factory()->create(['work_rate' => 100]);
        $department = Department::factory()->create();
        $position = Position::factory()->create();
        $employee = Employee::factory()->create([
            'contract_id' => $contract->id,
            'max_leave_allowed' => 0,
            'is_active' => true,
        ]);
        Timeline::create([
            'center_id' => $center->id,
            'department_id' => $department->id,
            'position_id' => $position->id,
            'employee_id' => $employee->id,
            'start_date' => '2023-01-01',
            'end_date' => null,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        Fingerprint::create([
            'employee_id' => $employee->id,
            'date' => '2024-01-02',
            'log' => null,
            'check_in' => null,
            'check_out' => null,
            'is_checked' => 0,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $job = new CalculateDiscountsAsDays($user, '2024-01-01 to 2024-01-31');
        $job->handle();

        $this->assertDatabaseHas('discounts', [
            'employee_id' => $employee->id,
            'date' => '2024-01-02',
            'reason' => 'Absent without excuse',
            'rate' => 100,
        ]);
        Notification::assertSentTo($user, DefaultNotification::class);
    }
}
