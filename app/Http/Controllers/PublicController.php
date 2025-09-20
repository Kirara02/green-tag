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

        return view('layouts.landing', compact('articles', 'schedules', 'stats'));
    }

    /**
     * Menampilkan halaman arsip untuk semua jadwal.
     */
    public function showSchedules(Request $request)
    {
        $query = CollectionRoute::with('locations');

        // Filter berdasarkan pencarian nama area
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan hari
        if ($request->filled('day')) {
            $query->where('day', $request->day);
        }

        $schedules = $query->latest()->paginate(9);

        // Tambahkan parameter query ke pagination links
        $schedules->appends($request->query());

        return view('public.schedules', compact('schedules'));
    }

    /**
     * Menampilkan halaman arsip untuk semua artikel edukasi.
     */
    public function showEducations(Request $request)
    {
        $query = Information::where('status', 'published');

        // Filter berdasarkan pencarian judul atau konten
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')->orWhere(
                    'content',
                    'like',
                    '%' . $searchTerm . '%',
                );
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $articles = $query->latest()->paginate(9);

        // Tambahkan parameter query ke pagination links
        $articles->appends($request->query());

        return view('public.educations', compact('articles'));
    }

    /**
     * Menampilkan detail artikel edukasi.
     */
    public function showArticle($slug)
    {
        $article = Information::where('slug', $slug)
            ->where('status', 'published')
            ->with('author')
            ->firstOrFail();

        // Ambil artikel terkait berdasarkan kategori
        $relatedArticles = Information::where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('public.article-detail', compact('article', 'relatedArticles'));
    }

    /**
     * Menampilkan detail jadwal pengambilan.
     */
    public function showSchedule($id)
    {
        $schedule = CollectionRoute::with(['locations', 'officerInCharge'])->findOrFail($id);

        // Ambil jadwal terkait berdasarkan hari yang sama
        $relatedSchedules = CollectionRoute::where('day', $schedule->day)
            ->where('id', '!=', $schedule->id)
            ->with('locations')
            ->latest()
            ->take(3)
            ->get();

        return view('public.schedule-detail', compact('schedule', 'relatedSchedules'));
    }

    /**
     * API endpoint untuk mendapatkan artikel berdasarkan kategori (AJAX).
     */
    public function getArticlesByCategory(Request $request)
    {
        $category = $request->get('category');

        $articles = Information::where('status', 'published')
            ->when($category, function ($query, $category) {
                return $query->where('category', $category);
            })
            ->latest()
            ->take(6)
            ->get(['id', 'title', 'slug', 'category', 'created_at']);

        return response()->json($articles);
    }

    /**
     * API endpoint untuk mendapatkan jadwal berdasarkan hari (AJAX).
     */
    public function getSchedulesByDay(Request $request)
    {
        $day = $request->get('day');

        $schedules = CollectionRoute::with('locations')
            ->when($day, function ($query, $day) {
                return $query->where('day', $day);
            })
            ->latest()
            ->take(6)
            ->get(['id', 'name', 'day', 'start_time', 'end_time']);

        return response()->json($schedules);
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
        $validated = $request->validate(
            [
                'qr_token' => ['required', 'string', 'exists:bins,qr_token'],
                'reporter_name' => ['required', 'string', 'max:255'],
                'reporter_phone' => ['nullable', 'string', 'max:20'],
                'address_detail' => ['required', 'string', 'max:1000'],
                'category' => [
                    'required',
                    Rule::in(['garbage_pile', 'odor', 'full_bin', 'broken_bin', 'other']),
                ],
                'description' => ['required', 'string', 'max:2000'],
                'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            ],
            [
                'qr_token.exists' =>
                    'The provided QR Code is invalid or not registered in our system.',
            ],
        );

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
        return redirect()
            ->route('landing')
            ->with(
                'success',
                'Your complaint has been submitted successfully. Thank you for your report!',
            );
    }
}
