@php
    $breadcrumb = [
        ['label' => __('system.breadcrumb_dashboard'), 'url' => route('admin.dashboard.index')],
        ['label' => __('system.breadcrumb_system'), 'url' => '#'],
        ['label' => __('system.breadcrumb_user_management'), 'url' => route('admin.users.index')],
        ['label' => __('system.breadcrumb_edit_user'), 'url' => '#'],
    ];
@endphp

<x-layout :breadcrumb="$breadcrumb">
    <x-slot:page_title>@lang('system.users_edit_title')</x-slot>

    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">@lang('system.users_edit_subtitle', ['name' => $user->name])</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md"
                role="alert">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6 space-y-6">
                    <div>
                        <label for="name"
                            class="block text-sm font-medium text-gray-700">@lang('system.form_full_name')</label>
                        <input type="text" id="name" name="name"
                            value="{{ old('name', $user->name) }}" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label for="email"
                            class="block text-sm font-medium text-gray-700">@lang('system.form_email_address')</label>
                        <input type="email" id="email" name="email"
                            value="{{ old('email', $user->email) }}" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label for="role"
                            class="block text-sm font-medium text-gray-700">@lang('system.form_role')</label>
                        <select id="role" name="role" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                            <option value="officer" @selected(old('role', $user->role) == 'officer')>@lang('system.role_option_officer')
                            </option>
                            <option value="admin" @selected(old('role', $user->role) == 'admin')>@lang('system.role_option_admin')
                            </option>
                        </select>
                    </div>
                </div>
                <div class="lg:col-span-1 bg-white shadow-md rounded-lg p-6">
                    <div class="space-y-6">
                        <div>
                            <p class="text-sm font-medium text-gray-800">@lang('system.form_change_password')</p>
                            <p class="text-xs text-gray-500">@lang('system.form_change_password_help')</p>
                        </div>
                        <div>
                            <label for="password"
                                class="block text-sm font-medium text-gray-700">@lang('system.form_new_password')</label>
                            <input type="password" id="password" name="password"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>
                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-gray-700">@lang('system.form_confirm_new_password')</label>
                            <input type="password" id="password_confirmation"
                                name="password_confirmation"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8 flex items-center gap-4">
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium transition-colors">@lang('system.btn_update_user')</button>
                <a href="{{ route('admin.users.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium transition-colors">@lang('system.btn_cancel')</a>
            </div>
        </form>
    </div>
</x-layout>
