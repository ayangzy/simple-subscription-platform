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
        \App\Models\Website::factory(10)->create();
        \App\Models\Subscription::factory(10)->create();
        \App\Models\Post::factory(10)->create();

    }
}
