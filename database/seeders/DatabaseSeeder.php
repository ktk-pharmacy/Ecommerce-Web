<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(CreatePermissionSeeder::class);
        // $this->call(CreateAdminUserSeeder::class);
        // $this->call(CreateDefaultImageSeeder::class);
        // $this->call(CreateNrcPrefixSeeder::class);
        // $this->call(CreateLocationSeeder::class);
        // $this->call(CreateDefaultBlogCategorySeeder::class);
        // $this->call(AddSliderSidebarSeeder::class);
        // $this->call(SettingsTableSeeder::class);
        $this->call(AdditionPermissionSeeder::class);
    }
}
