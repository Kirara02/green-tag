<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bin;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Statistik Utama
        $stats = [
            'total_officers' => User::where('role', 'officer')->count(),
            'total_bins' => Bin::count(),
            'new_complaints' => Complaint::where('status', 'new')->count(),
            'resolved_complaints' => Complaint::where('status', 'resolved')->count(),
        ];

        // 2. Data untuk Grafik Tren Pengaduan (7 Hari Terakhir)
        $complaints_per_day = Complaint::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->where('created_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->pluck('count', 'date');

        $chart_labels = [];
        $chart_values = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chart_labels[] = date('D, M j', strtotime($date)); // Format: "Tue, Sep 17"
            $chart_values[] = $complaints_per_day[$date] ?? 0;
        }

        // 3. Data untuk Grafik Komposisi Kategori
        $category_distribution = Complaint::select('category', DB::raw('count(*) as count'))
            ->groupBy('category')
            ->pluck('count', 'category');

        // 4. Pengaduan Terbaru
        $recent_complaints = Complaint::with('bin.location')->latest()->take(5)->get();

        return view('admin.dashboard.index', compact(
            'stats', 
            'recent_complaints', 
            'chart_labels', 
            'chart_values',
            'category_distribution'
        ));
    }
}