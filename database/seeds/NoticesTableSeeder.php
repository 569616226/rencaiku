<?php

use Illuminate\Database\Seeder;

class NoticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notices')->insert([
            [
                'id' => 1,
                'trial_salary' => 3000,
                'salary'       => 5000,
                'training'       => 1,
                'email'        => '邮箱',
                'entry_at'     => \Carbon\Carbon::now(),
                'subscribe_id'    => 1,
                'created_at'     => \Carbon\Carbon::now(),
                'updated_at'     => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
