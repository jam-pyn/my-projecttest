<?php
// ใช้สำหรับการสร้าง migration ใน Laravel
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// สร้างคลาสที่สืบทอดจาก Migration
return new class extends Migration
{
    /**
     * ฟังก์ชันที่ใช้ในการทำงานเมื่อรัน migration
     */
    public function up(): void
    {
        // สร้างตาราง 'users' ที่เก็บข้อมูลของผู้ใช้
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // สร้างคอลัมน์ id เป็น primary key (auto-increment)
            $table->string('name'); // คอลัมน์สำหรับเก็บชื่อผู้ใช้
            $table->string('email')->unique(); // คอลัมน์สำหรับเก็บอีเมล โดยต้องไม่ซ้ำ
            $table->timestamp('email_verified_at')->nullable(); // คอลัมน์สำหรับเก็บเวลาที่อีเมลถูกยืนยัน (nullable)
            $table->string('password'); // คอลัมน์สำหรับเก็บรหัสผ่าน
            $table->integer('roles_id')->default(2); // คอลัมน์สำหรับเก็บ ID ของ roles (บทบาท), ค่าเริ่มต้นเป็น 2
            $table->rememberToken(); // คอลัมน์ที่ใช้สำหรับการจำรหัสผ่านในกรณีที่มีการเข้าสู่ระบบระยะยาว
            $table->foreignId('current_team_id')->nullable(); // คอลัมน์สำหรับเก็บ ID ของทีมที่ผู้ใช้เป็นสมาชิก (nullable)
            $table->string('profile_photo_path', 2048)->nullable(); // คอลัมน์สำหรับเก็บ path ของภาพโปรไฟล์ (nullable)
            $table->timestamps(); // สร้างคอลัมน์ created_at และ updated_at
        });

        // สร้างตาราง 'password_reset_tokens' สำหรับจัดเก็บ token การรีเซ็ตรหัสผ่าน
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // ใช้ email เป็น primary key
            $table->string('token'); // คอลัมน์สำหรับเก็บ token ที่ใช้ในการรีเซ็ตรหัสผ่าน
            $table->timestamp('created_at')->nullable(); // คอลัมน์สำหรับเก็บเวลาที่ token ถูกสร้าง (nullable)
        });

        // สร้างตาราง 'sessions' สำหรับเก็บข้อมูลเซสชันของผู้ใช้
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // คอลัมน์สำหรับเก็บ ID ของเซสชัน (primary key)
            $table->foreignId('user_id')->nullable()->index(); // คอลัมน์สำหรับเก็บ ID ของผู้ใช้ (nullable และสร้างดัชนี)
            $table->string('ip_address', 45)->nullable(); // คอลัมน์สำหรับเก็บที่อยู่ IP ของผู้ใช้ (nullable)
            $table->text('user_agent')->nullable(); // คอลัมน์สำหรับเก็บข้อมูลเกี่ยวกับเบราว์เซอร์ (nullable)
            $table->longText('payload'); // คอลัมน์สำหรับเก็บข้อมูลของเซสชัน
            $table->integer('last_activity')->index(); // คอลัมน์สำหรับเก็บเวลาที่ผู้ใช้ทำกิจกรรมล่าสุด (สร้างดัชนี)
        });
    }

    /**
     * ฟังก์ชันที่ใช้ในการย้อนกลับการทำงานเมื่อยกเลิก migration
     */
    public function down(): void
    {
        // ลบตาราง 'users'
        Schema::dropIfExists('users');
        // ลบตาราง 'password_reset_tokens'
        Schema::dropIfExists('password_reset_tokens');
        // ลบตาราง 'sessions'
        Schema::dropIfExists('sessions');
    }
};
