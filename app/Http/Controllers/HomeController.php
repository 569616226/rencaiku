<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\Models\Depart;
use App\Models\Examine;
use App\Models\Resume;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class HomeController extends BaseController
{

    /**
     * CustomerController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*
     * 项目首页
     * */
    public function index()
    {

        $user = Functions::getLoginUser();
        $subscribes = 0;
        $examin_ings = 0;
        $examin_complates = 0;

        if (Functions::seeData($user)) {
            /*进行中的人员增补单*/
            $examin_ings = Examine::where('status', 2)->get()->count();
            /*已完成的人员增补单*/
            $examin_complates = Examine::where('status', 3)->get()->count();
            /*待开始的面试预约*/
            $subscribes = Subscribe::where('status', 1)->get()->count();
        } else {
            $depart_names = $user->departs->pluck('name')->toArray();
            /*进行中的人员增补单*/
            $examines = Examine::where('status', 2);

                $examin_ings = $examines->whereIn('depart', $depart_names)->orWhere('apply_user_id', $user->user_wechat_id)->get()->count();
                /*已完成的人员增补单*/
                $examin_complates = $examines->whereIn('depart', $depart_names)->orWhere('apply_user_id', $user->user_wechat_id)->get()->count();
                /*待开始的面试预约*/
                $subscribes = Subscribe::where('status', 1)->get();
                $subscribes = $subscribes->filter(function ($item) use ($user, $depart_names) {
                    return in_array( $item->examines->depart,$depart_names) || $item->examines->apply_user_id == $user->user_wechat_id;
                });

                $subscribes = $subscribes->count();
            }


        /*人才库*/
        $user = Functions::getLoginUser();
        if (Functions::seeData($user)) {
            $resumes = Resume::where('blacklist', 0)->get()->count();
        } else {
            $resumes = Resume::where('blacklist', 0)->get();
            $resumes = Functions::get_resumes($resumes, $user)->count();
        }

        if (Functions::wp_is_mobile()) {
            return redirect(url('/mobile'));
        } else {
            return view('home.index', compact('examin_complates', 'examin_ings', 'resumes', 'subscribes'));
        }
    }
}
