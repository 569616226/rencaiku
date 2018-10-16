<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use SoftDeletes;

    protected $dates = [
        'chang_at',
        'deleted_at',
    ];

    protected $fillable = [
        'new_depart',
        'new_offer',
        'chang_at',
        'type',
        'archive_id',
        'remark',
        'sp_num',
    ];

    /*档案*/
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}
