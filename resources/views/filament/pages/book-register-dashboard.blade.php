<x-filament-panels::page>
    <div class="space-y-6">

        <!-- 1. PREMIUM GLASSMORPHIC HEADER BANNER -->
        <div class="relative overflow-hidden rounded-2xl border border-white/5 bg-gradient-to-r from-gray-900 via-gray-800 to-gray-950 p-6 shadow-2xl" style="border-radius: 1.25rem; border: 1px solid rgba(255, 255, 255, 0.05); padding: 1.75rem;">
            <!-- Glow background accents -->
            <div class="absolute -right-16 -top-16 w-36 h-36 rounded-full bg-indigo-500/10 blur-3xl" style="filter: blur(40px);"></div>
            <div class="absolute -left-16 -bottom-16 w-36 h-36 rounded-full bg-emerald-500/5 blur-3xl" style="filter: blur(40px);"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between; gap: 1.5rem; flex-wrap: wrap;">
                <div class="space-y-1">
                    <h1 class="text-xl font-extrabold text-white tracking-tight" style="font-size: 1.35rem; font-weight: 800; color: #fff;">
                        🏛️ ระบบสมุดทะเบียนคุมหนังสือราชการและคลังเอกสาร
                    </h1>
                    <p class="text-xs text-gray-400 max-w-2xl" style="font-size: 0.75rem; color: #9ca3af; line-height: 1.5;">
                        ศูนย์กลางการขึ้นทะเบียน สืบค้น และจัดเก็บข้อมูลระบบงานสารบรรณอิเล็กทรอนิกส์ครบวงจร ทั้งทะเบียนรับ ทะเบียนส่ง คำสั่งสำนักงาน และเกียรติบัตร
                    </p>
                </div>
                
                <!-- Active Tab Badge Indicator -->
                <div class="px-4 py-1.5 rounded-full text-xs font-bold shadow-lg border transition-all duration-300"
                     style="border-radius: 9999px; font-size: 0.725rem; padding: 0.35rem 1rem;
                     @if($activeTab === 'receive') background-color: rgba(16, 185, 129, 0.1); color: #34d399; border-color: rgba(16, 185, 129, 0.2);
                     @elseif($activeTab === 'send') background-color: rgba(59, 130, 246, 0.1); color: #60a5fa; border-color: rgba(59, 130, 246, 0.2);
                     @elseif($activeTab === 'command') background-color: rgba(147, 51, 234, 0.1); color: #c084fc; border-color: rgba(147, 51, 234, 0.2);
                     @elseif($activeTab === 'certificate') background-color: rgba(245, 158, 11, 0.1); color: #fbbf24; border-color: rgba(245, 158, 11, 0.2);
                     @else background-color: rgba(99, 102, 241, 0.1); color: #818cf8; border-color: rgba(99, 102, 241, 0.2); @endif">
                    <span class="inline-block w-2 h-2 rounded-full mr-1.5 animate-pulse"
                          style="width: 8px; height: 8px; border-radius: 50%; display: inline-block; margin-right: 0.375rem;
                          @if($activeTab === 'receive') background-color: #10b981;
                          @elseif($activeTab === 'send') background-color: #3b82f6;
                          @elseif($activeTab === 'command') background-color: #9333ea;
                          @elseif($activeTab === 'certificate') background-color: #f59e0b;
                          @else background-color: #6366f1; @endif"></span>
                    กำลังดู: @if($activeTab === 'receive') ทะเบียนหนังสือรับ
                            @elseif($activeTab === 'send') ทะเบียนหนังสือส่ง
                            @elseif($activeTab === 'command') ทะเบียนคำสั่งสำนักงาน
                            @elseif($activeTab === 'certificate') ทะเบียนเกียรติบัตร
                            @else คู่มือแนะนำการใช้งาน @endif
                </div>
            </div>
        </div>

        <!-- 2. HIGHLY STYLISH HORIZONTAL TAB NAVIGATION BAR -->
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 0.75rem;">
            
            <!-- Tab 1: ทะเบียนหนังสือรับ -->
            <button wire:click="setTab('receive')" 
                    class="group flex flex-col items-center justify-center p-3 rounded-xl border transition-all duration-300 relative overflow-hidden"
                    style="border-radius: 0.75rem; text-align: center; cursor: pointer; outline: none;
                    @if($activeTab === 'receive') background: linear-gradient(135deg, rgba(16, 185, 129, 0.15) 0%, rgba(16, 185, 129, 0.05) 100%); border-color: rgba(16, 185, 129, 0.4); box-shadow: 0 0 15px rgba(16, 185, 129, 0.1);
                    @else background-color: rgba(255, 255, 255, 0.01); border-color: rgba(255, 255, 255, 0.05); @endif">
                <span class="text-xl mb-1 group-hover:scale-110 transition duration-300" style="font-size: 1.25rem;">📥</span>
                <span class="text-xs font-bold @if($activeTab === 'receive') text-emerald-400 @else text-gray-400 group-hover:text-white @endif" style="font-size: 0.725rem;">ทะเบียนหนังสือรับ</span>
            </button>

            <!-- Tab 2: ทะเบียนหนังสือส่ง -->
            <button wire:click="setTab('send')" 
                    class="group flex flex-col items-center justify-center p-3 rounded-xl border transition-all duration-300 relative overflow-hidden"
                    style="border-radius: 0.75rem; text-align: center; cursor: pointer; outline: none;
                    @if($activeTab === 'send') background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(59, 130, 246, 0.05) 100%); border-color: rgba(59, 130, 246, 0.4); box-shadow: 0 0 15px rgba(59, 130, 246, 0.1);
                    @else background-color: rgba(255, 255, 255, 0.01); border-color: rgba(255, 255, 255, 0.05); @endif">
                <span class="text-xl mb-1 group-hover:scale-110 transition duration-300" style="font-size: 1.25rem;">📤</span>
                <span class="text-xs font-bold @if($activeTab === 'send') text-blue-400 @else text-gray-400 group-hover:text-white @endif" style="font-size: 0.725rem;">ทะเบียนหนังสือส่ง</span>
            </button>

            <!-- Tab 3: ทะเบียนคำสั่ง -->
            <button wire:click="setTab('command')" 
                    class="group flex flex-col items-center justify-center p-3 rounded-xl border transition-all duration-300 relative overflow-hidden"
                    style="border-radius: 0.75rem; text-align: center; cursor: pointer; outline: none;
                    @if($activeTab === 'command') background: linear-gradient(135deg, rgba(147, 51, 234, 0.15) 0%, rgba(147, 51, 234, 0.05) 100%); border-color: rgba(147, 51, 234, 0.4); box-shadow: 0 0 15px rgba(147, 51, 234, 0.1);
                    @else background-color: rgba(255, 255, 255, 0.01); border-color: rgba(255, 255, 255, 0.05); @endif">
                <span class="text-xl mb-1 group-hover:scale-110 transition duration-300" style="font-size: 1.25rem;">📜</span>
                <span class="text-xs font-bold @if($activeTab === 'command') text-purple-400 @else text-gray-400 group-hover:text-white @endif" style="font-size: 0.725rem;">ทะเบียนคำสั่ง</span>
            </button>

            <!-- Tab 4: ทะเบียนเกียรติบัตร -->
            <button wire:click="setTab('certificate')" 
                    class="group flex flex-col items-center justify-center p-3 rounded-xl border transition-all duration-300 relative overflow-hidden"
                    style="border-radius: 0.75rem; text-align: center; cursor: pointer; outline: none;
                    @if($activeTab === 'certificate') background: linear-gradient(135deg, rgba(245, 158, 11, 0.15) 0%, rgba(245, 158, 11, 0.05) 100%); border-color: rgba(245, 158, 11, 0.4); box-shadow: 0 0 15px rgba(245, 158, 11, 0.1);
                    @else background-color: rgba(255, 255, 255, 0.01); border-color: rgba(255, 255, 255, 0.05); @endif">
                <span class="text-xl mb-1 group-hover:scale-110 transition duration-300" style="font-size: 1.25rem;">🏆</span>
                <span class="text-xs font-bold @if($activeTab === 'certificate') text-amber-400 @else text-gray-400 group-hover:text-white @endif" style="font-size: 0.725rem;">ทะเบียนเกียรติบัตร</span>
            </button>

            <!-- Tab 5: คู่มือการใช้งาน -->
            <button wire:click="setTab('manual')" 
                    class="group flex flex-col items-center justify-center p-3 rounded-xl border transition-all duration-300 relative overflow-hidden"
                    style="border-radius: 0.75rem; text-align: center; cursor: pointer; outline: none;
                    @if($activeTab === 'manual') background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(99, 102, 241, 0.05) 100%); border-color: rgba(99, 102, 241, 0.4); box-shadow: 0 0 15px rgba(99, 102, 241, 0.1);
                    @else background-color: rgba(255, 255, 255, 0.01); border-color: rgba(255, 255, 255, 0.05); @endif">
                <span class="text-xl mb-1 group-hover:scale-110 transition duration-300" style="font-size: 1.25rem;">📘</span>
                <span class="text-xs font-bold @if($activeTab === 'manual') text-indigo-400 @else text-gray-400 group-hover:text-white @endif" style="font-size: 0.725rem;">คู่มือการใช้งาน</span>
            </button>

        </div>

        <!-- 3. UNIFIED REGISTRY CARD (TABLE & SEARCH GRID) -->
        <div class="space-y-4 bg-white/[0.02] border border-white/5 rounded-2xl p-6 shadow-xl" style="border-radius: 1rem; border: 1px solid rgba(255,255,255,0.05); padding: 1.5rem;">
            
            @if($activeTab !== 'manual')
                <!-- TOP PAGINATION -->
                <div class="flex items-center justify-between border border-white/5 bg-white/[0.02] px-4 py-3 sm:px-6 rounded-xl" style="border: 1px solid rgba(255,255,255,0.05); background-color: rgba(255,255,255,0.02); display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 1.5rem; border-radius: 0.75rem;">
                    <div class="text-xs text-gray-400" style="font-size: 0.75rem; color: #9ca3af;">
                        กำลังแสดง <span class="font-semibold text-white">{{ $showingStart }}</span> ถึง <span class="font-semibold text-white">{{ $showingEnd }}</span> จาก <span class="font-semibold text-white">{{ $totalItems }}</span> รายการ
                    </div>
                    <div class="flex items-center gap-2" style="display: flex; gap: 0.5rem;">
                        <button wire:click="setPage(1)" @if($page <= 1) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab==='receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab==='send') hover:bg-blue-500/10 hover:border-blue-500/30 @elseif($activeTab==='command') hover:bg-purple-500/10 hover:border-purple-500/30 @else hover:bg-amber-500/10 hover:border-amber-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">หน้าแรก</button>
                        
                        <button wire:click="previousPage" @if($page <= 1) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab==='receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab==='send') hover:bg-blue-500/10 hover:border-blue-500/30 @elseif($activeTab==='command') hover:bg-purple-500/10 hover:border-purple-500/30 @else hover:bg-amber-500/10 hover:border-amber-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">&larr; ก่อนหน้า</button>
                        
                        @if(!in_array(1, $pagesToShow))
                            <span class="text-xs text-gray-500 px-1" style="font-size: 0.75rem; color: #6b7280;">...</span>
                        @endif

                        @foreach($pagesToShow as $pageNumber)
                            <button wire:click="setPage({{ $pageNumber }})" class="px-2.5 py-1 text-xs font-semibold rounded @if($page === $pageNumber) text-white @if($activeTab==='receive') bg-emerald-600 @elseif($activeTab==='send') bg-blue-600 @elseif($activeTab==='command') bg-purple-600 @else bg-amber-600 @endif @else text-gray-400 bg-white/5 border border-white/5 hover:text-white @if($activeTab==='receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab==='send') hover:bg-blue-500/10 hover:border-blue-500/30 @elseif($activeTab==='command') hover:bg-purple-500/10 hover:border-purple-500/30 @else hover:bg-amber-500/10 hover:border-amber-500/30 @endif @endif" style="padding: 0.25rem 0.625rem; font-size: 0.75rem; border-radius: 0.25rem; @if($page === $pageNumber) border: none; @endif">{{ $pageNumber }}</button>
                        @endforeach
                        
                        @if(!in_array($totalPages, $pagesToShow))
                            <span class="text-xs text-gray-500 px-1" style="font-size: 0.75rem; color: #6b7280;">...</span>
                        @endif

                        <button wire:click="nextPage" @if($page >= $totalPages) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab==='receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab==='send') hover:bg-blue-500/10 hover:border-blue-500/30 @elseif($activeTab==='command') hover:bg-purple-500/10 hover:border-purple-500/30 @else hover:bg-amber-500/10 hover:border-amber-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">ถัดไป &rarr;</button>
                        
                        <button wire:click="setPage({{ $totalPages }})" @if($page >= $totalPages) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab==='receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab==='send') hover:bg-blue-500/10 hover:border-blue-500/30 @elseif($activeTab==='command') hover:bg-purple-500/10 hover:border-purple-500/30 @else hover:bg-amber-500/10 hover:border-amber-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">หน้าสุดท้าย</button>
                    </div>
                </div>

                <!-- Dynamic Search Filter Bar -->
                <div class="flex flex-col lg:flex-row items-center justify-between gap-4 py-3 border-t border-b border-white/5 bg-white/[0.01]" style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.05); padding: 0.75rem 1rem; gap: 1rem; flex-wrap: wrap;">
                    
                    <!-- Left info icon and label -->
                    <div class="flex items-center gap-3 flex-wrap" style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg border" 
                              style="display: inline-flex; align-items: center; justify-center; width: 2rem; height: 2rem; border-radius: 0.5rem;
                              @if($activeTab==='receive') background-color: rgba(16, 185, 129, 0.1); color: #34d399; border-color: rgba(16, 185, 129, 0.2);
                              @elseif($activeTab==='send') background-color: rgba(59, 130, 246, 0.1); color: #60a5fa; border-color: rgba(59, 130, 246, 0.2);
                              @elseif($activeTab==='command') background-color: rgba(147, 51, 234, 0.1); color: #c084fc; border-color: rgba(147, 51, 234, 0.2);
                              @else background-color: rgba(245, 158, 11, 0.1); color: #fbbf24; border-color: rgba(245, 158, 11, 0.2); @endif">
                            @if($activeTab==='receive') 📥 @elseif($activeTab==='send') 📤 @elseif($activeTab==='command') 📜 @else 🏆 @endif
                        </span>
                        <span class="font-bold text-white text-sm" style="font-size: 0.875rem;">
                            @if($activeTab==='receive') ทะเบียนรับหนังสือราชการภายนอก
                            @elseif($activeTab==='send') ทะเบียนหนังสือส่งออกภายนอก
                            @elseif($activeTab==='command') ทะเบียนคำสั่งผู้บริหารราชการ
                            @else สมุดทะเบียนคุมเกียรติบัตรรางวัล
                            @endif
                        </span>
                        @if($activeTab === 'receive')
                            <button wire:click="openRegisterModal"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-500 hover:bg-emerald-400 text-black font-extrabold text-xs transition duration-300 hover:scale-105 shadow-md shadow-emerald-500/20"
                                    style="border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 0.375rem; border-radius: 0.5rem; font-size: 0.725rem; font-weight: 800; background-color: #10b981; color: #000; padding: 0.35rem 0.75rem;">
                                ➕ ลงทะเบียนหนังสือ
                            </button>
                        @endif
                    </div>

                    <!-- Right search filters -->
                    <div class="flex flex-wrap items-center gap-3 text-xs" style="display: flex; align-items: center; gap: 0.75rem; font-size: 0.75rem; flex-wrap: wrap;">
                        <span class="text-gray-300">ค้นหาจาก</span>
                        <select wire:model.live="searchType" class="bg-gray-800 text-white border border-white/10 rounded px-2 py-1 text-xs outline-none" style="background-color: #1f2937; color: #fff; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.25rem; padding: 0.25rem 0.5rem;">
                            @if($activeTab === 'receive')
                                <option value="subject">เรื่องหนังสือรับ</option>
                                <option value="book_no">เลขที่หนังสือ</option>
                                <option value="book_from">หน่วยงานต้นทาง</option>
                            @elseif($activeTab === 'send')
                                <option value="subject">เรื่องหนังสือส่ง</option>
                                <option value="book_no">เลขที่หนังสือส่ง</option>
                                <option value="book_to">ปลายทางผู้รับ</option>
                            @elseif($activeTab === 'command')
                                <option value="subject">เรื่องคำสั่ง</option>
                                <option value="book_no">เลขที่คำสั่ง</option>
                            @elseif($activeTab === 'certificate')
                                <option value="name_cer">ชื่อผู้ได้รับเกียรติบัตร</option>
                                <option value="subject">เรื่อง/รางวัลที่ได้รับ</option>
                            @endif
                        </select>
                        
                        <span class="text-gray-300">คำค้น</span>
                        <input wire:model.live.debounce.300ms="search" type="text" placeholder="พิมพ์คำค้นหา..." 
                               class="bg-gray-800 text-white border border-white/10 rounded px-2 py-1 text-xs w-48 outline-none focus:ring-1 @if($activeTab==='receive') focus:ring-emerald-500 @elseif($activeTab==='send') focus:ring-blue-500 @elseif($activeTab==='command') focus:ring-purple-500 @else focus:ring-amber-500 @endif" 
                               style="background-color: #1f2937; color: #fff; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.25rem; padding: 0.25rem 0.5rem; width: 14rem;">
                        
                        <div wire:loading wire:target="search, page, searchType, activeTab" class="font-semibold text-xs animate-pulse @if($activeTab==='receive') text-emerald-400 @elseif($activeTab==='send') text-blue-400 @elseif($activeTab==='command') text-purple-400 @else text-amber-400 @endif">
                            กำลังโหลด...
                        </div>
                    </div>
                </div>

                <!-- TABLE CONTENT STATE CONTROLLER -->
                <div class="overflow-x-auto rounded-xl border border-white/5 bg-white/[0.01]" style="overflow-x: auto; border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.05); background-color: rgba(255,255,255,0.01);">
                    <table class="w-full text-left text-sm text-gray-300" style="width: 100%; text-align: left; font-size: 0.875rem; border-collapse: collapse;">
                        
                        <!-- TAB 1: RECEIVE THEMED TABLE HEADERS -->
                        @if($activeTab === 'receive')
                            <thead>
                                <tr class="text-xs font-bold text-white uppercase tracking-wider" style="background-color: #064e3b; color: #fff; font-size: 0.75rem; border-bottom: 2px solid rgba(255,255,255,0.1);">
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 90px; min-width: 60px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ทะเบียนรับ</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 150px; min-width: 100px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">เลขที่หนังสือ</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; min-width: 250px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">เรื่องหนังสือรับ</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 120px; min-width: 100px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ดาวน์โหลด</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 120px; min-width: 100px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ลงวันที่</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 180px; min-width: 130px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ส่งกลุ่มงาน</div></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($books as $book)
                                    <tr class="hover:bg-white/[0.02] transition-all" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; font-weight: 700; color: #34d399;">{{ $book->register_number }} / {{ $book->year }}</td>
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; white-space: nowrap; font-family: monospace; font-size: 0.8rem;">{{ $book->book_no }}</td>
                                        <td style="padding: 0.75rem 1.25rem; line-height: 1.4;">
                                            <div class="font-semibold text-white hover:text-emerald-400 cursor-pointer text-[13px]">{{ $book->display_subject }}</div>
                                            <div class="text-[10px] text-gray-400 mt-0.5">จาก: {{ $book->book_from ?: '-' }}</div>
                                        </td>
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; vertical-align: middle;">
                                            @if($book->attachments && $book->attachments->isNotEmpty())
                                                @foreach($book->attachments as $attach)
                                                    <a href="{{ asset('modules/book/upload_files/' . $attach->file_des) }}" target="_blank" download class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-[10px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 hover:bg-emerald-500 hover:text-white transition hover:scale-105" style="text-decoration: none;">
                                                        📂 <span>ดาวน์โหลด</span>
                                                    </a>
                                                @endforeach
                                            @else
                                                <span class="text-[10px] text-gray-500">ไม่มีไฟล์แนบ</span>
                                            @endif
                                        </td>
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; white-space: nowrap;">{{ $book->display_signdate }}</td>
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; white-space: nowrap;"><span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-emerald-400/10 text-emerald-300 border border-emerald-400/20">{{ $book->display_workgroup }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="padding: 3rem; text-align: center; color: #9ca3af;">ไม่พบข้อมูลทะเบียนหนังสือรับ</td></tr>
                                @endforelse
                            </tbody>

                        <!-- TAB 2: SEND THEMED TABLE HEADERS -->
                        @elseif($activeTab === 'send')
                            <thead>
                                <tr class="text-xs font-bold text-white uppercase tracking-wider" style="background-color: #1e3a8a; color: #fff; font-size: 0.75rem; border-bottom: 2px solid rgba(255,255,255,0.1);">
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 90px; min-width: 60px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ทะเบียนส่ง</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 150px; min-width: 100px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">เลขที่หนังสือ</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; min-width: 250px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">เรื่องหนังสือส่ง</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 120px; min-width: 100px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ดาวน์โหลด</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 120px; min-width: 100px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ลงวันที่</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 180px; min-width: 130px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">กลุ่มงานที่ส่ง</div></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($books as $book)
                                    <tr class="hover:bg-white/[0.02] transition-all" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; font-weight: 700; color: #60a5fa;">{{ $book->register_number }} / {{ $book->year }}</td>
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; white-space: nowrap; font-family: monospace; font-size: 0.8rem;">{{ $book->book_no }}</td>
                                        <td style="padding: 0.75rem 1.25rem; line-height: 1.4;">
                                            <div class="font-semibold text-white hover:text-blue-400 cursor-pointer text-[13px]">{{ $book->display_subject }}</div>
                                            <div class="text-[10px] text-gray-400 mt-0.5">ส่งถึง: {{ $book->book_to ?: '-' }}</div>
                                        </td>
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; vertical-align: middle;">
                                            @if($book->attachments && $book->attachments->isNotEmpty())
                                                @foreach($book->attachments as $attach)
                                                    <a href="{{ asset('modules/book/upload_files/' . $attach->file_des) }}" target="_blank" download class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded text-[10px] font-semibold bg-blue-500/10 text-blue-400 border border-blue-500/20 hover:bg-blue-500 hover:text-white transition hover:scale-105" style="text-decoration: none;">
                                                        📂 <span>ดาวน์โหลด</span>
                                                    </a>
                                                @endforeach
                                            @else
                                                <span class="text-[10px] text-gray-500">ไม่มีไฟล์แนบ</span>
                                            @endif
                                        </td>
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; white-space: nowrap;">{{ $book->display_signdate }}</td>
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; white-space: nowrap;"><span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-blue-400/10 text-blue-300 border border-blue-400/20">{{ $book->display_workgroup }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="padding: 3rem; text-align: center; color: #9ca3af;">ไม่พบข้อมูลทะเบียนหนังสือส่ง</td></tr>
                                @endforelse
                            </tbody>

                        <!-- TAB 3: COMMAND THEMED TABLE HEADERS -->
                        @elseif($activeTab === 'command')
                            <thead>
                                <tr class="text-xs font-bold text-white uppercase tracking-wider" style="background-color: #3b0764; color: #fff; font-size: 0.75rem; border-bottom: 2px solid rgba(255,255,255,0.1);">
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 90px; min-width: 60px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ทะเบียนคำสั่ง</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 150px; min-width: 100px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">เลขที่คำสั่ง</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; min-width: 250px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">เรื่องคำสั่ง</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 150px; min-width: 120px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ดาวน์โหลดคำสั่ง</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 120px; min-width: 100px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">สั่ง ณ วันที่</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 120px; min-width: 100px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">วันลงทะเบียน</div></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($books as $book)
                                    <tr class="hover:bg-white/[0.02] transition-all" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; font-weight: 700; color: #c084fc;">{{ $book->register_number }} / {{ $book->year }}</td>
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; white-space: nowrap; font-family: monospace; font-size: 0.8rem;">{{ $book->book_no }}</td>
                                        <td style="padding: 0.75rem 1.25rem; line-height: 1.4;">
                                            <div class="font-semibold text-white hover:text-purple-400 cursor-pointer text-[13px]">{{ $book->display_subject }}</div>
                                            @if($book->comment)
                                                <div class="text-[10px] text-gray-500 mt-0.5" style="font-style: italic;">หมายเหตุ: {{ $book->comment }}</div>
                                            @endif
                                        </td>
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; vertical-align: middle;">
                                            @if($book->has_file)
                                                <a href="{{ asset('modules/bookregister/upload_files3/' . $book->file_name) }}" target="_blank" download class="inline-flex items-center gap-1.5 px-3 py-1 rounded text-xs font-semibold bg-purple-500/10 text-purple-400 border border-purple-500/20 hover:bg-purple-500 hover:text-white transition hover:scale-105" style="display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.25rem 0.75rem; font-size: 0.7rem; border-radius: 0.25rem; text-decoration: none;">
                                                    📂 <span>ดาวน์โหลด PDF</span>
                                                </a>
                                            @else
                                                <span class="text-[10px] text-gray-500">ไม่มีไฟล์คำสั่งแนบ</span>
                                            @endif
                                        </td>
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; white-space: nowrap;">{{ $book->display_signdate }}</td>
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; white-space: nowrap;">{{ $book->display_register_date }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="padding: 3rem; text-align: center; color: #9ca3af;">ไม่พบข้อมูลทะเบียนคำสั่ง</td></tr>
                                @endforelse
                            </tbody>

                        <!-- TAB 4: CERTIFICATE THEMED TABLE HEADERS -->
                        @elseif($activeTab === 'certificate')
                            <thead>
                                <tr class="text-xs font-bold text-white uppercase tracking-wider" style="background-color: #78350f; color: #fff; font-size: 0.75rem; border-bottom: 2px solid rgba(255,255,255,0.1);">
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 90px; min-width: 60px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ทะเบียนรับ</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 150px; min-width: 100px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">เลขที่เกียรติบัตร</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 220px; min-width: 150px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ชื่อผู้รับเกียรติบัตร</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; min-width: 250px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">รางวัล / เรื่องที่ได้รับ</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 120px; min-width: 100px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ดาวน์โหลด</div></th>
                                    <th style="padding: 1rem 1.25rem; text-align: center; width: 120px; min-width: 100px;"><div style="resize: horizontal; overflow: hidden; display: block; margin: 0 auto; width: 100%; white-space: nowrap; padding-bottom: 2px;">ลงวันที่</div></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($books as $book)
                                    <tr class="hover:bg-white/[0.02] transition-all" style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; font-weight: 700; color: #fbbf24;">{{ $book->register_number }} / {{ $book->year }}</td>
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; white-space: nowrap; font-family: monospace; font-size: 0.8rem;">{{ $book->book_no }}</td>
                                        <td style="padding: 0.75rem 1.25rem; font-weight: 600; color: #fff; font-size: 0.85rem;">{{ $book->name_cer }}</td>
                                        <td style="padding: 0.75rem 1.25rem; line-height: 1.4;">
                                            <div class="font-semibold text-white hover:text-amber-400 cursor-pointer text-[13px]">{{ $book->display_subject }}</div>
                                            @if($book->display_subject2)
                                                <div class="text-[11px] text-gray-400 mt-0.5">{{ $book->display_subject2 }}</div>
                                            @endif
                                            @if($book->comment)
                                                <div class="text-[10px] text-gray-500 mt-0.5" style="font-style: italic;">หมายเหตุ: {{ $book->comment }}</div>
                                            @endif
                                        </td>
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; vertical-align: middle;">
                                            @if($book->has_file)
                                                <a href="{{ asset('modules/bookregister/upload_files4/' . $book->file_name) }}" target="_blank" download class="inline-flex items-center gap-1.5 px-3 py-1 rounded text-xs font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20 hover:bg-amber-500 hover:text-white transition hover:scale-105" style="display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.25rem 0.75rem; font-size: 0.7rem; border-radius: 0.25rem; text-decoration: none;">
                                                    📂 <span>ดาวน์โหลด PDF</span>
                                                </a>
                                            @else
                                                <span class="text-[10px] text-gray-500">ไม่มีไฟล์แนบ</span>
                                            @endif
                                        </td>
                                        <td style="padding: 0.75rem 1.25rem; text-align: center; white-space: nowrap;">{{ $book->display_signdate }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="padding: 3rem; text-align: center; color: #9ca3af;">ไม่พบข้อมูลทะเบียนเกียรติบัตร</td></tr>
                                @endforelse
                            </tbody>
                        @endif

                    </table>
                </div>

                <!-- BOTTOM PAGINATION -->
                <div class="flex items-center justify-between border border-white/5 bg-white/[0.02] px-4 py-3 sm:px-6 rounded-xl mt-4" style="border: 1px solid rgba(255,255,255,0.05); background-color: rgba(255,255,255,0.02); display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 1.5rem; border-radius: 0.75rem;">
                    <div class="text-xs text-gray-400" style="font-size: 0.75rem; color: #9ca3af;">
                        กำลังแสดง <span class="font-semibold text-white">{{ $showingStart }}</span> ถึง <span class="font-semibold text-white">{{ $showingEnd }}</span> จาก <span class="font-semibold text-white">{{ $totalItems }}</span> รายการ
                    </div>
                    <div class="flex items-center gap-2" style="display: flex; gap: 0.5rem;">
                        <button wire:click="setPage(1)" @if($page <= 1) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab==='receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab==='send') hover:bg-blue-500/10 hover:border-blue-500/30 @elseif($activeTab==='command') hover:bg-purple-500/10 hover:border-purple-500/30 @else hover:bg-amber-500/10 hover:border-amber-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">หน้าแรก</button>
                        
                        <button wire:click="previousPage" @if($page <= 1) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab==='receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab==='send') hover:bg-blue-500/10 hover:border-blue-500/30 @elseif($activeTab==='command') hover:bg-purple-500/10 hover:border-purple-500/30 @else hover:bg-amber-500/10 hover:border-amber-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">&larr; ก่อนหน้า</button>
                        
                        @if(!in_array(1, $pagesToShow))
                            <span class="text-xs text-gray-500 px-1" style="font-size: 0.75rem; color: #6b7280;">...</span>
                        @endif

                        @foreach($pagesToShow as $pageNumber)
                            <button wire:click="setPage({{ $pageNumber }})" class="px-2.5 py-1 text-xs font-semibold rounded @if($page === $pageNumber) text-white @if($activeTab==='receive') bg-emerald-600 @elseif($activeTab==='send') bg-blue-600 @elseif($activeTab==='command') bg-purple-600 @else bg-amber-600 @endif @else text-gray-400 bg-white/5 border border-white/5 hover:text-white @if($activeTab==='receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab==='send') hover:bg-blue-500/10 hover:border-blue-500/30 @elseif($activeTab==='command') hover:bg-purple-500/10 hover:border-purple-500/30 @else hover:bg-amber-500/10 hover:border-amber-500/30 @endif @endif" style="padding: 0.25rem 0.625rem; font-size: 0.75rem; border-radius: 0.25rem; @if($page === $pageNumber) border: none; @endif">{{ $pageNumber }}</button>
                        @endforeach
                        
                        @if(!in_array($totalPages, $pagesToShow))
                            <span class="text-xs text-gray-500 px-1" style="font-size: 0.75rem; color: #6b7280;">...</span>
                        @endif

                        <button wire:click="nextPage" @if($page >= $totalPages) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab==='receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab==='send') hover:bg-blue-500/10 hover:border-blue-500/30 @elseif($activeTab==='command') hover:bg-purple-500/10 hover:border-purple-500/30 @else hover:bg-amber-500/10 hover:border-amber-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">ถัดไป &rarr;</button>
                        
                        <button wire:click="setPage({{ $totalPages }})" @if($page >= $totalPages) disabled @endif class="px-2 py-1 text-xs font-medium text-gray-400 rounded bg-white/5 border border-white/5 disabled:opacity-40 disabled:cursor-not-allowed hover:text-white @if($activeTab==='receive') hover:bg-emerald-500/10 hover:border-emerald-500/30 @elseif($activeTab==='send') hover:bg-blue-500/10 hover:border-blue-500/30 @elseif($activeTab==='command') hover:bg-purple-500/10 hover:border-purple-500/30 @else hover:bg-amber-500/10 hover:border-amber-500/30 @endif" style="padding: 0.25rem 0.5rem; font-size: 0.75rem; border-radius: 0.25rem;">หน้าสุดท้าย</button>
                    </div>
                </div>

            @else
                <!-- TAB 5: MANUAL CONTENT (GRID GUIDE CARDS) -->
                <div class="space-y-8">
                    <!-- Manual Hero Box -->
                    <div class="relative overflow-hidden rounded-2xl border border-white/5 bg-gradient-to-br from-indigo-500/10 via-blue-500/5 to-transparent p-6 shadow-2xl" style="border-radius: 1rem; border: 1px solid rgba(255, 255, 255, 0.05); padding: 1.5rem;">
                        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between; gap: 1.5rem; flex-wrap: wrap;">
                            <div class="space-y-1">
                                <h2 class="text-xl font-bold text-white tracking-tight" style="font-size: 1.25rem; font-weight: 800; color: #fff;">📘 คู่มือระบบทะเบียนหนังสือราชการอิเล็กทรอนิกส์</h2>
                                <p class="text-xs text-gray-400 max-w-xl" style="font-size: 0.725rem; color: #9ca3af; line-height: 1.5;">
                                    เอกสารแนะนำหลักเกณฑ์และวิธีปฏิบัติสำหรับการใช้งานระบบทะเบียนหนังสือรับ หนังสือส่ง คำสั่ง และเกียรติบัตร เพื่อความสะดวกรวดเร็วและเป็นสากลสูงสุด
                                </p>
                            </div>
                            <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 text-xs font-semibold" style="display: inline-flex; align-items: center; gap: 0.5rem; background-color: rgba(99, 102, 241, 0.1); color: #818cf8; border: 1px solid rgba(99, 102, 241, 0.2); border-radius: 9999px; font-size: 0.7rem; padding: 0.25rem 0.75rem;">
                                <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse" style="width: 8px; height: 8px; border-radius: 50%; background-color: #6366f1;"></span>
                                <span>เวอร์ชันอัปเดต พ.ศ. 2569</span>
                            </div>
                        </div>
                    </div>

                    <!-- Step Cards Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem;">
                        
                        <!-- Card 1: หนังสือรับ -->
                        <div class="bg-white/[0.01] border border-white/5 rounded-xl p-5 shadow-lg" style="border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.05); padding: 1.25rem;">
                            <div class="flex items-center gap-3 mb-3" style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.75rem;">
                                <div class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center border border-emerald-500/20" style="display: flex; width: 2rem; height: 2rem; border-radius: 0.5rem; background-color: rgba(16,185,129,0.1); color: #34d399; border: 1px solid rgba(16,185,129,0.2); justify-content: center; align-items: center;">📥</div>
                                <h3 class="font-bold text-white text-sm" style="font-size: 0.875rem; font-weight: 700;">1. ทะเบียนหนังสือรับ (Inbound)</h3>
                            </div>
                            <ul class="space-y-2 text-xs text-gray-300" style="display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.7rem; color: #d1d5db; list-style-type: none; padding-left: 0;">
                                <li class="flex items-start gap-2" style="display: flex; gap: 0.375rem; align-items: flex-start;"><span class="text-emerald-400 font-bold">✓</span><span>ลงรับเอกสารต้นฉบับภายนอกพร้อมระบบออกคิวเลขที่รับให้อัตโนมัติ</span></li>
                                <li class="flex items-start gap-2" style="display: flex; gap: 0.375rem; align-items: flex-start;"><span class="text-emerald-400 font-bold">✓</span><span>สแกนแนบไฟล์ในรูปแบบ PDF หรือ Word เพื่อการเปิดดูแบบลดโลกร้อน</span></li>
                            </ul>
                        </div>

                        <!-- Card 2: หนังสือส่ง -->
                        <div class="bg-white/[0.01] border border-white/5 rounded-xl p-5 shadow-lg" style="border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.05); padding: 1.25rem;">
                            <div class="flex items-center gap-3 mb-3" style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.75rem;">
                                <div class="w-8 h-8 rounded-lg bg-blue-500/10 text-blue-400 flex items-center justify-center border border-blue-500/20" style="display: flex; width: 2rem; height: 2rem; border-radius: 0.5rem; background-color: rgba(59,130,246,0.1); color: #60a5fa; border: 1px solid rgba(59,130,246,0.2); justify-content: center; align-items: center;">📤</div>
                                <h3 class="font-bold text-white text-sm" style="font-size: 0.875rem; font-weight: 700;">2. ทะเบียนหนังสือส่ง (Outbound)</h3>
                            </div>
                            <ul class="space-y-2 text-xs text-gray-300" style="display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.7rem; color: #d1d5db; list-style-type: none; padding-left: 0;">
                                <li class="flex items-start gap-2" style="display: flex; gap: 0.375rem; align-items: flex-start;"><span class="text-blue-400 font-bold">✓</span><span>ออกเลขที่หนังสือส่งและเลขที่ลงทะเบียนส่งแยกตามปีปฏิทินขององค์กร</span></li>
                                <li class="flex items-start gap-2" style="display: flex; gap: 0.375rem; align-items: flex-start;"><span class="text-blue-400 font-bold">✓</span><span>ระบุปลายทาง ผู้รับส่ง และผู้ลงนามเพื่อเก็บสถิติและง่ายแก่การค้นหา</span></li>
                            </ul>
                        </div>

                        <!-- Card 3: ทะเบียนคำสั่ง -->
                        <div class="bg-white/[0.01] border border-white/5 rounded-xl p-5 shadow-lg" style="border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.05); padding: 1.25rem;">
                            <div class="flex items-center gap-3 mb-3" style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.75rem;">
                                <div class="w-8 h-8 rounded-lg bg-purple-500/10 text-purple-400 flex items-center justify-center border border-purple-500/20" style="display: flex; width: 2rem; height: 2rem; border-radius: 0.5rem; background-color: rgba(147,51,234,0.1); color: #c084fc; border: 1px solid rgba(147,51,234,0.2); justify-content: center; align-items: center;">📜</div>
                                <h3 class="font-bold text-white text-sm" style="font-size: 0.875rem; font-weight: 700;">3. สมุดทะเบียนคำสั่งแต่งตั้ง (Commands)</h3>
                            </div>
                            <ul class="space-y-2 text-xs text-gray-300" style="display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.7rem; color: #d1d5db; list-style-type: none; padding-left: 0;">
                                <li class="flex items-start gap-2" style="display: flex; gap: 0.375rem; align-items: flex-start;"><span class="text-purple-400 font-bold">✓</span><span>บันทึกคำสั่งแต่งตั้งคณะกรรมการและคำสั่งการปฏิบัติงานประจำปี</span></li>
                                <li class="flex items-start gap-2" style="display: flex; gap: 0.375rem; align-items: flex-start;"><span class="text-purple-400 font-bold">✓</span><span>ระบบจัดเก็บไฟล์ PDF คำสั่งและสารบัญคำสั่งเพื่อดาวน์โหลดนำไปใช้งาน</span></li>
                            </ul>
                        </div>

                        <!-- Card 4: เกียรติบัตร -->
                        <div class="bg-white/[0.01] border border-white/5 rounded-xl p-5 shadow-lg" style="border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.05); padding: 1.25rem;">
                            <div class="flex items-center gap-3 mb-3" style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 0.75rem;">
                                <div class="w-8 h-8 rounded-lg bg-amber-500/10 text-amber-400 flex items-center justify-center border border-amber-500/20" style="display: flex; width: 2rem; height: 2rem; border-radius: 0.5rem; background-color: rgba(245,158,11,0.1); color: #fbbf24; border: 1px solid rgba(245,158,11,0.2); justify-content: center; align-items: center;">🏆</div>
                                <h3 class="font-bold text-white text-sm" style="font-size: 0.875rem; font-weight: 700;">4. ทะเบียนเกียรติบัตรรางวัล (Certificates)</h3>
                            </div>
                            <ul class="space-y-2 text-xs text-gray-300" style="display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.7rem; color: #d1d5db; list-style-type: none; padding-left: 0;">
                                <li class="flex items-start gap-2" style="display: flex; gap: 0.375rem; align-items: flex-start;"><span class="text-amber-400 font-bold">✓</span><span>รวบรวมทำประวัติเกียรติบัตรของข้าราชการครู บุคลากร และสถานศึกษา</span></li>
                                <li class="flex items-start gap-2" style="display: flex; gap: 0.375rem; align-items: flex-start;"><span class="text-amber-400 font-bold">✓</span><span>ระบบคัดกรองข้อมูลตามชื่อผู้ได้รับรางวัล และบันทึกประเภทระดับรางวัล</span></li>
                            </ul>
                        </div>

                    </div>

                    <!-- Layout Instructions -->
                    <div class="bg-white/[0.01] border border-white/5 rounded-xl p-5" style="border-radius: 0.75rem; border: 1px solid rgba(255,255,255,0.05); padding: 1.25rem;">
                        <h3 class="text-sm font-bold text-white mb-2" style="font-size: 0.875rem; font-weight: 700; color: #fff;">📌 การปรับขนาดตาราง (Column Resizing & Smart Layout)</h3>
                        <div class="space-y-2 text-xs text-gray-300" style="display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.7rem; color: #d1d5db; line-height: 1.5;">
                            <p>• <strong>การปรับความกว้างคอลัมน์:</strong> ในตารางทุกหน้า ท่านสามารถวางเมาส์ที่เส้นขอบขวาของคอลัมน์ในหัวตารางเพื่อลากยืดหรือหดคอลัมน์ได้อิสระตามความเหมาะสมของขนาดหน้าจอแสดงผล</p>
                            <p>• <strong>สืบค้นและคัดกรอง:</strong> ท่านสามารถระบุคีย์เวิร์ดเพื่อค้นหาข้อมูลแบบเรียลไทม์ (Livewire) และระบบจะทำการเปิดหน้าที่มีข้อมูลชุดล่าสุดขึ้นมาแสดงเป็นหน้าแรกเริ่มต้นให้ตรวจสอบเสมอ</p>
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>

        @if($showRegisterForm)
            <!-- Glassmorphic Modal Overlay -->
            <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm transition-all duration-300"
                 style="position: fixed; inset: 0; z-index: 9999; display: flex; align-items: center; justify-content: center; background-color: rgba(0,0,0,0.6); backdrop-filter: blur(4px); padding: 1rem;">
                
                <!-- Modal Body -->
                <div class="relative w-full max-w-2xl overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-b from-gray-900 via-gray-950 to-black shadow-2xl flex flex-col"
                     style="border-radius: 1.25rem; border: 1px solid rgba(255,255,255,0.1); background: linear-gradient(to bottom, #111827, #030712); padding: 1.75rem; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); max-height: 90vh; display: flex; flex-direction: column;">
                    
                    <!-- Decorative Top bar glow -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-500 to-teal-500" style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(to right, #10b981, #14b8a6);"></div>

                    <!-- Modal Header (Fixed at top) -->
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-white/5" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 0.75rem; margin-bottom: 1rem; flex-shrink: 0;">
                        <div class="flex items-center gap-2">
                            <span class="text-xl">✍️</span>
                            <h3 class="text-base font-extrabold text-white" style="font-size: 1.05rem; font-weight: 800; color: #fff;">ลงทะเบียนหนังสือรับ</h3>
                        </div>
                        <button wire:click="closeRegisterModal" class="text-gray-400 hover:text-white transition-all text-lg" style="background: none; border: none; cursor: pointer; font-size: 1.25rem; color: #9ca3af;">
                            &times;
                        </button>
                    </div>

                    <!-- Scrollable Form Container -->
                    <form wire:submit.prevent="registerInboundBook" class="flex flex-col gap-4 overflow-y-auto pr-1" style="display: flex; flex-direction: column; gap: 1rem; overflow-y: auto; flex-grow: 1; padding-right: 0.25rem;">
                        
                        <!-- Purple Info Banner -->
                        <div class="px-3 py-2 rounded-lg text-xs font-bold text-white bg-purple-700/80 border border-purple-500/30"
                             style="border-radius: 0.5rem; background-color: rgba(126, 34, 206, 0.8); border: 1px solid rgba(168, 85, 247, 0.3); padding: 0.5rem 0.75rem; font-size: 0.75rem; font-weight: 700; flex-shrink: 0;">
                             📢 กรุณาระบุรายละเอียด
                        </div>

                        <!-- จาก & ค้นหาโรงเรียน -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                            <div class="flex flex-col gap-1.5" style="display: flex; flex-direction: column; gap: 0.375rem;">
                                <label class="text-xs font-semibold text-gray-300" style="font-size: 0.75rem;">จาก <span class="text-red-500">*</span></label>
                                <select wire:model="regBookFrom" required
                                        class="bg-gray-955 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-1 focus:ring-emerald-500"
                                        style="background-color: #030712; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.5rem; padding: 0.5rem 0.75rem; color: #fff;">
                                    <option value="">เลือกหน่วยงาน</option>
                                    <option value="สพฐ.">สพฐ.</option>
                                    <option value="กระทรวงศึกษาธิการ">กระทรวงศึกษาธิการ</option>
                                    <option value="สำนักงานเขตพื้นที่การศึกษา">สำนักงานเขตพื้นที่การศึกษา</option>
                                    <option value="โรงเรียนในสังกัด">โรงเรียนในสังกัด</option>
                                    <option value="หน่วยงานภายนอก">หน่วยงานภายนอกอื่น ๆ</option>
                                </select>
                                @error('regBookFrom') <span class="text-red-400 text-[11px]" style="font-size: 0.65rem; color: #f87171;">{{ $message }}</span> @enderror
                            </div>
                            <div class="flex flex-col gap-1.5" style="display: flex; flex-direction: column; gap: 0.375rem;">
                                <label class="text-xs font-semibold text-gray-300" style="font-size: 0.75rem;">ค้นหาโรงเรียน</label>
                                <input wire:model="regSchoolSearch" type="text" placeholder="ระบุชื่อโรงเรียนเพื่อค้นหา..."
                                       class="bg-gray-955 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-1 focus:ring-emerald-500"
                                       style="background-color: #030712; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.5rem; padding: 0.5rem 0.75rem; color: #fff;">
                            </div>
                        </div>

                        <!-- ระดับความสำคัญ -->
                        <div class="flex flex-col gap-1.5" style="display: flex; flex-direction: column; gap: 0.375rem;">
                            <label class="text-xs font-semibold text-gray-300" style="font-size: 0.75rem;">ระดับความสำคัญ <span class="text-red-500">*</span></label>
                            <div class="flex flex-wrap gap-4 py-1" style="display: flex; flex-wrap: wrap; gap: 1rem; padding: 0.25rem 0;">
                                <label class="flex items-center gap-1.5 text-xs text-gray-300 cursor-pointer" style="display: flex; align-items: center; gap: 0.375rem; font-size: 0.75rem; cursor: pointer;">
                                    <input type="radio" wire:model="regSecret" value="0" class="text-emerald-500 focus:ring-emerald-500 bg-gray-955 border-white/10">
                                    <span class="text-emerald-400 font-bold">ปกติ</span>
                                </label>
                                <label class="flex items-center gap-1.5 text-xs text-gray-300 cursor-pointer" style="display: flex; align-items: center; gap: 0.375rem; font-size: 0.75rem; cursor: pointer;">
                                    <input type="radio" wire:model="regSecret" value="1" class="text-emerald-500 focus:ring-emerald-500 bg-gray-955 border-white/10">
                                    <span class="text-orange-400 font-bold">ด่วน</span>
                                </label>
                                <label class="flex items-center gap-1.5 text-xs text-gray-300 cursor-pointer" style="display: flex; align-items: center; gap: 0.375rem; font-size: 0.75rem; cursor: pointer;">
                                    <input type="radio" wire:model="regSecret" value="2" class="text-emerald-500 focus:ring-emerald-500 bg-gray-955 border-white/10">
                                    <span class="text-rose-400 font-bold">ด่วนมาก</span>
                                </label>
                                <label class="flex items-center gap-1.5 text-xs text-gray-300 cursor-pointer" style="display: flex; align-items: center; gap: 0.375rem; font-size: 0.75rem; cursor: pointer;">
                                    <input type="radio" wire:model="regSecret" value="3" class="text-emerald-500 focus:ring-emerald-500 bg-gray-955 border-white/10">
                                    <span class="text-red-500 font-bold">ด่วนที่สุด</span>
                                </label>
                            </div>
                        </div>

                        <!-- เลขที่หนังสือ & ลงวันที่ -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                            <div class="flex flex-col gap-1.5" style="display: flex; flex-direction: column; gap: 0.375rem;">
                                <label class="text-xs font-semibold text-gray-300" style="font-size: 0.75rem;">เลขที่หนังสือ <span class="text-red-500">*</span></label>
                                <input wire:model="regBookNo" type="text" placeholder="เช่น ศธ 04146/ว123" required
                                       class="bg-gray-955 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-1 focus:ring-emerald-500"
                                       style="background-color: #030712; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.5rem; padding: 0.5rem 0.75rem; color: #fff;">
                                @error('regBookNo') <span class="text-red-400 text-[11px]" style="font-size: 0.65rem; color: #f87171;">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex flex-col gap-1.5" style="display: flex; flex-direction: column; gap: 0.375rem;">
                                <label class="text-xs font-semibold text-gray-300" style="font-size: 0.75rem;">ลงวันที่ <span class="text-red-500">*</span></label>
                                <input wire:model="regSignDate" type="date" required
                                       class="bg-gray-955 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-1 focus:ring-emerald-500"
                                       style="background-color: #030712; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.5rem; padding: 0.5rem 0.75rem; color: #fff;">
                                @error('regSignDate') <span class="text-red-400 text-[11px]" style="font-size: 0.65rem; color: #f87171;">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- ถึง -->
                        <div class="flex flex-col gap-1.5" style="display: flex; flex-direction: column; gap: 0.375rem;">
                            <label class="text-xs font-semibold text-gray-300" style="font-size: 0.75rem;">ถึง <span class="text-red-500">*</span></label>
                            <input wire:model="regBookTo" type="text" required
                                   class="bg-gray-955 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-1 focus:ring-emerald-500"
                                   style="background-color: #030712; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.5rem; padding: 0.5rem 0.75rem; color: #fff;">
                            @error('regBookTo') <span class="text-red-400 text-[11px]" style="font-size: 0.65rem; color: #f87171;">{{ $message }}</span> @enderror
                        </div>

                        <!-- เรื่อง -->
                        <div class="flex flex-col gap-1.5" style="display: flex; flex-direction: column; gap: 0.375rem;">
                            <label class="text-xs font-semibold text-gray-300" style="font-size: 0.75rem;">เรื่อง <span class="text-red-500">*</span></label>
                            <input wire:model="regSubject" type="text" placeholder="ระบุเรื่องหนังสือรับ..." required
                                   class="bg-gray-955 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-1 focus:ring-emerald-500"
                                   style="background-color: #030712; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.5rem; padding: 0.5rem 0.75rem; color: #fff;">
                            @error('regSubject') <span class="text-red-400 text-[11px]" style="font-size: 0.65rem; color: #f87171;">{{ $message }}</span> @enderror
                        </div>

                        <!-- กลุ่มปฏิบัติ & บุคคลปฏิบัติ -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                            <div class="flex flex-col gap-1.5" style="display: flex; flex-direction: column; gap: 0.375rem;">
                                <label class="text-xs font-semibold text-gray-300" style="font-size: 0.75rem;">กลุ่มปฏิบัติ <span class="text-red-500">*</span></label>
                                <select wire:model="regWorkgroup" required
                                        class="bg-gray-955 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-1 focus:ring-emerald-500"
                                        style="background-color: #030712; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.5rem; padding: 0.5rem 0.75rem; color: #fff;">
                                    <option value="1">กลุ่มอำนวยการ</option>
                                    <option value="2">กลุ่มนโยบายและแผน</option>
                                    <option value="3">กลุ่มส่งเสริมการศึกษาทางไกลฯ</option>
                                    <option value="4">กลุ่มบริหารงานบุคคล</option>
                                    <option value="5">กลุ่มพัฒนาครูและบุคลากรฯ</option>
                                    <option value="6">กลุ่มส่งเสริมการจัดการศึกษา</option>
                                    <option value="7">กลุ่มนิเทศติดตามและประเมินผลฯ</option>
                                    <option value="8">กลุ่มบริหารงานการเงินและสินทรัพย์</option>
                                    <option value="9">หน่วยตรวจสอบภายใน</option>
                                    <option value="10">กลุ่มกฎหมายและคดี</option>
                                </select>
                            </div>
                            <div class="flex flex-col gap-1.5" style="display: flex; flex-direction: column; gap: 0.375rem;">
                                <label class="text-xs font-semibold text-gray-300" style="font-size: 0.75rem;">บุคคลปฏิบัติ</label>
                                <input wire:model="regOfficer" type="text" placeholder="ระบุชื่อเจ้าหน้าที่ผู้ปฏิบัติ..."
                                       class="bg-gray-955 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-1 focus:ring-emerald-500"
                                       style="background-color: #030712; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.5rem; padding: 0.5rem 0.75rem; color: #fff;">
                            </div>
                        </div>

                        <!-- หมายเหตุ -->
                        <div class="flex flex-col gap-1.5" style="display: flex; flex-direction: column; gap: 0.375rem;">
                            <label class="text-xs font-semibold text-gray-300" style="font-size: 0.75rem;">หมายเหตุ</label>
                            <input wire:model="regComment" type="text"
                                   class="bg-gray-955 border border-white/10 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:ring-1 focus:ring-emerald-500"
                                   style="background-color: #030712; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.5rem; padding: 0.5rem 0.75rem; color: #fff;">
                        </div>

                        <!-- Drag & Drop Premium Attachment Area -->
                        <div class="flex flex-col gap-2" style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <label class="text-xs font-semibold text-gray-300" style="font-size: 0.75rem;">แนบไฟล์ (Drag & Drop) <span class="text-gray-400 font-normal">(ไม่เกิน 5 MB/ไฟล์, ไม่จำกัดจำนวนไฟล์)</span></label>
                            
                            <div x-data="{ isDragging: false }"
                                 @dragover.prevent="isDragging = true"
                                 @dragleave.prevent="isDragging = false"
                                 @drop.prevent="isDragging = false; $refs.fileInput.files = $event.dataTransfer.files; $refs.fileInput.dispatchEvent(new Event('change'))"
                                 :class="isDragging ? 'border-emerald-500 bg-emerald-500/10' : 'border-white/10 bg-gray-950/40 hover:border-white/20'"
                                 class="relative flex flex-col items-center justify-center border border-dashed rounded-xl p-5 transition duration-300 cursor-pointer"
                                 style="border-width: 2px; border-style: dashed; border-radius: 0.75rem; padding: 1.25rem; display: flex; flex-direction: column; align-items: center; justify-content: center; transition: all 0.3s ease; position: relative;">
                                
                                <input type="file" multiple id="regFiles" wire:model="regFiles" x-ref="fileInput" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" style="position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;">
                                
                                <div class="flex flex-col items-center gap-1.5 text-center pointer-events-none" style="display: flex; flex-direction: column; align-items: center; gap: 0.375rem; text-align: center;">
                                    <span class="text-2xl">📂</span>
                                    <span class="text-xs font-bold text-white" style="font-size: 0.8rem;">ลากไฟล์มาวางที่นี่ หรือ คลิกเพื่อเลือกไฟล์</span>
                                    <span class="text-[10px] text-gray-400" style="font-size: 0.65rem;">เฉพาะไฟล์ doc, docx, pdf, xls, xlsx, gif, jpg, zip, rar เท่านั้น</span>
                                </div>
                            </div>
                            
                            @error('regFiles.*')
                                <span class="text-red-400 text-xs" style="font-size: 0.75rem; color: #f87171;">{{ $message }}</span>
                            @enderror

                            <!-- Uploading indicator -->
                            <div wire:loading wire:target="regFiles" class="text-xs text-emerald-400 font-bold" style="font-size: 0.75rem; color: #34d399;">
                                ⏳ กำลังอัปโหลดไฟล์... กรุณารอสักครู่
                            </div>

                            <!-- Uploaded Files List -->
                            @if(!empty($regFiles))
                                <div class="mt-2 space-y-2" style="margin-top: 0.5rem; display: flex; flex-direction: column; gap: 0.5rem;">
                                    <span class="text-xs font-bold text-emerald-400" style="font-size: 0.75rem;">ไฟล์ที่เลือกอัปโหลดแล้ว:</span>
                                    <div class="grid grid-cols-1 gap-2" style="display: grid; grid-template-columns: 1fr; gap: 0.5rem;">
                                        @foreach($regFiles as $index => $file)
                                            <div class="flex items-center justify-between bg-white/[0.02] border border-white/5 rounded-lg px-3 py-2 text-xs"
                                                 style="display: flex; justify-content: space-between; align-items: center; background-color: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); border-radius: 0.5rem; padding: 0.5rem 0.75rem;">
                                                <div class="flex items-center gap-2 overflow-hidden" style="display: flex; align-items: center; gap: 0.5rem; overflow: hidden;">
                                                    <span class="text-emerald-400">📄</span>
                                                    <span class="text-white truncate max-w-[200px]" style="color: #fff; font-weight: 600;">{{ $file->getClientOriginalName() }}</span>
                                                    <span class="text-gray-400 text-[10px]" style="font-size: 0.65rem; color: #9ca3af;">({{ number_format($file->getSize() / 1024 / 1024, 2) }} MB)</span>
                                                </div>
                                                <div class="flex items-center gap-2" style="display: flex; align-items: center; gap: 0.5rem;">
                                                    <!-- File description input -->
                                                    <input type="text" placeholder="คำอธิบายไฟล์..." wire:model="regFileDescriptions.{{ $index }}"
                                                           class="bg-gray-955 border border-white/10 rounded px-2 py-1 text-[11px] text-white focus:outline-none focus:ring-1 focus:ring-emerald-500 w-32"
                                                           style="background-color: #030712; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.25rem; padding: 0.25rem 0.5rem; color: #fff; font-size: 0.7rem; width: 8rem;">
                                                    
                                                    <button type="button" wire:click="removeFile({{ $index }})" class="text-red-400 hover:text-red-300 font-bold transition text-sm" style="background: none; border: none; cursor: pointer; color: #f87171;">
                                                        &times;
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Modal Actions (Fixed at bottom) -->
                        <div class="flex justify-end gap-3 pt-3 border-t border-white/5" style="display: flex; justify-content: flex-end; gap: 0.75rem; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 0.75rem; margin-top: 0.5rem; flex-shrink: 0;">
                            <button type="button" wire:click="resetForm"
                                    class="px-4 py-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-300 font-semibold text-xs transition duration-300 hover:scale-105"
                                    style="border: 1px solid rgba(255,255,255,0.1); cursor: pointer; padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.725rem; font-weight: 700; color: #d1d5db; background-color: rgba(255,255,255,0.05);">
                                ล้างข้อมูล
                            </button>
                            <button type="submit"
                                    class="px-5 py-2 rounded-lg bg-emerald-500 hover:bg-emerald-400 text-black font-extrabold text-xs transition duration-300 hover:scale-105 shadow-md shadow-emerald-500/20"
                                    style="border: none; cursor: pointer; padding: 0.5rem 1.25rem; border-radius: 0.5rem; font-size: 0.725rem; font-weight: 800; background-color: #10b981; color: #000;">
                                ตกลง
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        @endif

</x-filament-panels::page>

