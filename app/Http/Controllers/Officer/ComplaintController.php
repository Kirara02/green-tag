<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ComplaintController extends Controller
{
    /**
     * Menampilkan daftar semua pengaduan.
     */
    public function index()
    {
        // Eager load relasi untuk efisiensi query
        // 'bin.location' akan mengambil data tong sampah DAN lokasi tong sampah tersebut
        $complaints = Complaint::with('bin.location')
            ->latest() // Urutkan dari yang terbaru
            ->paginate(15);

        return view('officer.complaints.index', compact('complaints'));
    }

    /**
     * Menampilkan detail satu pengaduan.
     * Kita akan gabungkan halaman 'show' dan 'edit' untuk efisiensi.
     */
    public function show(Complaint $complaint)
    {
        // Redirect ke halaman edit, karena di sana kita akan menampilkan semua detail
        return redirect()->route('officer.complaints.edit', $complaint);
    }

    /**
     * Menampilkan form untuk mengedit (memperbarui status) pengaduan.
     */
    public function edit(Complaint $complaint)
    {
        return view('officer.complaints.edit', compact('complaint'));
    }

    /**
     * Memperbarui status dan catatan penyelesaian pengaduan.
     */
    public function update(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['new', 'in_progress', 'resolved', 'rejected'])],
            'resolution_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        // Tetapkan 'handler_id' ke officer yang sedang login saat status diubah dari 'new'
        if ($complaint->status == 'new' && $validated['status'] == 'in_progress') {
            $validated['handler_id'] = Auth::id();
        }

        // Jika status diubah menjadi 'resolved', pastikan catatan diisi
        if ($validated['status'] == 'resolved' && empty($validated['resolution_notes'])) {
            return back()
                ->withErrors([
                    'resolution_notes' =>
                        'Resolution notes are required when resolving a complaint.',
                ])
                ->withInput();
        }

        $complaint->update($validated);

        return redirect()
            ->route('officer.complaints.index')
            ->with('success', 'Complaint status updated successfully.');
    }
}
