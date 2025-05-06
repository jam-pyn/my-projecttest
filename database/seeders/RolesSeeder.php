<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['role_name' => 'Super Admin', 'role_code' => 'SADM'],
            ['role_name' => 'Moderator', 'role_code' => 'MOD'],
            ['role_name' => 'Editer', 'role_code' => 'EDT'],
            ['role_name' => 'Viewer', 'role_code' => 'VWR'],
        ]);
    }
}
