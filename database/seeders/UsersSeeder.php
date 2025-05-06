<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        $password = bcrypt('123456789');
        DB::table('users')->insert([
            'name' => "test user",
            'email' => "test@example.com",
            'password' => $password,
            'roles_id' => 1
        ]);
        DB::table('users')->insert([
            'name' => "John Doe",
            'email' => "johndoe@example.com",
            'password' => $password,
            'roles_id' => 2
        ]);
        DB::table('users')->insert([
            'name' => "user 1",
            'email' => "user1@example.com",
            'password' => $password,
            'roles_id' => 3
        ]);
        DB::table('users')->insert([
            'name' => "user 2",
            'email' => "user2@example.com",
            'password' => $password,
            'roles_id' => 3
        ]);
        DB::table('users')->insert([
            'name' => "user 3",
            'email' => "user3@example.com",
            'password' => $password,
            'roles_id' => 3
        ]);
        DB::table('users')->insert([
            'name' => "user 4",
            'email' => "user4@example.com",
            'password' => $password,
            'roles_id' => 3
        ]);
        DB::table('users')->insert([
            'name' => "user 5",
            'email' => "user5@example.com",
            'password' => $password,
            'roles_id' => 3
        ]);
        DB::table('users')->insert([
            'name' => "user 6",
            'email' => "user6@example.com",
            'password' => $password,
            'roles_id' => 3
        ]);
        DB::table('users')->insert([
            'name' => "user 7",
            'email' => "user7@example.com",
            'password' => $password,
            'roles_id' => 3
        ]);
        DB::table('users')->insert([
            'name' => "user 8",
            'email' => "user8@example.com",
            'password' => $password,
            'roles_id' => 3
        ]);
        DB::table('users')->insert([
            'name' => "user 9",
            'email' => "user9@example.com",
            'password' => $password,
            'roles_id' => 3
        ]);
    }
}
