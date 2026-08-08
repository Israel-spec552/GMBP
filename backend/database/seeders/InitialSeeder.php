<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class InitialSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $roles = [
            'super-admin',
            'municipal-admin',
            'system-admin',
            'finance-officer',
            'revenue-officer',
            'planning-officer',
            'inspector',
            'business-owner',
            'citizen'
        ];

        foreach ($roles as $r) {
            Role::firstOrCreate(['name' => $r]);
        }

        // Sample permissions (expand as needed)
        $perms = [
            'business.view',
            'business.create',
            'business.update',
            'business.delete',
            'permit.approve',
            'payment.process',
            'report.view'
        ];

        foreach ($perms as $p) {
            Permission::firstOrCreate(['name' => $p]);
        }

        // Assign permissions to roles (example)
        Role::where('name', 'super-admin')->first()->givePermissionTo(Permission::all());
        Role::where('name', 'finance-officer')->first()->givePermissionTo(['payment.process', 'report.view']);
        Role::where('name', 'revenue-officer')->first()->givePermissionTo(['business.view', 'report.view']);

        // Create a seeded admin user
        $admin = User::firstOrCreate([
            'email' => 'israel@example.com'
        ], [
            'name' => 'Seed Admin',
            'password' => Hash::make('Password123!')
        ]);

        $admin->assignRole('super-admin');
    }
}
