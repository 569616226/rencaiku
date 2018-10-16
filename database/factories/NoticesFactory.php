<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Notice::class, function (Faker $faker) {
    return [
        'trial_salary' => 3000,
        'salary'       => 5000,
        'training'     => 1,
        'email'        => '邮箱',
        'type'         => 1,
        'entry_at'     => \Carbon\Carbon::now(),
        'subscribe_id' => 1,
        'created_at'   => \Carbon\Carbon::now(),
        'updated_at'   => \Carbon\Carbon::now(),
    ];
});
