<?php

namespace Database\Seeders;

use App\Model\Media;
use Illuminate\Database\Seeder;

class CreateDefaultImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Media::create([
            'image_url' => 'assets/images/users/default-user.png',
            'file_name' => 'default-user.png',
            'file_path' => 'assets/images/users/',
            'file_type' => 'png',
            'file_size' => '5000'
        ]);
    }
}
