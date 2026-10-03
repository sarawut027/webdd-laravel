<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Helpdesk | แจ้งซ่อมคอมพิวเตอร์</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kanit', 'Inter', sans-serif; }
        .input-field {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        .input-field:focus {
            background-color: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
    </style>
</head>
<body class="bg-white min-h-screen">

    <div class="flex min-h-screen">
        
        <!-- Left Visual Side -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-gray-900 text-white overflow-hidden items-center justify-center">
            <!-- Background Decoration -->
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-blue-600 rounded-full mix-blend-multiply filter blur-[100px] opacity-50 animate-blob"></div>
                <div class="absolute top-[20%] right-[-10%] w-[50%] h-[50%] bg-purple-600 rounded-full mix-blend-multiply filter blur-[100px] opacity-50 animate-blob animation-delay-2000"></div>
                <div class="absolute bottom-[-20%] left-[20%] w-[50%] h-[50%] bg-cyan-600 rounded-full mix-blend-multiply filter blur-[100px] opacity-50 animate-blob animation-delay-4000"></div>
            </div>

            <!-- Content -->
            <div class="relative z-10 max-w-lg p-12 glass-panel rounded-3xl m-8">
                <div class="inline-flex items-center space-x-2 bg-white/20 px-4 py-2 rounded-full mb-6">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                    <span class="text-sm font-medium tracking-wide uppercase text-white/90">IT Support 24/7</span>
                </div>
                <h1 class="text-5xl font-bold mb-6 leading-tight font-['Inter']">We keep you <br><span class="text-blue-400">running.</span></h1>
                <p class="text-lg text-gray-300 font-light leading-relaxed mb-8">
                    ระบบแจ้งซ่อมคอมพิวเตอร์และอุปกรณ์ไอที กรุณากรอกรายละเอียดให้ชัดเจน เพื่อให้เจ้าหน้าที่สามารถแก้ไขปัญหาให้คุณได้อย่างรวดเร็ว
                </p>
                
                <a href="/my-tickets" class="inline-flex items-center space-x-2 text-white hover:text-blue-300 transition group">
                    <span class="font-medium">ดูประวัติการแจ้งซ่อมของคุณ</span>
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>

        <!-- Right Form Side -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 lg:p-24 bg-white">
            <div class="w-full max-w-md">
                
                <div class="lg:hidden mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">IT Helpdesk</h1>
                    <p class="text-gray-500 mt-2">กรอกข้อมูลเพื่อแจ้งซ่อมคอมพิวเตอร์</p>
                    <a href="/my-tickets" class="inline-block mt-4 text-blue-600 text-sm font-medium hover:underline">→ ดูประวัติของฉัน</a>
                </div>

                <div class="mb-10 hidden lg:block">
                    <h2 class="text-3xl font-bold text-gray-900 font-['Inter']">Report an Issue</h2>
                    <p class="text-gray-500 mt-2">กรอกรายละเอียดอุปกรณ์และอาการที่พบ</p>
                </div>

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 rounded-xl p-4 mb-8 flex items-start shadow-sm" role="alert">
                        <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="block sm:inline text-sm">{!! session('success') !!}</span>
                    </div>
                @endif

                <form action="/repair" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">ชื่อ-นามสกุล ผู้แจ้ง</label>
                        <input type="text" name="reporter_name" required 
                            class="input-field w-full px-4 py-3 rounded-xl outline-none text-gray-900" 
                            placeholder="เช่น สมชาย ใจดี">
                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">หมายเลขห้อง</label>
                            <input type="text" name="room_number" required 
                                class="input-field w-full px-4 py-3 rounded-xl outline-none text-gray-900" 
                                placeholder="เช่น IT-301">
                        </div>
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-gray-700">รหัสเครื่อง / Asset ID</label>
                            <input type="text" name="computer_id" required 
                                class="input-field w-full px-4 py-3 rounded-xl outline-none text-gray-900" 
                                placeholder="เช่น PC-05">
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">รายละเอียดอาการเสีย</label>
                        <textarea name="problem_detail" rows="4" required 
                            class="input-field w-full px-4 py-3 rounded-xl outline-none resize-none text-gray-900" 
                            placeholder="อธิบายอาการที่พบอย่างละเอียด เช่น เครื่องเปิดไม่ติด, หน้าจอฟ้า, โปรแกรมค้าง"></textarea>
                    </div>
                    
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-gray-700">แนบภาพประกอบ (ถ้ามี)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-blue-400 transition bg-gray-50">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="file-upload" class="relative cursor-pointer bg-transparent rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>อัปโหลดรูปภาพ</span>
                                        <input id="file-upload" name="image" type="file" accept="image/*" class="sr-only">
                                    </label>
                                    <p class="pl-1">หรือลากไฟล์มาวาง</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF ไม่เกิน 2MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" 
                            class="w-full bg-gray-900 hover:bg-black text-white font-semibold py-3.5 px-4 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-0.5 text-lg">
                            ส่งเรื่องแจ้งซ่อม
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>

</body>
</html>
