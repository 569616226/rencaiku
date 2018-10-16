<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20)->comment('姓名');
            $table->string('relation',20)->comment('关系 1:父亲 2：母亲3:儿子4：女儿5：夫妻');
            $table->string('offer',20)->comment('职位');
            $table->integer('age')->comment('年龄');
            $table->integer('birthday_type')->comment('生日类型0：农历1：阳历');
            $table->dateTime('birthday')->nullable()->comment('生日');
            $table->string('address')->comment('地址');
            $table->integer('archive_id')->unsigned();
            $table->foreign('archive_id')->references('id')->on('archives')->onUpdated('cascade')->onDeleted('cascade');
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
        Schema::dropIfExists('families');
    }
}
