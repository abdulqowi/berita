<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name' => 'Qowi ',
            'email' => 'superadmin@role.test',
            'password' => bcrypt('admin'),
        ]);

        $admin = User::create([
            'name' => 'Ikhsan Heriyawan',
            'email' => 'author@role.test',
            'password' => bcrypt('admin'),
        ]);

        $superadmin->assignRole('Admin');
        $admin->assignRole('Author');
    }
}
