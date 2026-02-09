<?php

namespace Tests\Unit;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    public function test_app_classes_merges_default_data_with_config(): void
    {
        Config::set('custom.custom', [
            'myLayout' => 'horizontal',
            'myTheme' => 'theme-default',
        ]);

        $result = Helpers::appClasses();

        $this->assertSame('horizontal', $result['layout']);
        $this->assertSame('theme-default', $result['theme']);
    }

    public function test_app_classes_returns_default_layout_keys(): void
    {
        Config::set('custom.custom', []);

        $result = Helpers::appClasses();

        $this->assertArrayHasKey('layout', $result);
        $this->assertArrayHasKey('theme', $result);
        $this->assertArrayHasKey('style', $result);
        $this->assertArrayHasKey('menuCollapsed', $result);
        $this->assertArrayHasKey('navbarFixed', $result);
        $this->assertArrayHasKey('footerFixed', $result);
        $this->assertArrayHasKey('rtlMode', $result);
        $this->assertArrayHasKey('textDirection', $result);
    }

    public function test_app_classes_invalid_layout_falls_back_to_default(): void
    {
        Config::set('custom.custom', [
            'myLayout' => 'invalid-layout',
            'myTheme' => 'theme-default',
        ]);

        $result = Helpers::appClasses();

        $this->assertSame('vertical', $result['layout']);
    }

    public function test_app_classes_menu_collapsed_maps_to_css_class(): void
    {
        Config::set('custom.custom', [
            'menuCollapsed' => true,
        ]);

        $result = Helpers::appClasses();

        $this->assertSame('layout-menu-collapsed', $result['menuCollapsed']);
    }

    public function test_app_classes_rtl_mode_sets_text_direction(): void
    {
        Config::set('custom.custom', [
            'myRTLMode' => true,
        ]);

        $result = Helpers::appClasses();

        $this->assertSame('rtl', $result['rtlMode']);
        $this->assertSame('rtl', $result['textDirection']);
    }

    public function test_update_page_config_sets_config_values(): void
    {
        Helpers::updatePageConfig(['myLayout' => 'blank']);

        $this->assertSame('blank', Config::get('custom.custom.myLayout'));
    }

    public function test_update_page_config_with_empty_array_does_not_throw(): void
    {
        Helpers::updatePageConfig([]);

        $this->assertTrue(true);
    }

    public function test_update_page_config_with_null_does_not_throw(): void
    {
        Helpers::updatePageConfig(null);

        $this->assertTrue(true);
    }

    public function test_app_classes_rtl_mode_false_sets_ltr(): void
    {
        Config::set('custom.custom', [
            'myRTLMode' => false,
        ]);

        $result = Helpers::appClasses();

        $this->assertSame('ltr', $result['rtlMode']);
        $this->assertSame('ltr', $result['textDirection']);
    }

    public function test_app_classes_show_dropdown_on_hover_false(): void
    {
        Config::set('custom.custom', [
            'showDropdownOnHover' => false,
        ]);

        $result = Helpers::appClasses();

        $this->assertSame('false', $result['showDropdownOnHover']);
    }

    public function test_app_classes_display_customizer_false(): void
    {
        Config::set('custom.custom', [
            'displayCustomizer' => false,
        ]);

        $result = Helpers::appClasses();

        $this->assertSame('false', $result['displayCustomizer']);
    }

    public function test_app_classes_null_key_falls_back_to_default(): void
    {
        Config::set('custom.custom', [
            'myLayout' => null,
        ]);

        $result = Helpers::appClasses();

        $this->assertSame('vertical', $result['layout']);
    }

    public function test_app_classes_type_mismatch_falls_back_to_default(): void
    {
        Config::set('custom.custom', [
            'myLayout' => true,
        ]);

        $result = Helpers::appClasses();

        $this->assertSame('vertical', $result['layout']);
    }

    public function test_app_classes_footer_fixed_true_maps_to_css_class(): void
    {
        Config::set('custom.custom', [
            'footerFixed' => true,
        ]);

        $result = Helpers::appClasses();

        $this->assertSame('layout-footer-fixed', $result['footerFixed']);
    }

    public function test_app_classes_menu_flipped_true_maps_to_css_class(): void
    {
        Config::set('custom.custom', [
            'menuFlipped' => true,
        ]);

        $result = Helpers::appClasses();

        $this->assertSame('layout-menu-flipped', $result['menuFlipped']);
    }

    public function test_app_classes_navbar_fixed_true_maps_to_css_class(): void
    {
        Config::set('custom.custom', [
            'navbarFixed' => true,
        ]);

        $result = Helpers::appClasses();

        $this->assertSame('layout-navbar-fixed', $result['navbarFixed']);
    }

    public function test_app_classes_rtl_support_true_maps_to_path(): void
    {
        Config::set('custom.custom', [
            'myRTLSupport' => true,
        ]);

        $result = Helpers::appClasses();

        $this->assertSame('/rtl', $result['rtlSupport']);
    }
}
