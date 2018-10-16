<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\Models\Appraise;
use App\Models\Notice;
use App\Models\Subscribe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AppraiseController extends BaseController
{

    /**
     * DepartController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*评价简历*/
    public function store(Request $request)
    {
        $status = $request->get('status');
        $content = $request->get('content');
        $subscribe_id = $request->get('subscribe_id');

        $user = Functions::getLoginUser();

        $appraise = new Appraise();
        $appraise->status = $status;
        $appraise->user_id = $user->id;
        $appraise->subscribe_id = $subscribe_id;
        $appraise->content = $content;
        $appraise->save();

        $is_create = Functions::isCreate(Appraise::all(), $appraise->id);

        if ( $user->last ) {

            $subscribe = Subscribe::find($subscribe_id);
            $subscribe->status = 3;

            if ($status == 1) {

                $subscribe->result = 2;//面试完成

            } else {

                $subscribe->result = 1;

            }

            $subscribe->update();

            /*完成的自动生成录取通知管理*/
            if($subscribe->result == 2 && !$subscribe->notice){

                Notice::create([
                    'subscribe_id' => $subscribe->id
                ]);

            }
        }

        return response()->json($is_create ? ['status' => 1, 'msg' => '操作成功'] : ['status' => 0, 'msg' => '操作失败']);
    }
}
