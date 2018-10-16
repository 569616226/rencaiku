<?php

use Illuminate\Database\Seeder;

class PromotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promotions')->insert([
            [
                'id'         => 1,
                'new_depart' => '新部门',
                'new_offer'  => '旧部门',
                'type'       => 1,
                'sp_num'     => 1,
                'chang_at'   => now(),
                'archive_id' => 1,
                'remark'     => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
