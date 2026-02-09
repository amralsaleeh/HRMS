<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\SubCategory;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    public function test_sub_category_relationship(): void
    {
        $category = Category::create([
            'name' => 'Electronics',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $this->assertInstanceOf(SubCategory::class, $category->subCategory()->getRelated());
    }
}
