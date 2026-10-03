<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Support & Helpdesk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kanit', 'Inter', sans-serif; }
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .hero-gradient {
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900 font-['Inter']">IT HELPDESK.</span>
                </div>
                <div class="flex items-center space-x-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition">เข้าสู่ระบบแล้ว (Dashboard)</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">เข้าสู่ระบบ</a>
                        <a href="{{ route('register') }}" class="bg-gray-900 hover:bg-black text-white text-sm font-medium px-5 py-2.5 rounded-full transition shadow-md hover:shadow-lg transform hover:-translate-y-0.5">ลงทะเบียน</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-grow flex items-center justify-center hero-gradient pt-20 relative overflow-hidden">
        
        <!-- Abstract Shapes -->
        <div class="absolute top-1/4 left-10 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-[80px] opacity-70 animate-blob"></div>
        <div class="absolute top-1/3 right-10 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-[80px] opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-10 left-1/3 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-[80px] opacity-70 animate-blob animation-delay-4000"></div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 lg:px-8 text-center">
            <div class="inline-flex items-center space-x-2 bg-white px-4 py-2 rounded-full mb-8 shadow-sm border border-gray-100">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                <span class="text-sm font-medium text-gray-600">ระบบให้บริการแจ้งซ่อมออนไลน์</span>
            </div>
            
            <h1 class="text-6xl md:text-7xl font-extrabold text-gray-900 tracking-tight leading-tight mb-6 font-['Inter']">
                Fix it. <br class="md:hidden"> <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Fast & Simple.</span>
            </h1>
            
            <p class="mt-4 text-xl text-gray-500 max-w-2xl mx-auto font-light leading-relaxed mb-10">
                หมดปัญหาคอมพิวเตอร์เสียแล้วไม่รู้จะแจ้งใคร ระบบนี้ช่วยให้คุณส่งเรื่องถึงช่าง IT ได้โดยตรง พร้อมติดตามสถานะการซ่อมได้แบบเรียลไทม์
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6">
                <a href="/repair" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white text-lg font-medium px-8 py-4 rounded-full transition shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    แจ้งซ่อมอุปกรณ์
                </a>
                <a href="/my-tickets" class="w-full sm:w-auto bg-white hover:bg-gray-50 text-gray-900 text-lg font-medium px-8 py-4 rounded-full transition shadow-md hover:shadow-lg border border-gray-200 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    ติดตามสถานะงาน
                </a>
            </div>
        </div>
    </main>

    <!-- Features Section -->
    <section class="bg-white py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">รวดเร็ว ทันใจ</h3>
                    <p class="text-gray-500">ระบบส่งข้อมูลตรงถึงช่าง IT ทันที ไม่ต้องรอคิวเอกสาร หรือโทรตามงานให้วุ่นวาย</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-50 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">เช็กสถานะได้ตลอด</h3>
                    <p class="text-gray-500">ดูได้ทันทีว่างานถึงขั้นตอนไหน รอดำเนินการ หรือกำลังซ่อมอยู่ ผ่านระบบ Dashboard</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">ข้อมูลปลอดภัย</h3>
                    <p class="text-gray-500">ประวัติการแจ้งซ่อมทั้งหมดถูกจัดเก็บอย่างเป็นระบบ พร้อมการยืนยันตัวตนแบบปลอดภัย</p>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
