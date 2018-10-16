<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppraisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appraises', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->nullable()->comment('状态：1同意；2不合适');
            $table->longText('content')->nullable()->comment('评价内容');
            $table->integer('user_id')->nullable()->unsigned()->comment('审核人');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('subscribe_id')->nullable()->unsigned()->comment('预约');
            $table->foreign('subscribe_id')->references('id')->on('subscribes')
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
        Schema::dropIfExists('appraises');
    }
}
