<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tickets | IT Helpdesk</title>
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
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center gap-3 hover:opacity-80 transition">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <span class="font-bold text-lg tracking-tight font-['Inter'] text-gray-900">IT HELPDESK</span>
                </a>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium text-gray-600">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-500 hover:text-gray-900 font-medium transition">ออกจากระบบ</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-28 pb-12 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 space-y-4 sm:space-y-0">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 font-['Inter']">My Tickets</h1>
                <p class="text-gray-500 mt-1 text-sm">ประวัติการแจ้งซ่อมและสถานะปัจจุบันของคุณ</p>
            </div>
            <a href="/repair" class="inline-flex items-center justify-center bg-gray-900 hover:bg-black text-white text-sm font-medium px-5 py-2.5 rounded-full transition shadow-sm hover:shadow">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                แจ้งซ่อมเพิ่ม
            </a>
        </div>

        <div class="space-y-6">
            @forelse($tickets as $ticket)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition duration-200">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                        
                        <!-- Left Side: Info -->
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="font-['Inter'] font-bold text-lg text-gray-900">{{ $ticket->ticket_no }}</span>
                                
                                @if($ticket->status == 'รอดำเนินการ')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-100">รอดำเนินการ</span>
                                @elseif($ticket->status == 'กำลังซ่อม')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-yellow-50 text-yellow-700 border border-yellow-100">กำลังซ่อม</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-100">เสร็จสิ้น</span>
                                @endif
                            </div>
                            
                            <div class="text-sm text-gray-500 flex items-center gap-4 mb-4">
                                <span class="flex items-center"><svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>{{ $ticket->created_at->format('d M Y, H:i') }}</span>
                                <span class="flex items-center"><svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>ห้อง {{ $ticket->room_number }} (เครื่อง {{ $ticket->computer_id }})</span>
                            </div>

                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">รายละเอียดปัญหา</h4>
                                <p class="text-gray-700 text-sm leading-relaxed">{{ $ticket->problem_detail }}</p>
                                
                                @if($ticket->image_path)
                                    <div class="mt-3">
                                        <a href="{{ Storage::url($ticket->image_path) }}" target="_blank" class="inline-flex items-center text-xs font-medium text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            ดูรูปภาพประกอบ
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Right Side: Technician Remark -->
                        @if($ticket->technician_remark)
                            <div class="md:w-1/3 bg-blue-50/50 rounded-xl p-4 border border-blue-100 mt-4 md:mt-0 flex flex-col justify-center">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <h4 class="text-xs font-bold text-blue-800 uppercase tracking-wider">ข้อความจากช่าง</h4>
                                </div>
                                <p class="text-sm text-blue-900 leading-relaxed">{{ $ticket->technician_remark }}</p>
                            </div>
                        @endif

                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-white rounded-3xl border border-gray-100 border-dashed">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    </div>
                    <h3 class="text-base font-medium text-gray-900">ยังไม่มีประวัติการแจ้งซ่อม</h3>
                    <p class="text-sm text-gray-500 mt-1 mb-6">หากคอมพิวเตอร์หรืออุปกรณ์มีปัญหา สามารถแจ้งซ่อมได้ทันที</p>
                    <a href="/repair" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline">
                        เริ่มแจ้งซ่อมครั้งแรก &rarr;
                    </a>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>
