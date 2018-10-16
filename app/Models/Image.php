<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * 应该被调整为日期的属性
     *
     * @var array
     */
    protected $dates = [ 'deleted_at' ];

    protected $fillable = [ 'name', 'url', 'item_id' ];

    public static $rules = [ 'img' => 'required|mimes:png,gif,jpeg,jpg' ];
    public static $messages = [ 'img.mimes' => '图片必须为png,gif,jpeg,jpg格式', 'img.required' => '请选择图片' ];
}
