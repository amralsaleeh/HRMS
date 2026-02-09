<?php

namespace Tests\Unit\Models;

use App\Models\Asset;
use App\Models\Transition;
use Tests\TestCase;

class AssetTest extends TestCase
{

    public function test_transitions_relationship(): void
    {
        $asset = new Asset;
        $asset->serial_number = 'SN1';
        $asset->class = 'Electronic';
        $asset->status = 'Good';
        $asset->description = 'Test';
        $asset->in_service = true;
        $asset->is_gpr = true;
        $asset->real_price = 100;
        $asset->expected_price = 100;
        $asset->acquisition_date = '2024-01-01';
        $asset->acquisition_type = 'Directed';
        $asset->funded_by = 'Test';
        $asset->created_by = 'System';
        $asset->updated_by = 'System';
        $asset->save();

        $this->assertInstanceOf(Transition::class, $asset->transitions()->getRelated());
        $this->assertSame('asset_id', $asset->transitions()->getForeignKeyName());
    }
}
