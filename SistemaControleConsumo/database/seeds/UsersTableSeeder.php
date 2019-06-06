<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Rafael Lucas',
            'email'     => 'rafael@teste.com',
            'access_level' => '0',
            'password'  => bcrypt('102030'),
        ]);

        User::create([
            'name'      => 'Admin',
            'email'     => 'admin@teste.com',
            'access_level' => '0',
            'password'  => bcrypt('admin'),
        ]);
    }
}
