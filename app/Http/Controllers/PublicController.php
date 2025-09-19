<?php

namespace App\Http\Controllers;

use App\Models\Bin;
use App\Models\Complaint;
use App\Models\Information;
use App\Models\CollectionRoute;
use App\Models\BinLocation; // <-- Import BinLocation
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PublicController extends Controller
{
    /**
     * Menampilkan halaman landing utama.
     */
    public function landing()
    {
        // Ambil 3 artikel terbaru yang sudah di-publish
        $articles = Information::where('status', 'published')->latest()->take(3)->get();
        
        // Ambil 3 jadwal/rute terbaru
        $schedules = CollectionRoute::with('locations')->latest()->take(3)->get();

        // Ambil data statistik dinamis
        $stats = [
            'complaint_count' => Complaint::count(),
            'bin_count' => Bin::count(),
            'location_count' => BinLocation::count(),
        ];

        return view('landing', compact('articles', 'schedules', 'stats'));
    }

    /**
     * Menampilkan halaman arsip untuk semua jadwal.
     */
    public function showSchedules()
    {
        $schedules = CollectionRoute::with('locations')->latest()->paginate(9); // Paginate 9 per halaman
        return view('public.schedules', compact('schedules'));
    }

    /**
     * Menampilkan halaman arsip untuk semua artikel edukasi.
     */
    public function showEducations()
    {
        $articles = Information::where('status', 'published')->latest()->paginate(9); // Paginate 9 per halaman
        return view('public.educations', compact('articles'));
    }

    /**
     * Menyimpan pengaduan baru yang dikirim dari form publik.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeComplaint(Request $request)
    {
        // --- 1. Validasi Input ---
        $validated = $request->validate([
            'qr_token' => ['required', 'string', 'exists:bins,qr_token'],
            'reporter_name' => ['required', 'string', 'max:255'],
            'reporter_phone' => ['nullable', 'string', 'max:20'],
            'address_detail' => ['required', 'string', 'max:1000'],
            'category' => ['required', Rule::in(['garbage_pile', 'odor', 'full_bin', 'broken_bin', 'other'])],
            'description' => ['required', 'string', 'max:2000'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [
            'qr_token.exists' => 'The provided QR Code is invalid or not registered in our system.'
        ]);

        // --- 2. Cari Bin berdasarkan QR Token ---
        // `firstOrFail` akan otomatis menghentikan proses jika token tidak valid, 
        // meskipun validasi 'exists' sudah menangkapnya. Ini lapisan keamanan tambahan.
        $bin = Bin::where('qr_token', $validated['qr_token'])->firstOrFail();

        // --- 3. Handle Upload Foto (jika ada) ---
        $photoPath = null;
        if ($request->hasFile('photo')) {
            // Simpan file ke storage/app/public/complaint-photos
            // Nama file akan di-generate secara acak untuk menghindari duplikasi.
            $photoPath = $request->file('photo')->store('complaint-photos', 'public');
        }

        // --- 4. Buat Record Pengaduan Baru ---
        Complaint::create([
            'bin_id' => $bin->id,
            'reporter_name' => $validated['reporter_name'],
            'reporter_phone' => $validated['reporter_phone'],
            'address_detail' => $validated['address_detail'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'photo' => $photoPath,
            'status' => 'new', // Status awal selalu 'new'
        ]);

        // --- 5. Redirect Kembali dengan Pesan Sukses ---
        // Menggunakan with() akan membuat session flash yang hanya tersedia untuk request berikutnya.
        return redirect()->route('landing')->with('success', 'Your complaint has been submitted successfully. Thank you for your report!');
    }
}
