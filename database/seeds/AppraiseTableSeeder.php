<?php

use Illuminate\Database\Seeder;

class AppraiseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appraises')->insert([
            [
                'id' => 1,
                'status'       => 1,
                'content'      => '评价内容',
                'user_id'      => 1,
                'subscribe_id' => 1,
                'created_at'  => \Carbon\Carbon::now(),
                'updated_at'  => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
