<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('origin_no')->nullable()->comment('微信内申请单号');
            $table->tinyInteger('status')->nullable()->comment('状态：1未开始；2 进行中；已完成；4已取消');
            $table->string('depart')->nullable()->comment('申请部门');
            $table->string('apply_name')->nullable()->comment('申请人');
            $table->dateTime('apply_time')->nullable()->comment('审批提交时间');
            $table->string('apply_user_id')->nullable()->comment('申请人ID');
            $table->string('position')->nullable()->comment('申请申请职位');
            $table->tinyInteger('places')->nullable()->comment('申请名额');
            $table->dateTime('complate_date')->nullable()->comment('计划完成时间');
            $table->longText('reason')->nullable()->comment('申请原因');
            $table->string('sex')->nullable()->comment('性别');
            $table->string('age')->nullable()->comment('年龄');
            $table->longText('wrok_experiences')->nullable()->comment('工作经验');
            $table->string('education')->nullable()->comment('学历');
            $table->longText('other')->nullable()->comment('其他要求');
            $table->longText('describe')->nullable()->comment('岗位职责');
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
        Schema::dropIfExists('examines');
    }
}
