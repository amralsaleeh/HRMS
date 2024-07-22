<?php

namespace App\Imports;

use App\Models\Transition;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportTransitions implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Ignore warehouse assets
        if ($row['employee_id'] != -1) {
            Transition::create([
                'asset_id' => $row['asset_id'],
                'employee_id' => $row['employee_id'],
                'handed_date' => $row['handed_date'],
                'return_date' => null,
                'center_document_number' => null,
                'reason' => null,
                'note' => null,
            ]);
        }

        return null;
    }
}
