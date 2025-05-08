<?php

// ใช้เพื่อระบุ namespace สำหรับ Seeder นี้
namespace Database\Seeders;

// การนำเข้าไลบรารีที่จำเป็น
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// คลาส UsersSeeder สืบทอดจาก Seeder
class UsersSeeder extends Seeder
{
    /**
     * ฟังก์ชันนี้จะทำงานเมื่อเราเรียกใช้คำสั่ง seed
     */
    public function run(): void
    {
        // ลบข้อมูลทั้งหมดในตาราง users ก่อน เพื่อป้องกันการซ้ำซ้อน
        DB::table('users')->truncate();

        // กำหนดรหัสผ่านที่ใช้สำหรับผู้ใช้ทั้งหมด (ใช้ bcrypt เพื่อเข้ารหัสรหัสผ่าน)
        $password = bcrypt('123456789');

        // การแทรกข้อมูลผู้ใช้ลงในตาราง 'users'
        DB::table('users')->insert([
            'name' => "test user", // ชื่อผู้ใช้
            'email' => "test@example.com", // อีเมลผู้ใช้
            'password' => $password, // รหัสผ่านที่เข้ารหัส
            'roles_id' => 1 // ระบุบทบาท (roles_id) ของผู้ใช้
        ]);
        
        // การแทรกข้อมูลผู้ใช้อีกคนลงในตาราง
        DB::table('users')->insert([
            'name' => "John Doe", 
            'email' => "johndoe@example.com",
            'password' => $password, 
            'roles_id' => 2
        ]);
        
        // การแทรกข้อมูลผู้ใช้อีกคนลงในตาราง
        DB::table('users')->insert([
            'name' => "user 1", 
            'email' => "user1@example.com", 
            'password' => $password, 
            'roles_id' => 3
        ]);

        // การแทรกข้อมูลผู้ใช้อีกคนลงในตาราง
        DB::table('users')->insert([
            'name' => "user 2", 
            'email' => "user2@example.com", 
            'password' => $password, 
            'roles_id' => 3
        ]);
        
        // การแทรกข้อมูลผู้ใช้อีกคนลงในตาราง
        DB::table('users')->insert([
            'name' => "user 3", 
            'email' => "user3@example.com", 
            'password' => $password, 
            'roles_id' => 3
        ]);
        
        // การแทรกข้อมูลผู้ใช้อีกคนลงในตาราง
        DB::table('users')->insert([
            'name' => "user 4", 
            'email' => "user4@example.com", 
            'password' => $password, 
            'roles_id' => 3
        ]);
        
        // การแทรกข้อมูลผู้ใช้อีกคนลงในตาราง
        DB::table('users')->insert([
            'name' => "user 5", 
            'email' => "user5@example.com", 
            'password' => $password, 
            'roles_id' => 3
        ]);

        // การแทรกข้อมูลผู้ใช้อีกคนลงในตาราง
        DB::table('users')->insert([
            'name' => "user 6", 
            'email' => "user6@example.com", 
            'password' => $password, 
            'roles_id' => 3
        ]);
        
        // การแทรกข้อมูลผู้ใช้อีกคนลงในตาราง
        DB::table('users')->insert([
            'name' => "user 7", 
            'email' => "user7@example.com", 
            'password' => $password, 
            'roles_id' => 3
        ]);
        
        // การแทรกข้อมูลผู้ใช้อีกคนลงในตาราง
        DB::table('users')->insert([
            'name' => "user 8", 
            'email' => "user8@example.com", 
            'password' => $password, 
            'roles_id' => 3
        ]);
        
        // การแทรกข้อมูลผู้ใช้อีกคนลงในตาราง
        DB::table('users')->insert([
            'name' => "user 9", 
            'email' => "user9@example.com", 
            'password' => $password, 
            'roles_id' => 3
        ]);
    }
}
