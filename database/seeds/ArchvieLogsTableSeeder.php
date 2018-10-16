<?php

use Illuminate\Database\Seeder;

class ArchvieLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('archive_logs')->insert([
            [
                'id' => 1,
                'type'       => '入职',
                'content'    => '姓名 于2018-01-15 加入公司',
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id' => 2,
                'type'       => '转正',
                'content'    => '张三 于2018-01-01 由试用期员工转正为正式员工',
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id' => 3,
                'type'       => '荣誉',
                'content'    => '张三 于2018-01-01 获得优秀员工的荣誉奖励，备注：2017年度优秀员工',
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id' => 4,
                'type'       => '薪资变动',
                'content'    => '张三 于2018-01-01 薪资从5000元/月 更变为 8000元/月，备注：加薪',
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id' => 5,
                'type'       => '升职',
                'content'    => '张三 于2018-01-01 从研发中心-PHP工程师 晋升为 研发中心-技术经理',
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id' => 6,
                'type'       => '惩罚',
                'content'    => '张三 于2018-01-01 获得重大记过处分，备注：违法公司规定，早退，迟到',
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id' => 7,
                'type'       => '离职',
                'content'    => '张三 于2018-01-01 从公司离职，离职原因：自离',
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ], [
                'id' => 8,
                'type'       => '复职',
                'content'    => '张三 于2018-01-01 复职为 研发中心-PHP工程师',
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
