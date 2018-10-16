<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', 'LoginController@login')->name('login');//登陆
Route::get('logout', 'LoginController@logout');//退出
Route::get('/', 'HomeController@index')->name('home');//首页
Route::get('auth', 'LoginController@auth');//登陆验证

Route::prefix('depart')->group(function () {
    Route::get('/', 'DepartController@index');//获取部门
    Route::get('{depart}/data/', 'DepartController@depart');//获取部门成员
    Route::get('/user', 'DepartController@depart_user');//获取部门
});

/*简历库*/
Route::prefix('resume')->group(function () {
    Route::get('/', 'ResumeController@index')->name('resume');//简历
    Route::get('all_data/{flag?}', 'ResumeController@all_data');//简历数据
    Route::get('{resume}/show', 'ResumeController@show')->name('resume.show');//查看
    Route::get('{resume}/remark', 'ResumeController@get_remark');//备注
    Route::post('{resume}/remark', 'ResumeController@remark');//备注
    Route::get('blacklist', 'ResumeController@blacklist')->name('resume.black');//黑名单
    Route::get('black_data', 'ResumeController@black_data');//黑名单数据
    Route::get('{resume}/destroy', 'ResumeController@destroy');//删除简历
    Route::get('{resume}/black_in', 'ResumeController@black_in');//加入黑名单
    Route::post('black_in_all', 'ResumeController@black_in_all');//加入黑名单
    Route::get('{resume}/black_out', 'ResumeController@black_out');//移除黑名单
    Route::post('black_out_all', 'ResumeController@black_out_all');//加入黑名单
    Route::get('export', 'ResumeController@export');//导出简历
    Route::post('import', 'ResumeController@import');//导入简历
});

Route::post('appraise/', 'AppraiseController@store');//评价

/*申请单*/
Route::prefix('examine')->group(function () {
    Route::get('/', 'ExamineController@index')->name('examine');//申请单
    Route::get('all_data/{flag?}', 'ExamineController@all_data');//申请单数据
    Route::get('{examine}/show', 'ExamineController@show')->name('examine.show');//查看
    Route::get('{examine}/destroy', 'ExamineController@destroy');//取消
    Route::get('{examine}/complate', 'ExamineController@complate');//完成

    Route::get('sync/{is_manual?}', 'ExamineController@sync');//申请单同步
});

/*面试预约*/
Route::prefix('subscribe')->group(function () {
    Route::get('/', 'SubscribeController@index')->name('subscribe');//面试预约
    Route::get('getCreateView','SubscribeController@get_create_view')->name('subscribe.create');//新增页面
    Route::get('all_data', 'SubscribeController@all_data');//面试预约
    Route::get('create/{examine?}', 'SubscribeController@create');//新增
    Route::post('{examine}/destroy', 'SubscribeController@destroy');//取消
    Route::post('{examine}/store', 'SubscribeController@store');//保存
    Route::get('{subscribe}/show', 'SubscribeController@show');//查看
    Route::get('{subscribe}/edit', 'SubscribeController@edit');//编辑
    Route::post('{subscribe}/update', 'SubscribeController@update');//更新
    Route::get('{subscribe}/copy', 'SubscribeController@copy');//复制
});

/*录取通知*/
Route::prefix('notice')->group(function () {
    Route::get('/', 'NoticeController@index')->name('notice');//录取通知
    Route::get('all_data', 'NoticeController@all_data');//录取数据
    Route::get('{subscribe}/create', 'NoticeController@create')->name('notice.create');//新增
    Route::post('{notice}/update', 'NoticeController@update');//保存
    Route::get('{notice}/show', 'NoticeController@show')->name('notice.show');//查看
    Route::post('{notice}/ship', 'NoticeController@ship');//发送邮件
});

