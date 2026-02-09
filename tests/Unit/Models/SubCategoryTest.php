<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\SubCategory;
use Tests\TestCase;

class SubCategoryTest extends TestCase
{

    public function test_category_relationship(): void
    {
        $category = Category::create([
            'name' => 'Electronics',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        $subCategory = SubCategory::create([
            'category_id' => $category->id,
            'name' => 'Phones',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $this->assertInstanceOf(Category::class, $subCategory->category()->getRelated());
        $this->assertSame($category->id, $subCategory->category_id);
    }
}
