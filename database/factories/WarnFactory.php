<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Warns::class, function (Faker $faker) {
    return [
        'type'       => '提醒类型 1：转正 2：周年：3合同：4员工生日，5家属生日',
        'status'     => '提醒状态 0：未完成 1：已完成',
        'content'    => '提醒内容',
        'warnor'     => '提醒人',
        'name'       => 'name',
        'warn_date'       => today(),
        'archive_id' => 1,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ];
});
