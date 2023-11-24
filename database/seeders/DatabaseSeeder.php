<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $admin_role = Role::query()->create([
            'name' => 'Admin',
            'code' => 'admin',
        ]);

        $user_role = Role::query()->create([
            'name' => 'User',
            'code' => 'user'
        ]);

        $admin_user = User::query()->create([
            'name' => 'admin',
            'phone' => '79011132487',
            'role_id' => $admin_role->id,
            'password' => 'admin'
        ]);

        $default_user = User::query()->create([
            'name' => 'Iam default user',
            'phone' => '79999999999',
            'role_id' => $user_role->id,
            'password' => 'user'
        ]);
    }
}
