<div class="kpp-theme-toggle-container">
    <div class="kpp-theme-toggle-bar">
        <!-- Light Mode Button -->
        <button onclick="setKppTheme('light')" class="kpp-theme-btn" id="kpp-theme-light" title="โหมดสว่าง">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
            </svg>
        </button>
        <!-- Sepia Mode Button -->
        <button onclick="setKppTheme('sepia')" class="kpp-theme-btn" id="kpp-theme-sepia" title="โหมดถนอมสายตา (Sepia)">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
            </svg>
        </button>
        <!-- Dark Mode Button -->
        <button onclick="setKppTheme('dark')" class="kpp-theme-btn" id="kpp-theme-dark" title="โหมดมืด">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
            </svg>
        </button>
    </div>
</div>

<style>
    /* Floating Bar Container */
    .kpp-theme-toggle-container {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 99999;
        pointer-events: auto;
    }
    
    /* Sleek Glassmorphism Bar */
    .kpp-theme-toggle-bar {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(12px) saturate(160%);
        -webkit-backdrop-filter: blur(12px) saturate(160%);
        border: 1px solid rgba(255, 255, 255, 0.4);
        padding: 6px;
        border-radius: 9999px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Dark mode adjustments for toggle bar itself */
    html.dark .kpp-theme-toggle-bar {
        background: rgba(30, 41, 59, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
    }

    /* Sepia mode adjustments for toggle bar */
    html.sepia-mode .kpp-theme-toggle-bar {
        background: rgba(244, 237, 219, 0.85);
        border: 1px solid rgba(139, 90, 43, 0.2);
    }
    
    /* Button style */
    .kpp-theme-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        color: #475569;
        border: none;
        background: transparent;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .kpp-theme-btn:hover {
        background: rgba(0, 0, 0, 0.05);
        transform: translateY(-2px);
    }

    html.dark .kpp-theme-btn {
        color: #94a3b8;
    }

    html.dark .kpp-theme-btn:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    html.sepia-mode .kpp-theme-btn {
        color: #5c4033;
    }

    html.sepia-mode .kpp-theme-btn:hover {
        background: rgba(139, 90, 43, 0.1);
    }

    /* Active States */
    .kpp-theme-btn.active {
        background: #f59e0b;
        color: white !important;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    html.dark #kpp-theme-dark.active {
        background: #6366f1;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
    }

    html.sepia-mode #kpp-theme-sepia.active {
        background: #8b5a2b;
        box-shadow: 0 4px 12px rgba(139, 90, 43, 0.4);
    }

    /* Sepia Global Filter */
    html.sepia-mode {
        filter: sepia(0.8) contrast(0.95) brightness(0.98);
        background-color: #f4eddb !important;
    }

    /* Ensure text contrast in sepia mode */
    html.sepia-mode body {
        color: #433022 !important;
    }
</style>

<script>
    function setKppTheme(mode) {
        // Toggle classes
        if (mode === 'dark') {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('sepia-mode');
        } else if (mode === 'sepia') {
            document.documentElement.classList.remove('dark');
            document.documentElement.classList.add('sepia-mode');
        } else {
            document.documentElement.classList.remove('dark', 'sepia-mode');
        }
        
        // Save preference
        localStorage.setItem('kpp-theme', mode);
        
        // Dispatch filament theme switch event if exists to update layout
        window.dispatchEvent(new CustomEvent('theme-changed', { detail: mode }));

        updateActiveButtonState(mode);
    }

    function updateActiveButtonState(mode) {
        document.querySelectorAll('.kpp-theme-btn').forEach(btn => btn.classList.remove('active'));
        const activeBtn = document.getElementById('kpp-theme-' + mode);
        if (activeBtn) {
            activeBtn.classList.add('active');
        }
    }

    // Initialize active states
    document.addEventListener('DOMContentLoaded', () => {
        const theme = localStorage.getItem('kpp-theme') || 'light';
        updateActiveButtonState(theme);
    });
</script>
