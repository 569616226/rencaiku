<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Appraise::class, function (Faker $faker) {
    return [
        'status'       => 1,
        'content'      => '评价内容',
        'user_id'      => 1,
        'subscribe_id' => 1,
        'created_at'  => \Carbon\Carbon::now(),
        'updated_at'  => \Carbon\Carbon::now(),
    ];
});
