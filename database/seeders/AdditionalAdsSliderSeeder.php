<?php

namespace Database\Seeders;

use App\Model\Advertisement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdditionalAdsSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = [
            [
                'name' => 'Left Sidbar 1',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/product/1.png',
                'type' => Advertisement::LEFT_SIDEBAR,
                'btn_txt' => 'View',
                'sorting' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Left Sidbar 1',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/banner/11.jpeg',
                'type' => Advertisement::LEFT_SIDEBAR,
                'btn_txt' => 'View',
                'sorting' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Left Sidbar 1',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/product/1.png',
                'type' => Advertisement::LEFT_SIDEBAR,
                'btn_txt' => 'View',
                'sorting' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            //
            [
                'name' => 'Left Sidbar 2',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/product/1.png',
                'type' => Advertisement::SECOND_SLIDER,
                'btn_txt' => 'View',
                'sorting' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Left Sidbar 2',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/product/1.png',
                'type' => Advertisement::SECOND_SLIDER,
                'btn_txt' => 'View',
                'sorting' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Left Sidbar 2',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/product/1.png',
                'type' => Advertisement::SECOND_SLIDER,
                'btn_txt' => 'View',
                'sorting' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Left Sidbar 2',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/product/1.png',
                'type' => Advertisement::SECOND_SLIDER,
                'btn_txt' => 'View',
                'sorting' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Left Sidbar 2',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/product/1.png',
                'type' => Advertisement::SECOND_SLIDER,
                'btn_txt' => 'View',
                'sorting' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        Advertisement::insert($ads);
    }
}
