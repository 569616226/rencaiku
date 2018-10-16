<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('origin_id')->nullable()->comment('简历来源,0:智通，1：卓博');
            $table->string('origin_no')->nullable()->comment('简历来源编号');
            $table->string('local_no')->nullable()->comment('简历本地编号');
            $table->string('wechat_position')->nullable()->comment('应聘职位');
            $table->string('name')->nullable()->comment('姓名');
            $table->integer('age')->nullable()->comment('年龄');
            $table->string('sex')->nullable()->comment('性别');
            $table->string('national')->nullable()->comment('民族');
            $table->string('origin_aderss')->nullable()->comment('户籍');
            $table->string('aderss')->nullable()->comment('现居住地');
            $table->string('marriage')->nullable()->comment('婚姻状况');
            $table->string('height')->nullable()->comment('身高');
            $table->string('education')->nullable()->comment('学历');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('tel')->nullable()->comment('手机');
            $table->string('work_experience')->nullable()->comment('工作经验');
            $table->longText('evaluation')->nullable()->comment('自我评价');
            $table->string('position')->nullable()->comment('意向职位');
            $table->string('area')->nullable()->comment('意向地区');
            $table->string('salary')->nullable()->comment('期望月薪');
            $table->string('fastest_date')->nullable()->comment('最快到岗');
            $table->longText('lang')->nullable()->comment('语言能力');
            $table->longText('wrok_experiences')->nullable()->comment('工作经验');
            $table->longText('evaluations')->nullable()->comment('教育经历');
            $table->longText('remark')->nullable()->comment('教育经历');
            $table->tinyInteger('blacklist')->default(0)->comment('黑名单,1:加入黑名单，0：移除');
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
        Schema::dropIfExists('resumes');
    }
}
