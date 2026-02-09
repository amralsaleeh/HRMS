<?php

namespace Tests\Unit\Models;

use App\Models\Position;
use App\Models\Timeline;
use Tests\TestCase;

class PositionTest extends TestCase
{

    public function test_name_setter_ucfirst(): void
    {
        $position = Position::factory()->create(['name' => 'developer']);

        $this->assertSame('Developer', $position->name);
    }

    public function test_timelines_relationship(): void
    {
        $position = Position::factory()->create();

        $this->assertInstanceOf(Timeline::class, $position->timelines()->getRelated());
        $this->assertSame('position_id', $position->timelines()->getForeignKeyName());
    }
}
