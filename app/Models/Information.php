<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Information extends Model
{
    protected $table = 'informations';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'video_url',
        'category',
        'status',
        'author_id',
    ];

    /**
     * Relasi: Sebuah artikel Informasi ditulis oleh satu User.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Scope untuk artikel yang sudah dipublikasikan.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope untuk pencarian berdasarkan judul atau konten.
     */
    public function scopeSearch($query, $searchTerm)
    {
        return $query->where(function ($q) use ($searchTerm) {
            $q->where('title', 'like', '%' . $searchTerm . '%')->orWhere(
                'content',
                'like',
                '%' . $searchTerm . '%',
            );
        });
    }

    /**
     * Scope untuk filter berdasarkan kategori.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Accessor untuk excerpt konten.
     */
    public function getExcerptAttribute()
    {
        return \Str::limit(strip_tags($this->content), 150);
    }

    /**
     * Accessor untuk URL artikel.
     */
    public function getUrlAttribute()
    {
        return route('public.article', $this->slug);
    }

    /**
     * Accessor untuk format tanggal yang lebih readable.
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y');
    }
}
