<?php

namespace Tests\Unit\Models;

use App\Models\Center;
use App\Models\Holiday;
use App\Models\Timeline;
use Tests\TestCase;

class CenterTest extends TestCase
{

    public function test_name_is_ucfirst_on_set(): void
    {
        $center = Center::factory()->create(['name' => 'branch one']);

        $this->assertSame('Branch one', $center->name);
    }

    public function test_start_work_hour_formats_as_h_i(): void
    {
        $center = Center::factory()->create([
            'start_work_hour' => '09:30:00',
            'end_work_hour' => '18:00:00',
        ]);

        $this->assertSame('09:30', $center->start_work_hour);
        $this->assertSame('18:00', $center->end_work_hour);
    }

    public function test_weekends_attribute_get_and_set(): void
    {
        $center = Center::factory()->create(['weekends' => [5, 6]]);

        $this->assertSame(['5', '6'], $center->weekends);

        $center->weekends = [4, 5];
        $center->save();

        $this->assertSame('4,5', $center->getRawOriginal('weekends'));
    }

    public function test_timelines_relationship(): void
    {
        $center = Center::factory()->create();
        $this->assertInstanceOf(Timeline::class, $center->timelines()->getRelated());
        $this->assertSame('center_id', $center->timelines()->getForeignKeyName());
    }

    public function test_holidays_relationship(): void
    {
        $center = Center::factory()->create();
        $this->assertInstanceOf(Holiday::class, $center->holidays()->getRelated());
    }

    public function test_get_holiday_returns_holiday_for_date_in_range(): void
    {
        $center = Center::factory()->create();
        $holiday = Holiday::factory()->create([
            'from_date' => '2025-01-01',
            'to_date' => '2025-01-05',
        ]);
        $center->holidays()->attach($holiday->id, [
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $found = $center->getHoliday('2025-01-03');

        $this->assertNotNull($found);
        $this->assertSame($holiday->id, $found->id);
    }

    public function test_get_holiday_returns_null_when_no_holiday(): void
    {
        $center = Center::factory()->create();

        $this->assertNull($center->getHoliday('2025-06-15'));
    }
}
