<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\CollectionRoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dasbor untuk Officer.
     */
    public function index()
    {
        $officerId = Auth::id();
        $today = Date::now()->format('l');

        // 1. STATISTIK UTAMA
        $stats = [
            'new_complaints_total' => Complaint::where('status', 'new')->count(),
            'my_in_progress' => Complaint::where('status', 'in_progress')
                ->where('handler_id', $officerId)
                ->count(),
            'today_schedules_count' => CollectionRoute::where(
                'day',
                'like',
                '%' . $today . '%',
            )->count(),
        ];

        // 2. DATA UNTUK GRAFIK TUGAS AKTIF (DOUGHNUT)
        $active_tasks_chart = [
            'labels' => ['Pengaduan Baru (Belum Ditugaskan)', 'Tugas Saya (Sedang Dikerjakan)'],
            'values' => [$stats['new_complaints_total'], $stats['my_in_progress']],
        ];

        // 3. DATA UNTUK GRAFIK KINERJA MINGGUAN (BAR)
        $performance_per_day = Complaint::select(
            DB::raw('DATE(updated_at) as date'),
            DB::raw('count(*) as count'),
        )
            ->where('status', 'resolved')
            ->where('handler_id', $officerId) // Hanya pengaduan yang diselesaikan oleh officer ini
            ->where('updated_at', '>=', now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->pluck('count', 'date');

        $performance_chart_labels = [];
        $performance_chart_values = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $performance_chart_labels[] = date('D', strtotime($date)); // Format: "Mon", "Tue"
            $performance_chart_values[] = $performance_per_day[$date] ?? 0;
        }

        // 4. DAFTAR TUGAS
        $recent_complaints = Complaint::where('status', 'new')
            ->orWhere(function ($query) use ($officerId) {
                $query->where('status', 'in_progress')->where('handler_id', $officerId);
            })
            ->with('bin.location')
            ->latest()
            ->take(5)
            ->get();

        $today_schedules = CollectionRoute::where('day', 'like', '%' . $today . '%')
            ->orderBy('start_time')
            ->get();

        return view(
            'officer.dashboard.index',
            compact(
                'stats',
                'recent_complaints',
                'today_schedules',
                'active_tasks_chart',
                'performance_chart_labels',
                'performance_chart_values',
            ),
        );
    }
}
