<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BinLocation extends Model
{
    protected $fillable = [
        'code',
        'name',
        'address',
    ];

    public function bins()
    {
        return $this->hasMany(Bin::class);
    }
}
