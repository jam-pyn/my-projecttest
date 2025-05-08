<?php

use App\Http\Controllers\APIs\DishController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|

*/
// Route สำหรับ API ที่เกี่ยวข้องกับ User

//ระบุว่าเส้นทางนี้ต้องการการตรวจสอบสิทธิ์โดยใช้ Sanctum 
//get('/user'): สร้างเส้นทาง GET เพื่อดึงข้อมูลผู้ใช้ที่ได้รับการยืนยัน
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {


    //$request->user(): คืนค่าข้อมูลของผู้ใช้ที่ทำการ authenticate ผ่าน Sanctum
    return $request->user();
});

//กำหนดว่าเส้นทางในกลุ่มนี้จะต้องผ่าน middleware auth:sanctum และ api
//Route::group หมายถึงการจัดกลุ่ม Route ที่มีลักษณะการทำงานหรือเงื่อนไขที่เหมือนกันไว้ในกลุ่มเดียวกัน
Route::group(['middleware' => ['api', 'auth:sanctum']], function () {

    //Route POST /userById: เมื่อมีการส่งคำขอ POST มาที่ /userById จะเรียกใช้ฟังก์ชัน 
    //userById ใน UserController เพื่อดึงข้อมูลของผู้ใช้จากฐานข้อมูลโดยใช้ ID ของผู้ใช้
    Route::post(
        '/userById',
        [
            \App\Http\Controllers\APIs\UserController::class,
            'userById'
        ]
    )->name('user.by.id'); //name('user.by.id'): ตั้งชื่อให้กับ route นี้เพื่อใช้ในที่อื่น ๆ

    Route::post(
        '/userWithDatatable',
        [
            \App\Http\Controllers\APIs\UserController::class,
            'userWithDatatable'
        ]

    )->name('user.with.datatable');

    Route::put(
        '/users/update',
        [
            \App\Http\Controllers\APIs\UserController::class,
            'updateApi'
        ]
    )->name('user.update');

    Route::delete(
        '/users/delete',
        [
            \App\Http\Controllers\APIs\UserController::class,
            'deleteApi'
        ]
    )->name('user.delete');
});





Route::group(['middleware' => ['api', 'auth:sanctum']], function () {
    // ดึงข้อมูล dish ตาม ID
    Route::get('/dish/{id}', [
        \App\Http\Controllers\APIs\DishController::class,
        'show'
    ])->name('dish.show');

    Route::post(
        '/dishById',
        [
            \App\Http\Controllers\APIs\DishController::class,
            'dishById'
        ]
    )->name('dish.by.id');

    Route::post(
        '/dishWithDatatable',
        [
            \App\Http\Controllers\APIs\DishController::class,
            'dishWithDatatable'
        ]
    )->name('dish.with.datatable');

    Route::put(
        '/dish/update',
        [
            \App\Http\Controllers\APIs\DishController::class,
            'updateDishApi'
        ]
    )->name('dish.update');

    Route::delete(
        '/dish/delete',
        [
            \App\Http\Controllers\APIs\DishController::class,
            'deleteApi'
        ]
    )->name('dish.delete');
});
