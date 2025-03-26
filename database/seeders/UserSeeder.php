<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => Str::uuid(),
            'name'=>'RemitSo',
            'email'=>'remitso@gmail.com',
            'password'=>Hash::make('12345678'),
        ]);
    }
}
