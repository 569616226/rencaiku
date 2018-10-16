<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Resume::class, function (Faker $faker) {
    return [
        'origin_id'        => 1,
        'origin_no'        => '简历来源编号',
        'local_no'         => '简历本地编号',
        'wechat_position'  => '应聘职位',
        'name'             => '姓名',
        'age'              => 23,
        'sex'              => '性别',
        'national'         => '民族',
        'origin_aderss'    => '户籍',
        'aderss'           => '现居住地',
        'marriage'         => '婚姻状况',
        'height'           => '身高',
        'education'        => '学历',
        'email'            => '邮箱',
        'tel'              => '手机',
        'work_experience'  => '工作经验',
        'evaluation'       => '自我评价',
        'position'         => '意向职位',
        'area'             => '意向地区',
        'salary'           => '期望月薪',
        'fastest_date'     => '最快到岗',
        'lang'             => '语言能力',
        'wrok_experiences' => '工作经验',
        'evaluations'      => '教育经历',
        'remark'           => '教育经历',
        'blacklist'        => 0,
        'created_at'     => \Carbon\Carbon::now(),
        'updated_at'     => \Carbon\Carbon::now(),
    ];
});
