<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
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
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
