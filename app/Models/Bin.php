<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bin extends Model
{
    protected $fillable = [
        'bin_location_id',
        'code',
        'qr_token',
        'description',
        'accepted_waste_types',
    ];

    /**
     * Relasi: Sebuah Bin dimiliki oleh satu BinLocation.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(BinLocation::class, 'bin_location_id');
    }

    /**
     * Relasi: Sebuah Bin dapat memiliki banyak Complaints.
     */
    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }

    /**
     * Scope untuk bin berdasarkan lokasi.
     */
    public function scopeByLocation($query, $locationId)
    {
        return $query->where('bin_location_id', $locationId);
    }

    /**
     * Scope untuk pencarian berdasarkan kode atau deskripsi.
     */
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($q) use ($searchTerm) {
            $q->where('code', 'like', '%' . $searchTerm . '%')
                ->orWhere('description', 'like', '%' . $searchTerm . '%')
                ->orWhere('qr_token', 'like', '%' . $searchTerm . '%');
        });
    }

    /**
     * Accessor untuk URL QR code.
     */
    public function getQrCodeUrlAttribute()
    {
        return route('officer.bins.qr-code', $this->id);
    }

    /**
     * Accessor untuk status bin berdasarkan complaint terbaru.
     */
    public function getStatusAttribute()
    {
        $latestComplaint = $this->complaints()->latest()->first();

        if (!$latestComplaint) {
            return 'good';
        }

        // Jika ada complaint dalam 7 hari terakhir yang belum resolved
        if (
            $latestComplaint->created_at->isAfter(now()->subDays(7)) &&
            in_array($latestComplaint->status, ['new', 'in_progress'])
        ) {
            return 'needs_attention';
        }

        return 'good';
    }

    /**
     * Accessor untuk status color.
     */
    public function getStatusColorAttribute()
    {
        $colors = [
            'good' => 'bg-green-100 text-green-800',
            'needs_attention' => 'bg-red-100 text-red-800',
        ];

        return $colors[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    /**
     * Method untuk mendapatkan complaint terbaru.
     */
    public function getLatestComplaint()
    {
        return $this->complaints()->latest()->first();
    }

    /**
     * Method untuk menghitung total complaint.
     */
    public function getTotalComplaints()
    {
        return $this->complaints()->count();
    }
}
