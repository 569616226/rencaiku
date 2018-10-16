<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Work::class, function (Faker $faker) {
    return [
        'name'       => '公司名称',
        'position'   => '职位',
        'reason'     => '离职原因',
        'tel'        => '电话',
        'start_at'   => \Carbon\Carbon::now(),
        'end_at'     => \Carbon\Carbon::now(),
        'salary'     => 3000,
        'archive_id' => 1,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ];
});
