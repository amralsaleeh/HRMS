<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportLeaves implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles
{
    private $headings;

    private $data;

    public function __construct($leaves)
    {
        $this->data = $leaves;
        $this->headings = $this->generateHeadings();
    }

    public function headings(): array
    {
        return $this->headings;
    }

    protected function generateHeadings()
    {
        if (count($this->data) === 0) {
            return ['لا يوجد اجازات ضمن الفترة المحددة'];
        }

        return array_keys((array) $this->data[0]);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 16],
                'color' => ['hex' => '808080'],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
            ],
        ];
    }

    public function collection()
    {
        return collect($this->data);
    }
}
