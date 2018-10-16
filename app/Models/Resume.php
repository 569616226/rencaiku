<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resume extends Model
{
    use SoftDeletes;

    /**
     * 应该被调整为日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'origin_id',
        'origin_no',
        'local_no',
        'wechat_position',
        'name',
        'age',
        'sex',
        'origin_aderss',
        'aderss',
        'marriage',
        'height',
        'education',
        'email',
        'tel',
        'evaluation',
        'work_experience',
        'position',
        'area',
        'salary',
        'fastest_date',
        'lang',
        'wrok_experiences',
        'evaluations',
        'remark',
        'blacklist'
    ];

    /*预约*/
    public function subscribes()
    {
        return $this->hasMany('App\Models\Subscribe', 'resume_id', 'id');
    }

}
