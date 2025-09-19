{{-- Tambahkan :class untuk mengatur padding dan alignment saat diciutkan --}}
<nav class="flex flex-col flex-1 p-3 space-y-1 sidebar-content" :class="!sidebarExpanded && 'items-center'">
    {{-- LINK UTAMA --}}
    <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard.index') : route('officer.dashboard.index') }}" 
       class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('*.dashboard.*') ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg>
        {{-- Sembunyikan teks saat sidebar diciutkan --}}
        <span x-show="sidebarExpanded" class="sidebar-content" x-cloak>Dasbor</span>
    </a>

    {{-- GRUP UNTUK OFFICER & ADMIN --}}
    @if(in_array(Auth::user()->role, ['officer', 'admin']))
        {{-- Judul Grup Operasional --}}
        <div x-show="sidebarExpanded" class="pt-4 pb-1 px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider sidebar-content" x-cloak>Operasional</div>
        
        <a href="{{ route('officer.complaints.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('officer.complaints.*') ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z" clip-rule="evenodd" /></svg>
            <span x-show="sidebarExpanded" class="sidebar-content" x-cloak>Pengaduan</span>
        </a>

        <a href="{{ route('officer.schedules.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('officer.schedules.*') ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" /></svg>
            <span x-show="sidebarExpanded" class="sidebar-content" x-cloak>Jadwal</span>
        </a>
        
        <a href="{{ route('officer.informations.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('officer.informations.*') ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" /><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" /></svg>
            <span x-show="sidebarExpanded" class="sidebar-content" x-cloak>Edukasi</span>
        </a>

        {{-- Judul Grup Master Data --}}
        <div x-show="sidebarExpanded" class="pt-4 pb-1 px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider sidebar-content" x-cloak>Master Data</div>

        <a href="{{ route('officer.locations.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('officer.locations.*') ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
            <span x-show="sidebarExpanded" class="sidebar-content" x-cloak>Lokasi</span>
        </a>
        
        <a href="{{ route('officer.bins.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('officer.bins.*') ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path d="M8 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" /><path d="M6 3a2 2 0 012-2h4a2 2 0 012 2v2a2 2 0 01-2 2H8a2 2 0 01-2-2V3z" /><path d="M7 7h6v11a1 1 0 01-1 1H8a1 1 0 01-1-1V7z" /></svg>
            <span x-show="sidebarExpanded" class="sidebar-content" x-cloak>Tempat Sampah</span>
        </a>
    @endif

    {{-- GRUP KHUSUS ADMIN --}}
    @if(Auth::user()->role == 'admin')
        {{-- Judul Grup Sistem --}}
        <div x-show="sidebarExpanded" class="pt-4 pb-1 px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider sidebar-content" x-cloak>Sistem</div>

        <a href="{{ route('admin.users.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.users.*') ? 'bg-green-50 text-green-700 font-semibold' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" /></svg>
            <span x-show="sidebarExpanded" class="sidebar-content" x-cloak>Pengguna</span>
        </a>
    @endif
</nav>