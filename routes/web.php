<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepairTicketController;
use Illuminate\Support\Facades\Route;

// ==========================================
// 1. หน้าแรกของเว็บไซต์ (Welcome Page)
// ==========================================
Route::get('/', function () {
    return view('welcome');
});

// ==========================================
// 2. หน้า Dashboard (เมื่อผู้ใช้ล็อกอินสำเร็จ)
// ==========================================
// เช็ค Role ผู้ใช้งานแล้วทำการ Redirect ไปยังหน้าที่เหมาะสม
Route::get('/dashboard', function () {
    // ถ้าผู้ใช้ที่ล็อกอินอยู่มีสถานะ (Role) เป็น admin
    if (auth()->user()->role == 'admin') {
        return redirect()->route('admin.repair.index'); // ไปหน้าจัดการของช่าง
    }
    // ถ้าเป็นผู้ใช้ทั่วไป
    return redirect()->route('repair.my_tickets'); // ไปหน้ารายการแจ้งซ่อมของฉัน
})->middleware(['auth', 'verified'])->name('dashboard');

// ==========================================
// 3. กลุ่ม Routes ที่ต้องล็อกอินก่อนเข้าใช้งาน (Middleware Auth)
// ==========================================
Route::middleware('auth')->group(function () {
    
    // --- ระบบจัดการข้อมูลส่วนตัว (Profile) ของ Laravel Breeze ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- 🟢 ระบบแจ้งซ่อม (สำหรับผู้ใช้งานทั่วไป) ---
    // [GET] แสดงฟอร์มแจ้งซ่อม
    Route::get('/repair', [RepairTicketController::class, 'create'])->name('repair.create');
    // [POST] รับข้อมูลจากฟอร์มเพื่อบันทึกลงฐานข้อมูล
    Route::post('/repair', [RepairTicketController::class, 'store'])->name('repair.store');
    // [GET] ดูประวัติการแจ้งซ่อมของตนเอง
    Route::get('/my-tickets', [RepairTicketController::class, 'myTickets'])->name('repair.my_tickets');

    // --- 🔴 ระบบจัดการหลังบ้าน (สำหรับ Admin / ช่าง IT เท่านั้น) ---
    // มีการตรวจสอบสิทธิ์ (Role Authorization) ภายใน Callback
    Route::get('/admin/repair', function() {
        if (auth()->user()->role !== 'admin') { 
            abort(403, 'เฉพาะผู้ดูแลระบบ (Admin) เท่านั้นที่สามารถเข้าถึงได้'); 
        }
        // เรียกใช้งาน Controller method ผ่าน App()->call()
        return app()->call(RepairTicketController::class . '@index');
    })->name('admin.repair.index');

    // เส้นทางสำหรับอัปเดตสถานะใบแจ้งซ่อม
    Route::post('/admin/repair/{id}/status', function(\Illuminate\Http\Request $request, $id) {
        if (auth()->user()->role !== 'admin') { 
            abort(403, 'เฉพาะผู้ดูแลระบบ (Admin) เท่านั้นที่สามารถเข้าถึงได้'); 
        }
        // เรียกใช้งาน Controller method พร้อมส่งพารามิเตอร์
        return app()->call(RepairTicketController::class . '@updateStatus', ['request' => $request, 'id' => $id]);
    })->name('admin.repair.status');
});

// นำเข้า Routes ของระบบ Authentication (Login/Register) ที่สร้างโดย Breeze
require __DIR__.'/auth.php';
