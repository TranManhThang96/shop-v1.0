<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            //UsersTableSeeder::class,
            ProvinceTableSeeder::class,
            DistrictTableSeeder::class,
            WardTableSeeder::class,
            CategoriesTableSeeder::class,
            DiscountTableSeeder::class,
            ProductTableSeeder::class,
            ProductItemTableSeeder::class,
            CustomerTableSeeder::class,
            PostTableSeeder::class

        ]);
        //cach viet 2
//        $this->call(UsersTableSeeder::class);
//        $this->call(CategoriesTableSeeder::class);

    }
}
