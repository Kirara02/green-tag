<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'bin_id',
        'reporter_name',
        'reporter_phone',
        'address_detail',
        'category',
        'description',
        'photo',
        'status',
        'handler_id',
        'resolution_notes',
    ];

    /**
     * Relasi: Sebuah Complaint dimiliki oleh satu Bin.
     */
    public function bin()
    {
        return $this->belongsTo(Bin::class);
    }

    /**
     * Relasi: Sebuah Complaint ditangani oleh satu User (handler).
     */
    public function handler()
    {
        return $this->belongsTo(User::class, 'handler_id');
    }

    /**
     * Scope untuk complaint berdasarkan status.
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk complaint berdasarkan kategori.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Accessor untuk format tanggal yang lebih readable.
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y H:i');
    }

    /**
     * Accessor untuk status badge color.
     */
    public function getStatusColorAttribute()
    {
        $colors = [
            'new' => 'bg-blue-100 text-blue-800',
            'in_progress' => 'bg-yellow-100 text-yellow-800',
            'resolved' => 'bg-green-100 text-green-800',
            'closed' => 'bg-gray-100 text-gray-800',
        ];

        return $colors[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    /**
     * Accessor untuk kategori badge color.
     */
    public function getCategoryColorAttribute()
    {
        $colors = [
            'garbage_pile' => 'bg-red-100 text-red-800',
            'odor' => 'bg-orange-100 text-orange-800',
            'full_bin' => 'bg-yellow-100 text-yellow-800',
            'broken_bin' => 'bg-purple-100 text-purple-800',
            'other' => 'bg-gray-100 text-gray-800',
        ];

        return $colors[$this->category] ?? 'bg-gray-100 text-gray-800';
    }
}
