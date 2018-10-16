<?php

use Illuminate\Database\Seeder;

class SubscribeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscribes')->insert([
            [
                'id' => 1,
                'status'         => 1,
                'offer_date'     => \Carbon\Carbon::now(),
                'address'        => '面试地址',
                'result'         => 0,
                'remark'         => '备注',
                'remark_destroy' => '取消原因',
                'examine_id'     => 1,
                'resume_id'      => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
