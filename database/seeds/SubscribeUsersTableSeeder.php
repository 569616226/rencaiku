<?php

use Illuminate\Database\Seeder;

class SubscribeUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscribe_user')->insert([
            [
                'user_id'      => 1,
                'subscribe_id' => 1,
                'index'        => 1,
            ],
        ]);
    }
}
