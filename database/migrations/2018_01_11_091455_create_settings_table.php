<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full')->comment('人员转正');
            $table->string('renew')->comment('合同续签');
            $table->string('birthday')->comment('员工生日');
            $table->string('family_birthday')->comment('生日');
            $table->string('year')->comment('周年');
            $table->string('archives')->nullable()->comment('薪资信息查看设置');
            $table->string('sync')->default(1)->comment('同步设置');
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
        Schema::dropIfExists('settings');
    }
}
