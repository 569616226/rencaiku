<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /*企业微信扫码登陆*/
    public function login()
    {
        return view('resume.login');

    }

    /*退出登录*/
    public function logout()
    {
        $cookie = Cookie::forget('userid');

        return redirect(url('/'))->withCookie($cookie);
    }

    /*验证*/
    public function auth(Request $request)
    {
        /*获取CODE*/
        $code = $request->get('code');
        $state = $request->get('state');
        $userids = User::all()->pluck('user_wechat_id')->toArray();

        /*登陆用户*/
        $user = Functions::getUser($code);
        $userid = $user['UserId'];

        if (in_array($userid, $userids)) {
            if (Functions::wp_is_mobile()) {
                return redirect(url('/mobile'))->withCookie(Cookie::make('userid', $userid . $state, '240'));
            } else {
                if( in_array( $userid, config('system.admin_user')) ){
                    return redirect(url('/'))->withCookie(Cookie::make('userid', $userid . $state, '240'));
                }else{
                    return view('auth.index');
                }
            }

        } else {
            return view('auth.index');
        }
    }
}