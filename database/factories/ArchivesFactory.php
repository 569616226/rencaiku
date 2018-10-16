<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Archive::class, function (Faker $faker) {
    return [
        'local_no'         => '内部编号',
        'name'             => '姓名',
        'sex'              => 1,
        'national'         => '民族',
        'origin_address'   => '籍贯',
        'residence'        => '现居住地',
        'address'          => '家庭住址',
        'avatar'           => '头像',
        'marriage'         => 1,
        'height'           => 123,
        'Id_card'          => '身份证',
        'healthy'          => '身份证',
        'birthday'         => \Carbon\Carbon::now(),
        'email'            => '邮箱',
        'tel'              => '电话',
        'evalution'        => '专长及能力',
        'family_discrible' => '专长及能力',
        'ability'          => '能力水平 （语言能力： 0：普通话，粤语，1：英语 计算机能力 ：0：会，1：一般，2：好，3：强）',
        'internal'         => '内部推荐 ',
        'sos'              => '紧急联系人（json格式 姓名： 关系：1：父母，2：配偶，3：兄弟姐妹，4：子女，5：亲属，6：好友）',
        'offer_status'     => 1,
        'offer_off_date'   => \Carbon\Carbon::now(),
        'offer_on_date'    => \Carbon\Carbon::now(),
        'offer_date'       => \Carbon\Carbon::now(),
        'offer_type'       => 1,
        'offer_des'        => 1,
        'user_id'          => 1,
        'offer_depart'     => '["1"]',
        'offer_off_reason' => '["1",""]',
        'offer_name'       => '职位',
        'created_at'       => \Carbon\Carbon::now(),
        'updated_at'       => \Carbon\Carbon::now(),
    ];
});
