<?php

namespace Database\Seeders;

use App\Model\Advertisement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NewBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Banner 2.3',
            'slider_text1' => null,
            'slider_text2' => null,
            'image_url' => 'assets/theme/img/product/1.png',
            'type' => Advertisement::BANNER_2,
            'btn_txt' => 'View',
            'sorting' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ];
        Advertisement::insert($data);
    }
}
