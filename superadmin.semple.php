<?php
use App\Models\User;
use Spatie\Permission\Models\Role;

$superAdminRole = Role::where('name', 'super-admin')->first();

$superAdmin = User::create([
    'name' => 'Super Admin Name',
    'email' => 'superadmin@example.com',
    'password' => bcrypt('password'),
]);

$superAdmin->assignRole($superAdminRole);
