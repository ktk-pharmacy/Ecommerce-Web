<?php

namespace Database\Seeders;

use App\Model\Term;
use Illuminate\Database\Seeder;

class CreateDefaultBlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Term::create([
            'name' => 'Uncategorized'
        ]);
    }
}
