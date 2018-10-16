<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\Models\Depart;
use App\Models\Examine;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;


class ExamineController extends BaseController
{

    /**
     * DepartController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*申请单*/
    public function index()
    {
        $latest = Cache::get('examine_sync_last_date');/*最新更新*/

        $sub_counts = Functions::getCounts();

        return view('examine.index', compact('latest', 'sub_counts'));
    }

    /*申请单数据*/
    public function all_data($flag = false)
    {
        $user = Functions::getLoginUser();

        if (Functions::seeData($user)) {

            $examines = Examine::all();

        } else {

            $depart_names = $user->departs->pluck('name')->toArray();
            $examines = Examine::whereIn('depart', $depart_names)
                ->orWhere('apply_user_id', $user->user_wechat_id)
                ->get();

        }

        $data = [];
        $array = [];

        foreach ($examines as $examine) {

            $url = url('/examine/' . $examine->id . '/show');

            if ($flag) {

                if (in_array($examine->status, [1, 2]) && $examine->subscribes()->where('result', 2)->get()->count() !== $examine->places) {

                    array_unshift($array, [
                        '<div class="check-box" name="' . $examine->id . '"><img class="check" src="' . url('img/check.png') . '"/><img class="uncheck" src="' . url('img/uncheck.png') . '"/></div>',
                        '<a target="_blank"  href="' . $url . '" >' . $examine->apply_name . '的人员增补申请单</a>',
                        $examine->status,
                        $examine->depart,
                        $examine->position,
                        $examine->places,
                        $examine->complate_date->toDateString(),
                        $examine->status,
                        $examine->id,
                    ]);
                }

            } else {

                array_unshift($array, [
                    '<a  href="' . $url . '"  target="_blank">' . $examine->apply_name . '的人员增补申请单</a>',
                    $examine->status,
                    $examine->depart,
                    $examine->position,
                    $examine->places,
                    $examine->complate_date->toDateString(),
                    $examine->status,
                    $examine->id,
                ]);
            }
        }

        $data['data'] = $array;

        return json_encode($data);
    }

    /*同步*/
    public function sync($is_manual=null)
    {

        $last_time = Cache::get('examine_sync_last_time');/*最新更新*/
        if (!$last_time || $is_manual) {//手动更新
            $last_time = Carbon::create(now()->year,now()->month,1)->timestamp;/*2017-7-1 00：00：00*/
        }

        $examine_wechat_data = Functions::getExamine($last_time);
        $examine_wechats = array_filter($examine_wechat_data['data'], function ($data) {
            $examine_old = Examine::where('origin_no', $data['sp_num'])->get()->isEmpty();
            if ($data['spname'] == '人员增补申请单' && $data['sp_status'] == 2) {
                return $data;
            }
        });



        foreach ($examine_wechats as $examine_wechat) {
            /*申请单内容*/
            $comms = json_decode($examine_wechat['comm']['apply_data'], true);

            foreach ($comms as $comm) {
                if ($comm['title'] == '申请部门') {
                    $depart = $comm['value'];
                } elseif ($comm['title'] == '申请岗位') {
                    $position = $comm['value'];
                } elseif ($comm['title'] == '申请名额') {
                    $places = $comm['value'];
                } elseif ($comm['title'] == '计划完成日期') {
                    $complate_date = $comm['value'];
                } elseif ($comm['title'] == '申请原因') {
                    $reason = $comm['value'];
                } elseif ($comm['title'] == '性别') {
                    $sex = $comm['value'];
                } elseif ($comm['title'] == '年龄') {
                    $age = $comm['value'];
                } elseif ($comm['title'] == '学历') {
                    $education = $comm['value'];
                } elseif ($comm['title'] == '工作经验') {
                    $wrok_experiences = $comm['value'];
                } elseif ($comm['title'] == '其他要求') {
                    $other = $comm['value'];
                } elseif ($comm['title'] == '岗位职责') {
                    $describe = $comm['value'];
                }
            }



            $examine_datas = [
                'origin_no'        => $examine_wechat['sp_num'],
                'status'           => 1,
                'depart'           => $depart,
                'apply_name'       => $examine_wechat['apply_name'],
                'apply_time'       => $examine_wechat['apply_time'],
                'apply_user_id'    => $examine_wechat['apply_user_id'],
                'position'         => $position,
                'places'           => $places,
                'complate_date'    => Carbon::createFromTimestamp(substr($complate_date, 0, 10)),
                'reason'           => $reason,
                'sex'              => $sex,
                'age'              => $age,
                'education'        => $education,
                'wrok_experiences' => $wrok_experiences,
                'other'            => $other,
                'describe'         => $describe,
                'created_at'       => now(),
            ];


            Examine::create($examine_datas);


        }

        Cache::forever('examine_sync_last_date', now()->toDateTimeString());
        Cache::forever('examine_sync_last_time', now()->timestamp);

        return response()->json(['status' => true, 'msg' => '成功同步']);

    }

    /*查看详情*/
    public function show($id)
    {
        $examine = Examine::with('subscribes.resumes')->where('id', $id)->first();

        return view('examine.show', compact('examine'));
    }

    /*删除&&取消*/
    public function destroy($id)
    {
        $examine = Examine::with('subscribes')->where('id', $id)->first();

        if ($examine->subscribes()->whereIn('status', [1, 2, 3])->get()->count()) {

            $status = 0;
            $msg = '不能取消在进行中预约的申请单';

        } else {

            $examine->status = 4;
            $examine->save();
            $is_update = Functions::isUpdate($examine->updated_at);

            if ($is_update) {

                $status = 1;
                $msg = '操作成功';

            } else {

                $status = 0;
                $msg = '操作失败';

            }
        }

        return response()->json(['status' => $status, 'msg' => $msg]);
    }

    /*完成*/
    public function complate($id)
    {
        $examine = Examine::find($id);

        if ($examine->subscribes()->where('result', 2)->get()->count() == $examine->places) {

            $examine->status = 3;
            $examine->save();

            $is_update = Functions::isUpdate($examine->updated_at);

            if ($is_update) {

                $status = 1;
                $msg = '操作成功';

            } else {

                $status = 0;
                $msg = '操作失败';

            }

        } else {

            $status = 0;
            $msg = '申请名额没有达标！！';

        }

        return response()->json(['status' => $status, 'msg' => $msg]);
    }
}
