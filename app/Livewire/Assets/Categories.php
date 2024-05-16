<?php

namespace App\Livewire\Assets;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public $search_term_categories = null;

    public $search_term_sub_categories = null;

    public function render()
    {
        $categories = Category::where('id', 'like', '%'.$this->search_term_categories.'%')
            ->orWhere('name', 'like', '%'.$this->search_term_categories.'%')
            ->paginate(5);

        $subCategories = SubCategory::where('id', 'like', '%'.$this->search_term_sub_categories.'%')
            ->orWhere('name', 'like', '%'.$this->search_term_sub_categories.'%')
            ->paginate(5);

        return view('livewire.assets.categories', [
            'categories' => $categories,
            'subCategories' => $subCategories,
        ]);
    }
}
