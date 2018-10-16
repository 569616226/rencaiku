<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'id'              => 1,
                'full'            => 7,
                'renew'           => 7,
                'birthday'        => 14,
                'family_birthday' => 7,
                'year'            => 7,
                'archives'        => '档案查看者',
                'sync'            => 1,
                'created_at'      => \Carbon\Carbon::now(),
                'updated_at'      => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
