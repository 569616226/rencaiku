<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
    use SoftDeletes;

    protected $dates = [
        'entry_at',
        'deleted_at',
    ];

    protected $fillable = [
        'subscribe_id',
        'trial_salary',
        'type',
        'salary',
        'training',
        'email',
        'entry_at',
        'notice_url',
    ];

    /*简历*/
    public function subscribe()
    {
        return $this->belongsTo(Subscribe::class);
    }

}
