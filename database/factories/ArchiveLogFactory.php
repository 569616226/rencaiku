<?php

use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\ArchiveLog::class, function (Faker $faker) {
    return [
        'type'       => '升职',
        'content'    => '姓名 于2018-01-15 加入公司',
        'archive_id' => 1,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ];
});
