<?php

namespace Database\Seeders;

use App\Models\Personal;
use Carbon\Carbon;
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
        \App\Models\Account::factory()->create();
        \App\Models\Category::factory(5)->create();
        Personal::create([
            'user_id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Admin'
        ]);
    }
}
