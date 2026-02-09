<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Permissions extends Component
{
    public $permissions = [];

    public $name;

    public $permission;
    public $isEdit = false;
    public $confirmedId;

    protected function rules(): array
    {
        $except = $this->permission?->id;
        $nameRule = ['required', 'string', 'max:255'];
        if ($except) {
            $nameRule[] = 'unique:permissions,name,' . $except . ',id,guard_name,web';
        } else {
            $nameRule[] = 'unique:permissions,name,NULL,id,guard_name,web';
        }

        return [
            'name' => $nameRule,
        ];
    }

    public function render()
    {
        $this->permissions = Permission::where('guard_name', 'web')->orderBy('name')->get();

        return view('livewire.settings.permissions');
    }

    public function submitPermission()
    {
        $this->isEdit ? $this->editPermission() : $this->addPermission();
    }

    public function addPermission()
    {
        $this->validate();

        Permission::create([
            'name' => $this->name,
            'guard_name' => 'web',
        ]);

        $this->dispatch('closeModal', elementId: '#permissionModal');
        $this->dispatch('toastr', type: 'success', message: __('Going Well!'));
        $this->reset();
    }

    public function editPermission()
    {
        $this->validate();

        $this->permission->update([
            'name' => $this->name,
        ]);

        $this->dispatch('closeModal', elementId: '#permissionModal');
        $this->dispatch('toastr', type: 'success', message: __('Going Well!'));
        $this->reset();
    }

    public function confirmDeletePermission($id)
    {
        $this->confirmedId = $id;
    }

    public function deletePermission($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        $this->dispatch('toastr', type: 'success', message: __('Going Well!'));
    }

    public function showNewPermissionModal()
    {
        $this->reset();
    }

    public function showEditPermissionModal($id)
    {
        $permission = Permission::findOrFail($id);

        $this->reset();
        $this->isEdit = true;
        $this->permission = $permission;
        $this->name = $permission->name;

        $this->dispatch('open-permission-modal');
    }
}
