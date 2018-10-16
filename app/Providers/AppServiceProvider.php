<?php

namespace App\Providers;

use App\Helpers\Functions;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Liebig\Cron\Facades\Cron;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer(
            ['mobile.notice.families','archive.notice.birthday','archive.notice.year',
                'archive.notice.on','archive.notice.familiesBirthday','archive.notice.agreements',
                'archive.index','home.index','mobile.notice.full','mobile.notice.agree',
                'mobile.notice.year','mobile.notice.birthday','mobile.notice.birthday'],
                'App\Http\ViewComposers\ArchiveViewComposer');

        View::composer(
            ['mobile.archive.all','mobile.archive.off','mobile.archive.all_off','mobile.archive.on','mobile.archive.search.on',
                'mobile.archive.search.all','mobile.archive.search.off','mobile.archive.search.all_off','archive.edit.archive','archive.reOffer'
                ,'mobile.archive.selcet_depart'],
            'App\Http\ViewComposers\Mobile\ArchiveViewComposer');


        //定时任务 提醒任务
        \Event::listen('cron.collectJobs', function() {
           Cron::setDisablePreventOverlapping();
            Cron::setLaravelLogging( false );
            Cron::setLogOnlyErrorJobsToDatabase( true );//只记录错误日志
            Cron::add('notice_message', '30 9 * * * *', function () {//每天早上9点半触发
                Functions::notice_full_message();//人员转正
                Functions::notice_agree_message();//合同续签
                Functions::notice_year_message();//员工周年
                Functions::notice_birthday_message();//员工生日

                if(Setting::findOrFail(1)->sync){
                    Functions::syncSalaryData();//薪资同步
                    Functions::syncWorkData();//岗位同步
                }

            });

            Cron::add('birthday_message',  '30 9 * * 1,3 *', function () {//每周一到周三早上9点30
                Functions::notice_families_message();//亲属生日
            });
        });

        Cron::run();
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
