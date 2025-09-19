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

    public function bin()
    {
        return $this->belongsTo(Bin::class);
    }
}
