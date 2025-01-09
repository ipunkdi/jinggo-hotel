<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generalManager = User::create([
            'name' => 'Ayu Wanda Febrian',
            'email' => 'medinfoworkbench@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $generalManager->assignRole('general manager');
    }
}
