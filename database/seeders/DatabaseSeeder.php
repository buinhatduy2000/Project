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
            'last_name' => 'Admin',
            'dob' => '2000-09-01',
            'phone_number' => '0888888888',
            'email' => 'duybngch18459@fpt.edu.vn',
            'address' => 'Ha Noi, Viet Nam',
            'department' => 'Management',
        ]);
        
        \App\Models\Account::create([
            'user_name' => "staff_account_1",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'staff',
        ]);
        Personal::create([
            'user_id' => 2,
            'first_name' => 'Staff',
            'last_name' => 'Duy',
            'dob' => '2000-09-01',
            'phone_number' => '0888888888',
            'email' => 'buinhatduykbhb.2000@gmail.com',
            'address' => 'Ha Noi, Viet Nam',
            'department' => 'IT',
        ]);


        \App\Models\Account::create([
            'user_name' => "staff_account_2",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'staff',
        ]);

        Personal::create([
            'user_id' => 3,
            'first_name' => 'Staff',
            'last_name' => 'Minh',
            'dob' => '2000-11-08',
            'phone_number' => '0888888888',
            'email' => 'minhnngbh18582@fpt.edu.vn',
            'address' => 'Ha Noi, Viet Nam',
            'department' => 'IT',
        ]);
    }
}
