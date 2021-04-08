<?php

namespace Database\Seeders;

use App\Models\UsersScores;
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
        UsersScores::factory(20)->create();
    }
}
