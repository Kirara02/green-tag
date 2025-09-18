<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - GreenTag</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
</head>
<body class="bg-gray-50 text-gray-800" x-data="{ open: false }">
    <!-- Desktop Sidebar -->
    <aside class="hidden md:flex fixed inset-y-0 left-0 w-60 bg-white border-r border-gray-200 z-40">
        <div class="flex flex-col w-full">
            <a href="/admin/dashboard" class="flex items-center gap-2 px-4 h-14 border-b border-gray-100">
                <img src="/logo.svg" alt="GreenTag" class="w-6 h-6">
                <span class="font-semibold">GreenTag Admin</span>
            </a>
            <nav class="p-3 space-y-1">
                <a href="{{ route('admin.dashboard.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 {{ request()->routeIs('admin.dashboard.index') ? 'bg-gray-50 text-green-700' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M12 3.75 3 9v11.25A1.5 1.5 0 0 0 4.5 21.75h5.25V14.25h4.5v7.5H19.5A1.5 1.5 0 0 0 21 20.25V9l-9-5.25Z"/></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.schedules.index') }}" 
                class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 {{ request()->routeIs('admin.schedules.*') ? 'bg-gray-50 text-green-700' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Zm1 11h5a1 1 0 0 1 0 2h-6V7a1 1 0 0 1 2 0v6Z"/>
                    </svg>
                    <span>Schedules</span>
                </a>
                <a href="{{ route('admin.complaints.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 {{ request()->routeIs('admin.complaints.*') ? 'bg-gray-50 text-green-700' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3 4.5A1.5 1.5 0 0 1 4.5 3h3A1.5 1.5 0 0 1 9 4.5v3A1.5 1.5 0 0 1 7.5 9h-3A1.5 1.5 0 0 1 3 7.5v-3ZM3 13.5A1.5 1.5 0 0 1 4.5 12h3A1.5 1.5 0 0 1 9 13.5v3A1.5 1.5 0 0 1 7.5 18h-3A1.5 1.5 0 0 1 3 16.5v-3ZM12 4.5A1.5 1.5 0 0 1 13.5 3h6A1.5 1.5 0 0 1 21 4.5v3A1.5 1.5 0 0 1 19.5 9h-6A1.5 1.5 0 0 1 12 7.5v-3ZM12 13.5A1.5 1.5 0 0 1 13.5 12h6A1.5 1.5 0 0 1 21 13.5v3A1.5 1.5 0 0 1 19.5 18h-6A1.5 1.5 0 0 1 12 16.5v-3Z"/></svg>
                    <span>Complaints</span>
                </a>
                <a href="{{ route('admin.bins.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 {{ request()->routeIs('admin.bins.*') ? 'bg-gray-50 text-green-700' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M4.5 6A1.5 1.5 0 0 1 6 4.5h12A1.5 1.5 0 0 1 19.5 6v3A1.5 1.5 0 0 1 18 10.5H6A1.5 1.5 0 0 1 4.5 9V6ZM4.5 15A1.5 1.5 0 0 1 6 13.5h12A1.5 1.5 0 0 1 19.5 15v3A1.5 1.5 0 0 1 18 19.5H6A1.5 1.5 0 0 1 4.5 18v-3Z"/></svg>
                    <span>Bins</span>
                </a>
                <a href="{{ route('admin.educations.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 {{ request()->routeIs('admin.educations.*') ? 'bg-gray-50 text-green-700' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M8.25 6.75A2.25 2.25 0 0 1 10.5 4.5h3a2.25 2.25 0 0 1 2.25 2.25v12.75a.75.75 0 0 1-1.2.6l-2.55-1.9-2.55 1.9a.75.75 0 0 1-1.2-.6V6.75Z"/></svg>
                    <span>Educations</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 {{ request()->routeIs('admin.users.*') ? 'bg-gray-50 text-green-700' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M15 8.25a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-3 4.5a6.75 6.75 0 0 0-6.46 4.8.75.75 0 0 0 .72.95h11.48a.75.75 0 0 0 .72-.95 6.75 6.75 0 0 0-6.46-4.8Z"/></svg>
                    <span>Users</span>
                </a>
            </nav>
        </div>
    </aside>

    <!-- Mobile sidebar overlay -->
    <div class="md:hidden" x-show="open" x-transition.opacity @click="open = false" class="fixed inset-0 bg-black/30 z-40"></div>
    <!-- Mobile sidebar panel -->
    <aside class="md:hidden fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 z-50" x-show="open" x-transition @click.away="open=false">
        <div class="flex items-center justify-between px-4 h-14 border-b border-gray-100">
            <a href="/admin/dashboard" class="flex items-center gap-2">
                <img src="/logo.svg" alt="GreenTag" class="w-6 h-6">
                <span class="font-semibold">GreenTag Admin</span>
            </a>
            <button class="p-2 rounded hover:bg-gray-100" @click="open=false" aria-label="Close sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M6.225 4.811a.75.75 0 0 1 1.06 0L12 9.525l4.715-4.714a.75.75 0 1 1 1.06 1.06L13.06 10.586l4.714 4.715a.75.75 0 1 1-1.06 1.06L12 11.646l-4.715 4.715a.75.75 0 1 1-1.06-1.06l4.714-4.715-4.714-4.715a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/></svg>
            </button>
        </div>
        <nav class="p-3 space-y-1">
            <a href="{{ route('admin.dashboard.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 {{ request()->routeIs('admin.dashboard.index') ? 'bg-gray-50 text-green-700' : '' }}" @click="open=false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M12 3.75 3 9v11.25A1.5 1.5 0 0 0 4.5 21.75h5.25V14.25h4.5v7.5H19.5A1.5 1.5 0 0 0 21 20.25V9l-9-5.25Z"/></svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.schedules.index') }}" 
            class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 {{ request()->routeIs('admin.schedules.*') ? 'bg-gray-50 text-green-700' : '' }}" 
            @click="open=false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2Zm1 11h5a1 1 0 0 1 0 2h-6V7a1 1 0 0 1 2 0v6Z"/>
                </svg>
                <span>Schedules</span>
            </a>
            <a href="{{ route('admin.complaints.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 {{ request()->routeIs('admin.complaints.*') ? 'bg-gray-50 text-green-700' : '' }}" @click="open=false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3 4.5A1.5 1.5 0 0 1 4.5 3h3A1.5 1.5 0 0 1 9 4.5v3A1.5 1.5 0 0 1 7.5 9h-3A1.5 1.5 0 0 1 3 7.5v-3ZM3 13.5A1.5 1.5 0 0 1 4.5 12h3A1.5 1.5 0 0 1 9 13.5v3A1.5 1.5 0 0 1 7.5 18h-3A1.5 1.5 0 0 1 3 16.5v-3ZM12 4.5A1.5 1.5 0 0 1 13.5 3h6A1.5 1.5 0 0 1 21 4.5v3A1.5 1.5 0 0 1 19.5 9h-6A1.5 1.5 0 0 1 12 7.5v-3ZM12 13.5A1.5 1.5 0 0 1 13.5 12h6A1.5 1.5 0 0 1 21 13.5v3A1.5 1.5 0 0 1 19.5 18h-6A1.5 1.5 0 0 1 12 16.5v-3Z"/></svg>
                <span>Complaints</span>
            </a>
            <a href="{{ route('admin.bins.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 {{ request()->routeIs('admin.bins.*') ? 'bg-gray-50 text-green-700' : '' }}" @click="open=false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M4.5 6A1.5 1.5 0 0 1 6 4.5h12A1.5 1.5 0 0 1 19.5 6v3A1.5 1.5 0 0 1 18 10.5H6A1.5 1.5 0 0 1 4.5 9V6ZM4.5 15A1.5 1.5 0 0 1 6 13.5h12A1.5 1.5 0 0 1 19.5 15v3A1.5 1.5 0 0 1 18 19.5H6A1.5 1.5 0 0 1 4.5 18v-3Z"/></svg>
                <span>Bins</span>
            </a>
            <a href="{{ route('admin.educations.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 {{ request()->routeIs('admin.educations.*') ? 'bg-gray-50 text-green-700' : '' }}" @click="open=false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M8.25 6.75A2.25 2.25 0 0 1 10.5 4.5h3a2.25 2.25 0 0 1 2.25 2.25v12.75a.75.75 0 0 1-1.2.6l-2.55-1.9-2.55 1.9a.75.75 0 0 1-1.2-.6V6.75Z"/></svg>
                <span>Educations</span>
            </a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-50 {{ request()->routeIs('admin.users.*') ? 'bg-gray-50 text-green-700' : '' }}" @click="open=false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M15 8.25a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-3 4.5a6.75 6.75 0 0 0-6.46 4.8.75.75 0 0 0 .72.95h11.48a.75.75 0 0 0 .72-.95 6.75 6.75 0 0 0-6.46-4.8Z"/></svg>
                <span>Users</span>
            </a>
        </nav>
    </aside>

    <!-- Header -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-30 md:pl-60">
        <div class="px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button class="md:hidden p-2 rounded hover:bg-gray-100" @click="open = true" aria-label="Open sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path fill-rule="evenodd" d="M3.75 6A.75.75 0 0 1 4.5 5.25h15a.75.75 0 0 1 0 1.5h-15A.75.75 0 0 1 3.75 6Zm0 6a.75.75 0 0 1 .75-.75h15a.75.75 0 0 1 0 1.5h-15A.75.75 0 0 1 3.75 12Zm0 6a.75.75 0 0 1 .75-.75h15a.75.75 0 0 1 0 1.5h-15a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd"/></svg>
                </button>
                <span class="font-semibold">@yield('page_title', 'Dashboard')</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="hidden sm:block text-sm text-gray-500">{{ session('admin_email') }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-3 py-1.5 rounded-md bg-green-600 text-white text-sm hover:bg-green-700">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="md:ml-60 px-4 py-6">
        @yield('content')
    </main>

</body>
</html>


