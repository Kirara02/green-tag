@extends('admin.layout')

@section('page_title', 'Users')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-bold">Users</h2>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 rounded-lg text-green-800 bg-green-50 border border-green-200">{{ session('success') }}</div>
    @endif

    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h3 class="font-semibold mb-4">Add New Admin</h3>
            <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-4" x-data="{ show:false }">
                @csrf
                <div>
                    <label class="block text-sm font-medium">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500/50" required>
                    @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500/50" required>
                    @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="password" class="w-full border rounded-lg px-3 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-green-500/50" required>
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-2 my-auto text-gray-500 hover:text-gray-700">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M12 5c-7.633 0-11 7-11 7s3.367 7 11 7 11-7 11-7-3.367-7-11-7Zm0 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10Z"/></svg>
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3.707 2.293 2.293 3.707l3.22 3.22A13.89 13.89 0 0 0 1 12s3.367 7 11 7a11.43 11.43 0 0 0 5.073-1.128l3.22 3.22 1.414-1.414-17-17ZM12 7a5 5 0 0 1 5 5c0 .558-.096 1.093-.272 1.592L9.408 6.272A4.98 4.98 0 0 1 12 7Z"/></svg>
                        </button>
                    </div>
                    @error('password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500/50" required>
                </div>
                <button type="submit" class="w-full bg-green-600 text-white py-2.5 rounded-lg font-semibold shadow hover:bg-green-700">Create Admin</button>
            </form>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h3 class="font-semibold mb-4">Existing Admins</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500">
                            <th class="py-2">Name</th>
                            <th class="py-2">Email</th>
                            <th class="py-2">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-t border-gray-100">
                                <td class="py-2">{{ $user->name }}</td>
                                <td class="py-2">{{ $user->email }}</td>
                                <td class="py-2">{{ $user->created_at?->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-6 text-center text-gray-500">No admins yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


