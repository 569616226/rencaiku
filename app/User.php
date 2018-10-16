<?php

namespace App;

use App\Models\Archive;
use App\Models\Depart;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'avatar',
        'tel',
        'user_wechat_id',
        'email',
        'position',
        'gender'
    ];

    /**
     * 应该被调整为日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /*审核人范围内*/
    public function subscribes()
    {
        return $this->belongsToMany('App\Subscribe')->withPivot('index');
    }

    /*评论*/
    public function appraises()
    {
        return $this->hasOne('App\Models\Appraise', 'user_id', 'id');
    }

    /*部门*/
    public function departs()
    {
        return $this->belongsToMany(Depart::class);
    }

    /*档案*/
    public function archive()
    {
        return $this->hasOne(Archive::class);
    }

}
