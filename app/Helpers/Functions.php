<?php

namespace App\Helpers;

use App\Models\Archive;
use App\Models\ArchiveLog;
use App\Models\Depart;
use App\Models\Family;
use App\Models\Notice;
use App\Models\Promotion;
use App\Models\Salary;
use App\Models\Setting;
use App\Models\Subscribe;
use App\Models\Warns;
use App\User;
use App\Verify\lib\helper;
use App\Verify\lib\Lunar;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Overtrue\ChineseCalendar\Calendar;

class Functions
{

    /**
     *
     * 获取企业微信数据
     * @return bool|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public static function getAccessToken()
    {
        $appConfigs = config('resume');

        //TODO:填写需要验证的应用配置信息
        $corpsecret = $appConfigs['AppsConfig']['resume']['Secret'];
        $corpId = $appConfigs['CorpId'];

        $access_token = Session::get('access_token_expires');
        if (!Session::has('access_token_expires')) {
            $reslut = helper::http_get('https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=' . $corpId . '&corpsecret=' . $corpsecret);

            if (array_key_exists('http_code', $reslut) && $reslut['http_code'] == 200) {
                $access_token = Session('access_token_expires', json_decode($reslut['content'], true)['access_token']);
            } else {
                return false;
            }
        }

        return $access_token;
    }


    /**
     *
     * 获取企业微信通讯录AccessToken
     * @return bool|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public static function getDepartAccessToken()
    {
        /*人才库设置*/
        $appConfigs = config('resume');

        //TODO:填写需要验证的应用配置信息
        $corpsecret = config('resume')['AppsConfig']['depart']['Secret'];
        $corpId = $appConfigs['CorpId'];
        $access_token = Session::get('depart_access_token_expires');

        if (!Session::has('depart_access_token_expires')) {
            $reslut = helper::http_get('https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=' . $corpId . '&corpsecret=' . $corpsecret);
            if (array_key_exists('http_code', $reslut) && $reslut['http_code'] == 200) {
                $access_token = Session('access_token_expires', json_decode($reslut['content'], true)['access_token']);
            } else {
                return false;
            }
        }

