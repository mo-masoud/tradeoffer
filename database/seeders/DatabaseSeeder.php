<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\RoleEnum;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);

        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
        ]);

        $user->assignRole(RoleEnum::SuperAdmin->value);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'test@admin.com',
        ]);

        $user->assignRole(RoleEnum::Admin->value);

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@user.com',
        ]);

        $user->assignRole(RoleEnum::User->value);

        $user = User::factory()->create([
            'name' => 'Store Manager',
            'email' => 'test@store.com',
        ]);

        $user->assignRole(RoleEnum::StoreManager->value);

        Store::factory(1)->create([
            'user_id' => $user->id,
        ]);

        $this->call(CategorySeeder::class);
    }
}
