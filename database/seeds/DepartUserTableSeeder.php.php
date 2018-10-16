<?php

use Illuminate\Database\Seeder;

class DepartUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('depart_user')->insert([
            [
                'user_id' => 1,
                'depart_id' => 9,
            ],[
                'user_id' => 2,
                'depart_id' => 9,
            ],[
                'user_id' => 3,
                'depart_id' => 9,
            ],[
                'user_id' => 4,
                'depart_id' => 9,
            ],[
                'user_id' => 5,
                'depart_id' => 9,
            ], [
                'user_id' => 6,
                'depart_id' => 9,
            ],[
                'user_id' => 7,
                'depart_id' => 9,
            ],[
                'user_id' => 8,
                'depart_id' => 9,
            ],[
                'user_id' => 9,
                'depart_id' => 9,
            ],[
                'user_id' => 10,
                'depart_id' => 10,
            ],
        ]);
    }
}
