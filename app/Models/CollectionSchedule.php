<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionSchedule extends Model
{
    protected $fillable = [
        'day',
        'start_time',
        'end_time',
        'location',
    ];
}
