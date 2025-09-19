<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\User;
use App\Models\BinLocation;

class CollectionRoute extends Model
{
    protected $fillable = [
        'name',
        'day',
        'start_time',
        'end_time',
        'officer_in_charge_id',
    ];

    /**
     * Relasi: Sebuah CollectionRoute ditugaskan pada satu User (petugas).
     */
    public function officerInCharge(): BelongsTo
    {
        return $this->belongsTo(User::class, 'officer_in_charge_id');
    }

    /**
     * Relasi: Sebuah CollectionRoute mencakup banyak BinLocations.
     */
    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(BinLocation::class, 'route_location')
                    ->withPivot('sequence') // Mengambil kolom 'sequence' dari tabel pivot
                    ->orderBy('sequence');   // Mengurutkan lokasi berdasarkan urutan
    }

    /**
     * Scope untuk filter berdasarkan hari.
     */
    public function scopeByDay($query, $day)
    {
        return $query->where('day', $day);
    }

    /**
     * Scope untuk pencarian berdasarkan nama area.
     */
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('name', 'like', '%' . $searchTerm . '%');
    }

    /**
     * Accessor untuk format waktu yang lebih readable.
     */
    public function getFormattedTimeAttribute()
    {
        return date('H:i', strtotime($this->start_time)) . ' - ' . date('H:i', strtotime($this->end_time));
    }

    /**
     * Accessor untuk URL jadwal.
     */
    public function getUrlAttribute()
    {
        return route('public.schedule', $this->id);
    }

    /**
     * Accessor untuk durasi dalam menit.
     */
    public function getDurationAttribute()
    {
        $start = strtotime($this->start_time);
        $end = strtotime($this->end_time);
        return ($end - $start) / 60; // dalam menit
    }

    /**
     * Accessor untuk status jadwal berdasarkan waktu.
     */
    public function getStatusAttribute()
    {
        $now = now();
        $start = $this->created_at->setTimeFromTimeString($this->start_time);
        $end = $this->created_at->setTimeFromTimeString($this->end_time);
        
        if ($now < $start) {
            return 'upcoming';
        } elseif ($now >= $start && $now <= $end) {
            return 'ongoing';
        } else {
            return 'completed';
        }
    }
}
