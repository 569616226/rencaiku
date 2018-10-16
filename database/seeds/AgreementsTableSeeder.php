<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AgreementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agreements')->insert([
            [
                'id'         => 1,
                'no'         => '合同编号',
                'type'       => 1,
                'archive_id' => 1,
                'sign_type'  => 1,
                'effect_at'  => \Carbon\Carbon::now(),
                'expire_at'  => \Carbon\Carbon::now(),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        ]);
    }
}
