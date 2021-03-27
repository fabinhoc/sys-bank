<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            0 => [
                'name' => 'Jose da Silva',
                'email' => 'jose@gmail.com',
                'password' => Hash::make('admin'),
                'created_at' => date('Y-m-d H:i:s')
            ],
            1 => [
                'name' => 'Fabio Cruz',
                'email' => 'fabio@gmail.com',
                'password' => Hash::make('admin'),
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
