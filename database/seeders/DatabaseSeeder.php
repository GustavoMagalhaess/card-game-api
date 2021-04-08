<?php

namespace Database\Seeders;

use App\Models\Players;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Players::factory(20)->create();
    }
}
