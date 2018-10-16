<?php

use Illuminate\Database\Seeder;

class DepartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departs')->insert([
            [
                'id' => 1,
                'fid'              => 1,
                'wechat_depart_id' => 2,
                'name'             => '部门名称',
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
