<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'test@test.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('user_addresses')->insert([
            'user_id' => User::first()->id,
            'address_line_1' => Str::random(25),
            'city' => Str::random(10),
            'state' => Str::random(10),
            'postal_code' => Str::random(4),
        ]);
    }
}
