<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Archive extends Model
{
    use SoftDeletes;

    protected $dates = [
        'birthday',
        'offer_off_date',
        'offer_on_date',
        'offer_date',
        'deleted_at',
    ];

    protected $casts = [
        'ability'      => 'array',
        'sos'          => 'array',
        'offer_off_reason' => 'array',
    ];

    protected $fillable = [
        'local_no',
        'name',
        'sex',
        'national',
        'origin_address',
        'residence',
        'address',
        'marriage',
        'height',
        'Id_card',
        'healthy',
        'birthday',
        'email',
        'tel',
        'evalution',
        'family_discrible',
        'ability',
        'internal',
        'sos',
        'avatar',
        'offer_status',
        'offer_off_reason',
        'offer_off_date',
        'offer_on_date',
        'offer_date',
        'offer_type',
        'offer_name',
        'offer_des',
        'user_id',
    ];

    /*教育经历*/
    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    /*工作经历*/
    public function works()
    {
        return $this->hasMany(Work::class);
    }

    /*奖惩*/
    public function sanctions()
    {
        return $this->hasMany(Sanction::class);
    }

    /*家庭成员*/
    public function families()
    {
        return $this->hasMany(Family::class);
    }

    /*合同*/
    public function agreements()
    {
        return $this->hasMany(Agreement::class);
    }

    /*升迁*/
    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    /*薪资*/
    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    /*附件*/
    public function closures()
    {
        return $this->hasMany(Closure::class);
    }

    /*记录*/
    public function archive_logs()
    {
        return $this->hasMany(ArchiveLog::class);
    }

    /*提醒*/
    public function warns()
    {
        return $this->hasMany(Warns::class);
    }

    /*企业微信账号*/
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
