<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salary extends Model
{
    use SoftDeletes;

    protected $dates = [
        'start_at',
        'deleted_at',
    ];

    protected $fillable = [
        'status',
        'basic',
        'added',
        'total',
        'sp_num',
        'start_at',
        'remark',
        'archive_id',
    ];

    /*档案*/
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}
