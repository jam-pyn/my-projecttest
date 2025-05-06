<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dishes')->insert([
            ['dish_name' => 'ข้าวผัดกะเพรา', 'price' => '80.00' , 'category_id' => '1'],
            ['dish_name' => 'ต้มยำกุ้ง', 'price' => '150.00' , 'category_id' => '2'],
            ['dish_name' => 'ส้มตำ', 'price' => '60.00' , 'category_id' => '3'],
            ['dish_name' => 'ผัดไทย', 'price' => '100.00' , 'category_id' => '1'],
            ['dish_name' => 'ข้าวมันไก่', 'price' => '120.00' , 'category_id' => '1'],


        ]);
    }
}
