<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
            'name' => 'Michael',
            'email' => 'michael@admin.com',
            'password' => bcrypt('password'),
            'avatar' => '1.png',
            'admin' => 1,
        ]);

        $user1 = App\User::create([
            'name' => 'Michael',
            'email' => 'michael@user.com',
            'password' => bcrypt('password'),
            'avatar' => '1.png',
            'admin' => 0,
        ]);

        $user = App\User::create([
            'name' => 'Stephen',
            'email' => 'stephen@admin.com',
            'password' => bcrypt('password'),
            'avatar' => '1.png',
            'admin' => 1,
        ]);
    }
}
