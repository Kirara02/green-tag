<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/', function () {
    return view('landing');
});

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/complaints', function () {
    return 'Complaints store not implemented yet.';
})->name('complaints.store');

// Admin
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', function () { return redirect()->route('admin.dashboard.index'); });
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('admin.dashboard.index');

    Route::get('/admin/schedules', function () {
        return view('admin.schedules.index');
    })->name('admin.schedules.index');

    Route::get('/admin/complaints', function () {
        return view('admin.complaints.index');
    })->name('admin.complaints.index');

    Route::get('/admin/bins', function () {
        return view('admin.bins.index');
    })->name('admin.bins.index');

    Route::get('/admin/educations', function () {
        return view('admin.educations.index');
    })->name('admin.educations.index');

    // Users management
    Route::get('/admin/users', function () {
        $users = User::orderByDesc('created_at')->get();
        return view('admin.users.index', compact('users'));
    })->name('admin.users.index');

    Route::post('/admin/users', function (\Illuminate\Http\Request $request) {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'password' => ['required','min:6','confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Admin created successfully');
    })->name('admin.users.store');
});