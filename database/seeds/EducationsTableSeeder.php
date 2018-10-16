<?php

use Illuminate\Database\Seeder;

class EducationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educations')->insert([
            [
                'id' => 1,
                'name'       => '学校名称',
                'major'      => '专业',
                'education'  => 1,
                'is_finish'  => 1,
                'start_at'   => \Carbon\Carbon::now(),
                'end_at'     => \Carbon\Carbon::now(),
                'archive_id' => 1,
                'created_at'     => \Carbon\Carbon::now(),
                'updated_at'     => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
