<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportFingerprints implements FromCollection, WithHeadings
{
    protected $data;

    protected $headings;

    public function __construct($fingerprints)
    {
        $this->data = $fingerprints;
        $this->headings = $this->generateHeadings();
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
