<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);

        $admin = Role::create([
            'name' => 'Author',
            'guard_name' => 'web'
        ]);

        $superadmin->givePermissionTo([
            'user-read',
            'user-edit',
            'user-delete',
            'user-create',
            'role-read',
            'role-edit',
            'role-delete',
            'role-create',
            'blog-read',
            'blog-edit',
            'blog-delete',
            'blog-create',
            'category-read',
            'category-edit',
            'category-delete',
            'category-create',
        ]);

        $admin->givePermissionTo([
            'blog-read',
            'blog-edit',
            'blog-delete',
            'blog-create',
        ]);
    }
}
