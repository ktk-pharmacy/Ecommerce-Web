<?php

namespace Database\Seeders;

use App\Model\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    protected $settings = [
        [
            'key'                       =>  'site_name',
            'value'                     =>  'SayAid',
        ],
        [
            'key'                       =>  'site_title',
            'value'                     =>  'SayAid',
        ],
        [
            'key'                       =>  'default_email',
            'value'                     =>  'sayaid.info@gmail.com',
        ],
        [
            'key'                       =>  'default_phone_number',
            'value'                     =>  '+959-959472316',
        ],
        [
            'key'                       =>  'default_address',
            'value'                     =>  'No (48/1) 69th Street, Between 108th & 109th Street, Chanmyatarsi Township, Mandalay',
        ],
        [
            'key'                       =>  'default_location',
            'value'                     =>  '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d992.7286728233495!2d96.12209370921423!3d21.974886266350758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30cb6dcda05db111%3A0x494f4dc84eeac182!2s528%20Health%2CBeauty%20and%20Wellness%20(Shop%201)!5e0!3m2!1sen!2smm!4v1666366799629!5m2!1sen!2smm" width="100%" height="100%" style="border:0;" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        ],
        [
            'key'                       =>  'site_logo',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'site_favicon',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'header_text',
            'value'                     =>  'ဆေးအိတ်မှ လူကြီးမင်းတို အတွက် ဆေးနှင့် ဆေးပစ္စည်းများ၊ လူသုံးကုန်ပစ္စည်း များကို တစ်နေရာတည်းတွင် မျှတသော ဈေးနှုန်းများဖြင့် မန္တလေး မြိုတွင်း ရုံးချိန်အတွင်းမှာ ယူသော ပစ္စည်းများကို ၂၄နာရီ အတွင်း ပိုဆောင်ပေးမည် ဖြစ်ပါသည်။',
        ],
        [
            'key'                       =>  'footer_copyright_text',
            'value'                     =>  '',
        ],
        [
            'key'                       =>  'social_facebook',
            'value'                     =>  '#',
        ],
        [
            'key'                       =>  'social_twitter',
            'value'                     =>  '#',
        ],
        [
            'key'                       =>  'social_instagram',
            'value'                     =>  '#',
        ],
        [
            'key'                       =>  'social_linkedin',
            'value'                     =>  '#',
        ],
        [
            'key'                       =>  'frontend_banner',
            'value'                     =>  'assets/theme/img/bg/bgNew.png',
        ],
        [
            'key'                       =>  'frontend_campaing',
            'value'                     =>  'assets/theme/img/bg/campaing.jpg',
        ]
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
