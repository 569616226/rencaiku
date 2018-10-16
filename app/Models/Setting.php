<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $casts = [
        'full'            => 'array',
        'renew'           => 'array',
        'birthday'        => 'array',
        'family_birthday' => 'array',
        'year'            => 'array',
        'archives'        => 'array',
    ];

    protected $fillable = [
        'full',
        'renew',
        'birthday',
        'family_birthday',
        'year',
        'archives',
        'sync',
    ];
}
