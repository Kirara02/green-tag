@extends('admin.layout')

@section('page_title', 'Dashboard')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Dashboard</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="#" class="bg-white shadow rounded-xl p-6 block hover:shadow-md">
            <div class="text-sm text-gray-500">Complaints</div>
            <div class="text-3xl font-bold mt-2">—</div>
        </a>
        <a href="#" class="bg-white shadow rounded-xl p-6 block hover:shadow-md">
            <div class="text-sm text-gray-500">Bins</div>
            <div class="text-3xl font-bold mt-2">—</div>
        </a>
        <a href="#" class="bg-white shadow rounded-xl p-6 block hover:shadow-md">
            <div class="text-sm text-gray-500">Users</div>
            <div class="text-3xl font-bold mt-2">—</div>
        </a>
    </div>
@endsection


