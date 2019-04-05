<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            [
                'name' => 'adidas',
                'image' => 'logo.png',
                'content' => 'thương hiệu nổi tiếng'
            ],
            [
                'name' => 'fabbi',
                'image' => 'logo.png',
                'content' => 'thương hiệu nổi tiếng'
            ],
        ]);
    }
}
