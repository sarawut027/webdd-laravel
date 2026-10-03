<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('repair_tickets', function (Blueprint $table) {
            $table->id();
            // รหัสใบแจ้งซ่อม เช่น TICKET-202609-001
            $table->string('ticket_no')->unique();
            
            // เชื่อมกับตาราง users ว่าใครเป็นคนแจ้ง
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // เก็บชื่อคนแจ้ง (เผื่อไม่ได้เป็นคนเดียวกับ user หรือกรอกชื่ออื่น)
            $table->string('reporter_name');
            // เก็บหมายเลขห้อง เช่น IT-301
            $table->string('room_number');
            // เก็บหมายเลขเครื่อง หรือ Asset Tag
            $table->string('computer_id');
            // เก็บรายละเอียดอาการที่เสีย
            $table->text('problem_detail');
            
            // เก็บที่อยู่ไฟล์ภาพ (เผื่อแนบภาพประกอบ)
            $table->string('image_path')->nullable();
            
            // หมายเหตุจากช่าง (เช่น ช่างพิมพ์ตอบกลับว่าซ่อมเสร็จแล้ว เปลี่ยน RAM ให้)
            $table->text('technician_remark')->nullable();
            
            // เก็บสถานะการซ่อม (ตั้งค่าเริ่มต้นเป็น "รอดำเนินการ")
            $table->string('status')->default('รอดำเนินการ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_tickets');
    }
};
