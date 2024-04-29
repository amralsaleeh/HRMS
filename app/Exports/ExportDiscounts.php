<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExportDiscounts implements FromView, ShouldAutoSize, WithEvents
{
    public $data;

    public function __construct($employeeDiscounts)
    {
        $this->data = $employeeDiscounts;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $workSheet = $event->sheet->getDelegate();
                $workSheet->freezePane('A2');
            },
        ];
    }

    public function view(): View
    {
        return view('exports.discounts', [
            'employeeDiscounts' => $this->data,
        ]);
    }
}
