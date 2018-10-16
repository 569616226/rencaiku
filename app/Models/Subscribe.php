<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscribe extends BaseModel
{
    use SoftDeletes;

    /**
     * 应该被调整为日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'offer_date'];

    protected $fillable = [
        'status',
        'offer_date',
        'address',
        'result',
        'remark',
        'examine_id',
        'resume_id',
    ];

    /*简历*/
    public function resumes()
    {
        return $this->belongsTo('App\Models\Resume', 'resume_id', 'id');
    }

    /*申请单*/
    public function examines()
    {
        return $this->belongsTo('App\Models\Examine', 'examine_id', 'id');
    }

    /*审核人范围内*/
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('index');
    }

    /*审核人范围内*/
    public function appraises()
    {
        return $this->hasMany('App\Models\Appraise', 'subscribe_id', 'id');
    }

    /*录取通知管理*/
    public function notice()
    {
        return $this->hasOne(Notice::class);
    }


}
