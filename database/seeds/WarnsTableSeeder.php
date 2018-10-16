<?php

use Illuminate\Database\Seeder;

class WarnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('warns')->insert([
            [
                'id'         => 1,
                'type'       => 1,
                'status'     => 1,
                'content'    => ' 的试用期将于2018-01-25结束，请及时办理转正手续',
                'warnor'     => '["1","2"]',
                'name'       => '小明',
                'warn_date'       => today(),
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id'         => 2,
                'type'       => 3,
                'status'     => 1,
                'content'    => ' 的劳动合同将于2018-01-29结束，请及时办理合同续签手续',
                'warnor'     => '["1","2"]',
                'name'       => '小明',
                'warn_date'       => today(),
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id'         => 3,
                'type'       => 4,
                'status'     => 1,
                'content'    => '（1月11日）',
                'warnor'     => '["1","2"]',
                'name'       => '小明',
                'warn_date'       => today(),
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id'         => 4,
                'type'       => 5,
                'status'     => 1,
                'content'    => ' 父亲 ：姓名（1月24日， 阳历 ）',
                'warnor'     => '["1","2"]',
                'name'       => '小明',
                'warn_date'       => today(),
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id'         => 5,
                'type'       => 2,
                'status'     => 1,
                'content'    => ' 于2019-01-29入职满一年，感谢为公司的付出',
                'warnor'     => '["1","2"]',
                'name'       => '小明',
                'warn_date'       => today(),
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id'         => 6,
                'type'       => 1,
                'status'     => 0,
                'content'    => ' 的试用期将于2018-01-25结束，请及时办理转正手续',
                'warnor'     => '["1","2"]',
                'name'       => '小明',
                'warn_date'       => today(),
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id'         => 7,
                'type'       => 3,
                'status'     => 0,
                'content'    => ' 的劳动合同将于2018-01-29结束，请及时办理合同续签手续',
                'warnor'     => '["1","2"]',
                'name'       => '小明',
                'warn_date'       => today(),
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id'         => 8,
                'type'       => 4,
                'status'     => 0,
                'content'    => '姓名（1月11日）',
                'warnor'     => '["1","2"]',
                'name'       => '小明',
                'warn_date'       => today(),
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id'         => 9,
                'type'       => 5,
                'status'     => 0,
                'content'    => '姓名 父亲 ：姓名（1月24日， 阳历 ）',
                'warnor'     => '["1","2"]',
                'name'       => '小明',
                'warn_date'       => today(),
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id'         => 10,
                'type'       => 2,
                'status'     => 0,
                'content'    => '姓名 于2019-01-29入职满一年，感谢为公司的付出',
                'warnor'     => '["1","2"]',
                'name'       => '小明',
                'warn_date'       => today(),
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
