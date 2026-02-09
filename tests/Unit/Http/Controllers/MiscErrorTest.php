<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\MiscError;
use Tests\TestCase;

class MiscErrorTest extends TestCase
{
    public function test_index_returns_misc_error_view_with_page_configs(): void
    {
        $controller = new MiscError;
        $response = $controller->index();

        $this->assertSame('content.pages-misc-error', $response->name());
        $this->assertEquals(['myLayout' => 'blank'], $response->getData()['pageConfigs']);
    }
}
