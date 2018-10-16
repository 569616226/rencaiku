<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warns', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type')->comment('提醒类型 1：转正 2：周年：3合同：4员工生日，5家属生日');
            $table->tinyInteger('status')->default(0)->comment('提醒状态 0：未完成 1：已完成');
            $table->Integer('agree_id')->nullable()->comment('合同id');
            $table->string('content')->comment('提醒内容');
            $table->string('warnor')->comment('提醒人 array');
            $table->string('name')->comment('姓名 array');
            $table->dateTime('warn_date')->nullable()->comment('提醒时间');
            $table->integer('archive_id')->unsigned();
            $table->foreign('archive_id')->references('id')->on('archives')->onUpdated('cascade')->onDeleted('cascade');
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
        Schema::dropIfExists('warns');
    }
}