/*人事档案*/
Route::prefix('archive')->group(function () {
    Route::get('/', 'ArchiveController@index')->name('archive');//人事档案主页
    Route::get('on', 'ArchiveController@on')->name('archive.on');//在职员工档案
    Route::get('off', 'ArchiveController@off')->name('archive.off');//离职员工档案

    Route::get('on_data', 'ArchiveController@on_data');//在职员工档案数据
    Route::get('off_data', 'ArchiveController@off_data');//离职员工数据

    Route::get('create/{user}', 'ArchiveController@create')->name('archive.create');//个人新增
    Route::post('store/{archive?}', 'ArchiveController@store');//个人保存

    Route::post('import', 'ArchiveController@import');//导入档案

    Route::get('{archive}/edit', 'ArchiveController@edit')->name('archive.edit');//个人编辑
    Route::get('{archive}/show', 'ArchiveController@show')->name('archive.show');//档案查看

    Route::post('avater/upload', 'ArchiveController@upload')->name('archive.avater.upload');//头像上传
    Route::post('avater/crop', 'ArchiveController@postCrop')->name('archive.avater.crop');//头像裁剪

    Route::get('{archive}/edit_archive', 'ArchiveController@edit_archive')->name('archive.edit_archive');//档案编辑
    Route::post('{archive}/update_archive', 'ArchiveController@update_archive');//档案更新

    Route::get('{archive}/offer_on', 'ArchiveController@offer_on');//转正
    Route::post('{archive}/training', 'ArchiveController@training');//延长试用期

    Route::get('{archive}/reOffer', 'ArchiveController@getReOffer')->name('archive.reOffer');//复职页面
    Route::post('{archive}/reOffer', 'ArchiveController@reOffer');//复职

    Route::get('full', 'ArchiveController@forOnNotice')->name('archive.notice.full');//七天内转正
    Route::get('agree', 'ArchiveController@forAgreementsNotice')->name('archive.notice.agree');//合同续签
    Route::get('birthday', 'ArchiveController@forBirthdayNotice')->name('archive.notice.birthday');//员工生日
    Route::get('year', 'ArchiveController@forYearNotice')->name('archive.notice.year');//周年
    Route::get('family_birthday', 'ArchiveController@forFamiliesBirthdayNotice')->name('archive.notice.family_birthday');//亲属周年

    Route::post('{archive}/offer_off', 'ArchiveController@offer_off');//离职

    Route::get('{warns}/complate', 'ArchiveController@complate');//完成提醒

    /*薪资*/
    Route::prefix('salary')->group(function () {
        Route::get('{archive}/edit', 'SalaryController@edit')->name('salary.edit');//薪资编辑
        Route::post('{archive}/update', 'SalaryController@update');//薪资更新
        Route::post('destory', 'SalaryController@destory');//薪资删除
    });

    /*附件*/
    Route::prefix('clsoure')->group(function () {
        Route::get('{archive}/edit', 'ClsoureController@edit')->name('clsoure.edit');//附件编辑
        Route::post('{archive}/upload', 'ClsoureController@upload')->name('archive.clsoure.upload');//附件上传
        Route::get('{closure}/download', 'ClsoureController@download');//附件下载
        Route::get('{closure}/destory', 'ClsoureController@destory');//附件删除
    });

});

/*管理人*/
Route::prefix('user')->group(function () {
    Route::get('/', 'UserController@index')->name('user');//管理人员信息
    Route::get('all_data', 'UserController@all_data');//管理人员信息
    Route::get('data/{user}/{name?}', 'UserController@data');//管理人员信息
    Route::get('user_lists', 'UserController@user_lists');//管理人员信息
});

/*数据统计*/
Route::prefix('data')->group(function () {
    Route::get('/', 'DataController@index')->name('data');//新入职员工
    Route::get('all_data', 'DataController@all_data');//新入职员工数据
    Route::get('table_all_data', 'DataController@table_all_data');//新入职员工详细数据

    Route::get('off', 'DataController@off')->name('data.off');//离职员工
    Route::get('off_data', 'DataController@off_data');//离职员工数据
    Route::get('table_off_data', 'DataController@table_off_data');//离职员工详细数据

});

/*系统设置*/
Route::prefix('setting')->group(function () {
    Route::get('/', 'SettingController@index')->name('setting');//面试预约审核人
    Route::get('see_all_data/{setting}', 'SettingController@setSeeing');//系统设置

    Route::get('leader', 'SettingController@leader')->name('setting.leader');//通用设置
    Route::post('setting_user', 'SettingController@settingUser');//设置审核人

    Route::get('resume', 'SettingController@resume_setting')->name('setting.resume');//简历访问设置
    Route::post('resume', 'SettingController@store_resume_setting');//简历访问保存

    Route::get('admin', 'SettingController@admin')->name('setting.admin');//简历访问设置
    Route::post('admin', 'SettingController@store_admin');//简历访问保存

    Route::get('notice', 'SettingController@notice_index')->name('setting.notice');//提醒设置
    Route::post('notice', 'SettingController@notice_store');//提醒设置保存

    Route::get('archive', 'SettingController@archive_index')->name('setting.archive');//薪资查看设置
    Route::post('archive', 'SettingController@archive_store');//薪资查看设置保存

    Route::get('sync', 'SettingController@sync')->name('setting.sync');//同步设置
    Route::post('sync', 'SettingController@sync_store');//同步设置保存

    Route::get('user/sync', 'UserController@sync');//同步管理人员信息

    Route::get('sync/salary', 'SettingController@sync_salary');//手动同步薪资
    Route::get('sync/pro', 'SettingController@sync_pro');//手动同步岗位


});

