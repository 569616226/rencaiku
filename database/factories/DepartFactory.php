<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Depart::class, function (Faker $faker) {
    return [
        'fid'              => 1,
        'wechat_depart_id' => 2,
        'name'             => '部门名称',
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});
