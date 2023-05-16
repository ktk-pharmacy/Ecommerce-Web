<?php

namespace Database\Seeders;

use App\Model\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BonousSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $bonouses = [
        [
            'key'                       =>  'bonous_1_title',
            'value'                     =>  'Medical Accessories',
        ],
        [
            'key'                       =>  'bonous_1_txt',
            'value'                     =>  'over 1 million+ homes for sale available on the website we can match you with a house you will want to call home.',
        ],
        [
            'key'                       =>  'bonous_1_img',
            'value'                     =>  'assets/theme/img/sayaid1.png',
        ],
        [
            'key'                       =>  'bonous_2_title',
            'value'                     =>  'Medical Accessories',
        ],
        [
            'key'                       =>  'bonous_2_txt',
            'value'                     =>  'over 1 million+ homes for sale available on the website we can match you with a house you will want to call home.',
        ],
        [
            'key'                       =>  'bonous_2_img',
            'value'                     =>  'assets/theme/img/sayaid1.png',
        ],
        [
            'key'                       =>  'bonous_3_title',
            'value'                     =>  'Medical Accessories',
        ],
        [
            'key'                       =>  'bonous_3_txt',
            'value'                     =>  'over 1 million+ homes for sale available on the website we can match you with a house you will want to call home.',
        ],
        [
            'key'                       =>  'bonous_3_img',
            'value'                     =>  'assets/theme/img/sayaid1.png',
        ],
        [
            'key'                       =>  'bonous_4_title',
            'value'                     =>  'Medical Accessories',
        ],
        [
            'key'                       =>  'bonous_4_txt',
            'value'                     =>  'over 1 million+ homes for sale available on the website we can match you with a house you will want to call home.',
        ],
        [
            'key'                       =>  'bonous_4_img',
            'value'                     =>  'assets/theme/img/sayaid1.png',
        ],
        [
            'key'                       =>  'bonous_5_title',
            'value'                     =>  'Medical Accessories',
        ],
        [
            'key'                       =>  'bonous_5_txt',
            'value'                     =>  'over 1 million+ homes for sale available on the website we can match you with a house you will want to call home.',
        ],
        [
            'key'                       =>  'bonous_5_img',
            'value'                     =>  'assets/theme/img/sayaid1.png',
        ],
        [
            'key'                       =>  'bonous_6_title',
            'value'                     =>  'Medical Accessories',
        ],
        [
            'key'                       =>  'bonous_6_txt',
            'value'                     =>  'over 1 million+ homes for sale available on the website we can match you with a house you will want to call home.',
        ],
        [
            'key'                       =>  'bonous_6_img',
            'value'                     =>  'assets/theme/img/sayaid1.png',
        ],
    ];

    public function run()
    {
        foreach ($this->bonouses as $index => $setting) {
            $result = Setting::create($setting);
            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Inserted '.count($this->bonouses). ' records');
    }
}
