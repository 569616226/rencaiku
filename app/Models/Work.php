<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use SoftDeletes;

    protected $dates = [
        'start_at',
        'end_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'start_at',
        'end_at',
        'position',
        'reason',
        'salary',
        'tel',
        'archive_id',
    ];

    /*档案*/
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}
