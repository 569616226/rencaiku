<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('local_no',20)->comment('内部编号');
            $table->string('name',20)->comment('姓名');
            $table->integer('sex')->comment('性别 ： 0男，1女');
            $table->string('national',20)->comment('民族');
            $table->string('origin_address',20)->comment('籍贯');
            $table->string('residence',50)->comment('现居住地');
            $table->string('address',50)->comment('家庭住址');
            $table->string('avatar')->nullable()->comment('头像');
            $table->string('marriage',1)->comment('婚姻状况0：未婚，1：已婚，2：离异');
            $table->string('height')->comment('身高');
            $table->string('Id_card',20)->comment('身份证');
            $table->string('healthy',20)->comment('身体情况');
            $table->dateTime('birthday')->comment('生日');
            $table->string('email',50)->comment('邮箱');
            $table->string('tel',15)->comment('电话');
            $table->longText('evalution')->comment('专长及能力');
            $table->longText('family_discrible')->nullable()->comment('家庭情况');
            $table->string('ability')->comment('能力水平 （语言能力： 0：普通话1:粤语，2：英语 计算机能力 ：0：会，1：一般，2：好，3：强）');
            $table->integer('internal')->unllable()->comment('内部推荐 （是否推荐 0 ：否，1：是，推荐人： 推荐人部门：）');
            $table->string('sos')->comment('紧急联系人（json格式 姓名： 关系：1：父母，2：配偶，3：兄弟姐妹，4：子女，5：亲属，6：好友）');
            $table->tinyInteger('offer_status')->comment('员工状态：0：离职，1：转正，2：试用，3：复职');
            $table->string('offer_name')->comment('职位名称');
            $table->dateTime('offer_off_date')->nullable()->comment('离职时间');
            $table->dateTime('offer_off_reason')->nullable()->comment('离职原因 array (0:正常离职1：自离2：辞退3：试用期不通过，原因)');
            $table->dateTime('offer_on_date')->nullable()->comment('入职时间');
            $table->dateTime('offer_date')->nullable()->comment('试用期结束时间');
            $table->tinyInteger('offer_type')->comment('工作性质：0：全职，1：兼职，2：实习');
            $table->longText('offer_des')->comment('岗位职责');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('archives');
    }
}
