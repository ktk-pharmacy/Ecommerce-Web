<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = database_path('master_data/region_and_township.sql');
        DB::unprepared(file_get_contents($path));
        $this->command->info('Locations table seeded!');
    }
}
