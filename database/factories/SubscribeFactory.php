<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Subscribe::class, function (Faker $faker) {
    return [
        'status'         => 1,
        'offer_date'     => \Carbon\Carbon::now(),
        'address'        => '面试地址',
        'result'         => 0,
        'remark'         => '备注',
        'remark_destroy' => '取消原因',
        'examine_id'     => 1,
        'resume_id'      => 1,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ];
});
