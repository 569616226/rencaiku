<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('new_depart')->unllable()->comment('新部门');
            $table->string('new_offer')->comment('新职位');
            $table->string('sp_num')->comment('单号');
            $table->integer('type')->comment('升迁类型 0:升职1:降职2:调岗3:复职');
            $table->dateTime('chang_at')->comment('生效时间');
            $table->string('remark')->comment('备注');
            $table->integer('archive_id')->unsigned();
            $table->foreign('archive_id')->references('id')->on('archives')->onUpdated('cascade')->onDeleted('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
