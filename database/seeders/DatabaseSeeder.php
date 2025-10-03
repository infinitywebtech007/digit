<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user=User::create([
            'name' => 'Admin',
            'email' => 'admin@digit.test',
            'password' => Hash::make('password'),
        ]);
        $role = Role::create(
            ['name' => 'admin'],
            ['name' => 'manager'],
            ['name' => 'employee'],
            // ['name' => 'user'], // default role for customers
        );
        $user->assignRole('admin');

        $permission = Permission::create(

            ['name' => 'create-manager'],
            ['name' => 'edit-manager'],
            ['name' => 'delete-manager'],
            ['name' => 'view-manager'],

            ['name' => 'create-employee'],
            ['name' => 'edit-employee'],
            ['name' => 'delete-employee'],
            ['name' => 'view-employee'],
           
        );
        $role->givePermissionTo($permission);


    }
}
