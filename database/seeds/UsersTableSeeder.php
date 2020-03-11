<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           [
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            'type' => 'superadmin',
            'email' => 'superadmin@demo.com',
            'phone' => '01715123456',
            'email_verified_at'=>Carbon::now(),
            'password' => bcrypt('superadmin@123')
           ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'type' => 'admin',
                'email' => 'admin@demo.com',
                'phone' => '01715123456',
                'email_verified_at'=>Carbon::now(),
                'password' => bcrypt('admin@123')
            ]
        ]);
    }
}
