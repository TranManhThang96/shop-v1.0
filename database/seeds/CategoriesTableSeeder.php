<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Sách',
                'slug' => 'sach',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Âm nhạc',
                'slug' => 'am-nhac',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Đồng hồ',
                'slug' => 'dong-ho',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Trang sức',
                'slug' => 'trang-suc',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Đồ chơi',
                'slug' => 'do-choi',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Công cụ',
                'slug' => 'cong-cu',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Thiết bị điện tử, điện lạnh',
                'slug' => 'thiet-bi-dien-tu-dien-lanh',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Văn phòng phẩm',
                'slug' => 'van-phong-pham',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Thể thao',
                'slug' => 'the-thao',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Điện thoại và máy tính bảng',
                'slug' => 'dien-thoai-va-may-tinh-bang',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Bếp và phòng ăn',
                'slug' => 'bep-va-phong-an',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Đồ gia dụng',
                'slug' => 'do-gia-dung',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Chăm sóc sức khỏe & làm đẹp',
                'slug' => 'cham-soc-suc-khoe-lam-dep',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Đồ nội thất & trang trí',
                'slug' => 'do-noi-that-trang-tri',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Thời trang & du lịch',
                'slug' => 'thoi-trang-du-lich',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Máy tính & laptop',
                'slug' => 'may-tinh-laptop',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Máy ảnh & máy quay phim',
                'slug' => 'may-anh-quay-phim',
                'parent_id' => 0,
                'active' => 1
            ]
        ]);
    }
}
