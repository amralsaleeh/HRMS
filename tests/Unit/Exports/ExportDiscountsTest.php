<?php

namespace Tests\Unit\Exports;

use App\Exports\ExportDiscounts;
use Maatwebsite\Excel\Events\AfterSheet;
use Tests\TestCase;

class ExportDiscountsTest extends TestCase
{
    public function test_view_returns_correct_view_and_data(): void
    {
        $data = [['employee' => 'John', 'rate' => 10]];
        $export = new ExportDiscounts($data);

        $view = $export->view();

        $this->assertSame('exports.discounts', $view->name());
        $this->assertEquals(['exportedDiscounts' => $data], $view->getData());
    }

    public function test_register_events_includes_after_sheet(): void
    {
        $export = new ExportDiscounts([]);
        $events = $export->registerEvents();

        $this->assertArrayHasKey(AfterSheet::class, $events);
        $this->assertIsCallable($events[AfterSheet::class]);
    }

    public function test_after_sheet_closure_freezes_pane(): void
    {
        $workSheet = $this->getMockBuilder(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::class)
            ->onlyMethods(['freezePane'])
            ->getMock();
        $workSheet->expects($this->once())->method('freezePane')->with('A2');

        $sheet = $this->createMock(\Maatwebsite\Excel\Sheet::class);
        $sheet->method('getDelegate')->willReturn($workSheet);

        $event = $this->createMock(AfterSheet::class);
        $event->sheet = $sheet;

        $export = new ExportDiscounts([]);
        $events = $export->registerEvents();
        $events[AfterSheet::class]($event);
    }
}
