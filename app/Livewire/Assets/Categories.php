<?php

namespace App\Livewire\Assets;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    // 👉 Variables
    public $search_term_categories = null;

    public $search_term_sub_categories = null;

    public $category;

    public $categoryInfo;

    public $subCategory;

    public $categoryName;

    public $subCategoryName;

    public $isEdit = false;

    public $confirmedCategoryId;

    public $confirmedSubCategoryId;

    public function mount()
    {
        $this->showCategoryInfo(1);
    }

    public function render()
    {
        $categories = Category::where('id', 'like', '%'.$this->search_term_categories.'%')
            ->orWhere('name', 'like', '%'.$this->search_term_categories.'%')
            ->paginate(6);

        $subCategories = SubCategory::where('id', 'like', '%'.$this->search_term_sub_categories.'%')
            ->orWhere('name', 'like', '%'.$this->search_term_sub_categories.'%')
            ->paginate(6);

        return view('livewire.assets.categories', [
            'categories' => $categories,
            'subCategories' => $subCategories,
        ]);
    }

    public function showCategoryInfo($categoryId)
    {
        $category = Category::with('subCategory')->find($categoryId);

        $this->categoryInfo = $category;
    }

    public function submitCategory()
    {
        $this->isEdit ? $this->editCategory() : $this->addCategory();
    }

    public function showNewCategoryModal()
    {
        $this->reset('isEdit', 'categoryName');
    }

    public function addCategory()
    {
        // $this->validate();
        Category::create([
            'name' => $this->categoryName,
        ]);

        $this->dispatch('closeModal', elementId: '#categoryModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }

    public function showEditCategoryModal(Category $category)
    {
        $this->reset('isEdit', 'categoryName');
        $this->isEdit = true;
        $this->category = $category;
        $this->categoryName = $category->name;
    }

    public function editCategory()
    {
        // $this->validate();
        $this->category->update([
            'name' => $this->categoryName,
        ]);

        $this->dispatch('closeModal', elementId: '#categoryModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));

        $this->reset('isEdit', 'categoryName');
    }

    public function confirmDeleteCategory($id)
    {
        $this->confirmedCategoryId = $id;
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }

    public function submitSubCategory()
    {
        $this->isEdit ? $this->editSubCategory() : $this->addSubCategory();
    }

    public function showNewSubCategoryModal()
    {
        $this->reset('isEdit', 'subCategoryName');
    }

    public function addSubCategory()
    {
        // $this->validate();
        SubCategory::create([
            'name' => $this->subCategoryName,
        ]);

        $this->dispatch('closeModal', elementId: '#subCategoryModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }

    public function showEditSubCategoryModal(SubCategory $subCategory)
    {
        $this->reset('isEdit', 'subCategoryName');
        $this->isEdit = true;
        $this->subCategory = $subCategory;
        $this->subCategoryName = $subCategory->name;
    }

    public function editSubCategory()
    {
        // $this->validate();
        $this->subCategory->update([
            'name' => $this->subCategoryName,
        ]);

        $this->dispatch('closeModal', elementId: '#subCategoryModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));

        $this->reset('isEdit', 'subCategoryName');
    }

    public function confirmDeleteSubCategory($id)
    {
        $this->confirmedSubCategoryId = $id;
    }

    public function deleteSubCategory(SubCategory $subCategory)
    {
        $subCategory->delete();
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }
}
