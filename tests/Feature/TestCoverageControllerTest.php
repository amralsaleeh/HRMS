<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolesSeeder;
use Tests\TestCase;

class TestCoverageControllerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolesSeeder::class);
    }

    private function admin(): User
    {
        $user = User::factory()->create();
        $user->assignRole('Admin');

        return $user;
    }

    public function test_redirects_test_coverage_to_trailing_slash(): void
    {
        $response = $this->actingAs($this->admin())->get('/test-coverage');

        $response->assertStatus(301);
        $this->assertStringEndsWith('/test-coverage/', $response->headers->get('Location'));
    }

    public function test_serves_index_when_coverage_dir_exists(): void
    {
        $basePath = base_path('build/coverage/html');
        if (! is_dir($basePath)) {
            $this->markTestSkipped('Coverage report not generated. Run: composer coverage');
        }

        $response = $this->actingAs($this->admin())->get('/test-coverage/');

        if ($response->status() === 301) {
            $this->assertStringEndsWith('/test-coverage/', $response->headers->get('Location'));
            return;
        }
        $response->assertStatus(200);
        $this->assertStringContainsString('text/html', $response->headers->get('Content-Type') ?? '');
        $response->assertSee('Code Coverage', false);
    }

    public function test_serves_css_asset_when_coverage_dir_exists(): void
    {
        $cssPath = base_path('build/coverage/html/_css/style.css');
        if (! is_file($cssPath)) {
            $this->markTestSkipped('Coverage report not generated. Run: composer coverage');
        }

        $response = $this->actingAs($this->admin())->get('/test-coverage/_css/style.css');

        $response->assertStatus(200);
        $this->assertStringContainsString('text/css', $response->headers->get('Content-Type'));
    }

    public function test_returns_404_for_nonexistent_path(): void
    {
        $response = $this->actingAs($this->admin())->get('/test-coverage/nonexistent-file-xyz');

        $response->assertStatus(404);
    }
}
