<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Hussein Mersal',
            'email' => 'mersal@gmail.com',
            'password' => Hash::make('123456'),         
            'phone_number' => '01127797917',
       ],);
       User::create([
        'name' => 'Ahmed Mersal',
        'email' => 'ahmed@gmail.com',
        'password' => Hash::make('123456'),         
        'phone_number' => '01117797917',
   ],);

    }
}
