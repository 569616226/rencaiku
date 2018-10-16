<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examine extends Model
{
    use SoftDeletes;

    /**
     * 应该被调整为日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'complate_date', 'apply_time'];

    protected $fillable = [
        'origin_no',
        'status',
        'depart',
        'position',
        'places',
        'complate_date',
        'reason',
        'sex',
        'age',
        'wrok_experiences',
        'education',
        'other',
        'describe',
        'apply_time',
        'apply_name',
        'apply_user_id',

    ];


    /*预约*/
    public function subscribes()
    {
        return $this->hasMany('App\Models\Subscribe', 'examine_id', 'id');
    }

}
