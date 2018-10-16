<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribeUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for associating roles to users (Many-to-Many)
        /*
         * 角色和权限的多对多关联表
         * */
        Schema::create('subscribe_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('subscribe_id')->unsigned();
            $table->foreign('subscribe_id')->references('id')->on('subscribes')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('index')->unsigned();
            $table->primary(['user_id', 'subscribe_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribe_user');
    }
}
