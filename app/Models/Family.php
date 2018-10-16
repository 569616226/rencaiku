<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    use SoftDeletes;

    protected $dates = [
        'birthday',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'relation',
        'offer',
        'age',
        'birthday_type',
        'birthday',
        'address',
        'archive_id',
    ];

    /*档案*/
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}
