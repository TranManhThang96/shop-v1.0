<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DiscountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discount')->insert([
            [
                'id' => 1,
                'name' => 'Khuyến mại tháng 01',
                'code' => 'KM1554427713',
                'type' => 2,
                'type_by' => 1,
                'discount' => 15,
                'limit' => 40000,
                'start'=>'2019-01-01 00:00:00',
                'end' => '2019-01-31 00:00:00',
                'description' => 'khuyến mãi tháng 1 theo sản phẩm'
            ],
            [
                'id' => 2,
                'name' => 'Khuyến mãi tháng 1 đơn hàng',
                'code' => 'KM1554427744',
                'type' => 2,
                'type_by' => 2,
                'discount' => 15,
                'limit' => 150000,
                'start'=>'2019-01-01 00:00:00',
                'end' => '2019-01-31 00:00:00',
                'description' => 'khuyến mãi tháng 1 theo đơn hàng'
            ],

            [
                'id' => 3,
                'name' => 'khuyến mại tháng 2 theo sản phẩm',
                'code' => 'KM1554427983',
                'type' => 1,
                'type_by' => 1,
                'discount' => 30000,
                'limit' => 30000,
                'start'=>'2019-02-01 00:00:00',
                'end' => '2019-02-28 00:00:00',
                'description' => 'khuyến mãi tháng 2 theo sản phẩm'
            ],

            [
                'id' => 4,
                'name' => 'khuyến mại tháng 2 theo đơn hàng',
                'code' => 'KM1554428011',
                'type' => 2,
                'type_by' => 2,
                'discount' => 20,
                'limit' => 150000,
                'start'=>'2019-02-01 00:00:00',
                'end' => '2019-02-28 00:00:00',
                'description' => 'khuyến mãi tháng 2 theo đơn hàng'
            ],

        ]);
    }
}
