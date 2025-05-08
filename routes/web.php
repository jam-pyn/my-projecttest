<?php

use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\Inertia\CurrentUserController;
use App\Http\Controllers\APIs\UserController;
use App\Http\Controllers\DishesController;

//*****ใช้สำหรับหน้าเว็บ

// เมื่อผู้ใช้เข้าถึงหน้าแรก (root route) แอปจะทำการเปลี่ยนเส้นทางไปยังหน้าล็อกอิน
Route::get('/', function () {
    return redirect()->route('login');
});

// กลุ่มของ routes ที่ต้องผ่านการตรวจสอบด้วย middleware ที่กำหนด 
Route::middleware([
    // ตรวจสอบการเข้าสู่ระบบโดยใช้ Sanctum
    'auth:sanctum', 

    // ตรวจสอบการตั้งค่าการเข้าสู่ระบบจาก Jetstream
    config('jetstream.auth_session'), 
    'verified', 
])->group(function () {

    // Route สำหรับหน้าแดชบอร์ด
    Route::get('/dashboard', function () {
        return view('dashboard'); // แสดงหน้าแดชบอร์ด
    })->name('dashboard'); // กำหนดชื่อให้กับ route นี้เพื่อใช้อ้างอิงภายในแอป

    // สร้าง routes สำหรับการทำ CRUD (Create, Read, Update, Delete) กับ "roles" โดยอ้างอิงถึง RolesController
    Route::resource('roles', RolesController::class);

    // สร้าง routes สำหรับการทำ CRUD ผ่าน API สำหรับ "users" โดยอ้างอิงถึง UsersController
    Route::apiresource('users', UsersController::class);

    // สร้าง routes สำหรับการทำ CRUD (Create, Read, Update, Delete) กับ "dishes" โดยอ้างอิงถึง DishesController
    Route::resource('dishes', DishesController::class);
}); // ปิดกลุ่ม routes ที่มี middleware
