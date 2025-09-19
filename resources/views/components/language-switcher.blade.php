<div class="relative" x-data="{ open: false }">
    <!-- Language Button -->
    <button @click="open = !open" class="flex items-center gap-2 text-gray-600 hover:text-green-600 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-green-50" title="{{ __('navbar.language') }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
            <path d="M12.87 15.07l-2.54-2.51.03-.03c1.74-1.94 2.98-4.17 3.71-6.53H17V4h-7V2H8v2H1v1.99h11.17C11.5 7.92 10.44 9.75 9 11.35 8.07 10.32 7.3 9.19 6.69 8h-2c.73 1.63 1.73 3.17 2.98 4.56l-5.09 5.02L4 19l5-5 3.11 3.11.76-2.04zM18.5 10h-2L12 22h2l1.12-3h4.75L21 22h2l-4.5-12zm-2.62 7l1.62-4.33L19.12 17h-3.24z"/>
        </svg>
        <span class="hidden md:inline">{{ strtoupper(app()->getLocale()) }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3">
            <path d="M7 10l5 5 5-5z"/>
        </svg>
    </button>

    <!-- Language Dropdown -->
    <div x-show="open" 
         @click.away="open = false" 
         @keydown.escape.window="open = false"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
         x-cloak
         class="absolute right-0 mt-2 w-32 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
        <a href="{{ route('lang.switch', 'id') }}" @click="open = false" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors {{ app()->getLocale() === 'id' ? 'bg-green-50 text-green-600' : '' }}">
            <span class="text-xs font-semibold">ID</span>
            <span>Indonesia</span>
        </a>
        <a href="{{ route('lang.switch', 'en') }}" @click="open = false" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-600 transition-colors {{ app()->getLocale() === 'en' ? 'bg-green-50 text-green-600' : '' }}">
            <span class="text-xs font-semibold">EN</span>
            <span>English</span>
        </a>
    </div>
</div>
