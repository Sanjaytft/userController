<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('password'),
            'role' => 1, 
        ]);

        
        User::factory()->create([
            'name' => 'SubAdmin',
            'email' => 'subadmin@admin.com',
            'password' => Hash::make('password'),
            'role' => 2, 
        ]);
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 3, 
        ]);
    }
}
