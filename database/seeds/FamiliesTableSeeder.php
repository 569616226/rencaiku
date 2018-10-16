<?php

use Illuminate\Database\Seeder;

class FamiliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('families')->insert([
            [
                'id' => 1,
                'name'          => '姓名',
                'relation'      => 1,
                'offer'         => '职位',
                'age'           => 23,
                'birthday_type' => 1,
                'birthday'      => \Carbon\Carbon::now(),
                'address'       => '地址',
                'archive_id'    => 1,
                'created_at'     => \Carbon\Carbon::now(),
                'updated_at'     => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
