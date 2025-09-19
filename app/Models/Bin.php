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
}
