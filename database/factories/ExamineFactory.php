<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Examine::class, function (Faker $faker) {
    return [
        'origin_no'        => '微信内申请单号',
        'status'           => 1,
        'depart'           => '申请部门',
        'apply_name'       => '申请人',
        'apply_time'       => \Carbon\Carbon::now(),
        'apply_user_id'    => 1,
        'position'         => '申请申请职位',
        'places'           => 3,
        'complate_date'    => \Carbon\Carbon::now(),
        'reason'           => '申请原因',
        'sex'              => '性别',
        'age'              => '年龄',
        'wrok_experiences' => '工作经验',
        'education'        => '学历',
        'other'            => '其他要求',
        'describe'         => '岗位职责',
        'created_at'     => \Carbon\Carbon::now(),
        'updated_at'     => \Carbon\Carbon::now(),
    ];
});
