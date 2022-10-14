<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 50; $i++) {
            DB::table('blog_category')->insert([
                'category_id' => rand(1, 7),
                'blog_id' => rand(1, 50),
            ]);
        }
    }
}
