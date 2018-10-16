<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Promotion::class, function (Faker $faker) {
    return [
        'new_depart' => '新部门',
        'new_offer'  => '旧部门',
        'type'       => 1,
        'chang_at'   => now(),
        'sp_num'     => 1,
        'archive_id' => 1,
        'remark'     => 1,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
