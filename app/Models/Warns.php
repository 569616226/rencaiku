<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warns extends Model
{
    protected $casts = [
        'warnor' => 'array',

    ];

    protected $dates = [ 'warn_date'];

    protected $fillable = [
        'content',
        'status',
        'type',
        'warnor',
        'name',
        'warn_date',
        'archive_id',
        'agree_id',
    ];

    /*档案*/
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }

}
