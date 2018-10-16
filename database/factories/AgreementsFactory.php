<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Agreement::class, function (Faker $faker) {
    return [
        'no'         => '合同编号',
        'type'       => '合同类型',
        'archive_id' => 1,
        'sign_type'  => 1,
        'effect_at'  => \Carbon\Carbon::now(),
        'expire_at'  => \Carbon\Carbon::now(),
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ];
});
