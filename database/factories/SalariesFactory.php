<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Salary::class, function (Faker $faker) {
    return [
        'status'     => 0,
        'basic'      => 1000,
        'added'      => 5000,
        'total'      => 6000,
        'sp_num'     => 201803230001,
        'start_at'   => now(),
        'remark'     => '备注',
        'archive_id' => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
