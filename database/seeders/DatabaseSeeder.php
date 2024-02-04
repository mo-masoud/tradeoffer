<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\RoleEnum;
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

        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);

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

        $this->call(CategoriesSeeder::class);

    }
}
