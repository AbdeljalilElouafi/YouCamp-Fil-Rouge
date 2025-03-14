<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
    $userRole = Role::create(['name' => 'visitor']);
    $managerRole = Role::create(['name' => 'manager']);
    $adminRole = Role::create(['name' => 'admin']);

    
    // $createPost = Permission::create(['name' => 'create-post']);
    // $editPost = Permission::create(['name' => 'edit-post']);
    $manageDashboard = Permission::create(['name' => 'manage-admin-dashboard']);

    
    $adminRole->permissions()->attach([$manageDashboard->id]);

    
    $user = User::find(1);
    $user->roles()->attach($adminRole->id);
    }
}
