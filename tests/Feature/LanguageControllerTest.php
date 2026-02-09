<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{

    public function test_swap_to_english_sets_locale_and_redirects_back(): void
    {
        $response = $this->from('/dashboard')->get('lang/en');

        $response->assertRedirect('/dashboard');
        $this->assertSame('en', Session::get('locale'));
        $this->assertSame('en', App::getLocale());
    }

    public function test_swap_to_arabic_sets_locale(): void
    {
        $response = $this->from('/dashboard')->get('lang/ar');

        $response->assertRedirect('/dashboard');
        $this->assertSame('ar', Session::get('locale'));
        $this->assertSame('ar', App::getLocale());
    }

    public function test_swap_to_invalid_locale_aborts(): void
    {
        $response = $this->get('lang/fr');

        $response->assertStatus(400);
    }
}