        return $access_token;
    }


    /**
     *
     * 获取部门
     * @return bool
     */
    public static function getDeparts()
    {

        $access_token = self::getDepartAccessToken();

        if (!$access_token) {
            return false;
        }

        $reslut = helper::http_get('https://qyapi.weixin.qq.com/cgi-bin/department/list?access_token=' . $access_token);

        if (array_key_exists('http_code', $reslut) && $reslut['http_code'] == 200) {
            $content = json_decode($reslut['content'], true);
            return $content['department'];
        } else {
            return false;
        }

    }


    /**
     *
     * 获取企业微信审批AccessToken
     * @return bool|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    public static function getExamineAccessToken()
    {
        /*人才库设置*/
        $appConfigs = config('resume');

        //TODO:填写需要验证的应用配置信息
        $corpsecret = $appConfigs['AppsConfig']['examine']['Secret'];
        $corpId = $appConfigs['CorpId'];

        $access_token = Session::get('examine_access_token_expires');

        if (!Session::has('examine_access_token_expires')) {

            $reslut = helper::http_get('https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=' . $corpId . '&corpsecret=' . $corpsecret);

            if (array_key_exists('http_code', $reslut) && $reslut['http_code'] == 200) {
                $access_token = Session('access_token_expires', json_decode($reslut['content'], true)['access_token']);
            } else {
                return false;
            }
        }

        return $access_token;
    }


    /**
     *
     * 获取部门成员
     * @param $department_id
     * @return bool
     */
    public static function getDepartmentUser($department_id)
    {
        $access_token = self::getDepartAccessToken();

        if (!$access_token) {
            return false;
        }

        $reslut = helper::http_get('https://qyapi.weixin.qq.com/cgi-bin/user/list?access_token=' . $access_token . '&department_id=' . $department_id . '&fetch_child=0');

        if (array_key_exists('http_code', $reslut) && $reslut['http_code'] == 200) {
            $content = json_decode($reslut['content'], true);
            return $content['userlist'];
        } else {
            return false;
        }

    }

    /*删除企业成员*/
    /**
     * @param $wechat_user_id
     * @return bool
     */
    public static function delWechatUser($wechat_user_id)
    {
        $access_token = self::getAccessToken();

        if (!$access_token) {
            return false;
        }

        $reslut = helper::http_get('https://qyapi.weixin.qq.com/cgi-bin/user/delete?access_token=' . $access_token . '&userid=' . $wechat_user_id);

        if (array_key_exists('http_code', $reslut) && $reslut['errcode'] == 0) {
            return true;
        } else {
            return false;
        }
    }


    /**
     *
     * 获取企业微信用户数据
     * @param $code
     * @return bool|mixed
     */
    public static function getUser($code)
    {
        $access_token = self::getAccessToken();

        if (!$access_token) {
            return false;
        }

        $reslut = helper::http_get('https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=' . $access_token . '&code=' . $code);

        if (array_key_exists('http_code', $reslut) && $reslut['http_code'] == 200) {
            return json_decode($reslut['content'], true);
        } else {
            return false;
        }
    }


    /**
     *
     * 获取企业微信用户数据详情
     * @param $userid
     * @return bool|mixed
     */
    public static function getUserData($userid)
    {
        $access_token = self::getAccessToken();

        $reslut = helper::http_get('https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token=' . $access_token . '&userid=' . $userid);

        if (array_key_exists('http_code', $reslut) && $reslut['http_code'] == 200) {

            return json_decode($reslut['content'], true);
        } else {
            return false;
        }
    }


    /**
     *
     * 获取人员增补单数据，审批数据
     * @param $last_time
     * @return bool|mixed
     */
    public static function getExamine($last_time)
    {
        $access_token = self::getExamineAccessToken();

        if (!$access_token) {
            return false;
        }

        $reslut = helper::http_post('https://qyapi.weixin.qq.com/cgi-bin/corp/getapprovaldata?access_token=' . $access_token, array(
//           'starttime' => Carbon::now()->timestamp-2678400,//一个月时间戳
'starttime' => $last_time,//上次同步时间
'endtime'   => Carbon::now()->timestamp
        ));

        if (array_key_exists('http_code', $reslut) && $reslut['http_code'] == 200) {
            return json_decode($reslut['content'], true);
        } else {
            return false;
        }

    }

    /*同步薪资审请数据*/
    /**
     *
     */
    public static function syncSalaryData()
    {

//        Cache::flush();//清除缓存

        $last_time = Cache::get('sync_salary_time');/*最新更新*/

        if (!$last_time) {

            $last_time = 1498838400;/*2017-7-1 00：00：00*/

        }

        $salary_data = self::getExamine($last_time);
        $salary_wechats = array_filter($salary_data['data'], function ($data) {

            $is_empty = Salary::where('sp_num', $data['sp_num'])->get()->isEmpty();

            if ($data['spname'] == '员工薪资调整' && $data['sp_status'] == 2 && $is_empty) {

                return $data;
            }

        });

        foreach ($salary_wechats as $salary_wechat) {
            /*申请单内容*/
            $comms = json_decode($salary_wechat['comm']['apply_data'], true);

            $status_type = [
                '入职' => 0,
                '转正' => 1,
                '加薪' => 2,
                '减薪' => 3,
            ];

            foreach ($comms as $comm) {
                if ($comm['title'] == '姓名') {
                    $name = $comm['value'];
                }

                if ($comm['title'] == '调薪类别') {
                    $status = $comm['value'][0];
                }

                if ($comm['title'] == '调整后工资') {
                    $basic = $comm['value'];
                }

                if ($comm['title'] == '调整后绩效') {
                    $added = (int)$comm['value'];
                }

                if ($comm['title'] == '调薪理由') {
                    $remark = $comm['value'];
                }

                if ($comm['title'] == '生效时间') {
                    $start_at = $comm['value'];
                }
            }

            try {

                $archive = Archive::where('name', $name)->get()->first();
                $archive_id = optional($archive)->id;

                if ($archive_id) {

                    /*同步申请单*/
                    $salary = [
                        'status'     => $status_type[$status],
                        'sp_num'     => (int)$salary_wechat['sp_num'],
                        'basic'      => $basic,
                        'added'      => $added,
                        'total'      => $basic + $added,
                        'start_at'   => Carbon::createFromTimestamp(substr($start_at, 0, 10)),//转换时间
                        'remark'     => $remark,
                        'archive_id' => $archive_id,
                        'created_at' => now()
                    ];

                    Salary::create($salary);
                }

                Cache::forever('sync_salary_time', now()->timestamp);/*最新更新*/
                Cache::forever('sync_salary_date', now()->toDateTimeString());/*最新更新*/

                self::create_salary_log($salary, $archive);

            } catch (\Exception $e) {
                report($e);
            }
        }

    }


    /*同步岗位调整数据*/
    /**
     *
     */
    public static function syncWorkData()
    {

        $last_time = Cache::get('sync_work_time');/*最新更新*/

        if (!$last_time) {

            $last_time = 1498838400;/*2017-7-1 00：00：00*/

        }

        $pro_data = self::getExamine($last_time);
        $pro_wechats = array_filter($pro_data['data'], function ($data) {

            $is_empty = Promotion::where('sp_num', $data['sp_num'])->get()->isEmpty();

            if ($data['spname'] == '岗位调整' && $data['sp_status'] == 2 && $is_empty) {

                return $data;
            }

        });

        foreach ($pro_wechats as $pro_wechat) {
            /*申请单内容*/
            $comms = json_decode($pro_wechat['comm']['apply_data'], true);
//            dd($comms);

            foreach ($comms as $comm) {
                if ($comm['title'] == '姓名') {
                    $name = $comm['value'];
                }

                if ($comm['title'] == '调整类型') {
                    $status = $comm['value'][0];
                }

                if ($comm['title'] == '职位名称') {
                    $new_offer = $comm['value'];
                }

                if ($comm['title'] == '调整后部门') {
                    $new_depart = $comm['value'];
                }

                if ($comm['title'] == '备注') {
                    $remark = $comm['value'];
                }

                if ($comm['title'] == '生效时间') {
                    $start_at = $comm['value'];
                }
            }

            $status_type = [
                '升职' => 0,
                '降职' => 1,
                '调岗' => 2,
                '复职' => 3,
                '入职' => 4,
            ];

            try {

                $archive = Archive::where('name', $name)->get()->first();
                $archive_id = optional($archive)->id;

                if ($new_depart) {
                    $archive_pro_deprt = $new_depart;
                } else {
                    $archive_pro_deprt = optional($archive->promotions->first())->new_depart;
                }

                if ($archive_id) {

                    /*同步申请单*/
                    $promotion = [
                        'type'       => $status_type[$status],
                        'sp_num'     => $pro_wechat['sp_num'],
                        'new_offer'  => $new_offer,
                        'new_depart' => $archive_pro_deprt,
                        'chang_at'   => Carbon::createFromTimestamp(substr($start_at, 0, 10)),//转换时间
                        'remark'     => $remark,
                        'archive_id' => $archive_id,
                        'created_at' => now()
                    ];


                }

                Promotion::create($promotion);

                $archive->update(['offer_name' => $new_offer]);//更新档案岗位
                $depart_ids = Depart::whereIn('name', [$archive_pro_deprt])->get()->pluck('id')->toArray();
                $archive->user->departs()->sync($depart_ids);//更新成员部门

                self::create_pro_log($promotion, $archive);

                Cache::forever('sync_work_time', now()->timestamp);/*最新更新*/
                Cache::forever('sync_work_date', now()->toDateTimeString());/*最新更新*/

            } catch (\Exception $e) {
                report($e);
            }
        }

    }


    /**
     * 获取应用数据
     * @return bool|mixed
     */
    public static function getApp()
    {
        $access_token = self::getAccessToken();

        if (!$access_token) {
            return false;
        }

        $appConfigs = config('resume');
        $agentid = $appConfigs['AppsConfig']['resume']['AgentId'];

        $reslut = helper::http_get('https://qyapi.weixin.qq.com/cgi-bin/agent/get?access_token=' . $access_token . '&agentid=' . $agentid);

        if (array_key_exists('http_code', $reslut) && $reslut['http_code'] == 200) {
            return json_decode($reslut['content'], true);
        } else {
            return false;
        }
    }


    /**
     * 判断数据更新
     * @param $updated_at
     * @return bool
     */
    public static function isUpdate($updated_at)
    {
        $update = $updated_at->timestamp;
        $now = Carbon::now()->timestamp;

        if (!$update && $update < $now) {
            return false;
        } else {
            return true;
        }
    }


    /**
     *
     * 判断数据新增
     * @param $objs
     * @param $id
     * @return bool
     */
    public static function isCreate($objs, $id)
    {
        /*判断是否新增成功*/
        $ids = self::getIds($objs);
        $isSave = in_array($id, $ids);

        return $isSave;
    }


    /**
     * 获取id集合
     * @param $objs
     * @return mixed
     */
    public static function getIds($objs)
    {
        $Ids = $objs->pluck('id')->toArray();

        return $Ids;
    }


    /**
     * 判断手机设备
     * @return bool|null
     */
    public static function wp_is_mobile()
    {
        static $is_mobile = null;

        if (isset($is_mobile)) {
            return $is_mobile;
        }

        if (empty($_SERVER['HTTP_USER_AGENT'])) {
            $is_mobile = false;
        } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false) {
            $is_mobile = true;
        } else {
            $is_mobile = false;
        }

        return $is_mobile;
    }

    /**
     *
     * 发送消息
     * @param $userids
     * @param $id
     * @return bool
     */
    public static function sendMessages($userids, $id)
    {

        $appConfigs = config('resume');
        $agentid = $appConfigs['AppsConfig']['resume']['AgentId'];

        $subscribe = Subscribe::find($id);
        if ($subscribe->resumes->origin_id == 0) {
            $orgin_id = '智通';
        } elseif ($subscribe->resumes->origin_id == 1) {
            $orgin_id = '卓博';
        } elseif ($subscribe->resumes->origin_id == 2) {
            $orgin_id = '内部推荐';
        } else {
            $orgin_id = '人才市场';
        }

        $message = "<div class='gray'>职位：" . $subscribe->examines->position . "</div><div class='gray'>时间：" . $subscribe->offer_date->toDateTimeString() . "</div><div class='gray'>地点："
            . $subscribe->address . "</div><div class='gray'>来源：" . $orgin_id . "</div><div class='gray'>备注：" . $subscribe->remark . "</div>";

        $wechat_userid = '';
        foreach ($userids as $userid) {
            $wechat_userid .= User::find($userid)->user_wechat_id . '|';
        }

        $wechat_userid .= User::where('last', 1)->first()->user_wechat_id;//面试管

        $array = [
            'touser'   => $wechat_userid,
            'msgtype'  => 'textcard',
            'agentid'  => $agentid,
            'textcard' => [
                'title'       => '你有一个新的面试！！',
                'description' => $message,
                'url'         => url('subscribe/' . $id . '/show')
            ]
        ];

        return self::send_wechat_messages($array);
    }

    /**
     * 企业微信发送信息
     * @param $array
     * @return bool
     */
    protected static function send_wechat_messages($array)
    {
        $access_token = self::getAccessToken();

        if (!$access_token) {
            return false;
        }

        try {

            $reslut = helper::http_post('https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token=' . $access_token, $array);

            if (array_key_exists('http_code', $reslut) && $reslut['http_code'] == 200) {

                Log::info('企业微信发送成功', $array);
                return true;

            } else {

                Log::info('企业微信发送失败');
                return false;
            }

        } catch (\Exception $exception) {

            report($exception);

            Log::info('企业微信发送失败');

            return false;

        }

    }


    /**
     * 获取登陆用户
     * @return mixed
     */
    public static function getLoginUser()
    {
        if (env('ENABLE_MOCK')) {
            $userid = env('MOCK_USER_USER_ID');
        } else {
            $userid = explode(':', Cookie::get('userid'))[0];
        }

        $user = User::where('user_wechat_id', $userid);

        if ($user->get()->isEmpty()) {
            return view('auth.index');
        } else {
            return $user->first();
        }

    }

    /**
     * 判断能不能评论
     *
     * @param $subscribe
     * @param $users
     * @return bool
     */
    public static function is_appraise($subscribe, $users)
    {
        $login_user = self::getLoginUser();/*登陆用户*/
        $user_all_ids = self::get_user_id($users);/*本地所有用户*/

        $is_appraise = false;
        /*评论按顺序评论，只能评论一次*/
        if (in_array($login_user->id, $user_all_ids) && $login_user->appraises()->where('subscribe_id', $subscribe->id)->get()->isEmpty()) {
            foreach ($users as $key => $user) {
                if ($login_user->id == $user->id) {
                    if ($key == 1) {
                        $is_appraise = true;
                    } elseif ($users[$key - 1]->appraises()->where('subscribe_id', $subscribe->id)->get()->isEmpty()) {
                        $is_appraise = false;
                    } else {
                        $is_appraise = true;
                    }
                }
            }
            /*最确定人为张志*/
        } elseif ($login_user->last == 1 && $subscribe->appraises()->get()->count() == count($users) && $login_user->appraises()->where('subscribe_id', $subscribe->id)->get()->isEmpty()) {
            $is_appraise = true;

        } else {
            $is_appraise = false;
        }

        /*只有进行中的才能评价*/
        if ($subscribe->status == 1 || $subscribe->status == 3 || $subscribe->status == 4) {
            $is_appraise = false;
        }

        return $is_appraise;
    }


    /**
     *
     * 获取审核人数据
     * @param $subscribe
     * @return array
     */
    public static function get_user_data($subscribe)
    {
        $user_locals = $subscribe->users;/*审核人*/

        $users = [];
        foreach ($user_locals as $user_local) {
            $users[$user_local->pivot->index] = $user_local;
        }

        /*排序*/
        ksort($users);

        return $users;
    }


    /**
     * 获取用用户id
     * @param $users
     * @return array
     */
    private static function get_user_id($users)
    {
        $user_ids = [];
        foreach ($users as $user) {
            array_push($user_ids, $user->id);
        }

        return $user_ids;
    }


    /**
     * 格式化简历数据
     * @param $object
     * @return mixed
     */
    public static function rebulid_resume($object)
    {

        /*语言能力*/
        $lang = $object->lang;
        $langs = explode("<div class=\"widget_hr_dotted\"></div>", html_entity_decode(stripslashes($lang)));

        $lang_data = '';

        foreach ($langs as $lang) {

            $lang_data_row = '';

            if (strlen($lang)) {

                $lang_rows = explode("&nbsp;&nbsp;&nbsp;&nbsp;", $lang);

                foreach ($lang_rows as $lang_row) {

                    $lang_data_in = '';

                    if (strlen($lang_row)) {

                        $lang_row_inners = explode("：", $lang_row);

                        foreach ($lang_row_inners as $key => $value) {

                            if ($key) {
                                $lang_data_in .= '<div class="wap_col_xs_8"><p>' . trim(str_replace('&nbsp;', '', $value)) . '</p></div>';
                            } else {
                                $lang_data_in .= '<div class="wap_col_xs_4"><p>' . trim(str_replace('&nbsp;', '', $value)) . '：</p></div>';
                            }

                        }

                        $lang_data_row .= '<div class="row">' . trim(str_replace('&nbsp;', '', $lang_data_in)) . '</div>';
                    }

                }

                $lang_data .= '<div class="wap_basic_bottom wap_padding iconfont">' . trim(str_replace('&nbsp;', '', $lang_data_row)) . '</div>';
            }

        }


        $evaluations = $object->evaluations;
        $evaluations = explode("<div class=\"widget_hr_dotted\"></div>", html_entity_decode(stripslashes($evaluations)));

        $evaluation_datas = '';
        foreach ($evaluations as $evaluation) {
            if (strlen($evaluation)) {
                $evaluation_datas .= '<div class="wap_basic_bottom wap_padding iconfont">' . trim(str_replace('&nbsp;', '', $evaluation)) . '</div>';
            }

        }

        /*工作经验*/
        $wrok_experiences = $object->wrok_experiences;

        if ($object->origin_id == 0) {
            $wrok_experiences = explode("<div class=\"widget_hr_dotted\"></div>", str_replace('<br />', '<br/><br/>', html_entity_decode(stripslashes(nl2br($wrok_experiences)))));
        } else {
            $wrok_experiences = explode("<div class=\"widget_hr_dotted\"></div>", html_entity_decode(stripslashes(nl2br($wrok_experiences))));
        }

        $wrok_experience_datas = '';

        foreach ($wrok_experiences as $work_experience) {

            $work_experience_data_row = '';

            if (strlen($work_experience)) {

                $work_experience_rows = explode("<br/><br/>", $work_experience);

                foreach ($work_experience_rows as $work_experience_row) {

                    $work_experience_in = '';

                    if (strlen($work_experience_row)) {

                        $work_experience_row_inners = explode("：", $work_experience_row);

                        foreach ($work_experience_row_inners as $key => $value) {

                            if ($key) {
                                if ($key == 1) {
                                    if ($key == count($work_experience_row_inners) - 1) {
                                        $work_experience_in .= '<div class="wap_col_xs_8"><p>' . trim(str_replace('&nbsp;', '', $value)) . '</p></div>';
                                    } else {
                                        $work_experience_in .= '<div class="wap_col_xs_8"><p>' . trim(str_replace('&nbsp;', '', $value));
                                    }

                                } elseif ($key == count($work_experience_row_inners) - 1) {
                                    $work_experience_in .= trim(str_replace('&nbsp;', '', $value)) . '</p></div>';
                                } else {
                                    $work_experience_in .= trim(str_replace('&nbsp;', '', $value));
                                }

                            } else {
                                if (strlen(trim(str_replace('&nbsp;', '', $value))) && strlen(trim(str_replace('&nbsp;', '', $value))) <= 12) {
                                    $work_experience_in .= '<div class="wap_col_xs_4"><p>' . trim(str_replace('&nbsp;', '', $value)) . '：</p></div>';
                                } else {
                                    if (strlen(trim(str_replace('&nbsp;', '', $value)))) {
                                        $work_experience_in .= '<div class="wap_col_xs_4"><ap></ap></div><div class="wap_col_xs_8"><p>' . trim(str_replace('▌', '', $value)) . '</p></div>';
                                    }
                                }
                            }

                        }

                        $work_experience_data_row .= '<div class="row">' . trim(str_replace('&nbsp;', '', $work_experience_in)) . '</div>';
                    }

                }

                $wrok_experience_datas .= '<div class="wap_basic_bottom wap_padding iconfont">' . trim(str_replace('&nbsp;', '', $work_experience_data_row)) . '</div>';

            }
        }

        $object->lang = $lang_data;
        $object->evaluations = $evaluation_datas;
        $object->wrok_experiences = $wrok_experience_datas;

        return $object;
    }

    /**
     * 面试预约
     * @param $object
     */
    public static function changeStatus($object)
    {
        /*面试预约*/
        $offer_date = $object->offer_date->timestamp;

        if ($object->status == 1 && Carbon::now()->timestamp >= $offer_date) {  /*超过面试时间直接变为 进行中 */
            $object->status = 2;
            $object->update();
        }

        /*完成的自动生成录取通知管理*/
        if ($object->result == 2 && !$object->notice) {
            Notice::create([
                'subscribe_id' => $object->id
            ]);
        }

    }


    /**
     * 预约数据
     * @return int
     */
    public static function getCounts()
    {
        $user = self::getLoginUser();

        $subscribes = Subscribe::with(['resumes', 'examines'])->where('status', 2)->get();

        $filtered = $subscribes->filter(function ($item) use ($user) {
            if (in_array($user->id, $item->users->pluck('id')->toArray()) || self::seeData($user)) {
                return true;
            } else {
                $depart_names = $user->departs->pluck('name')->toArray();
                return in_array($item->examines->depart, $depart_names);
            }
        });

        $sub_counts = $filtered->count();

        return $sub_counts;
    }


    /**
     * 数据查看权限
     * @param $user
     * @return bool
     */
    public static function seeData($user)
    {
        if ($user->see_all_data == 1 || $user->first == 1 || $user->last == 1 || in_array($user->user_wechat_id, config('system.admin_user'))) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 获取简历对应预约审核人id集合
     * @param $resumes
     * @param $user
     * @return mixed
     */
    public static function get_resumes($resumes, $user)
    {
        $resumes = $resumes->filter(function ($item) use ($user) {
            $subscribe_user_ids = [];
            foreach ($item->subscribes as $subscribe) {

                $array = $subscribe->users->pluck('id')->toArray();
                array_push($subscribe_user_ids, $array);
            }

            if (in_array($user->id, array_flatten($subscribe_user_ids)) || $user->see_resume == 1) {
                return true;
            } else {
                $depart_names = $user->departs->pluck('name')->toArray();
                foreach ($item->subscribes as $subscribe) {
                    if (in_array($subscribe->examines->depart, $depart_names)) {
                        return true;
                    } else {
                        continue;
                    }
                }
            }
        });

        return $resumes;
    }


    /**
     * 创建记录
     * @param $type
     * @param $archive
     * @param $content
     * @param $data
     */
    public static function create_archive_log($type, $archive, $content, $data)
    {
        try {
            /*记录*/
            ArchiveLog::create([
                'type'       => $type,
                'archive_id' => $archive->id,
                'content'    => $archive->name . ' 于' . $data . $content,
            ]);
        } catch (\Exception $e) {
            report($e);
        }
    }


    /**
     * 上传图片到服务器
     *
     * 首先我使用Image模型的验证数组验证输入，
     * 在那里我指定了图片格式并声明图片是必填项。
     * 你也可以添加其它约束，比如图片尺寸等。
     * 如果验证失败，后台会发送错误响应，Croppic也会弹出错误对话框。
     * 注：原生的弹出框看上去真的很丑，所以我总是使用SweetAlert，
     * 要使用SweetAlert可以在croppic.js文件中搜索alert并将改行替换成：sweetAlert("Oops...", response.message, 'error');
     * 当然你还要在HTML中引入SweetAlert相关css和js文件。
     * 我们使用sanitize和createUniqueFilename方法创建服务器端文件名
     * @param $photo_data
     * @param $username
     * @return \Illuminate\Http\JsonResponse
     */
    public static function upload($photo_data, $username)
    {

        $photo = $photo_data['img'];

        if ($photo->getSize() > 1048576) {
            return response()->json(['status' => false, 'message' => '图片不能大于1M']);
        }

        $original_name = $photo->getClientOriginalName();
        $ext = $photo->getClientOriginalExtension();
        $original_name_without_ext = str_replace('.' . $ext, '', trim(json_encode($original_name), '"'));

        if (!in_array(strtolower($ext), ['png', 'gif', 'jpeg', 'jpg'])) {
            return response()->json(['status' => false, 'message' => '图片必须为png,gif,jpeg,jpg格式']);
        }

        $filename_ext = self::createUniqueFilename($username, $original_name_without_ext, $ext);

        if (!is_dir(public_path() . $username)) {
            mkdir(public_path() . $username, 0777, true);
        }

        try {
            $manager = new ImageManager();
            $image = $manager->make($photo)->encode($ext)->save(public_path() . $username . $filename_ext);

            if (!$image) {
                return response()->json(['status' => false, 'message' => '图片上传失败']);
            }

        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['status' => false, 'message' => '图片上传失败']);
        }


        return response()->json([
            'status' => true,
            'url'    => asset($username . $filename_ext),
            'width'  => $image->width(),
            'height' => $image->height()
        ]);
    }

    /**
     * 序列号
     * @param $string
     * @param bool $force_lowercase
     * @param bool $anal
     * @return mixed|null|string|string[]
     */
    private static function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]", "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;", "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;

        return ($force_lowercase) ? (function_exists('mb_strtolower')) ? mb_strtolower($clean, 'UTF-8') : strtolower($clean) : $clean;
    }

    /**
     * 创建唯一文件名
     * @param $username
     * @param $filename
     * @param $imageExt
     * @return string
     */
    private static function createUniqueFilename($username, $filename, $imageExt)
    {

        $filename = self::sanitize($filename);

        $upload_path = public_path() . $username;
        $full_image_path = $upload_path . $filename . '.' . $imageExt;

        if (File::exists($full_image_path)) {
            // Generate token for image
            $image_token = substr(sha1(mt_rand()), 0, 5);

            return $filename . '-' . $image_token . '.' . $imageExt;
        }
        return $filename . '.' . $imageExt;
    }


    /**
     * 上传附件
     * @param $photo_data
     * @param $username
     * @return \Illuminate\Http\JsonResponse
     */
    public static function uploadClsoure($username, $request)
    {
        $clsoure = $request->file('clsoure');

        $original_name = $clsoure->getClientOriginalName();//文件名
        $ext = $clsoure->getClientOriginalExtension();//文件扩展名
        $original_name_without_ext = str_replace('.' . $ext, '', trim($original_name, '"'));//去除文件扩展名
        $filename_ext = self::createUniqueFilename($username, $original_name_without_ext, $ext);//创建唯一文件名

        try {

            $path = Storage::disk('public')->putFileAs('clsoure', $request->file('clsoure'), $filename_ext);

            if ($path) {

                return ['status' => true, 'name' => $filename_ext, 'path' => $path];

            } else {

                return response()->json(['status' => false, 'message' => '上传失败']);

            }

        } catch (\Exception $e) {

            return response()->json(['status' => false, 'message' => '上传失败']);

        }
    }

    /**
     * 转正提示
     *
     */
    public static function notice_full_message()
    {
        $setting = Setting::find(1);

        $appConfigs = config('resume');
        $agentid = $appConfigs['AppsConfig']['resume']['AgentId'];

        $full_notice_days = explode('|', env('FULL_NOTICE_DAYS', '7|3|1'));//提醒设置

        if ($setting->full[0]) {//是否开启提醒

            foreach ($full_notice_days as $full_notice_day) {

                $date = today()->addDays($full_notice_day)->toDateString();
                $archives = Archive::where('offer_status', 2)->whereDate('offer_date', $date)->get();

                try {

                    if ($archives->count()) {

                        self::storeWarn($archives, 1);

                        $user_names = implode('|', $archives->pluck('name')->toArray());
                        $message = $user_names . ' 的试用期将于 ' . $archives->first()->offer_date->toDateString() . ' 结束，请及时办理转正手续！';

                        $array = [
                            'touser'   => $setting->full[1],
                            'msgtype'  => 'textcard',
                            'agentid'  => $agentid,
                            'textcard' => [
                                'title'       => '你有一个新的员工转正提醒！！',
                                'description' => $message,
                                'url'         => url('/mobile/notice/full')
                            ]
                        ];

//                        Log::info('转正提醒 发送提醒', [$message]);
                        foreach ($setting->full[1] as $user_id) {
                            $touser = User::findOrFail($user_id)->user_wechat_id;

                            $array['touser'] = $touser;

                            self::send_wechat_messages($array);
                        }
                    }

                } catch (\Exception $exception) {

                    report($exception);
                    Log::info('转正提醒 发送提醒失败');
                }
            }

        } else {

            Log::info('转正提醒禁用');
        }

    }

    /**
     *合同续约提醒
     */
    public static function notice_agree_message()
    {
        $appConfigs = config('resume');
        $agentid = $appConfigs['AppsConfig']['resume']['AgentId'];
        $setting = Setting::find(1);

        $agree_notice_days = explode('|', env('AGREE_NOTICE_DAYS', '7|3|1'));

        if ($setting->renew[0]) {

            foreach ($agree_notice_days as $agree_notice_day) {

                $date = today()->addDays($agree_notice_day)->toDateString();
                $archive_agrees = Archive::with('agreements', 'families')->whereIn('offer_status', [1, 2, 3])->get();
                $archives = $archive_agrees->filter(function ($value, $key) use ($date) {

                    return $value->agreements->count() && $value->agreements()->latest()->first()->expire_at->toDateString() === $date;

                });

                try {

                    if ($archives->count()) {

                        self::storeWarn($archives, 3);//保存提醒

                        $user_names = implode('|', $archives->pluck('name')->toArray());
                        $message = $user_names . ' 的劳动合同将于 ' . $date . ' 到期，请及时办理合同续签！';

                        $array = [
                            'touser'   => $setting->renew[1],
                            'msgtype'  => 'textcard',
                            'agentid'  => $agentid,
                            'textcard' => [
                                'title'       => '你有一个新的员工合同续签提醒！！',
                                'description' => $message,
                                'url'         => url('/mobile/notice/agree')
                            ]
                        ];

//                        Log::info('合同续签 发送提醒', [$message]);
                        foreach ($setting->renew[1] as $user_id) {
                            $touser = User::findOrFail($user_id)->user_wechat_id;

                            $array['touser'] = $touser;

                            self::send_wechat_messages($array);
                        }
                    }


                } catch (\Exception $exception) {

                    report($exception);
                    Log::info('合同续签 发送提醒失败');
                }

            }

        } else {

            Log::info('合同续签禁用');

        }

    }

    /**
     *  周年
     */
    public static function notice_year_message()
    {
        $appConfigs = config('resume');
        $agentid = $appConfigs['AppsConfig']['resume']['AgentId'];
        $setting = Setting::find(1);
        $year_notice_days = explode('|', env('YEAR_NOTICE_DAYS', '7|3|1'));

        if ($setting->year[0]) {

            foreach ($year_notice_days as $year_notice_day) {

                $date = today()->addDays($year_notice_day);
                $archives = Archive::where('offer_status', '!=', 0)->whereMonth('offer_on_date', $date->month)->whereDay('offer_on_date', $date->day)->get();
                $archives = $archives->filter(function ($value) use ($date) {

                    return $date->diffInYears($value->offer_on_date) > 0;

                });

//                \Log::info('员工周年',[$archives->count()]);
                try {

                    if ($archives->count()) {

                        self::storeWarn($archives, 2);

                        $message = '本周共有' . $archives->count() . '个员入职满周年，感谢为公司的付出！';
                        $array = [
                            'touser'   => $setting->year[1],
                            'msgtype'  => 'textcard',
                            'agentid'  => $agentid,
                            'textcard' => [
                                'title'       => '你有一个新的员工周年提醒！！',
                                'description' => $message,
                                'url'         => url('/mobile/notice/year')
                            ]
                        ];

                        foreach ($setting->year[1] as $user_id) {
                            $touser = User::findOrFail($user_id)->user_wechat_id;

                            $array['touser'] = $touser;

                            self::send_wechat_messages($array);
                        }
                    }

                } catch (\Exception $exception) {

                    report($exception);
                    Log::info('周年提醒 发送提醒失败');

                }

            }
        } else {

            Log::info('周年提醒禁用');

        }

    }

    /**
     *
     *  生日提醒
     */
    public static function notice_birthday_message($archive = null)
    {
        $appConfigs = config('resume');
        $agentid = $appConfigs['AppsConfig']['resume']['AgentId'];
        $setting = Setting::find(1);

        $array_months = [
            3  => [1, 2, 3],
            6  => [4, 5, 6],
            9  => [7, 8, 9],
            12 => [10, 11, 12],
        ];

        if ($setting->birthday[0]) {

            if ($archive) {
                foreach ($array_months as $key => $array_month) {
                    //提醒过后，亲的员工提醒
                    if ($archive->birthday->month == $array_month && today()->month == $key && today()->day >= env('BIRTHDAY_NOTICE_DAYS', '15')) {//季度最后一个月月中提醒

                        try {
                            self::storeWarn([$archive], 4);

                            $message = $archive->name . '在本季度生日，请提前做好准备！';
                            $array = [
                                'touser'   => $setting->birthday[1],
                                'msgtype'  => 'textcard',
                                'agentid'  => $agentid,
                                'textcard' => [
                                    'title'       => '你有一个新的员工生日提醒！！',
                                    'description' => $message,
                                    'url'         => url('/mobile/notice/birthday')
                                ]
                            ];

                            foreach ($setting->birthday[1] as $user_id) {
                                $touser = User::findOrFail($user_id)->user_wechat_id;

                                $array['touser'] = $touser;

                                self::send_wechat_messages($array);
                            }

                        } catch (\Exception $exception) {

                            report($exception);
                            Log::info('员工生日 发送提醒失败');
                        }

                    }
                }

            } else {

                foreach ($array_months as $key => $array_month) {
                    //定时提醒
                    if (today()->month == $key && today()->day == env('BIRTHDAY_NOTICE_DAYS', '15')) {//季度最后一个月月中提醒

                        $archives = Archive::all()->filter(function ($item) use ($array_month) {

                            return in_array($item->birthday->month, $array_month);

                        });

                        try {

                            if ($archives->count()) {

                                self::storeWarn($archives, 4);

                                $message = '本季度共有' . $archives->count() . '个员工生日，请提前做好准备！';
                                $array = [
                                    'touser'   => $setting->birthday[1],
                                    'msgtype'  => 'textcard',
                                    'agentid'  => $agentid,
                                    'textcard' => [
                                        'title'       => '你有一个新的员工生日提醒！！',
                                        'description' => $message,
                                        'url'         => url('/mobile/notice/birthday')
                                    ]
                                ];

                                foreach ($setting->birthday[1] as $user_id) {
                                    $touser = User::findOrFail($user_id)->user_wechat_id;

                                    $array['touser'] = $touser;

                                    self::send_wechat_messages($array);
                                }
                            }
                        } catch (\Exception $exception) {

                            report($exception);
                            Log::info('员工生日 发送提醒失败');
                        }

                    }
                }
            }

        } else {

            Log::info('员工生日禁用');

        }

    }

    /**
     *  亲属提醒
     */
    public static function notice_families_message($fam = null)
    {

//        \Log::info('员工亲属生日',[$fam]);

        $appConfigs = config('resume');
        $agentid = $appConfigs['AppsConfig']['resume']['AgentId'];
        $setting = Setting::find(1);

        if ($setting->family_birthday[0]) {

            if ($fam) {

                if ($fam->birthday_type == 0) {
                    /*将阴历转换为阳历*/
                    $lunar = new Calendar();
                    $times = $lunar->lunar($fam->birthday->year, $fam->birthday->month, $fam->birthday->day);
                    $birthday = Carbon::createFromDate(today()->year, $times['gregorian_month'], $times['gregorian_day']);

                } else {

                    $birthday = Carbon::createFromDate(today()->year, $fam->birthday->month, $fam->birthday->day);

                }

                if (today()->dayOfWeek >= 3 && today()->diffInWeeks($birthday) < 1) {

                    try {

                        self::storeWarn([$fam], 5);

                        $message = '新员工 ' . $fam->archive->name . ' 的亲属本周生日，请悉知！！！';

                        $array = [
                            'touser'   => $setting->family_birthday[1],
                            'msgtype'  => 'textcard',
                            'agentid'  => $agentid,
                            'textcard' => [
                                'title'       => '你有一个新的员工亲属生日提醒！！！！',
                                'description' => $message,
                                'url'         => url('/mobile/notice/families')
                            ]
                        ];

                        foreach ($setting->family_birthday[1] as $user_id) {
                            $touser = User::findOrFail($user_id)->user_wechat_id;

                            $array['touser'] = $touser;

                            self::send_wechat_messages($array);
                        }

                    } catch (\Exception $exception) {

                        report($exception);
                        Log::info('员工亲属生日 发送提醒失败');

                    }

                }

            } else {

                $familie_datas = Family::all();

                $families = $familie_datas->filter(function ($item) {

                    if ($item->birthday_type == 0) {
                        /*将阴历转换为阳历*/
                        $lunar = new Calendar();
                        $times = $lunar->lunar($item->birthday->year, $item->birthday->month, $item->birthday->day);
                        $birthday = Carbon::createFromDate($times['gregorian_year'], $times['gregorian_month'], $times['gregorian_day']);

                    } else {
                        $birthday = Carbon::createFromDate(today()->year, $item->birthday->month, $item->birthday->day);

                    }

                    return today()->diffInWeeks($birthday) < 1;

                });

                try {

                    if ($families->count()) {

                        self::storeWarn($families, 5);

                        $message = '本周共有' . $families->count() . '个员工亲属生日，请悉知！';

                        $array = [
                            'touser'   => $setting->family_birthday[1],
                            'msgtype'  => 'textcard',
                            'agentid'  => $agentid,
                            'textcard' => [
                                'title'       => '你有一个新的员工亲属生日提醒！！！！',
                                'description' => $message,
                                'url'         => url('/mobile/notice/families')
                            ]
                        ];

                        foreach ($setting->family_birthday[1] as $user_id) {

                            $touser = User::findOrFail($user_id)->user_wechat_id;

                            $array['touser'] = $touser;

                            self::send_wechat_messages($array);
                        }

                    }

                } catch (\Exception $exception) {

                    report($exception);
                    Log::info('员工亲属生日 发送提醒失败');

                }

            }


        } else {

            Log::info('员工亲属生日禁用');

        }


    }

    /**
     * @param $archives
     */
    public static function storeWarn($modes, $warn_type)
    {
        $setting = Setting::find(1);

        foreach ($modes as $key => $mode) {
            $agree_id = null;

            if ($warn_type == 1) {

                $warn_date = $mode->offer_date;
                $content = '的试用期将于' . $warn_date->toDateString() . '结束，请及时办理转正手续';
                $warnor = $setting->full[1];
                $name = $mode->name;

            } elseif ($warn_type == 2) {

                $warn_date = $mode->offer_on_date;
                $content = '于' . $warn_date->toDateString() . '入职满' . (today()->diffInYears($mode->offer_on_date) + 1) . '年，感谢为公司的付出';
                $warnor = $setting->year[1];
                $name = $mode->name;

            } elseif ($warn_type == 3) {

                $agree = $mode->agreements()->latest()->first();
                $warn_date = $agree->expire_at;
                $content = '的劳动合同将于' . $warn_date->toDateString() . '结束，请及时办理合同续签手续';
                $warnor = $setting->renew[1];
                $name = $mode->name;
                $agree_id = $agree->id;

            } elseif ($warn_type == 4) {

                $warn_date = $mode->birthday;
                $content = '（' . $warn_date->month . '月' . $warn_date->day . '日）';
                $warnor = $setting->birthday[1];
                $name = $mode->name;

            } elseif ($warn_type == 5) {

                $warn_date = $mode->birthday;

                if ($mode->relation == 1) {

                    $relation = '父亲';

                } elseif ($mode->relation == 2) {

                    $relation = '母亲';

                } elseif ($mode->relation == 3) {

                    $relation = '儿子';
                } elseif ($mode->relation == 4) {

                    $relation = '女儿';

                } elseif ($mode->relation == 5) {

                    $relation = '夫妻';
                }

                if ($mode->birthday_type == 0) {

                    $birthday_type = '农历';

                } elseif ($mode->birthday_type == 1) {

                    $birthday_type = '阳历';

                }

                $warnor = $setting->family_birthday[1];
                $content = $mode->name . ': ' . $warn_date->month . '月' . $warn_date->day . '日,' . $birthday_type . '(' . $mode->archive->name . '-' . $relation . ')';
                $name = $mode->name . '(' . $mode->archive->name . '-' . $relation . ')';
            }

            /*如果已经有提醒就不重复保存*/
            if ($warn_type == 5) {//家属生日

                if ($mode->archive && $mode->archive->warns && $mode->archive->warns()->where('type', $warn_type)->where('content', $content)->get()->count()) {

                    continue;

                }

                $archive_id = $mode->archive->id;

            } else {//其他提醒

                if ($mode->warns && $mode->warns()->where('type', $warn_type)->where('content', $content)->get()->count()) {

                    continue;

                }

                $archive_id = $mode->id;
            }

            try {

                Warns::create([
                    'name'       => $name,
                    'content'    => $content,
                    'type'       => $warn_type,
                    'warnor'     => $warnor,
                    'warn_date'  => $warn_date,
                    'archive_id' => $archive_id,
                    'agree_id'   => $agree_id,
                ]);

            } catch (\Exception $exception) {

                report($exception);

            }
        }

    }

    /*获取部门名称*/
    /**
     * @param $depart_ids
     * @return string
     */
    public static function getDepartName($depart_ids)
    {
        return implode(' | ', Depart::whereIn('id', $depart_ids)->pluck('name')->toArray());

    }

    /*格式化数据 档案数据*/
    /**
     * @param $archive
     * @return mixed
     */
    public static function archiveFormat($archive)
    {
        $archive_user = $archive->user()->withTrashed()->first();

        $archive->offer_depart = self::getDepartName($archive_user->departs->pluck('id')->toArray());

        if ($archive->internal) {
            $user = User::withTrashed()->whereId($archive->internal)->first();
            $archive->internal_user_departs = $user->departs;
            $archive->internal_user = $user->name;
            $archive->internal_departs = self::getDepartName($user->departs->pluck('id')->toArray());
            $archive->internal_id = $user->id;
        }

        $lang = '';

        foreach ($archive->ability[0] as $ability) {

            if ($ability == 0) {

                $lang .= '普通话  ';

            } elseif ($ability == 1) {

                $lang .= '粤语  ';

            } elseif ($ability == 2) {

                $lang .= '英语';

            }
        }

        $archive->lang = $lang;

        /*权限设置*/
        $local_user = self::getLoginUser();
        $setting = Setting::find(1);

        if ($setting->archives && in_array($local_user->id, $setting->archives)) {
            //
        } elseif ($local_user->id == $archive_user->id) {
            //
        } else {
            $archive->salaries = null;
        }

        return $archive;
    }

    /*记录薪资记录*/
    /**
     * @param $salary
     * @param $archive
     */
    public static function create_salary_log($salary, $archive)
    {

        if ($salary['status'] == 0) {
            /*薪资变动*/
            $type = '入职薪资';
            $content = '入职薪资为：基本工资' . $salary['basic'] . '元，绩效 ' . $salary['added'] . '元，备注：' . $salary['remark'];
        } elseif ($salary['status'] == 1) {
            /*薪资变动*/
            $type = '转正薪资';
            $content = '转正薪资为：基本工资' . $salary['basic'] . '元，绩效 ' . $salary['added'] . '元，备注：' . $salary['remark'];
        } elseif ($salary['status'] == 2) {
            /*薪资变动*/
            $type = '加薪';
            $content = '加薪后：基本工资' . $salary['basic'] . '元，绩效 ' . $salary['added'] . '元，备注：' . $salary['remark'];
        } elseif ($salary['status'] == 2) {
            /*薪资变动*/
            $type = '减薪';
            $content = '减薪后：基本工资' . $salary['basic'] . '元，绩效 ' . $salary['added'] . '元，备注：' . $salary['remark'];
        }

        try {

            self::create_archive_log($type, $archive, $content, $salary['start_at']);

        } catch (\Exception $e) {

            report($e);

        }
    }

    /*记录岗位记录*/
    /**
     * @param $promotion
     * @param $archive
     */
    public static function create_pro_log($promotion, $archive)
    {
        /*记录升迁*/
        if ($promotion['type'] == 0) {
            $type = '升职';
        } elseif ($promotion['type'] == 1) {
            $type = '降职';
        } elseif ($promotion['type'] == 2) {
            $type = '调岗';
        } elseif ($promotion['type'] == 3) {
            $type = '复职';
        } elseif ($promotion['type'] == 4) {
            $type = '入职';
        }

        $content = $type . '为' . self::getDepartName([$promotion['new_depart']]) . '-' . $promotion['new_offer'];
        self::create_archive_log($type, $archive, $content, $promotion['chang_at']);
    }

}