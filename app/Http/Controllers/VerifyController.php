<?php

namespace App\Http\Controllers;

use App\Verify\lib\MsgCrypt;

use Illuminate\Http\Request;
use Log;

class VerifyController extends Controller
{

    /**
     * 企业微信接受消息验证
     *
     * @param Request $request
     */
    public function verify(Request $request)
    {
        /*人才库设置*/
        $appConfigs = config('resume');

        //TODO:填写需要验证的应用配置信息
        $token = $appConfigs['AppsConfig']['resume']['Token'];
        $corpId = $appConfigs['CorpId'];
        $encodingAesKey = $appConfigs['AppsConfig']['resume']['EncodingAESKey'];

        /*
         * 企业开启接收消息模式时，企业号会向验证url发送一个get请求
         * 此逻辑需要先开通接收消息模式并将代码部署到服务器后进行验证
        */
//        $sVerifyMsgSig = urldecode($request->get("msg_signature"));
//        $sVerifyTimeStamp = urldecode($request->get("timestamp"));
//        $sVerifyNonce = urldecode($request->get("nonce"));
//        $sVerifyEchoStr = urldecode($request->get("echostr"));


        $sVerifyMsgSig = $request->get("msg_signature");
        $sVerifyTimeStamp = $request->get("timestamp");
        $sVerifyNonce = $request->get("nonce");
        $sVerifyEchoStr = $request->get("echostr");

        try {

            // 需要返回的明文
            $sEchoStr = "";

            $wxcpt = new MsgCrypt($token, $encodingAesKey, $corpId);
            $errCode = $wxcpt->VerifyURL($sVerifyMsgSig, $sVerifyTimeStamp, $sVerifyNonce, $sVerifyEchoStr, $sEchoStr);

            if ($errCode == 0) {

                // 验证URL成功，将sEchoStr返回
                echo $sEchoStr;
                exit(0);

            } else {

                Log::info($errCode);

            }

        } catch (\Exception $exception) {

            report($exception);

        }

    }
}
