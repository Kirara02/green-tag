<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Bin;
use App\Models\BinLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BinController extends Controller
{
    public function index()
    {
        // Eager load relasi 'location' untuk menghindari N+1 query problem
        $bins = Bin::with('location')->latest()->paginate(10);
        return view('officer.bins.index', compact('bins'));
    }

    public function create()
    {
        // Ambil semua lokasi untuk ditampilkan di dropdown form
        $locations = BinLocation::orderBy('name')->get();
        return view('officer.bins.create', compact('locations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bin_location_id' => ['required', 'exists:bin_locations,id'],
            'code' => ['required', 'string', 'max:255', 'unique:bins,code'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        // Tambahkan qr_token unik secara otomatis
        $validated['qr_token'] = (string) Str::uuid();

        Bin::create($validated);

        return redirect()
            ->route('officer.bins.index')
            ->with('success', 'Bin created successfully.');
    }

    public function edit(Bin $bin)
    {
        $locations = BinLocation::orderBy('name')->get();
        return view('officer.bins.edit', compact('bin', 'locations'));
    }

    public function update(Request $request, Bin $bin)
    {
        $validated = $request->validate([
            'bin_location_id' => ['required', 'exists:bin_locations,id'],
            'code' => ['required', 'string', 'max:255', Rule::unique('bins')->ignore($bin->id)],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $bin->update($validated);

        return redirect()
            ->route('officer.bins.index')
            ->with('success', 'Bin updated successfully.');
    }

    public function destroy(Bin $bin)
    {
        $bin->delete();
        return redirect()
            ->route('officer.bins.index')
            ->with('success', 'Bin deleted successfully.');
    }

    public function showQrCode(Bin $bin)
    {
        // 1. Buat URL lengkap yang akan disematkan di QR Code.
        // Ini akan mengarah ke landing page dengan parameter qr_token.
        $url = route('landing', ['qr_token' => $bin->qr_token]);

        // 2. Kirim data bin dan URL ke view
        return view('officer.bins.qr_code', compact('bin', 'url'));
    }
}
