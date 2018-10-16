<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Setting::class, function (Faker $faker) {
    return [
        'full'            => 7,
        'renew'           => 7,
        'birthday'        => 7,
        'family_birthday' => 7,
        'year'            => 7,
        'archives'        => '档案查看者',
        'sync'            => 1,
        'created_at'      => \Carbon\Carbon::now(),
        'updated_at'      => \Carbon\Carbon::now(),
    ];
});
