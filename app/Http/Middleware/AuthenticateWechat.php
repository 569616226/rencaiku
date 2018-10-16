<?php

namespace App\Http\Middleware;

use App\Helpers\Functions;
use Closure;


class AuthenticateWechat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //TODO:填写需要验证的应用配置信息
        $agentid = env('QY_WECHAT_AGENT_ID',"1000013");
        $corpId = env('QY_WECHAT_CORP_ID',"wwf82e897ad9dc4859");
        $url = urlencode(config('system.wechat_http') . '/auth');
        $state = $this->MathRand();

        $login_flag = $request->cookie('userid');

        if (!$login_flag) {
            if (Functions::wp_is_mobile()) {
                return redirect('https://open.weixin.qq.com/connect/oauth2/authorize?appid='
                    . $corpId . '&redirect_uri=' . $url . '&response_type=code&scope=snsapi_privateinfo&agentid=' . $agentid . '&state=' . $state . '#wechat_redirect');
            } else {
                return redirect(route('login'));
            }
        }

        return $next($request);
    }

    /*6位随机数*/
    function MathRand()
    {
        $Num = ":web_login";

        for ($i = 0; $i < 6; $i++) {
            $Num .= floor(rand(0, 10));
        }

        return $Num;
    }

}
