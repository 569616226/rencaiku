<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sanction extends Model
{
    use SoftDeletes;

    protected $dates = [
        'execute_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'type',
        'execute_at',
        'remark',
        'archive_id',
    ];


    /*档案*/
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}
