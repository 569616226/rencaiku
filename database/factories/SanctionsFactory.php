<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Sanction::class, function (Faker $faker) {
    return [
        'name'       => '奖惩名称',
        'remark'     => '备注',
        'type'       => 1,
        'execute_at' => \Carbon\Carbon::now(),
        'archive_id' => 1,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ];
});
