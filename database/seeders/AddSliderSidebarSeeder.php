<?php

namespace Database\Seeders;

use App\Model\Advertisement;
use Illuminate\Database\Seeder;

class AddSliderSidebarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ads = [
            //Slider
            [
                'name' => 'Slider 1',
                'slider_text1' => 'Up To 50% Off Today Only!',
                'slider_text2' => 'Product Name',
                'image_url' => 'assets/theme/img/slider/71.jpeg',
                'type' => Advertisement::SLIDER,
                'btn_txt' => 'Show Now',
                'sorting' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Slider 2',
                'slider_text1' => 'Default Slider Text 1',
                'slider_text2' => 'Default Slider Text 2',
                'image_url' => 'assets/theme/img/slider/71.jpg',
                'type' => Advertisement::SLIDER,
                'btn_txt' => 'Button Text',
                'sorting' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            //Slider Sidebar
            [
                'name' => 'Slider Sidbar 1',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/banner/18.jpeg',
                'type' => Advertisement::SLIDER_SIDEBAR,
                'btn_txt' => 'View',
                'sorting' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Slider Sidbar 2',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/banner/17.jpg',
                'type' => Advertisement::SLIDER_SIDEBAR,
                'btn_txt' => 'View',
                'sorting' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            //Left Sidebar
            [
                'name' => 'Left Sidbar 1',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/banner/11.jpeg',
                'type' => Advertisement::LEFT_SIDEBAR,
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
                'type' => Advertisement::LEFT_SIDEBAR,
                'btn_txt' => 'View',
                'sorting' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            //Banner 1
            [
                'name' => 'Banner 1',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/banner/1.jpeg',
                'type' => Advertisement::BANNER_1,
                'btn_txt' => 'View',
                'sorting' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Banner 1.2',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/product/1.png',
                'type' => Advertisement::BANNER_1,
                'btn_txt' => 'View',
                'sorting' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Banner 1.3',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/product/1.png',
                'type' => Advertisement::BANNER_1,
                'btn_txt' => 'View',
                'sorting' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            //Banner 2
            [
                'name' => 'Banner 2',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/banner/1.jpeg',
                'type' => Advertisement::BANNER_2,
                'btn_txt' => 'View',
                'sorting' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Banner 2.2',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/product/1.png',
                'type' => Advertisement::BANNER_2,
                'btn_txt' => 'View',
                'sorting' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Banner 2.3',
                'slider_text1' => null,
                'slider_text2' => null,
                'image_url' => 'assets/theme/img/product/1.png',
                'type' => Advertisement::BANNER_2,
                'btn_txt' => 'View',
                'sorting' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        Advertisement::insert($ads);
    }
}
