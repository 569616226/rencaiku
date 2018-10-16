<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no',20)->comment('合同编号');
            $table->integer('type')->comment('合同类型0：非固定期限合同 1：固定期限合同');
            $table->integer('archive_id')->unsigned();
            $table->foreign('archive_id')->references('id')->on('archives')->onUpdated('cascade')->onDeleted('cascade');
            $table->integer('sign_type')->comment('签订类型 0：首签 1：续签');
            $table->dateTime('effect_at')->comment('生效时间');
            $table->dateTime('expire_at')->comment('到期时间');
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
        Schema::dropIfExists('agreements');
    }
}
