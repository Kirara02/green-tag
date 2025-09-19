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
}
