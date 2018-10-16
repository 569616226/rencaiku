<?php

namespace App\Http\Controllers\Mobile;

use App\Helpers\Functions;
use App\Models\Appraise;
use App\Models\Subscribe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\BaseController;

class AppraiseController extends BaseController
{

    /**
     * DepartController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*评价*/
    public function index($subscribe_id)
    {
        $subscribe = Subscribe::find($subscribe_id);
        $users = Functions::get_user_data($subscribe);/*审核人*/

        $is_appraise = Functions::is_appraise($subscribe, $users);

        return view('mobile.appraise.index', compact('subscribe_id', 'is_appraise'));
    }

    /*评价简历*/
    public function store(Request $request, $subscribe_id)
    {
        $status = $request->get('optionsRadiosinline');
        $content = $request->get('content');


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

                $subscribe->result = 2;

            } else {

                $subscribe->result = 1;

            }

            $subscribe->update();
        }

        if ($is_create) {

            return redirect(url('/mobile/subscribe/' . $subscribe_id . '/show'));

        } else {

            $error_msg = '操作失败';
            return view('mobile.appraise.index', compact('subscribe_id', 'error_msg'));

        }
    }
}
