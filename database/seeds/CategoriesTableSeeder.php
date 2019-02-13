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
                'alias' => 'sach',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Âm nhạc',
                'alias' => 'am-nhac',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Đồng hồ',
                'alias' => 'dong-ho',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Trang sức',
                'alias' => 'trang-suc',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Đồ chơi',
                'alias' => 'do-choi',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Công cụ',
                'alias' => 'cong-cu',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Thiết bị điện tử, điện lạnh',
                'alias' => 'thiet-bi-dien-tu-dien-lanh',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Văn phòng phẩm',
                'alias' => 'van-phong-pham',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Thể thao',
                'alias' => 'the-thao',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Điện thoại và máy tính bảng',
                'alias' => 'dien-thoai-va-may-tinh-bang',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Bếp và phòng ăn',
                'alias' => 'bep-va-phong-an',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Đồ gia dụng',
                'alias' => 'do-gia-dung',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Chăm sóc sức khỏe & làm đẹp',
                'alias' => 'cham-soc-suc-khoe-lam-dep',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Đồ nội thất & trang trí',
                'alias' => 'do-noi-that-trang-tri',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Thời trang & du lịch',
                'alias' => 'thoi-trang-du-lich',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Máy tính & laptop',
                'alias' => 'may-tinh-laptop',
                'parent_id' => 0,
                'active' => 1
            ],
            ['name' => 'Máy ảnh & máy quay phim',
                'alias' => 'may-anh-quay-phim',
                'parent_id' => 0,
                'active' => 1
            ]
        ]);
    }
}
