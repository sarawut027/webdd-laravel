<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepairTicket extends Model
{
    /**
     * กำหนดชื่อตารางในฐานข้อมูลที่ Model นี้ทำงานด้วย
     * (เป็น Optional: ถ้าชื่อตารางเป็นพหูพจน์ตามชื่อ Model เช่น repair_tickets สามารถละเว้นบรรทัดนี้ได้)
     */
    protected $table = 'repair_tickets';

    /**
     * $fillable: กำหนดฟิลด์ (Columns) ที่อนุญาตให้บันทึกข้อมูลแบบกลุ่มได้ (Mass Assignment)
     * ช่วยป้องกันความเสี่ยงด้านความปลอดภัย ไม่ให้ผู้ใช้งานส่งค่าฟิลด์ที่ไม่ได้รับอนุญาตเข้ามาบันทึก
     */
    protected $fillable = [
        'user_id',           // รหัสผู้แจ้งซ่อม (อ้างอิงจากตาราง users)
        'ticket_no',         // รหัสใบแจ้งซ่อม (สำหรับไว้อ้างอิง)
        'reporter_name',     // ชื่อผู้แจ้ง
        'room_number',       // หมายเลขห้อง
        'computer_id',       // รหัสประจำเครื่องคอมพิวเตอร์
        'problem_detail',    // รายละเอียดปัญหาหรืออาการเสีย
        'image_path',        // พาธของไฟล์รูปภาพประกอบ
        'status',            // สถานะ (รอดำเนินการ, กำลังซ่อม, เสร็จสิ้น)
        'technician_remark'  // หมายเหตุผลการซ่อมจากช่าง (Admin)
    ];

    /**
     * การสร้างความสัมพันธ์ของตาราง (Relationship)
     * ประเภท: One-to-One (ย้อนกลับ) หรือ BelongsTo
     * คำอธิบาย: "ใบแจ้งซ่อม 1 ใบ จะเป็นของ ผู้ใช้งาน (User) 1 คนเท่านั้น"
     * 
     * การนำไปใช้งาน (ตัวอย่างใน View): {{ $ticket->user->name }}
     */
    public function user(): BelongsTo
    {
        // ระบุว่า Model RepairTicket นี้ เป็นของ (belongs to) Model User
        return $this->belongsTo(User::class);
    }
}