Route::get('receipt', 'ReceiptController@index');//发票抬头


/*手机端*/
Route::group(['namespace' => 'Mobile', 'prefix' => 'mobile'], function () {

    Route::get('/', 'HomeController@index');//首页

    Route::prefix('resume')->group(function () {
        Route::get('/', 'ResumeController@index');//简历
        Route::get('all_data', 'ResumeController@all_data');//简历
        Route::post('search', 'ResumeController@search');//简历
        Route::get('{resume}/show', 'ResumeController@show');//简历详情
    });

    Route::prefix('subscribe')->group(function () {
        Route::get('/', 'SubscribeController@index');//面试预约
        Route::get('tomorrow', 'SubscribeController@tomorrow');//面试预约
        Route::get('week', 'SubscribeController@week');//本周
        Route::get('histroy', 'SubscribeController@histroy');//历史记录
        Route::get('subscribe', 'SubscribeController@index');//面试预约
        Route::get('{subscribe}/show', 'SubscribeController@show');//面试预约
    });

    Route::prefix('appraise')->group(function () {
        Route::get('{subscribe}', 'AppraiseController@index');//评价
        Route::post('{subscribe}', 'AppraiseController@store');//评价
    });

    Route::prefix('notice')->group(function () {
        /*代办提醒*/
        Route::get('full', 'NoticeController@full')->name('mobile.notice.full');//转正
        Route::get('agree', 'NoticeController@agree')->name('mobile.notice.agree');//合同
        Route::get('year', 'NoticeController@year')->name('mobile.notice.year');//周年
        Route::get('birthday', 'NoticeController@birthday')->name('mobile.notice.birthday');//员工生日
        Route::get('families', 'NoticeController@families')->name('mobile.notice.families');//亲属生日

        Route::prefix('history')->group(function () {//历史数据
            Route::get('full', 'NoticeController@history_full');//转正
            Route::get('agree', 'NoticeController@history_agree');//合同
            Route::get('year', 'NoticeController@history_year');//周年
            Route::get('birthday', 'NoticeController@history_birthday');//员工生日
            Route::get('families', 'NoticeController@history_families');//亲属生日

            Route::get('history_full_all', 'NoticeController@history_full_all');//历史数据数据
            Route::get('history_agree_all', 'NoticeController@history_agree_all');//历史数据数据
            Route::get('history_year_all', 'NoticeController@history_year_all');//历史数据数据
            Route::get('history_birthday_all', 'NoticeController@history_birthday_all');//历史数据数据
            Route::get('history_families_all', 'NoticeController@history_families_all');//历史数据数据
        });

        Route::get('{warns}/complate', 'NoticeController@complate');//完成提醒
    });

    Route::prefix('archive')->group(function () {

        Route::get('/', 'ArchiveController@index');//员工管理

        Route::get('{depart}/depart', 'ArchiveController@depart');//员工管理

        Route::get('{depart}/all', 'ArchiveController@all');//本月入职
        Route::get('{depart}/on', 'ArchiveController@on');//本月入职
        Route::get('{depart}/off', 'ArchiveController@off');//本月离职
        Route::get('{depart}/all_off', 'ArchiveController@all_off');//离职员工数据

        Route::get('get_all/{depart_id}', 'ArchiveController@get_all');//在职员工数据
        Route::get('get_on/{depart_id}', 'ArchiveController@get_on');//本月入职数据
        Route::get('get_off/{depart_id}', 'ArchiveController@get_off');//本月离职数据
        Route::get('get_all_off/{depart_id}', 'ArchiveController@get_all_off');//离职员工数据

        Route::get('{depart_id}/search_all', 'ArchiveController@search_all');//在职员工数据搜索
        Route::get('{depart_id}/search_on', 'ArchiveController@search_on');//本月入职数据搜索
        Route::get('{depart_id}/search_off', 'ArchiveController@search_off');//本月离职数据搜索
        Route::get('{depart_id}/search_all_off', 'ArchiveController@search_all_off');//离职员工数据

        Route::get('search_all_data/{depart_id}', 'ArchiveController@search_all_data');//在职员工数据搜索
        Route::get('search_on_data/{depart_id}', 'ArchiveController@search_on_data');//本月入职数据搜索
        Route::get('search_off_data/{depart_id}', 'ArchiveController@search_off_data');//本月离职数据搜索
        Route::get('search_all_off_data/{depart_id}', 'ArchiveController@search_all_off_data');//离职员工数据

        Route::get('{archive}/show', 'ArchiveController@show');//员工详情
        Route::get('me', 'ArchiveController@me');//员工详情
    });

});

//企业微信接受消息验证
Route::any('verify', 'VerifyController@verify');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');



