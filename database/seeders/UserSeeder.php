<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('L3star1');
        $users = [
            ['id' => 1, 'username' => 'Andi', 'email' => 'andi@andi.com', 'password' => $password],
            ['id' => 2, 'username' => 'Budi', 'email' => 'budi@budi.com', 'password' => $password],
            ['id' => 3, 'username' => 'Caca', 'email' => 'caca@caca.com', 'password' => $password],
            ['id' => 5, 'username' => 'Deni', 'email' => 'deni@deni.com', 'password' => $password],
            ['id' => 6, 'username' => 'Euis', 'email' => 'euis@euis.com', 'password' => $password],
            ['id' => 7, 'username' => 'Fafa', 'email' => 'fafa@fafa.com', 'password' => $password],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['id' => $user['id']],
                [
                    'name' => $user['username'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                ]
            );
        }
    }
}
