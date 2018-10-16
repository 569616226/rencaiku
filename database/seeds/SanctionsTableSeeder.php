<?php

use Illuminate\Database\Seeder;

class SanctionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sanctions')->insert([
            [
                'id' => 1,
                'name'       => '奖惩名称',
                'remark'     => '备注',
                'type'       => 1,
                'execute_at' => \Carbon\Carbon::now(),
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
