<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | IT Helpdesk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kanit', 'Inter', sans-serif; background-color: #f8fafc; }
        .glass-header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
    </style>
</head>
<body class="text-gray-800">

    <!-- Top Navigation -->
    <nav class="fixed w-full z-50 glass-header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <span class="font-bold text-lg tracking-tight font-['Inter']">ADMIN WORKSPACE</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-500">ยินดีต้อนรับ, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium bg-red-50 hover:bg-red-100 px-4 py-2 rounded-full transition">ออกจากระบบ</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-24 pb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 space-y-4 md:space-y-0">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 font-['Inter']">Tickets Overview</h1>
                <p class="text-sm text-gray-500 mt-1">จัดการรายการแจ้งซ่อมทั้งหมดในระบบ</p>
            </div>
            
            <div class="flex space-x-3">
                <div class="bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100 flex items-center">
                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                    <span class="text-sm font-medium">ทั้งหมด <span class="font-bold text-gray-900 ml-1">{{ $tickets->count() }}</span> รายการ</span>
                </div>
                <a href="/" class="bg-white hover:bg-gray-50 px-4 py-2 rounded-xl shadow-sm border border-gray-100 text-sm font-medium transition flex items-center">
                    🏠 กลับหน้าหลัก
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 rounded-2xl p-4 mb-8 flex items-center shadow-sm" role="alert">
                <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="font-medium text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Table Section -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-6 py-5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Ticket Info</th>
                            <th class="px-6 py-5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Location & Device</th>
                            <th class="px-6 py-5 text-xs font-semibold text-gray-500 uppercase tracking-wider w-1/4">Issue Details</th>
                            <th class="px-6 py-5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-5 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($tickets as $ticket)
                        <tr class="hover:bg-gray-50/50 transition duration-150">
                            <!-- Info -->
                            <td class="px-6 py-5 align-top">
                                <div class="font-['Inter'] font-bold text-gray-900">{{ $ticket->ticket_no }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $ticket->created_at->format('d M Y, H:i') }}</div>
                                <div class="text-sm font-medium text-gray-700 mt-3 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ $ticket->reporter_name }}
                                </div>
                            </td>
                            
                            <!-- Location -->
                            <td class="px-6 py-5 align-top">
                                <div class="inline-flex items-center px-2.5 py-1 rounded-md bg-gray-100 text-gray-800 text-xs font-medium mb-2">
                                    📍 ห้อง {{ $ticket->room_number }}
                                </div>
                                <div class="text-sm text-gray-600">
                                    <span class="text-gray-400 text-xs uppercase tracking-wider">Asset:</span><br>
                                    <span class="font-medium text-gray-800">{{ $ticket->computer_id }}</span>
                                </div>
                            </td>

                            <!-- Issue -->
                            <td class="px-6 py-5 align-top">
                                <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-lg border border-gray-100">{{ $ticket->problem_detail }}</p>
                                @if($ticket->image_path)
                                    <a href="{{ Storage::url($ticket->image_path) }}" target="_blank" class="inline-flex items-center mt-3 text-xs font-medium text-blue-600 hover:text-blue-800 hover:bg-blue-50 px-2.5 py-1 rounded-md transition">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        ดูรูปประกอบ
                                    </a>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-5 align-top">
                                @if($ticket->status == 'รอดำเนินการ')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-2"></span> รอดำเนินการ
                                    </span>
                                @elseif($ticket->status == 'กำลังซ่อม')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-50 text-yellow-700 border border-yellow-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 mr-2 animate-pulse"></span> กำลังซ่อม
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-2"></span> เสร็จสิ้น
                                    </span>
                                @endif
                            </td>

                            <!-- Action -->
                            <td class="px-6 py-5 align-top">
                                <form action="/admin/repair/{{ $ticket->id }}/status" method="POST" class="flex flex-col items-end space-y-3">
                                    @csrf
                                    <div class="relative w-full max-w-[160px]">
                                        <select name="status" class="block w-full text-sm font-medium text-gray-700 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none py-2 pl-3 pr-8 appearance-none transition">
                                            <option value="รอดำเนินการ" {{ $ticket->status == 'รอดำเนินการ' ? 'selected' : '' }}>รอดำเนินการ</option>
                                            <option value="กำลังซ่อม" {{ $ticket->status == 'กำลังซ่อม' ? 'selected' : '' }}>กำลังซ่อม</option>
                                            <option value="เสร็จสิ้น" {{ $ticket->status == 'เสร็จสิ้น' ? 'selected' : '' }}>เสร็จสิ้น</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                    <input type="text" name="technician_remark" value="{{ $ticket->technician_remark }}" placeholder="เพิ่มหมายเหตุ (ออปชัน)" class="w-full max-w-[160px] text-xs border border-gray-200 rounded-lg px-3 py-2 bg-white focus:ring-2 focus:ring-blue-500 outline-none transition placeholder-gray-400">
                                    <button type="submit" class="w-full max-w-[160px] bg-gray-900 hover:bg-black text-white text-xs font-medium px-4 py-2 rounded-lg transition shadow-sm hover:shadow">
                                        บันทึกการเปลี่ยนแปลง
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <h3 class="text-sm font-medium text-gray-900">ไม่มีรายการแจ้งซ่อม</h3>
                                <p class="text-sm text-gray-500 mt-1">ยังไม่มีผู้ใช้งานส่งใบแจ้งซ่อมเข้ามาในระบบ</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
