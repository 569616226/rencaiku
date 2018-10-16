<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trial_salary')->nullable()->comment('试用薪资');
            $table->integer('salary')->nullable()->comment('薪资');
            $table->tinyInteger('training')->nullable()->comment('试用期');
            $table->tinyInteger('type')->default(0)->comment('发送状态 0:已发送，1：未发送');
            $table->string('email',50)->nullable()->comment('邮箱');
            $table->string('notice_url')->nullable()->comment('入职须知链接');
            $table->dateTime('entry_at')->nullable()->comment('报到时间');
            $table->integer('subscribe_id')->unsigned();
            $table->foreign('subscribe_id')->references('id')->on('subscribes')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('notices');
    }
}
