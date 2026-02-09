<?php

namespace Tests\Unit\Models;

use App\Models\Changelog;
use Tests\TestCase;

class ChangelogTest extends TestCase
{

    public function test_fillable_attributes(): void
    {
        $changelog = Changelog::create([
            'version' => '1.0',
            'title' => 'Release',
            'description' => 'Initial release',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $this->assertSame('1.0', $changelog->version);
        $this->assertSame('Release', $changelog->title);
        $this->assertSame('Initial release', $changelog->description);
    }
}
