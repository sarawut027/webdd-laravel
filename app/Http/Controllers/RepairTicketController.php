<?php

namespace App\Http\Controllers;

use App\Models\RepairTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepairTicketController extends Controller
{
    // =========================================================
    // 🟢 ส่วนที่ 1: สำหรับผู้ใช้งานทั่วไป (User Methods)
    // =========================================================

    /**
     * [GET] แสดงฟอร์มสำหรับแจ้งซ่อมคอมพิวเตอร์
     * หน้าที่: ทำการ Render หน้า View (Blade) ที่มีแบบฟอร์มให้ผู้ใช้กรอกข้อมูล
     */
    public function create()
    {
        return view('repair.create');
    }

    /**
     * [POST] จัดการข้อมูลที่ถูกส่งมาจากฟอร์มแจ้งซ่อม
     * หน้าที่: ตรวจสอบความถูกต้อง (Validation), ประมวลผลไฟล์รูปภาพ, และบันทึกลง Database
     */
    public function store(Request $request)
    {
        // 1. ตรวจสอบข้อมูล (Validate) ว่าผู้ใช้กรอกมาครบถ้วนและถูกต้องตามเงื่อนไขหรือไม่
        $request->validate([
            'reporter_name'  => 'required|string|max:255',
            'room_number'    => 'required|string|max:50',
            'computer_id'    => 'required|string|max:100',
            'problem_detail' => 'required|string',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // ตรวจสอบไฟล์รูปภาพ (ไม่เกิน 2MB)
        ]);

        // 2. สร้าง Object หรือ Instance ใหม่ของ Model RepairTicket
        $ticket = new RepairTicket();
        
        // 3. ผูกข้อมูล User ID ปัจจุบันเข้ากับใบแจ้งซ่อม (เพื่อทราบว่าใครเป็นผู้แจ้ง)
        $ticket->user_id = Auth::id();
        
        // 4. สร้างรหัสอ้างอิงใบแจ้งซ่อมอัตโนมัติ (รูปแบบ: TICKET-[ปีเดือน]-[สุ่มตัวเลข 4 หลัก])
        $ticket->ticket_no = 'TICKET-' . date('Ym') . '-' . rand(1000, 9999);
        
        // 5. นำข้อมูลที่ผ่านการ Validate จากฟอร์ม ($request) มากำหนดค่าลงใน Model
        $ticket->reporter_name  = $request->reporter_name;
        $ticket->room_number    = $request->room_number;
        $ticket->computer_id    = $request->computer_id;
        $ticket->problem_detail = $request->problem_detail;
        
        // 6. จัดการระบบอัปโหลดไฟล์ (กรณีที่ผู้ใช้แนบรูปภาพปัญหามาด้วย)
        if ($request->hasFile('image')) {
            // บันทึกไฟล์ลงในโฟลเดอร์ storage/app/public/repairs
            $path = $request->file('image')->store('repairs', 'public');
            $ticket->image_path = $path; // เก็บเฉพาะข้อมูล Path ลงฐานข้อมูลเพื่อนำไปดึงรูปแสดงผลภายหลัง
        }

        // 7. กำหนดสถานะเริ่มต้นให้กับใบแจ้งซ่อม
        $ticket->status = 'รอดำเนินการ';
        
        // 8. สั่งบันทึกข้อมูลทั้งหมดลงฐานข้อมูล (Insert into database)
        $ticket->save();

        // 9. ทำการ Redirect กลับไปที่หน้าเดิม พร้อมกับส่งข้อความแจ้งเตือนผลลัพธ์ (Flash Session)
        return redirect()->back()->with('success', 'ส่งข้อมูลแจ้งซ่อมเรียบร้อยแล้ว! รหัสอ้างอิงของคุณคือ: ' . $ticket->ticket_no);
    }

    /**
     * [GET] แสดงประวัติใบแจ้งซ่อมของตนเอง (My Tickets)
     * หน้าที่: ดึงเฉพาะข้อมูลใบแจ้งซ่อมที่เป็นของผู้ใช้ที่กำลัง Login อยู่เท่านั้น
     */
    public function myTickets()
    {
        // ใช้ Query Builder (Eloquent ORM) ค้นหาจาก user_id และเรียงลำดับจากล่าสุด
        $tickets = RepairTicket::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();
                    
        return view('repair.my_tickets', compact('tickets'));
    }

    // =========================================================
    // 🔴 ส่วนที่ 2: สำหรับผู้ดูแลระบบ (Admin / Technician Methods)
    // =========================================================

    /**
     * [GET] แสดงหน้ารายการแจ้งซ่อมทั้งหมด (Admin Dashboard)
     * หน้าที่: ดึงข้อมูลใบแจ้งซ่อมในระบบทั้งหมด เพื่อนำมาตรวจสอบและบริหารจัดการ
     */
    public function index()
    {
        // Query ดึงใบแจ้งซ่อมทั้งหมดจากฐานข้อมูล เรียงตามเวลาที่แจ้งล่าสุด
        $tickets = RepairTicket::orderBy('created_at', 'desc')->get();
        return view('repair.index', compact('tickets'));
    }

    /**
     * [POST] อัปเดตสถานะและเพิ่มหมายเหตุการทำงานจากช่าง (Update Status & Remark)
     * หน้าที่: รับข้อมูลอัปเดตจาก Admin เพื่อเปลี่ยนสถานะงานซ่อม
     */
    public function updateStatus(Request $request, $id)
    {
        // 1. ค้นหาใบแจ้งซ่อมจาก ID (หากไม่พบข้อมูล จะแสดงหน้า 404 Not Found อัตโนมัติ)
        $ticket = RepairTicket::findOrFail($id);
        
        // 2. ตรวจสอบว่ามีการส่งค่า 'สถานะ' มาให้เปลี่ยนหรือไม่
        if ($request->has('status')) {
            $ticket->status = $request->status;
        }
        
        // 3. ตรวจสอบว่ามีการบันทึก 'หมายเหตุจากช่าง' หรือไม่ (เช่น ซ่อมเสร็จแล้วแก้ปัญหาอย่างไร)
        if ($request->has('technician_remark')) {
            $ticket->technician_remark = $request->technician_remark;
        }

        // 4. บันทึกการเปลี่ยนแปลงลงฐานข้อมูล (Update statement)
        $ticket->save();

        // 5. Redirect กลับหน้าเดิมพร้อมแสดงข้อความสำเร็จ
        return redirect()->back()->with('success', 'อัปเดตสถานะและหมายเหตุการซ่อมเรียบร้อยแล้ว');
    }
}
