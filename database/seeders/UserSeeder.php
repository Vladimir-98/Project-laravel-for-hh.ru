<?php

namespace Database\Seeders;

use App\Models\Admin\About;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => '1',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'avatar' => 'team4-1653653157-2322.webp',
            'password' => '$2y$10$faqQ2gDTkCxujRnibmzANuZqgEFva3RUvU2XyB39EQiAF4fXOIUie'

        ]);
    }
}
