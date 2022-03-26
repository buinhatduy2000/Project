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
        
        \App\Models\Account::create([
            'user_name' => "staff_account_1",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'staff',
        ]);

        Personal::create([
            'user_id' => 2,
            'first_name' => 'Staff',
            'last_name' => '1'
        ]);
    }
}
