<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->get();
        $users->map(function($user) {
            DB::table('accounts')->insert([
                'user_id' => $user->id,
                'total' => 10000
            ]);
        });
    }
}
