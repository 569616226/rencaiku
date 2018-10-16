<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribes', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->nullable()->comment('状态：1未开始；2 进行中；已完成；4已关闭');
            $table->dateTime('offer_date')->nullable()->comment('面试时间');
            $table->string('address')->nullable()->comment('面试地址');
            $table->tinyInteger('result')->default(0)->nullable()->comment('面试结果0:待面试；1：通过，2：不合试');
            $table->string('remark')->nullable()->comment('备注');
            $table->string('remark_destroy')->nullable()->comment('取消原因');
            $table->integer('examine_id')->nullable()->unsigned()->comment('申请单');
            $table->foreign('examine_id')->references('id')->on('examines')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('resume_id')->nullable()->unsigned()->comment('简历');
            $table->foreign('resume_id')->references('id')->on('resumes')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('subscribes');
    }
}
