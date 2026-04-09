<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     */   
    public function run(): void
    {
         User::create([
            'name' => 'Admin User',
            'email' => 'saad@gmail.com',
            'password' => Hash::make('saad'),
            'role'=> 1,
        ]);
    }
}
