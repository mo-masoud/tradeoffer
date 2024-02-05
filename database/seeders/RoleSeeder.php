<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (RoleEnum::cases() as $role) {
            Role::updateOrCreate([
                'name' => $role->value,
            ]);
        }

        $role = Role::where('name', RoleEnum::SuperAdmin)->first();
        $role->permissions()->sync(Permission::all());

        $role = Role::where('name', RoleEnum::Admin)->first();
        $role->permissions()->sync(Permission::whereNotIn('group', ['roles'])->get());

        $role = Role::where('name', RoleEnum::StoreManager)->first();

        $storeManagerPermissions = [
            'categories.viewAny',
            'categories.view',
            'stores.viewAny',
            'stores.view',
            'stores.update',
            'branches.viewAny',
            'branches.view',
            'branches.update',
        ];
        $role->permissions()->sync(Permission::whereIn('name', $storeManagerPermissions)->get());

        $role = Role::where('name', RoleEnum::BranchManager)->first();

        $branchManagerPermissions = [
            'categories.viewAny',
            'categories.view',
            'branches.viewAny',
            'branches.view',
            'branches.update',
        ];
        $role->permissions()->sync(Permission::whereIn('name', $branchManagerPermissions)->get());
    }
}
