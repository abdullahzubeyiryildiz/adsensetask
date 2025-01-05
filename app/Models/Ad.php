<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'ad_unit_id',
        'name',
        'location',
        'content',
        'is_active',
    ];
}
