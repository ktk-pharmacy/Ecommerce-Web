<?php

namespace Database\Seeders;

use App\Model\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MyanmarSettingsSeeder extends Seeder
{
    protected $settings = [
        [
            'key'                       =>  'site_name_mm',
            'value'                     =>  'SayAid',
        ],
        [
            'key'                       =>  'site_title_mm',
            'value'                     =>  'SayAid',
        ],
        [
            'key'                       =>  'default_phone_number_mm',
            'value'                     =>  '+959-959472316',
        ],
        [
            'key'                       =>  'default_address_mm',
            'value'                     =>  'အမှတ်(၄၈/၁) ၆၉လမ်း၊ ၁၀၈လမ်းနှင့် ၁၀၉လမ်းကြား၊ချမ်းမြသာစည်မြို့နယ်၊မန္တလေး၊',
        ],
        [
            'key'                       =>  'bonous_1_title_mm',
            'value'                     =>  'Medical Accessories MM',
        ],
        [
            'key'                       =>  'bonous_1_txt_mm',
            'value'                     =>  'over 1 million+ homes for sale available on the website we can match you with a house you will want to call home.',
        ],
        [
            'key'                       =>  'bonous_2_title_mm',
            'value'                     =>  'Medical Accessories mm2',
        ],
        [
            'key'                       =>  'bonous_2_txt_mm',
            'value'                     =>  'over 1 million+ homes for sale available on the website we can match you with a house you will want to call home.',
        ],
        [
            'key'                       =>  'bonous_3_title_mm',
            'value'                     =>  'Medical Accessories mm3',
        ],
        [
            'key'                       =>  'bonous_3_txt_mm',
            'value'                     =>  'over 1 million+ homes for sale available on the website we can match you with a house you will want to call home.',
        ],
        [
            'key'                       =>  'bonous_4_title_mm',
            'value'                     =>  'Medical Accessories mm4',
        ],
        [
            'key'                       =>  'bonous_4_txt_mm',
            'value'                     =>  'over 1 million+ homes for sale available on the website we can match you with a house you will want to call home.',
        ],
        [
            'key'                       =>  'bonous_5_title_mm',
            'value'                     =>  'Medical Accessories mm5',
        ],
        [
            'key'                       =>  'bonous_5_txt_mm',
            'value'                     =>  'over 1 million+ homes for sale available on the website we can match you with a house you will want to call home.',
        ],
        [
            'key'                       =>  'bonous_6_title_mm',
            'value'                     =>  'Medical Accessories mm6',
        ],
        [
            'key'                       =>  'bonous_6_txt_mm',
            'value'                     =>  'over 1 million+ homes for sale available on the website we can match you with a house you will want to call home.',
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->settings as $index => $setting) {
            $result = Setting::create($setting);
            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }
        $this->command->info('Inserted '.count($this->settings). ' records');
    }
}
