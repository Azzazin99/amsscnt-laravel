<x-filament-panels::page>
    <div class="flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="relative max-w-lg w-full text-center overflow-hidden rounded-3xl bg-gradient-to-br from-white/5 to-white/[0.01] border border-white/10 p-10 shadow-2xl backdrop-blur-2xl">
            <!-- Decorative blur objects -->
            <div class="absolute -left-16 -top-16 h-36 w-36 rounded-full bg-amber-500/10 blur-3xl animate-pulse"></div>
            <div class="absolute -right-16 -bottom-16 h-36 w-36 rounded-full bg-teal-500/10 blur-3xl animate-pulse"></div>

            <div class="relative z-10 space-y-6">
                <!-- Icon container -->
                <div class="mx-auto h-20 w-20 rounded-2xl bg-amber-500/10 flex items-center justify-center text-amber-400 ring-2 ring-amber-500/20 shadow-lg shadow-amber-500/5 transition-transform duration-300 hover:scale-110">
                    @if ($icon === 'heroicon-o-share')
                        <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                        </svg>
                    @elseif ($icon === 'heroicon-o-envelope-open')
                        <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V14.73Z" />
                        </svg>
                    @elseif ($icon === 'heroicon-o-map')
                        <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503-3.46 3.66-1.83a2.25 2.25 0 0 0 1.247-2.013V4.39a2.25 2.25 0 0 0-2.92-2.13l-5.41 1.8a2.25 2.25 0 0 1-1.494 0l-5.41-1.8a2.25 2.25 0 0 0-2.92 2.13v11.758a2.25 2.25 0 0 0 1.247 2.013L9 21.003m6.003-3.46 3.66-1.83a2.25 2.25 0 0 0 1.247-2.013V4.39M9 21.003V12.75m0 8.253-3.66-1.83A2.25 2.25 0 0 1 4.093 17.16V5.4a2.25 2.25 0 0 1 2.92-2.13l5.41 1.8a2.25 2.25 0 0 0 1.494 0l5.41-1.8v8.253" />
                        </svg>
                    @elseif ($icon === 'heroicon-o-clipboard-document-check')
                        <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.03 0 1.9.693 2.166 1.638m-7.377 0A48.536 48.536 0 0 1 12 3m0 0c-2.917 0-5.747.294-8.5.862L3.75 18a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25V9A2.25 2.25 0 0 0 15 6.75h-.75" />
                        </svg>
                    @endif
                </div>

                <!-- Text content -->
                <div class="space-y-2">
                    <h3 class="text-xl font-extrabold text-white tracking-wide">{{ $systemName }}</h3>
                    <div class="inline-flex items-center gap-1.5 rounded-md bg-amber-500/10 px-2.5 py-0.5 text-xs font-medium text-amber-400 ring-1 ring-inset ring-amber-500/20">
                        <svg class="h-3 w-3 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        กำลังพัฒนาระบบ (Under Construction)
                    </div>
                </div>

                <p class="text-sm text-gray-400 leading-relaxed">
                    {{ $description }}
                </p>

                <!-- Status meter -->
                <div class="space-y-1">
                    <div class="flex justify-between text-xs text-gray-500">
                        <span>ขั้นตอนการพอร์ตระบบ</span>
                        <span>0% Completed</span>
                    </div>
                    <div class="h-2 w-full bg-white/5 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-amber-500 to-amber-600 rounded-full" style="width: 5%"></div>
                    </div>
                </div>

                <div class="pt-4 border-t border-white/5 flex justify-center gap-4 text-xs text-gray-500">
                    <span class="flex items-center gap-1">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        Secure Port
                    </span>
                    <span>&bull;</span>
                    <span class="flex items-center gap-1">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Phased Rollout
                    </span>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
