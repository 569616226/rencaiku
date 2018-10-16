<?php

namespace App\Http\Controllers\Mobile;

use App\Helpers\Functions;
use App\Http\Controllers\BaseController;
use App\Models\Archive;
use App\Models\Family;
use App\Models\Warns;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoticeController extends BaseController
{

    /**
     * CustomerController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function full()
    {

        $local_user = Functions::getLoginUser();
        if (in_array($local_user->user_wechat_id, config('system.admin_user'))) {
            return view('mobile.notice.full');
        } else {
//            print ('您没有权限使用该应用！！！');
            return view('auth.index');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function agree()
    {
        return view('mobile.notice.agree');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function year()
    {
        return view('mobile.notice.year');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function birthday()
    {
        return view('mobile.notice.birthday');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function families()
    {
        return view('mobile.notice.families');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function history_full()
    {
        return view('mobile.notice.history.full');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function history_agree()
    {
        return view('mobile.notice.history.agree');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function history_year()
    {
        return view('mobile.notice.history.year');
    }

    /**
     * 提醒完成
     * @param Warns $warns
     * @return \Illuminate\Http\JsonResponse
     */
    public static function complate(Warns $warns)
    {
        try {

            $warns->update(['status' => 1]);

            $user = Functions::getLoginUser();
            $count = Warns::where('type', $warns->type)->where('status', 0)->get()->filter(function ($query) use ($user) {
                return in_array($user->id, $query->warnor);
            })->count();

            return response()->json(['status' => true, 'msg' => '操作成功', 'count' => $count]);

        } catch (\Exception $exception) {

            report($exception);

            return response()->json(['status' => false, 'msg' => '操作失败']);
        }
    }


    /**
     * 历史数据
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function history_full_all()
    {
        $last = request('last');
        $amount = request('amount');

        return \App\Http\Resources\MobileWarn::collection($this->get_datas(1, $last, $amount));
    }


    /**
     * 历史数据
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function history_agree_all()
    {
        $last = request('last');
        $amount = request('amount');

        return \App\Http\Resources\MobileWarn::collection($this->get_datas(3, $last, $amount));
    }


    /**
     * 历史数据
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function history_year_all()
    {
        $last = request('last');
        $amount = request('amount');

        return \App\Http\Resources\MobileWarn::collection($this->get_datas(2, $last, $amount));
    }


    /**
     * 手机员工生日数据
     * 历史数据
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function history_birthday_all()
    {
        $last = request('last');
        $amount = request('amount');

        $archives = Archive::whereIn('offer_status', [1, 2, 3])->get();

        if (today()->month >= 1 && today()->month <= 3) {
            $array_months = [1, 2, 3];
        } elseif (today()->month >= 4 && today()->month <= 6) {
            $array_months = [4, 5, 6];
        } elseif (today()->month >= 7 && today()->month <= 9) {
            $array_months = [7, 8, 9];
        } else {
            $array_months = [10, 11, 12];
        }

        $archive_quarters = array_values($archives->filter(function ($item) use ($array_months) {
            return in_array($item->birthday->month, $array_months);
        })->forPage($last/$amount + 1,$amount)->all());

        return \App\Http\Resources\MobileBirthday::collection(collect($archive_quarters));
    }


    /**
     *
     * 手机家属生日数据
     * 历史数据
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function history_families_all()
    {
        $last = request('last');
        $amount = request('amount');

        $archives = Archive::whereIn('offer_status', [1, 2, 3])->get();

        if (today()->month >= 1 && today()->month <= 3) {
            $array_months = [1, 2, 3];
        } elseif (today()->month >= 4 && today()->month <= 6) {
            $array_months = [4, 5, 6];
        } elseif (today()->month >= 7 && today()->month <= 9) {
            $array_months = [7, 8, 9];
        } else {
            $array_months = [10, 11, 12];
        }

        $families_data = Family::whereIn('archive_id', $archives->pluck('id')->toArray())->get();
        $families = array_values($families_data->filter(function ($item) use ($array_months) {
            return in_array($item->birthday->month, $array_months);
        })->forPage($last/$amount + 1,$amount)->all());

        return \App\Http\Resources\MobileWarnBirthday::collection(collect($families));
    }

    /**
     * 获取数据
     * @param $col
     * @param null $type
     * @return mixed
     */
    public function get_datas($col, $last, $amount)
    {
        if($col == 4 || $col == 5){
            $warns = Warns::whereType($col)->offset($last)->limit($amount)->get();
        }else{
            $warns = Warns::whereStatus(1)->whereType($col)->offset($last)->limit($amount)->get();
        }

        return $warns;
    }


}
