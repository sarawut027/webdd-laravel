<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * เมธอด run() จะถูกเรียกใช้งานเมื่อเราใช้คำสั่ง php artisan db:seed
     * ใช้สำหรับสร้างข้อมูลจำลอง (Mock Data) ลงในฐานข้อมูลเริ่มต้น
     */
    public function run(): void
    {
        // 1. สร้างบัญชีสำหรับผู้ดูแลระบบ (Admin / ช่าง IT)
        // ใช้ Factory ในการช่วยสร้าง User จำลอง
        User::factory()->create([
            'name' => 'IT Admin',                 // ชื่อผู้ใช้งาน
            'email' => 'admin@it.com',            // อีเมลสำหรับล็อกอิน
            'password' => Hash::make('password'), // เข้ารหัสรหัสผ่านด้วย Hash::make
            'role' => 'admin',                    // กำหนดสิทธิ์เป็น admin
        ]);

        // 2. สร้างบัญชีสำหรับผู้ใช้งานทั่วไป (User / นักศึกษา / อาจารย์)
        User::factory()->create([
            'name' => 'Somchai User',             // ชื่อผู้ใช้งาน
            'email' => 'user@it.com',             // อีเมลสำหรับล็อกอิน
            'password' => Hash::make('password'), // เข้ารหัสรหัสผ่านด้วย Hash::make
            'role' => 'user',                     // กำหนดสิทธิ์เป็น user
        ]);
        
        // หมายเหตุสำหรับการนำเสนอ: ข้อมูลเหล่านี้ช่วยให้เราสามารถทดสอบระบบ
        // ทั้งในมุมมองของ Admin และมุมมองของ User ได้ทันทีโดยไม่ต้องสมัครสมาชิกใหม่
    }
}
