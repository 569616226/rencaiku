<?php

use Illuminate\Database\Seeder;

class ClosuresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('closures')->insert([
            [
                'id' => 1,
                'name'       => '附件名称',
                'uploader'   => '上传者',
                'path'       => '附件地址',
                'archive_id' => 1,
                'created_at'     => \Carbon\Carbon::now(),
                'updated_at'     => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
