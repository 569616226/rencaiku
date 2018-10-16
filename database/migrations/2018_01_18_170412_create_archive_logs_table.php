<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchiveLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->comment('记录类型');
            $table->longText('content')->comment('记录内容');
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
        Schema::dropIfExists('archive_logs');
    }
}
