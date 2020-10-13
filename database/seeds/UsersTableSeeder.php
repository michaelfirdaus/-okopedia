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
            'email' => 'michael@michael.com',
            'password' => bcrypt('password'),
            'admin' => 1,
        ]);
    }
}
