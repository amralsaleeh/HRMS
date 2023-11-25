<?php

namespace App\Imports;

use App\Models\Fingerprint;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportFingerprints implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $employee_id = $row[0];
        $date = Carbon::parse($row[3])->format('Y-m-d');
        $log = $row[4];
        $check_in = null;
        $check_out = null;

        // Check if the record does not exist to avoid duplicate
        if (! Fingerprint::where('date', $date)->exists()) {
            if (empty($log)) {
                $log = null;
            } elseif (strlen($log) == 5) {
                $check_in = substr($log, 0, 5);
            } else {
                $check_in = substr($log, 0, 5);
                $check_out = substr($log, -5);
            }

            Fingerprint::create([
                'employee_id' => $employee_id,
                'date' => $date,
                'log' => $log,
                'check_in' => $check_in,
                'check_out' => $check_out,
                'is_checked' => false,
            ]);

            return null;
        } else {
            // Skip this row
            return null;
        }
    }
}
