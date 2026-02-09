<?php

namespace Tests\Unit\Imports;

use App\Imports\ImportTransitions;
use App\Models\Employee;
use App\Models\Transition;
use Tests\TestCase;

class ImportTransitionsTest extends TestCase
{

    public function test_model_returns_null_when_employee_id_is_minus_one(): void
    {
        $import = new ImportTransitions;
        $result = $import->model([
            'employee_id' => -1,
            'asset_id' => 1,
            'handed_date' => '2025-01-01',
        ]);

        $this->assertNull($result);
        $this->assertDatabaseCount('transitions', 0);
    }

    public function test_model_creates_transition_when_employee_id_not_minus_one(): void
    {
        $employee = Employee::factory()->create();
        $asset = new \App\Models\Asset;
        $asset->serial_number = 'SN1';
        $asset->class = 'Electronic';
        $asset->status = 'Good';
        $asset->in_service = true;
        $asset->is_gpr = true;
        $asset->acquisition_type = 'Directed';
        $asset->created_by = 'System';
        $asset->updated_by = 'System';
        $asset->save();

        $import = new ImportTransitions;
        $this->actingAs(\App\Models\User::factory()->create(['name' => 'Test']));
        $import->model([
            'employee_id' => $employee->id,
            'asset_id' => $asset->id,
            'handed_date' => '2025-01-01',
        ]);

        $this->assertDatabaseHas('transitions', [
            'employee_id' => $employee->id,
            'asset_id' => $asset->id,
        ]);
    }
}
