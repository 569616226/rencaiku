<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_wechat_id')->nullable()->comment('微信用户ID');
            $table->string('name')->nullable()->comment('用户名');
            $table->string('avatar')->nullable()->comment('头像');
            $table->string('tel')->nullable()->comment('手机');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('position')->nullable()->comment('职位');
            $table->integer('gender')->nullable()->comment('性别1：女，0:男');
            $table->tinyInteger('see_all_data')->nullable()->default(0)->comment('是否能访问全部数据 0:不能访问，1:可以访问');
            $table->tinyInteger('first')->nullable()->default(0)->comment('第一审核人 0:不是，1:是 ');
            $table->tinyInteger('last')->nullable()->default(0)->comment('面试官 0:不是，1:是');
//            $table->integer('depart_id')->unsigned();
//            $table->foreign('depart_id')->references('id')->on('departs')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
