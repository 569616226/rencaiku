<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agreement extends Model
{
    use SoftDeletes;

    protected $dates = [
        'effect_at',
        'expire_at',
        'deleted_at',
    ];

    protected $fillable = [
        'no',
        'type',
        'archive_id',
        'sign_type',
        'effect_at',
        'expire_at',
    ];

    /*档案*/
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}
