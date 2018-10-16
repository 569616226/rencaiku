<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->comment('调薪类型：0：入职 1：转正 2：加薪 3：减薪');
            $table->integer('basic')->comment('基本工资');
            $table->string('sp_num')->comment('审批单号');
            $table->integer('added')->comment('绩效薪资');
            $table->integer('total')->comment('合计薪资');
            $table->dateTime('start_at')->comment('生效时间');
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
        Schema::dropIfExists('salaries');
    }
}
