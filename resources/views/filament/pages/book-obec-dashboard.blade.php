<x-filament-panels::page>
    <div class="space-y-6">

        <!-- 1. PREMIUM GLASSMORPHIC HEADER BANNER -->
        <div class="relative overflow-hidden rounded-2xl border border-white/5 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-950 p-6 shadow-2xl" style="border-radius: 1.25rem; border: 1px solid rgba(255, 255, 255, 0.05); padding: 1.75rem;">
            <!-- Glow background accents -->
            <div class="absolute -right-16 -top-16 w-36 h-36 rounded-full bg-teal-500/10 blur-3xl" style="filter: blur(40px);"></div>
            <div class="absolute -left-16 -bottom-16 w-36 h-36 rounded-full bg-purple-500/5 blur-3xl" style="filter: blur(40px);"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between; gap: 1.5rem; flex-wrap: wrap;">
                <div class="space-y-1">
                    <h1 class="text-xl font-extrabold text-white tracking-tight" style="font-size: 1.35rem; font-weight: 800; color: #fff;">
                        🏛️ ระบบรับส่งหนังสือราชการ สพฐ. (OBEC Document Portal)
                    </h1>
                    <p class="text-xs text-gray-400 max-w-2xl" style="font-size: 0.75rem; color: #9ca3af; line-height: 1.5;">
                        ศูนย์เชื่อมโยงระบบการรับและส่งหนังสือราชการระหว่างสำนักงานคณะกรรมการการศึกษาขั้นพื้นฐาน (สพฐ.) ส่วนกลาง และสำนักงานเขตพื้นที่การศึกษาโดยตรง
                    </p>
                </div>
                
                <!-- Active Tab Badge Indicator -->
                <div class="px-4 py-1.5 rounded-full text-xs font-bold shadow-lg border transition-all duration-300"
                     style="border-radius: 9999px; font-size: 0.725rem; padding: 0.35rem 1rem;
                     @if($activeTab === 'receive') background-color: rgba(16, 185, 129, 0.1); color: #34d399; border-color: rgba(16, 185, 129, 0.2);
                     @elseif($activeTab === 'send') background-color: rgba(167, 139, 250, 0.1); color: #c084fc; border-color: rgba(167, 139, 250, 0.2);
                     @else background-color: rgba(99, 102, 241, 0.1); color: #818cf8; border-color: rgba(99, 102, 241, 0.2); @endif">
                    <span class="inline-block w-2 h-2 rounded-full mr-1.5 animate-pulse"
                          style="width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-right: 0.375rem;
                          @if($activeTab === 'receive') background-color: #10b981;
                          @elseif($activeTab === 'send') background-color: #a78bfa;
                          @else background-color: #6366f1; @endif"></span>
                    กำลังดู: @if($activeTab === 'receive') รายการหนังสือรับ สพฐ.
                            @elseif($activeTab === 'send') รายการหนังสือส่ง สพฐ.
                            @else คู่มือการใช้งานระบบ @endif
                </div>
            </div>
        </div>

        <!-- 2. HIGHLY STYLISH HORIZONTAL TAB NAVIGATION BAR -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem;">
            
            <!-- Tab 1: รายการหนังสือรับ -->
            <button wire:click="setTab('receive')" 
                    class="group flex flex-col items-center justify-center p-3 rounded-xl border transition-all duration-300 relative overflow-hidden"
                    style="border-radius: 0.75rem; text-align: center; cursor: pointer; outline: none;
                    @if($activeTab === 'receive') background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(16, 185, 129, 0.05) 100%); border-color: rgba(16, 185, 129, 0.4); box-shadow: 0 0 15px rgba(16, 185, 129, 0.1);
                    @else background-color: rgba(255, 255, 255, 0.01); border-color: rgba(255, 255, 255, 0.05); @endif">
                <span class="text-xl mb-1 group-hover:scale-110 transition duration-300" style="font-size: 1.2rem;">📥</span>
                <span class="text-[11px] font-bold @if($activeTab === 'receive') text-emerald-400 @else text-gray-400 group-hover:text-white @endif" style="font-size: 0.7rem;">รายการหนังสือรับ</span>
            </button>

            <!-- Tab 2: รายการหนังสือส่ง -->
            <button wire:click="setTab('send')" 
                    class="group flex flex-col items-center justify-center p-3 rounded-xl border transition-all duration-300 relative overflow-hidden"
                    style="border-radius: 0.75rem; text-align: center; cursor: pointer; outline: none;
                    @if($activeTab === 'send') background: linear-gradient(135deg, rgba(167, 139, 250, 0.15) 0%, rgba(167, 139, 250, 0.05) 100%); border-color: rgba(167, 139, 250, 0.4); box-shadow: 0 0 15px rgba(167, 139, 250, 0.1);
                    @else background-color: rgba(255, 255, 255, 0.01); border-color: rgba(255, 255, 255, 0.05); @endif">
                <span class="text-xl mb-1 group-hover:scale-110 transition duration-300" style="font-size: 1.2rem;">📤</span>
                <span class="text-[11px] font-bold @if($activeTab === 'send') text-purple-400 @else text-gray-400 group-hover:text-white @endif" style="font-size: 0.7rem;">รายการหนังสือส่ง</span>
            </button>

            <!-- Tab 3: คู่มือ -->
            <button wire:click="setTab('manual')" 
                    class="group flex flex-col items-center justify-center p-3 rounded-xl border transition-all duration-300 relative overflow-hidden"
                    style="border-radius: 0.75rem; text-align: center; cursor: pointer; outline: none;
                    @if($activeTab === 'manual') background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(99, 102, 241, 0.05) 100%); border-color: rgba(99, 102, 241, 0.4); box-shadow: 0 0 15px rgba(99, 102, 241, 0.1);
                    @else background-color: rgba(255, 255, 255, 0.01); border-color: rgba(255, 255, 255, 0.05); @endif">
                <span class="text-xl mb-1 group-hover:scale-110 transition duration-300" style="font-size: 1.2rem;">📘</span>
                <span class="text-[11px] font-bold @if($activeTab === 'manual') text-indigo-400 @else text-gray-400 group-hover:text-white @endif" style="font-size: 0.7rem;">คู่มือ</span>
            </button>

        </div>

        <!-- 3. DATATABLE / GUIDE / FORM CONTENT CONTAINER -->
        <div class="space-y-4 bg-white/[0.02] border border-white/5 rounded-2xl p-6 shadow-xl" style="border-radius: 1rem; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
            
            @if($activeTab !== 'manual' && $activeTab !== 'publish')
                <!-- TOP PAGINATION -->
                <div class="flex items-center justify-between border border-white/5 bg-white/[0.02] px-4 py-3 sm:px-6 rounded-xl" style="border: 1px solid rgba(255,255,255,0.05); background-color: rgba(255,255,255,0.02); display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 1.5rem; border-radius: 0.75rem;">
                    <div class="text-xs text-gray-400" style="font-size: 0.75rem; color: #9ca3af;">
                        กำลังแสดง <span class="font-semibold text-white">{{ $showingStart }}</span> ถึง <span class="font-semibold text-white">{{ $showingEnd }}</span> จาก <span class="font-semibold text-white">{{ $totalItems }}</span> รายการ
                    </div>
                    <div class="flex items-center gap-2" style="display: flex; gap: 0.5rem;">
                        <button wire:click="setPage(1)" @if($page <= 1) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab === 'receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab === 'send') hover:bg-purple-500/10 hover:border-purple-500/30 @elseif($activeTab === 'unreceived_3_days') hover:bg-red-500/10 hover:border-red-500/30 @else hover:bg-rose-500/10 hover:border-rose-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">หน้าแรก</button>
                        
                        <button wire:click="previousPage" @if($page <= 1) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab === 'receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab === 'send') hover:bg-purple-500/10 hover:border-purple-500/30 @elseif($activeTab === 'unreceived_3_days') hover:bg-red-500/10 hover:border-red-500/30 @else hover:bg-rose-500/10 hover:border-rose-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">&larr; ก่อนหน้า</button>
                        
                        @if(!in_array(1, $pagesToShow))
                            <span class="text-xs text-gray-500 px-1" style="font-size: 0.75rem; color: #6b7280;">...</span>
                        @endif

                        @foreach($pagesToShow as $pageNumber)
                            <button wire:click="setPage({{ $pageNumber }})" class="px-2.5 py-1 text-xs font-semibold rounded @if($page === $pageNumber) text-white @if($activeTab === 'receive') bg-emerald-600 @elseif($activeTab === 'send') bg-purple-600 @elseif($activeTab === 'unreceived_3_days') bg-red-600 @else bg-rose-600 @endif @else text-gray-400 bg-white/5 border border-white/5 hover:text-white @if($activeTab === 'receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab === 'send') hover:bg-purple-500/10 hover:border-purple-500/30 @elseif($activeTab === 'unreceived_3_days') hover:bg-red-500/10 hover:border-red-500/30 @else hover:bg-rose-500/10 hover:border-rose-500/30 @endif @endif" style="padding: 0.25rem 0.625rem; font-size: 0.75rem; border-radius: 0.25rem; @if($page === $pageNumber) border: none; @endif">{{ $pageNumber }}</button>
                        @endforeach
                        
                        @if(!in_array($totalPages, $pagesToShow))
                            <span class="text-xs text-gray-500 px-1" style="font-size: 0.75rem; color: #6b7280;">...</span>
                        @endif

                        <button wire:click="nextPage" @if($page >= $totalPages) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab === 'receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab === 'send') hover:bg-purple-500/10 hover:border-purple-500/30 @elseif($activeTab === 'unreceived_3_days') hover:bg-red-500/10 hover:border-red-500/30 @else hover:bg-rose-500/10 hover:border-rose-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">ถัดไป &rarr;</button>
                        
                        <button wire:click="setPage({{ $totalPages }})" @if($page >= $totalPages) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab === 'receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab === 'send') hover:bg-purple-500/10 hover:border-purple-500/30 @elseif($activeTab === 'unreceived_3_days') hover:bg-red-500/10 hover:border-red-500/30 @else hover:bg-rose-500/10 hover:border-rose-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">หน้าสุดท้าย</button>
                    </div>
                </div>

                <!-- Dynamic Search Filter Bar -->
                <div class="flex flex-col lg:flex-row items-center justify-between gap-4 py-3 border-t border-b border-white/5 bg-white/[0.01]" style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.05); padding: 0.75rem 1rem; gap: 1rem; flex-wrap: wrap;">
                    
                    <!-- Left: Level of Importance blocks -->
                    <div class="flex flex-wrap items-center gap-3 text-xs text-gray-300" style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.75rem; font-size: 0.75rem;">
                        <span class="font-bold text-white">ระดับความสำคัญ</span>
                        <div class="flex items-center gap-1.5" style="display: flex; align-items: center; gap: 0.375rem;">
                            <span class="w-6 h-3 rounded-sm bg-green-500 inline-block border border-green-400/30" style="width: 24px; height: 12px; background-color: #10b981; border-radius: 2px;"></span>
                            <span>ปกติ</span>
                        </div>
                        <div class="flex items-center gap-1.5" style="display: flex; align-items: center; gap: 0.375rem;">
                            <span class="w-6 h-3 rounded-sm bg-yellow-400 inline-block border border-yellow-300/30" style="width: 24px; height: 12px; background-color: #facc15; border-radius: 2px;"></span>
                            <span>ด่วน</span>
                        </div>
                        <div class="flex items-center gap-1.5" style="display: flex; align-items: center; gap: 0.375rem;">
                            <span class="w-6 h-3 rounded-sm bg-orange-500 inline-block border border-orange-400/30" style="width: 24px; height: 12px; background-color: #f97316; border-radius: 2px;"></span>
                            <span>ด่วนมาก</span>
                        </div>
                        <div class="flex items-center gap-1.5" style="display: flex; align-items: center; gap: 0.375rem;">
                            <span class="w-6 h-3 rounded-sm bg-red-500 inline-block border border-red-400/30" style="width: 24px; height: 12px; background-color: #ef4444; border-radius: 2px;"></span>
                            <span>ด่วนที่สุด</span>
                        </div>
                    </div>

                    <!-- Right search filters -->
                    <div class="flex flex-wrap items-center gap-3 text-xs" style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.75rem; flex-wrap: wrap;">
                        <span class="text-gray-300">ค้นหาจาก</span>
                        <select wire:model.live="searchType" class="bg-gray-800 text-white border border-white/10 rounded px-2 py-1 text-xs outline-none" style="background-color: #1f2937; color: #fff; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.25rem; padding: 0.25rem 0.5rem;">
                            <option value="subject">เรื่องหนังสือ</option>
                            <option value="bookno">เลขที่หนังสือ</option>
                        </select>
                        
                        <span class="text-gray-300">คำค้น</span>
                        <input wire:model.live.debounce.300ms="search" type="text" placeholder="พิมพ์คำค้นหา..." 
                               class="bg-gray-800 text-white border border-white/10 rounded px-2 py-1 text-xs w-48 outline-none focus:ring-1 @if($activeTab === 'receive') focus:ring-emerald-500 @elseif($activeTab === 'send') focus:ring-purple-500 @elseif($activeTab === 'unreceived_3_days') focus:ring-red-500 @else focus:ring-rose-500 @endif" 
                               style="background-color: #1f2937; color: #fff; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.25rem; padding: 0.25rem 0.5rem; width: 12rem;">
                        
                        <div wire:loading wire:target="search, page, searchType, activeTab" class="font-semibold text-xs animate-pulse @if($activeTab === 'receive') text-emerald-400 @elseif($activeTab === 'send') text-purple-400 @elseif($activeTab === 'unreceived_3_days') text-red-400 @else text-rose-400 @endif">
                            กำลังโหลด...
                        </div>
                    </div>
                </div>

                <!-- TABLE CONTENT AREA -->
                <div class="overflow-x-auto rounded-xl border border-white/5 bg-white/[0.01]" style="overflow-x: auto; border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.05); background-color: rgba(255,255,255,0.01);">
                    <table class="w-full text-left text-sm text-gray-300" style="width: 100%; text-align: left; font-size: 0.875rem; border-collapse: collapse;">
                        <thead>
                            <tr class="text-xs font-bold text-white uppercase tracking-wider" 
                                style="color: #fff; font-size: 0.75rem; border-bottom: 2px solid rgba(255,255,255,0.1);
                                @if($activeTab === 'receive') background-color: #064e3b;
                                @elseif($activeTab === 'send') background-color: #4c1d95;
                                @elseif($activeTab === 'unreceived_3_days') background-color: #7f1d1d;
                                @else background-color: #881337; @endif">
                                <th style="padding: 1rem 1.25rem; text-align: center; width: 90px; min-width: 60px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ที่</div></th>
                                <th style="padding: 1rem 1.25rem; text-align: center; width: 220px; min-width: 120px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">เลขหนังสือ</div></th>
                                <th style="padding: 1rem 1.25rem; text-align: center; min-width: 250px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">เรื่อง</div></th>
                                <th style="padding: 1rem 1.25rem; text-align: center; width: 130px; min-width: 90px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ดาวน์โหลด</div></th>
                                <th style="padding: 1rem 1.25rem; text-align: center; width: 120px; min-width: 95px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ลงวันที่</div></th>
                                <th style="padding: 1rem 1.25rem; text-align: center; width: 240px; min-width: 130px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">กลุ่มงาน/ต้นทาง</div></th>
                                <th style="padding: 1rem 1.25rem; text-align: center; width: 180px; min-width: 130px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">วันเวลาที่ส่ง</div></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($books as $book)
                                <tr class="hover:bg-white/[0.02] transition-all" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                    <td style="padding: 1rem 1.25rem; text-align: center; font-weight: bold; color: #fff; font-size: 0.8rem;">{{ $book->ms_id }}</td>
                                    <td style="padding: 1rem 1.25rem;">
                                        <div class="flex items-center gap-2" style="display: flex; align-items: center; gap: 0.5rem; justify-content: center;">
                                            <span class="font-semibold text-white">{{ $book->bookno ?: 'ไม่มีเลขหนังสือ' }}</span>
                                            <span class="w-6 h-3 rounded {{ $book->level_color }} inline-block" style="width: 24px; height: 12px; border-radius: 2px;" title="{{ $book->level_text }}"></span>
                                        </div>
                                    </td>
                                    <td style="padding: 1rem 1.25rem; line-height: 1.4;">
                                        <div class="flex items-start gap-1.5" style="display: flex; gap: 0.375rem; align-items: center;">
                                            <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-white/5 border border-white/10" style="display: inline-flex; align-items: center; justify-content: center; width: 20px; height: 20px; border-radius: 50%; flex-shrink: 0;">
                                                @if($activeTab === 'receive' || $activeTab === 'unreceived_3_days') 📥 @else 📤 @endif
                                            </span>
                                            <span class="text-white hover:text-emerald-400 font-semibold cursor-pointer text-[13px]">{{ $book->display_subject }}</span>
                                            @if($book->has_files)
                                                <span class="inline-flex items-center justify-center w-5 h-5 rounded-md bg-amber-500/10 text-amber-400 border border-amber-500/20" style="display: inline-flex; align-items: center; justify-content: center; width: 20px; height: 20px; border-radius: 0.25rem; background-color: rgba(245, 158, 11, 0.1); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.2); flex-shrink: 0; margin-left: 0.25rem;" title="มีไฟล์เอกสารแนบ">
                                                    📄
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td style="padding: 1rem 1.25rem; text-align: center; vertical-align: middle;">
                                        @if($book->has_files)
                                            <div class="flex flex-col gap-1.5 items-center" style="display: flex; flex-direction: column; gap: 0.375rem; align-items: center;">
                                                @foreach($book->attached_files as $file)
                                                    @php
                                                        $ext = strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION));
                                                        $badgeStyle = 'background-color: rgba(244, 63, 94, 0.1); color: #fb7185; border: 1px solid rgba(244, 63, 94, 0.2);';
                                                        if ($ext === 'docx' || $ext === 'doc') {
                                                            $badgeStyle = 'background-color: rgba(59, 130, 246, 0.1); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.2);';
                                                        }
                                                    @endphp
                                                    <a href="{{ asset('modules/book/upload_files/' . $file->file_name) }}" 
                                                       target="_blank"
                                                       download
                                                       class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-[10px] font-semibold transition hover:scale-105 hover:bg-emerald-500 hover:text-white" 
                                                       style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.125rem 0.5rem; font-size: 0.65rem; border-radius: 0.25rem; text-decoration: none; {{ $badgeStyle }}">
                                                        <span>📁 {{ $ext ?: 'PDF' }}</span>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td style="padding: 1rem 1.25rem; text-align: center; white-space: nowrap;">{{ $book->display_signdate }}</td>
                                    <td style="padding: 1rem 1.25rem; text-align: center;">{{ $book->display_sender }}</td>
                                    <td style="padding: 1rem 1.25rem; text-align: center; white-space: nowrap;">{{ $book->display_send_date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="padding: 4rem; text-align: center; color: #9ca3af;">
                                        📭 ไม่พบข้อมูลหนังสือราชการ สพฐ. ตามเงื่อนไขที่กรอง
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- BOTTOM PAGINATION -->
                <div class="flex items-center justify-between border border-white/5 bg-white/[0.02] px-4 py-3 sm:px-6 rounded-xl mt-4" style="border: 1px solid rgba(255,255,255,0.05); background-color: rgba(255,255,255,0.02); display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 1.5rem; border-radius: 0.75rem;">
                    <div class="text-xs text-gray-400" style="font-size: 0.75rem; color: #9ca3af;">
                        กำลังแสดง <span class="font-semibold text-white">{{ $showingStart }}</span> ถึง <span class="font-semibold text-white">{{ $showingEnd }}</span> จาก <span class="font-semibold text-white">{{ $totalItems }}</span> รายการ
                    </div>
                    <div class="flex items-center gap-2" style="display: flex; gap: 0.5rem;">
                        <button wire:click="setPage(1)" @if($page <= 1) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab === 'receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab === 'send') hover:bg-purple-500/10 hover:border-purple-500/30 @elseif($activeTab === 'unreceived_3_days') hover:bg-red-500/10 hover:border-red-500/30 @else hover:bg-rose-500/10 hover:border-rose-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">หน้าแรก</button>
                        
                        <button wire:click="previousPage" @if($page <= 1) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab === 'receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab === 'send') hover:bg-purple-500/10 hover:border-purple-500/30 @elseif($activeTab === 'unreceived_3_days') hover:bg-red-500/10 hover:border-red-500/30 @else hover:bg-rose-500/10 hover:border-rose-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">&larr; ก่อนหน้า</button>
                        
                        @if(!in_array(1, $pagesToShow))
                            <span class="text-xs text-gray-500 px-1" style="font-size: 0.75rem; color: #6b7280;">...</span>
                        @endif

                        @foreach($pagesToShow as $pageNumber)
                            <button wire:click="setPage({{ $pageNumber }})" class="px-2.5 py-1 text-xs font-semibold rounded @if($page === $pageNumber) text-white @if($activeTab === 'receive') bg-emerald-600 @elseif($activeTab === 'send') bg-purple-600 @elseif($activeTab === 'unreceived_3_days') bg-red-600 @else bg-rose-600 @endif @else text-gray-400 bg-white/5 border border-white/5 hover:text-white @if($activeTab === 'receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab === 'send') hover:bg-purple-500/10 hover:border-purple-500/30 @elseif($activeTab === 'unreceived_3_days') hover:bg-red-500/10 hover:border-red-500/30 @else hover:bg-rose-500/10 hover:border-rose-500/30 @endif @endif" style="padding: 0.25rem 0.625rem; font-size: 0.75rem; border-radius: 0.25rem; @if($page === $pageNumber) border: none; @endif">{{ $pageNumber }}</button>
                        @endforeach
                        
                        @if(!in_array($totalPages, $pagesToShow))
                            <span class="text-xs text-gray-500 px-1" style="font-size: 0.75rem; color: #6b7280;">...</span>
                        @endif

                        <button wire:click="nextPage" @if($page >= $totalPages) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab === 'receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab === 'send') hover:bg-purple-500/10 hover:border-purple-500/30 @elseif($activeTab === 'unreceived_3_days') hover:bg-red-500/10 hover:border-red-500/30 @else hover:bg-rose-500/10 hover:border-rose-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">ถัดไป &rarr;</button>
                        
                        <button wire:click="setPage({{ $totalPages }})" @if($page >= $totalPages) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab === 'receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab === 'send') hover:bg-purple-500/10 hover:border-purple-500/30 @elseif($activeTab === 'unreceived_3_days') hover:bg-red-500/10 hover:border-red-500/30 @else hover:bg-rose-500/10 hover:border-rose-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">หน้าสุดท้าย</button>
                    </div>
                </div>

            @elseif($activeTab === 'publish')
                <!-- TAB 3: ส่งหนังสือราชการ FORM (HIGHLY PREMIUM GLASSMORPHIC LAYOUT) -->
                <div class="max-w-2xl mx-auto space-y-6" style="margin: 0 auto;">
                    <div class="relative overflow-hidden rounded-2xl border border-white/5 bg-gradient-to-br from-amber-500/10 via-orange-500/5 to-transparent p-6 shadow-2xl" style="border-radius: 1rem; border: 1px solid rgba(255, 255, 255, 0.05); padding: 1.5rem;">
                        <h2 class="text-lg font-bold text-white mb-1" style="font-size: 1.15rem; font-weight: 800; color: #fff;">✉️ ส่งหนังสือราชการ สพฐ. (Outbound Transmission)</h2>
                        <p class="text-xs text-gray-400" style="font-size: 0.725rem; color: #9ca3af;">จัดเตรียมและนำส่งเอกสารราชการอิเล็กทรอนิกส์ไปยังระบบงานส่วนกลาง สพฐ.</p>
                    </div>

                    <form wire:submit.prevent="submitOutboundDoc" class="space-y-4 bg-white/[0.01] border border-white/5 rounded-2xl p-6" style="border-radius: 1rem; border: 1px solid rgba(255, 255, 255, 0.05); padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                            <!-- Book No -->
                            <div class="flex flex-col gap-1.5" style="display: flex; flex-direction: column; gap: 0.375rem;">
                                <label class="text-xs font-semibold text-gray-300" style="font-size: 0.75rem;">เลขที่หนังสือ</label>
                                <input wire:model="outboundBookNo" type="text" required placeholder="เช่น ศธ 04146..." 
                                       class="bg-gray-900 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-1 focus:ring-amber-500"
                                       style="background-color: #111827; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.5rem; padding: 0.5rem 0.75rem; color: #fff;">
                            </div>

                            <!-- Level of Urgency -->
                            <div class="flex flex-col gap-1.5" style="display: flex; flex-direction: column; gap: 0.375rem;">
                                <label class="text-xs font-semibold text-gray-300" style="font-size: 0.75rem;">ระดับความเร่งด่วน</label>
                                <select wire:model="outboundLevel" 
                                        class="bg-gray-900 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-1 focus:ring-amber-500"
                                        style="background-color: #111827; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.5rem; padding: 0.5rem 0.75rem; color: #fff;">
                                    <option value="1">ปกติ</option>
                                    <option value="2">ด่วน</option>
                                    <option value="3">ด่วนมาก</option>
                                    <option value="4">ด่วนที่สุด</option>
                                </select>
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="flex flex-col gap-1.5" style="display: flex; flex-direction: column; gap: 0.375rem;">
                            <label class="text-xs font-semibold text-gray-300" style="font-size: 0.75rem;">เรื่อง/หัวข้อหนังสือราชการ</label>
                            <input wire:model="outboundSubject" type="text" required placeholder="ระบุเรื่องหนังสือราชการ..." 
                                   class="bg-gray-900 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-1 focus:ring-amber-500"
                                   style="background-color: #111827; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.5rem; padding: 0.5rem 0.75rem; color: #fff;">
                        </div>

                        <!-- Mock File Upload Zone -->
                        <div class="flex flex-col gap-1.5" style="display: flex; flex-direction: column; gap: 0.375rem;">
                            <label class="text-xs font-semibold text-gray-300" style="font-size: 0.75rem;">ไฟล์แนบเอกสาร (.pdf, .doc, .docx)</label>
                            <div class="border border-dashed border-white/10 rounded-lg p-6 flex flex-col items-center justify-center bg-gray-900/50 hover:bg-gray-900/80 transition cursor-pointer"
                                 style="border: 2px dashed rgba(255,255,255,0.1); border-radius: 0.5rem; padding: 1.5rem; display: flex; flex-direction: column; align-items: center; justify-content: center; background-color: rgba(17,24,39,0.5);">
                                <span class="text-2xl mb-2">📁</span>
                                <span class="text-xs text-gray-300 font-semibold" style="font-size: 0.75rem;">ลากไฟล์มาวางที่นี่ หรือ คลิกเพื่อเลือกไฟล์</span>
                                <span class="text-[10px] text-gray-500 mt-1" style="font-size: 0.65rem;">รองรับไฟล์เอกสารทุกประเภท ขนาดสูงสุด 20MB</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-end pt-2" style="display: flex; justify-content: flex-end; padding-top: 0.5rem;">
                            <button type="submit" 
                                    class="px-5 py-2 rounded-lg bg-amber-500 text-black font-bold text-xs hover:bg-amber-400 transition hover:scale-105"
                                    style="background-color: #f59e0b; color: #000; font-weight: 700; font-size: 0.75rem; padding: 0.5rem 1.25rem; border-radius: 0.5rem; border: none; cursor: pointer;">
                                🚀 บันทึกและส่งหนังสือ
                            </button>
                        </div>
                    </form>
                </div>

            @else
                <!-- TAB 6: MANUAL CONTENT (GRID GUIDE CARDS) -->
                <div class="space-y-8">
                    <!-- Manual Hero Box -->
                    <div class="relative overflow-hidden rounded-2xl border border-white/5 bg-gradient-to-br from-indigo-500/10 via-blue-500/5 to-transparent p-6 shadow-2xl" style="border-radius: 1rem; border: 1px solid rgba(255, 255, 255, 0.05); padding: 1.5rem;">
                        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between; gap: 1.5rem; flex-wrap: wrap;">
                            <div class="space-y-1">
                                <h2 class="text-xl font-bold text-white tracking-tight" style="font-size: 1.25rem; font-weight: 800; color: #fff;">📘 คู่มือการใช้งานระบบรับส่งหนังสือราชการ สพฐ.</h2>
                                <p class="text-xs text-gray-400 max-w-xl" style="font-size: 0.725rem; color: #9ca3af; line-height: 1.5;">
                                    เอกสารแนวทางการสืบค้นและติดตามหนังสือดิจิทัลส่วนกลางที่เชื่อมตรงมาจาก สำนักงานคณะกรรมการการศึกษาขั้นพื้นฐาน
                                </p>
                            </div>
                            <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-xs font-semibold" style="display: inline-flex; align-items: center; gap: 0.5rem; background-color: rgba(99, 102, 241, 0.1); color: #818cf8; border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 9999px; font-size: 0.7rem; padding: 0.25rem 0.75rem;">
                                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse" style="width: 8px; height: 8px; border-radius: 50%; background-color: #6366f1;"></span>
                                <span>คู่มือระบบ สพฐ. v1.0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step Cards Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem;">
                        
                        <!-- Card 1: รายการหนังสือรับ -->
                        <div class="bg-white/[0.01] border border-white/5 rounded-xl p-5 shadow-lg" style="border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.05); padding: 1.25rem;">
                            <div class="flex items-center gap-3 mb-3" style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.75rem;">
                                <div class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center border border-emerald-500/20" style="display: flex; width: 2rem; height: 2rem; border-radius: 0.5rem; background-color: rgba(16,185,129,0.1); color: #34d399; border: 1px solid rgba(16,185,129,0.2); justify-content: center; align-items: center;">📥</div>
                                <h3 class="font-bold text-white text-sm" style="font-size: 0.875rem; font-weight: 700;">1. รายการหนังสือรับ สพฐ. (Inbound)</h3>
                            </div>
                            <p class="text-xs text-gray-300 leading-relaxed" style="font-size: 0.7rem; color: #d1d5db; line-height: 1.5;">
                                สำหรับเรียกดูและสืบค้นเอกสารราชการภายนอกที่ส่งตรงมาจาก สพฐ. ส่วนกลางเข้ามายังเขตพื้นที่การศึกษา โดยสามารถดาวน์โหลดไฟล์แนบ PDF/Word เพื่อดำเนินการกระจายข่าวสารต่อได้ทันที
                            </p>
                        </div>

                        <!-- Card 2: รายการหนังสือส่ง -->
                        <div class="bg-white/[0.01] border border-white/5 rounded-xl p-5 shadow-lg" style="border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.05); padding: 1.25rem;">
                            <div class="flex items-center gap-3 mb-3" style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.75rem;">
                                <div class="w-8 h-8 rounded-lg bg-purple-500/10 text-purple-400 flex items-center justify-center border border-purple-500/20" style="display: flex; width: 2rem; height: 2rem; border-radius: 0.5rem; background-color: rgba(167,139,250,0.1); color: #c084fc; border: 1px solid rgba(167,139,250,0.2); justify-content: center; align-items: center;">📤</div>
                                <h3 class="font-bold text-white text-sm" style="font-size: 0.875rem; font-weight: 700;">2. รายการหนังสือส่ง สพฐ. (Outbound)</h3>
                            </div>
                            <p class="text-xs text-gray-300 leading-relaxed" style="font-size: 0.7rem; color: #d1d5db; line-height: 1.5;">
                                สำหรับเรียกดูและติดตามประวัติเอกสารสำคัญที่สำนักงานเขตพื้นที่การศึกษาดำเนินการส่งต่อไปยังสถานศึกษาและโรงเรียนในเครือข่าย เพื่อสั่งการหรือแจ้งให้ทราบตามหนังสือแจ้งเวียนของ สพฐ.
                            </p>
                        </div>

                    </div>

                    <!-- Layout Instructions -->
                    <div class="bg-white/[0.01] border border-white/5 rounded-xl p-5" style="border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.05); padding: 1.25rem;">
                        <h3 class="text-sm font-bold text-white mb-2" style="font-size: 0.875rem; font-weight: 700; color: #fff;">📌 ข้อมูลการสืบค้น</h3>
                        <div class="space-y-2 text-xs text-gray-300" style="display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.7rem; color: #d1d5db; line-height: 1.5;">
                            <p>• ในตารางของแท็บรับและส่ง ท่านสามารถค้นหาข้อมูลจากเรื่องหนังสือหรือเลขที่เอกสารเพื่อความสะดวกสบายและรวดเร็วสูงสุด</p>
                            <p>• หากเอกสารใดมีไฟล์แนบ ระบบจะแสดงไอคอนเอกสารสีเหลืองกระพริบ ท่านสามารถดาวน์โหลดไฟล์แนบต้นฉบับได้โดยกดปุ่มเอกสารในตารางได้โดยตรง</p>
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>
</x-filament-panels::page>
