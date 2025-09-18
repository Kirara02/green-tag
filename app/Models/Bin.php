<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bin extends Model
{
    protected $fillable = [
        'bin_location_id',
        'code',
        'qr_token',
        'description',
    ];

    public function location()
    {
        return $this->belongsTo(BinLocation::class, 'bin_location_id');
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}
