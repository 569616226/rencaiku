<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Depart extends Model
{
    use SoftDeletes;

    /**
     * 应该被调整为日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'fid',
        'name',
    ];

    /*审核人范围内*/
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getSubDepartAttribute($id)
    {
        $sub_departs = Depart::where('fid', $id)->get();

        return $sub_departs;
    }

}
