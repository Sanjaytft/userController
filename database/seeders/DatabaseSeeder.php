<?php

namespace Database\Seeders;

use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $role= Role::create([
            'name' => 'superadmin',
        ]);
        $role= Role::create([
            'name' => 'admin',
        ]);
       
        $role= Role::create([
            'name' => 'user',
        ]);
       
       
        User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'department_id'=>null,
        ]);

        // Role::create([
        //     'id' => '1',
        //     'name' => 'superadmin',
        // ]);
        // $role = Role::where('name', 'SuperAdmin')->firstOrFail();
        // User::factory()->create([
        //     'name' => 'SuperAdmin',
        //     'email' => 'superadmin@admin.com',
        //     'password' => Hash::make('password'),
        //     'role' => $role->id, 
        // ]);

        // Role::factory()->create([
        //     'id' => '1',
        //     'name' => 'superAdmin',
        // ]);
        // Role::factory()->create([
        //     'id' => '2',
        //     'name' => 'subAdmin',
        // ]);
        // Role::factory()->create([
        //     'id' => '3',
        //     'name' => 'Admin',
        // ]);

        
        // User::factory()->create([
        //     'name' => 'SubAdmin',
        //     'email' => 'subadmin@admin.com',
        //     'password' => Hash::make('password'),
        //     'role' => 2, 
        // ]);
        // User::factory()->create([
        //     'name' => 'Admin',
        //     'email' => 'admin@admin.com',
        //     'password' => Hash::make('password'),
        //     'role' => 3, 
        // ]);
    }
}
