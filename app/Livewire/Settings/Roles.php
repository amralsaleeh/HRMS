<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $roles = [];

    public $name;

    /** @var array<string> Permission names selected for this role */
    public $selectedPermissions = [];

    public $role;
    public $isEdit = false;
    public $confirmedId;

    protected function rules(): array
    {
        $except = $this->role?->id;
        $nameRule = ['required', 'string', 'max:255'];
        if ($except) {
            $nameRule[] = 'unique:roles,name,' . $except . ',id,guard_name,web';
        } else {
            $nameRule[] = 'unique:roles,name,NULL,id,guard_name,web';
        }

        return [
            'name' => $nameRule,
        ];
    }

    public function render()
    {
        $this->roles = Role::with('permissions')->orderBy('name')->get();
        $permissions = Permission::where('guard_name', 'web')->orderBy('name')->get();

        return view('livewire.settings.roles', [
            'permissions' => $permissions,
        ]);
    }

    public function submitRole()
    {
        $this->isEdit ? $this->editRole() : $this->addRole();
    }

    public function addRole()
    {
        $this->validate();

        $role = Role::create([
            'name' => $this->name,
            'guard_name' => 'web',
        ]);

        if (! empty($this->selectedPermissions)) {
            $role->syncPermissions($this->selectedPermissions);
        }

        $this->dispatch('closeModal', elementId: '#roleModal');
        $this->dispatch('toastr', type: 'success', message: __('Going Well!'));
        $this->reset();
    }

    public function editRole()
    {
        $this->validate();

        $this->role->update([
            'name' => $this->name,
        ]);

        $this->role->syncPermissions($this->selectedPermissions ?? []);

        $this->dispatch('closeModal', elementId: '#roleModal');
        $this->dispatch('toastr', type: 'success', message: __('Going Well!'));
        $this->reset();
    }

    public function confirmDeleteRole($id)
    {
        $this->confirmedId = $id;
    }

    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        $this->dispatch('toastr', type: 'success', message: __('Going Well!'));
    }

    public function showNewRoleModal()
    {
        $this->reset();
        $this->selectedPermissions = [];
    }

    public function showEditRoleModal($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        $this->reset();
        $this->isEdit = true;
        $this->role = $role;
        $this->name = $role->name;
        $this->selectedPermissions = $role->getPermissionNames()->toArray();

        $this->dispatch('open-role-modal');
    }
}
