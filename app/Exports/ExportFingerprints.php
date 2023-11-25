<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportFingerprints implements FromCollection, WithHeadings
{
    protected $headings;

    protected $data;

    public function __construct($fingerprints)
    {
        $this->headings = $this->generateHeadings();
        $this->data = $fingerprints;
    }

    public function headings(): array
    {
        return $this->headings;
    }

    protected function generateHeadings()
    {
        if (empty($this->data)) {
            return [];
        }

        return array_keys($this->data->first()->toArray());
    }

    public function collection()
    {
        return collect($this->data);
    }
}
