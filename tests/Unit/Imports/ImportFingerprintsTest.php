<?php

namespace Tests\Unit\Imports;

use App\Imports\ImportFingerprints;
use App\Models\Employee;
use App\Models\Fingerprint;
use App\Models\Import;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Events\ImportFailed;
use Tests\TestCase;

class ImportFingerprintsTest extends TestCase
{

    public function test_chunk_size_returns_500(): void
    {
        $import = Import::create([
            'file_name' => 'test.xlsx',
            'status' => 'pending',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        $fingerprints = new ImportFingerprints(1, $import->id);

        $this->assertSame(500, $fingerprints->chunkSize());
    }

    public function test_model_creates_fingerprint_when_employee_active(): void
    {
        $employee = Employee::factory()->create(['is_active' => true]);
        $import = Import::create([
            'file_name' => 'test.xlsx',
            'status' => 'pending',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        $fingerprints = new ImportFingerprints(1, $import->id);

        $row = [
            'ac_no' => $employee->id,
            'date' => '15/01/2025',
            'time' => '08:00-17:00',
        ];
        $fingerprints->model($row);

        $this->assertDatabaseHas('fingerprints', [
            'employee_id' => $employee->id,
            'date' => '2025-01-15',
        ]);
    }

    public function test_model_handles_empty_log(): void
    {
        $employee = Employee::factory()->create(['is_active' => true]);
        $import = Import::create([
            'file_name' => 'test.xlsx',
            'status' => 'pending',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        $fingerprints = new ImportFingerprints(1, $import->id);

        $row = [
            'ac_no' => $employee->id,
            'date' => '15/01/2025',
            'time' => '',
        ];
        $fingerprints->model($row);

        $this->assertDatabaseHas('fingerprints', [
            'employee_id' => $employee->id,
            'date' => '2025-01-15',
        ]);
    }

    public function test_model_handles_five_char_log(): void
    {
        $employee = Employee::factory()->create(['is_active' => true]);
        $import = Import::create([
            'file_name' => 'test.xlsx',
            'status' => 'pending',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        $fingerprints = new ImportFingerprints(1, $import->id);

        $row = [
            'ac_no' => $employee->id,
            'date' => '15/01/2025',
            'time' => '08:00',
        ];
        $fingerprints->model($row);

        $fp = Fingerprint::where('employee_id', $employee->id)->where('date', '2025-01-15')->first();
        $this->assertNotNull($fp);
        $this->assertSame('08:00', $fp->check_in);
    }

    public function test_register_events_includes_before_after_and_failed(): void
    {
        $import = Import::create([
            'file_name' => 'test.xlsx',
            'status' => 'pending',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        $fingerprints = new ImportFingerprints(1, $import->id);
        $events = $fingerprints->registerEvents();

        $this->assertArrayHasKey(BeforeImport::class, $events);
        $this->assertArrayHasKey(AfterImport::class, $events);
        $this->assertArrayHasKey(ImportFailed::class, $events);
    }

    public function test_model_skips_and_logs_when_employee_inactive(): void
    {
        $import = Import::create([
            'file_name' => 'test.xlsx',
            'status' => 'pending',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        $fingerprints = new ImportFingerprints(1, $import->id);

        Log::shouldReceive('warning')
            ->once()
            ->withArgs(fn($msg) => str_contains($msg, 'Employee not find in the records'));

        $row = [
            'ac_no' => 99999,
            'date' => '15/01/2025',
            'time' => '08:00-17:00',
        ];
        $fingerprints->model($row);

        $this->assertDatabaseMissing('fingerprints', ['employee_id' => 99999]);
    }

    public function test_before_import_closure_updates_import_status(): void
    {
        $import = Import::create([
            'file_name' => 'test.xlsx',
            'status' => 'pending',
            'total' => 0,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        $fingerprints = new ImportFingerprints(1, $import->id);
        $events = $fingerprints->registerEvents();

        $reader = $this->createMock(\Maatwebsite\Excel\Reader::class);
        $reader->method('getTotalRows')->willReturn(['Sheet1' => 10]);

        $event = new BeforeImport($reader, $fingerprints);

        $events[BeforeImport::class]($event);

        $import->refresh();
        $this->assertSame('processing', $import->status);
        $this->assertEquals(9, $import->total);
    }

    public function test_after_import_closure_updates_status_and_notifies(): void
    {
        $user = User::factory()->create();
        $import = Import::create([
            'file_name' => 'test.xlsx',
            'status' => 'processing',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        $fingerprints = new ImportFingerprints($user->id, $import->id);
        $events = $fingerprints->registerEvents();

        $reader = $this->createMock(\Maatwebsite\Excel\Reader::class);
        $event = new AfterImport($reader, $fingerprints);
        $events[AfterImport::class]($event);

        $import->refresh();
        $this->assertSame('finished', $import->status);
    }

    public function test_import_failed_closure_updates_status_and_logs(): void
    {
        $import = Import::create([
            'file_name' => 'test.xlsx',
            'status' => 'processing',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        $fingerprints = new ImportFingerprints(1, $import->id);
        $events = $fingerprints->registerEvents();

        $event = new ImportFailed(new \Exception('Test import failure'));

        Log::shouldReceive('alert')
            ->once()
            ->withArgs(fn($msg) => str_contains($msg, 'Excel Import Failed (Fingerprints)'));

        $events[ImportFailed::class]($event);

        $import->refresh();
        $this->assertSame('error', $import->status);
        $this->assertSame('Test import failure', $import->details);
    }
}
