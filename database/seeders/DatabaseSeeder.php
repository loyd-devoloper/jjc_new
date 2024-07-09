<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(10)->create();

        DB::table('customers')->insert([
            'fullname' => 'Loyd garcia' ,
            'email' => 'loyd@gmail.com',
            'password' => Hash::make('123'),
            'contact' => '09101421073',
            'address' => 'dsad das;dla;ld;sal;d;lsa',
            'contact_verify'=>true
        ]);

    }
}
