<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\CollectionRoute;

class BinLocation extends Model
{
    protected $fillable = [
        'code',
        'name',
        'address',
        'latitude',
        'longitude',
    ];

    /**
     * Relasi: Satu BinLocation memiliki banyak Bins.
     */
    public function bins(): HasMany
    {
        return $this->hasMany(Bin::class);
    }

    /**
     * Relasi: Satu BinLocation bisa menjadi bagian dari banyak CollectionRoutes.
     */
    public function collectionRoutes(): BelongsToMany
    {
        return $this->belongsToMany(CollectionRoute::class, 'route_location')
                    ->withPivot('sequence') // Mengambil kolom 'sequence' dari tabel pivot
                    ->orderBy('sequence');   // Mengurutkan berdasarkan urutan pengambilan
    }
}
