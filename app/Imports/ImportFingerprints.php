<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\Fingerprint;
use App\Models\Import;
use App\Models\User;
use App\Notifications\DefaultNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Events\ImportFailed;

class ImportFingerprints implements ShouldQueue, ToModel, WithChunkReading, WithEvents, WithHeadingRow
{
    private $user_id;

    private $file_id;

    private $import;

    private $lastEmployeeId;

    public function __construct($user_id, int $file_id)
    {
        $this->user_id = $user_id;
        $this->file_id = $file_id;
        $this->import = Import::find($this->file_id);
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                $total_rows = collect($event->reader->getTotalRows())
                    ->flatten()
                    ->values();
                $tmp_total_rows = isset($total_rows[0]) ? $total_rows[0] - 1 : 0;
                $this->import->update([
                    'status' => 'processing',
                    'total' => $tmp_total_rows,
                ]);
            },

            AfterImport::class => function (AfterImport $event) {
                $this->import->update([
                    'status' => 'finished',
                ]);

                User::find($this->user_id)->notify(
                    new DefaultNotification($this->user_id, 'Successfully imported the fingerprint file')
                );

                session()->flash('success', __('Imported Successfully!'));
            },

            ImportFailed::class => function (ImportFailed $event) {
                $this->import->update([
                    'status' => 'error',
                    'details' => $event->e->getMessage(),
                ]);

                Log::alert('Excel Import Failed (Fingerprints): '.$event->e->getMessage());
                session()->flash('error', __('Error Occurred, Check Log File!'));
            },
        ];
    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function model(array $row)
    {
        $employee_id = $row['ac_no'];
        $date = Carbon::createFromFormat('d/m/Y', $row['date'])->format('Y-m-d');
        $log = $row['time'];
        $check_in = null;
        $check_out = null;

        if (empty($log)) {
            $log = null;
        } elseif (strlen($log) == 5) {
            $check_in = substr($log, 0, 5);
        } else {
            $check_in = substr($log, 0, 5);
            $check_out = substr($log, -5);
        }

        if (Employee::where('is_active', 1)->find($employee_id)) {
            Fingerprint::firstOrCreate([
                'employee_id' => $employee_id,
                'date' => $date,
                'log' => $log,
                'check_in' => $check_in,
                'check_out' => $check_out,
            ]);
        } else {
            if ($this->lastEmployeeId != $row['ac_no']) {
                Log::warning('Employee not find in the records: '.$employee_id);
            }
        }

        $this->lastEmployeeId = $row['ac_no'];

        $importRow = Import::find($this->file_id);
        $importRow->update([
            'current' => $importRow->current > 0 ? $importRow->current + 1 : 1,
        ]);
    }
}
