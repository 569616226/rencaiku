<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Closure extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'uploader',
        'path',
        'archive_id',
    ];

    protected $dates = ['deleted_at'];

    /*档案*/
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }

}
