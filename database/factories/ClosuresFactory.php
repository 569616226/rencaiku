<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Closure::class, function (Faker $faker) {
    return [
        'name'       => '附件名称',
        'uploader'   => '上传者',
        'path'       => '附件地址',
        'archive_id' => 1,
        'created_at'     => \Carbon\Carbon::now(),
        'updated_at'     => \Carbon\Carbon::now(),
    ];
});
