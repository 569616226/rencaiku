<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Education::class, function (Faker $faker) {
    return [
        'name'       => '学校名称',
        'major'      => '专业',
        'education'  => 1,
        'is_finish'  => 1,
        'start_at'   => \Carbon\Carbon::now(),
        'end_at'     => \Carbon\Carbon::now(),
        'archive_id' => 1,
        'created_at'     => \Carbon\Carbon::now(),
        'updated_at'     => \Carbon\Carbon::now(),
    ];
});
