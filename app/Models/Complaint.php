<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'reporter_name',
        'address',
        'category',
        'description',
        'photo',
        'status',
    ];

    public function bin()
    {
        return $this->belongsTo(Bin::class);
    }
}
