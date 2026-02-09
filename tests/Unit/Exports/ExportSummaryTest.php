<?php

namespace Tests\Unit\Exports;

use App\Exports\ExportSummary;
use Maatwebsite\Excel\Events\AfterSheet;
use Tests\TestCase;

class ExportSummaryTest extends TestCase
{
    public function test_view_returns_correct_view_and_data(): void
    {
        $data = [['total' => 100, 'count' => 5]];
        $export = new ExportSummary($data);

        $view = $export->view();

        $this->assertSame('exports.summary', $view->name());
        $this->assertEquals(['exportedSummary' => $data], $view->getData());
    }

    public function test_register_events_includes_after_sheet(): void
    {
        $export = new ExportSummary([]);
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

        $export = new ExportSummary([]);
        $events = $export->registerEvents();
        $events[AfterSheet::class]($event);
    }
}
