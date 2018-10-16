<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Family::class, function (Faker $faker) {
    return [
        'name'          => '姓名',
        'relation'      => 1,
        'offer'         => '职位',
        'age'           => 23,
        'birthday_type' => 1,
        'birthday'      => \Carbon\Carbon::now(),
        'address'       => '地址',
        'archive_id'    => 1,
        'created_at'     => \Carbon\Carbon::now(),
        'updated_at'     => \Carbon\Carbon::now(),
    ];
});
