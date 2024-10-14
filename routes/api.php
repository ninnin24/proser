<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------------------------------------- 
| API Routes 
|-------------------------------------------------------------------------- 
| 
| Here is where you can register API routes for your application. These 
| routes are loaded by the RouteServiceProvider within a group which 
| is assigned the "api" middleware group. Enjoy building your API! 
| 
*/

use App\Http\Controllers\NovelController;
use App\Http\Controllers\AuthController;

// เส้นทางสำหรับจัดการนวนิยาย
Route::get('/novels', [NovelController::class, 'index']); // เปลี่ยนชื่อเส้นทางเป็น 'novels'

Route::post('/novels', [NovelController::class, 'store']); // เปลี่ยนชื่อเส้นทางเป็น 'novels'

Route::get('/novels/{id}', [NovelController::class, 'show']); // เปลี่ยนชื่อเส้นทางเป็น 'novels'

Route::put('/novels/{id}', [NovelController::class, 'update']); // เปลี่ยนจาก 'products' เป็น 'novels'

Route::delete('/novels/{id}', [NovelController::class, 'destroy']); // เปลี่ยนจาก 'products' เป็น 'novels'

// เส้นทางสำหรับการเข้าสู่ระบบ
Route::post('login', [AuthController::class, 'login']);

// เส้นทางที่ต้องการการตรวจสอบสิทธิ์
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('novels', NovelController::class); // ใช้ resource สำหรับ 'novels'

    Route::post('logout', [AuthController::class, 'logout']); // ฟังก์ชัน logout
});

// เส้นทางเพื่อดึงข้อมูลผู้ใช้ที่เข้าสู่ระบบ
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
