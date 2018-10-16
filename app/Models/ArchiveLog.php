<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchiveLog extends Model
{

    protected $fillable = [
        'type',
        'archive_id',
        'content',
    ];

    /*档案*/
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}
