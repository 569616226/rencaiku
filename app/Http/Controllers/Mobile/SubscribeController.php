<?php

namespace App\Http\Controllers\Mobile;

use App\Helpers\Functions;
use App\Http\Controllers\BaseController;
use App\Models\Depart;
use App\Models\Subscribe;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribeController extends BaseController
{



    /**
     * DepartController constructor.
     */
    public function __construct()
    {

        parent::__construct();

    }

    /*首页*/
    public function index()
    {
        $today = $this->getData('today')->count();
        $tomorrow = $this->getData('tomorrow')->count();
        $week = $this->getData('week')->count();
        $subscribes = $this->getData('today');

        /*到时间改变状态*/
        foreach ($subscribes as $subscribe) {
            /*到时间改变状态*/
            Functions::changeStatus($subscribe);
        }

        $local_user = Functions::getLoginUser();
        if( in_array($local_user->user_wechat_id, config('system.admin_user')) || $local_user->is_admin == 1 ){
            return view('mobile.subscribe.index')->with(['today' => $today,'tomorrow' => $tomorrow,'week' => $week,'flag' => 'today','subscribes'=> $subscribes]);
        }else{
            return view('auth.index');
        }

    }

    /*明天*/
    public function tomorrow()
    {

        $today = $this->getData('today')->count();
        $tomorrow = $this->getData('tomorrow')->count();
        $week = $this->getData('week')->count();
        $subscribes = $this->getData('tomorrow');

        return view('mobile.subscribe.index')->with(['today' => $today,'tomorrow' => $tomorrow,'week' => $week,'flag' => 'tomorrow','subscribes'=> $subscribes]);
    }

    /*本周*/
    public function week()
    {

        $today = $this->getData('today')->count();
        $tomorrow = $this->getData('tomorrow')->count();
        $week = $this->getData('week')->count();
        $subscribes = $this->getData('week');

        return view('mobile.subscribe.index')->with(['today' => $today,'tomorrow' => $tomorrow,'week' => $week,'flag' => 'week','subscribes'=> $subscribes]);
    }

    /*历史记录*/
    public function histroy()
    {
        $subscribes = $this->getData('histroy');

        $local_user = Functions::getLoginUser();
        if( in_array($local_user->user_wechat_id, config('system.admin_user')) || $local_user->is_admin == 1 ){
            return view('mobile.subscribe.histroy', compact('subscribes'));
        }else{
            return view('auth.index');
        }

    }

    /*获取预约数据*/
    public function getData($type)
    {
        $user = Functions::getLoginUser();
        $filtered = Subscribe::recent()->get()->filter(function ($item) use ($type,$user) {

            $depart_names = $user->departs->pluck('name')->toArray();
            if (in_array($user->id, $item->users->pluck('id')->toArray()) || Functions::seeData($user) ) {

                if ( $type == 'today' ) {
                    return $item->offer_date->toDateString() === today()->toDateString() && in_array($item->status,[1,2]);
                } elseif($type == 'tomorrow') {
                    return $item->offer_date->toDateString() === today()->addDay()->toDateString() && in_array($item->status,[1,2]);
                } elseif($type == 'week') {
                    return  today()->diffInWeeks($item->offer_date) <= 1 && in_array($item->status,[1,2]);
                } elseif($type == 'histroy') {
                    return  today()->diffInWeeks($item->offer_date) > 1;
                }

            }elseif( in_array($item->examines->depart,$depart_names) ){//查看部门的预约数据
                if ( $type == 'today' ) {
                    return $item->offer_date->toDateString() === today()->toDateString() && in_array($item->status,[1,2]);
                } elseif($type == 'tomorrow') {
                    return $item->offer_date->toDateString() === today()->addDay()->toDateString() && in_array($item->status,[1,2]);
                } elseif($type == 'week') {
                    return  today()->diffInWeeks($item->offer_date) <= 1 && in_array($item->status,[1,2]);
                } elseif($type == 'histroy') {
                    return  today()->diffInWeeks($item->offer_date) > 1;
                }
            }
        });

        return $filtered;
    }

    /*查看*/
    public function show($id)
    {
        $subscribe = Subscribe::with(['appraises.users', 'examines', 'users'])->where('id', $id)->first();

        /*到时间改变状态*/
        Functions::changeStatus($subscribe);

        $users = Functions::get_user_data($subscribe);/*审核人*/

        $resume = Functions::rebulid_resume($subscribe->resumes);

        $is_appraise = Functions::is_appraise($subscribe, $users);

        $user_last = User::where('last', 1)->first();/*面试官*/

        return view('mobile.subscribe.show', compact('subscribe', 'resume', 'users', 'user_last', 'is_appraise'));
    }
}
