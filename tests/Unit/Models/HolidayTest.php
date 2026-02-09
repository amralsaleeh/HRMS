<?php

namespace Tests\Unit\Models;

use App\Models\Center;
use App\Models\Holiday;
use Tests\TestCase;

class HolidayTest extends TestCase
{

    public function test_name_setter_ucfirst(): void
    {
        $holiday = Holiday::factory()->create(['name' => 'eid']);

        $this->assertSame('Eid', $holiday->name);
    }

    public function test_centers_relationship(): void
    {
        $holiday = Holiday::factory()->create();

        $this->assertInstanceOf(Center::class, $holiday->centers()->getRelated());
    }
}
