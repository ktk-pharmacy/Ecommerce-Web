<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateNrcPrefixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = database_path('master_data/nrc_prefix.sql');
        DB::unprepared(file_get_contents($path));
        $this->command->info('NRC Prefix table seeded!');
    }
}
