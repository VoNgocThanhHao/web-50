<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'username' => 'admin',
            'email' => '19004058@st.vlute.edu.vn',
            'password' => bcrypt('admin'),
            'hint_password' => 'admin',
            'permission' => 2,
        ],[
            'username' => 'guest',
            'email' => 'kennen330@gmail.com',
            'password' => bcrypt('guest'),
            'hint_password' => 'guest',
            'permission' => 0,
        ],[
            'username' => 'staff',
            'email' => '19004046@st.vlute.edu.vn',
            'password' => bcrypt('staff'),
            'hint_password' => 'staff',
            'permission' => 1,
        ],]);

    }
}
