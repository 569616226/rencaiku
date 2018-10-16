<?php

use Illuminate\Database\Seeder;

class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('works')->insert([
            [
                'id'         => 1,
                'name'       => '公司名称',
                'position'   => '职位',
                'reason'     => '离职原因',
                'tel'        => '电话',
                'start_at'   => \Carbon\Carbon::now(),
                'end_at'     => \Carbon\Carbon::now(),
                'salary'     => 3000,
                'archive_id' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
