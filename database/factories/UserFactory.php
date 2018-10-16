<?php

use Faker\Generator as Faker;

$factory->define(\App\User::class, function (Faker $faker) {
    return [
        'user_wechat_id' => 123456,
        'name'           => '用户名',
        'avatar'         => '头像',
        'see_all_data'   => 0,
        'first'          => 0,
        'last'           => 0,
        'depart_id'      => 1,
        'created_at'     => \Carbon\Carbon::now(),
        'updated_at'     => \Carbon\Carbon::now(),
    ];
});
