<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use SoftDeletes;

    protected $table = 'educations';

    protected $casts = [
        'is_finish' => 'boolean',
    ];

    protected $dates = [
        'start_at',
        'end_at',
        'deleted_at',
    ];

    protected $fillable = [
        'education',
        'name',
        'start_at',
        'end_at',
        'major',
        'is_finish',
        'archive_id',
    ];

    /*档案*/
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
}
