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
}
