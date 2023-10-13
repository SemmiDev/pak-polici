<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $adminRole = Role::create(['name' => UserRole::ADMIN]);
        $adminRole->givePermissionTo(Permission::all());

        Role::create(['name' => UserRole::POLISI]);

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'nip' => '1234567890',
            'password' => bcrypt('admin123'),
        ]);

        $admin->assignRole($adminRole);
    }
}
