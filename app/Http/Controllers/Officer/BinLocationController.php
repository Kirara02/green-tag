<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\BinLocation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BinLocationController extends Controller
{
    public function index()
    {
        $locations = BinLocation::latest()->paginate(10);
        return view('officer.locations.index', compact('locations'));
    }

    public function create()
    {
        return view('officer.locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:255', 'unique:bin_locations,code'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:1000'],
        ]);

        BinLocation::create($validated);

        return redirect()->route('officer.locations.index')->with('success', 'Location created successfully.');
    }

    public function edit(BinLocation $location)
    {
        // Variabel $location sudah otomatis didapatkan dari Route Model Binding
        return view('officer.locations.edit', compact('location'));
    }

    // --- PERUBAHAN DI SINI ---
    public function update(Request $request, BinLocation $location)
    {
        $validated = $request->validate([
            'code' => ['required', 'string', 'max:255', Rule::unique('bin_locations')->ignore($location->id)],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:1000'],
        ]);

        $location->update($validated);

        return redirect()->route('officer.locations.index')->with('success', 'Location updated successfully.');
    }

    // --- PERUBAHAN DI SINI ---
    public function destroy(BinLocation $location)
    {
        if ($location->bins()->count() > 0) {
            return back()->with('error', 'Cannot delete location because it still has bins associated with it.');
        }

        $location->delete();
        return redirect()->route('officer.locations.index')->with('success', 'Location deleted successfully.');
    }
}