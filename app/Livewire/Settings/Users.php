<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    public $users = [];

    public $name;
    public $email;
    public $username;
    public $password;
    public $role;

    public $user;
    public $isEdit = false;
    public $confirmedId;

    protected function rules(): array
    {
        $userId = $this->user?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email' . ($userId ? ',' . $userId : '')],
            'username' => ['required', 'string', 'max:255', 'unique:users,username' . ($userId ? ',' . $userId : '')],
            'password' => [$this->isEdit ? 'nullable' : 'required', 'string', 'min:6'],
            'role' => ['nullable', 'string', 'exists:roles,name'],
        ];
    }

    public function render()
    {
        $this->users = User::with('roles')->orderBy('id')->get();
        $roles = Role::orderBy('name')->pluck('name')->all();

        return view('livewire.settings.users', [
            'roles' => $roles,
        ]);
    }

    public function submitUser()
    {
        $this->isEdit ? $this->editUser() : $this->addUser();
    }

    public function addUser()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'password' => Hash::make($this->password),
        ]);

        if ($this->role) {
            $user->assignRole($this->role);
        }

        $this->dispatch('closeModal', elementId: '#userModal');
        $this->dispatch('toastr', type: 'success', message: __('Going Well!'));

        $this->reset();
    }

    public function editUser()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
        ]);

        if ($this->password) {
            $this->user->update([
                'password' => Hash::make($this->password),
            ]);
        }

        if ($this->role) {
            $this->user->syncRoles([$this->role]);
        } else {
            $this->user->syncRoles([]);
        }

        $this->dispatch('closeModal', elementId: '#userModal');
        $this->dispatch('toastr', type: 'success', message: __('Going Well!'));

        $this->reset();
    }

    public function confirmDeleteUser($id)
    {
        $this->confirmedId = $id;
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $this->dispatch('toastr', type: 'success', message: __('Going Well!'));
    }

    public function showNewUserModal()
    {
        $this->reset();
    }

    public function showEditUserModal($id)
    {
        $user = User::with('roles')->findOrFail($id);

        $this->reset();
        $this->isEdit = true;

        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->role = $user->roles->pluck('name')->first();

        $this->dispatch('open-user-modal');
    }
}
