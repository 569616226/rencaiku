<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appraise extends Model
{
    use SoftDeletes;

    /**
     * 应该被调整为日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'status',
        'content',
        'user_id',
        'subscribe_id',
    ];

    /*审核人范围内*/
    public function subscribes()
    {
        return $this->belongsTo('App\Models\Subscribe', 'subscribe_id', 'id');
    }

    /*审核人范围内*/
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
