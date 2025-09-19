<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\CollectionRoute;
use App\Models\BinLocation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ScheduleController extends Controller
{
    public function index()
    {
        // Eager load jumlah lokasi untuk setiap rute untuk efisiensi
        $routes = CollectionRoute::withCount('locations')->latest()->paginate(10);
        return view('officer.schedules.index', compact('routes'));
    }

    public function create()
    {
        $locations = BinLocation::orderBy('name')->get();
        return view('officer.schedules.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'day' => ['required', 'string', 'max:50'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'locations' => ['required', 'array'], // Pastikan 'locations' adalah array
            'locations.*' => ['exists:bin_locations,id'], // Pastikan setiap item di array ada di tabel
        ]);

        $route = CollectionRoute::create($validated);

        // 'attach' akan menambahkan relasi di tabel pivot (route_location)
        $route->locations()->attach($validated['locations']);

        return redirect()->route('officer.schedules.index')->with('success', 'Schedule created successfully.');
    }

    public function edit(CollectionRoute $schedule)
    {
        $locations = BinLocation::orderBy('name')->get();
        // 'pluck('id')->toArray()' akan mengambil semua ID lokasi yang sudah terhubung dengan rute ini
        // Ini akan kita gunakan untuk menandai checkbox di form edit.
        $selectedLocations = $schedule->locations->pluck('id')->toArray();
        
        return view('officer.schedules.edit', compact('schedule', 'locations', 'selectedLocations'));
    }

    public function update(Request $request, CollectionRoute $schedule)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'day' => ['required', 'string', 'max:50'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'locations' => ['required', 'array'],
            'locations.*' => ['exists:bin_locations,id'],
        ]);

        $schedule->update($validated);

        // 'sync' adalah cara paling efisien untuk update relasi many-to-many.
        // Ia akan otomatis menambah, menghapus, atau membiarkan relasi yang ada di tabel pivot
        // agar cocok dengan array yang kita berikan.
        $schedule->locations()->sync($validated['locations']);

        return redirect()->route('officer.schedules.index')->with('success', 'Schedule updated successfully.');
    }

    public function destroy(CollectionRoute $schedule)
    {
        // Karena kita menggunakan cascadeOnDelete di migrasi,
        // semua relasi di tabel pivot akan otomatis terhapus saat rute dihapus.
        $schedule->delete();

        return redirect()->route('officer.schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}