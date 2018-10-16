<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\Models\Depart;
use App\Models\Examine;
use App\Models\Resume;
use App\Models\Subscribe;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscribeController extends BaseController
{

    /**
     * DepartController constructor.
     */
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        return view('subscribe.index');
    }

    /**
     * 面试预约
     *
     * @return string
     */
    public function all_data()
    {
        $user = Functions::getLoginUser();

        $subscribes = Subscribe::with(['resumes', 'examines'])->get();

        $filtered = $subscribes->filter(function ($item) use ($user) {

            if (in_array($user->id, $item->users->pluck('id')->toArray()) || Functions::seeData($user)) {

                return true;

            } else {

                $departs = $user->departs;
                return in_array($item->examines->depart , $departs->pluck('name')->toArray) || $item->examines->apply_user_id == $user->user_wechat_id;

            }

        });

        $data = [];
        $array = [];
        $status = '';
        $origin_id = '';

        foreach ($filtered as $subscribe) {

            /*到时间改变状态*/
            Functions::changeStatus($subscribe);

            $url = url('/subscribe/' . $subscribe->id . '/show');

            if ($subscribe->resumes()->get()->isEmpty()) {

                array_unshift($array, [
                    '',
                    $subscribe->status,
                    $subscribe->offer_date->toDateTimeString(),
                    $subscribe->result,
                    $subscribe->address,
                    '',
                    '',
                    $subscribe->status,
                    $subscribe->id,
                ]);

            } else {

                array_unshift($array, [
                    '<a href="' . $url . '" target="_blank" >' . $subscribe->examines->position . '</a>',
                    $subscribe->status,
                    $subscribe->offer_date->toDateTimeString(),
                    $subscribe->result,
                    $subscribe->address,
                    $subscribe->resumes->name,
                    $subscribe->resumes->origin_id,
                    $subscribe->status,
                    $subscribe->id,
                    $subscribe->appraises()->get()->isEmpty(),
                ]);
            }
        }

        $data['data'] = $array;

        return json_encode($data);
    }

    /**
     * 新增预约
     *
     * @param null $examine_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function create($examine_id = null)
    {

        if (User::where('first', 1)->get()->isEmpty() || User::where('last', 1)->get()->isEmpty()) {

            return response()->json(['status' => false, 'msg' => '预约审核人没有设置']);

        } else {


            $data = ['status' => true];
            if ($examine_id) {
                $data = array_merge($data, ['examine_id' => $examine_id]);
            }

            return response()->json($data);

        }

    }

    /**
     * 新建预约页面·
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_create_view()
    {

        $user_first = User::where('first', 1)->first();
        $user_last = User::where('last', 1)->first();

        if (request('examine_id')) {

            $examine = Examine::find(request('examine_id'));
            return view('subscribe.create', compact('examine', 'user_first', 'user_last'));

        } else {

            return view('subscribe.create', compact('user_first', 'user_last'));

        }

    }


    /**
     * 新建预约
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request, $id)
    {

        $offer_date = $request->get('offer_date');
        $address = $request->get('address');
        $remark = $request->get('remark');
        $resume_id = $request->get('resume_id');
        $userIds = $request->get('user_ids');

        if (count($userIds) == 0) {

            return response()->json(['status' => 0, 'msg' => '设置失败']);

        }

        $status = null;
        $msg = '';
        $last_user = User::where('last', 1)->first();

        if (in_array($last_user->id, $userIds)) {

            return response()->json(['status' => 0, 'msg' => '面试官不能设置为审核人']);

        }

        $resume = Resume::find($resume_id);

        /*格式化数据*/
        $user_ids = [];
        foreach ($userIds as $key => $userId) {

            $user_ids[$userId] = ['index' => $key + 1];

        }

        $exmaine = Examine::find($id);

        if ($exmaine->subscribes()->where('result', 2)->get()->count() < $exmaine->places) {

            if ($resume->subscribes()->where('result', 2)->get()->count()) {

                $status = 0;
                $msg = '招聘者已经通过面试，不能新建预约';

            } else {

                try {

                    $subscribe = Subscribe::create([
                        'status'     => 1,
                        'offer_date' => $offer_date,
                        'address'    => $address,
                        'result'     => 0,
                        'remark'     => $remark,
                        'examine_id' => $id,
                        'resume_id'  => $resume_id,
                    ]);

                    $subscribe->users()->attach($user_ids);/*添加审核人*/
                    $send_flag = Functions::sendMessages($userIds, $subscribe->id);/*推送消息*/

                    Log::info($send_flag);

                    if ($send_flag) {

                        try {

                            $exmaine->status = 2;/*改变申请单状态*/
                            $exmaine->update();

                            $status = 1;
                            $msg = '操作成功';

                        } catch (\Exception $exception) {
                            report($exception);

                            $status = 0;
                            $msg = '操作失败';
                        }

                    } else {

                        $subscribe->users()->detach();/*添加审核人*/
                        $subscribe->delete();

                        $status = 0;
                        $msg = '消息发送失败';

                    }

                } catch (\Exception $exception) {
                    report($exception);

                    $status = 0;
                    $msg = '操作失败';
                }

            }

        } else {

            $status = 0;
            $msg = '招聘名额已满';

        }

        return response()->json(['status' => $status, 'msg' => $msg]);
    }

    /**
     * 查看
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {

        $subscribe = Subscribe::with(['appraises.users', 'examines', 'users'])->where('id', $id)->first();

        /*到时间改变状态*/
        Functions::changeStatus($subscribe);

        $users = Functions::get_user_data($subscribe);/*审核人*/

        $is_appraise = Functions::is_appraise($subscribe, $users);

        $user_last = User::where('last', 1)->first();/*面试官*/

        if (Functions::wp_is_mobile()) {

            $resume = Functions::rebulid_resume($subscribe->resumes);
            return view('mobile.subscribe.show', compact('subscribe', 'resume', 'users', 'user_last', 'is_appraise'));

        } else {

            return view('subscribe.show', compact('subscribe', 'users', 'user_last', 'is_appraise'));

        }
    }


    /**
     * 编辑
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $subscribe = Subscribe::with(['appraises.users', 'examines', 'users'])->where('id', $id)->first();
        $users = Functions::get_user_data($subscribe);/*审核人*/

        $sub_counts = Functions::getCounts();
        $user_last = User::where('last', 1)->first();

        return view('subscribe.edit', compact('subscribe', 'users', 'user_last', 'sub_counts'));
    }


    /**
     * 更新
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $offer_date = $request->get('offer_date');
        $address = $request->get('address');
        $remark = $request->get('remark');
        $examine_id = $request->get('examine_id');
        $resume_id = $request->get('resume_id');
        $userIds = $request->get('user_ids');

        if (count($userIds) == 0) {

            return response()->json(['status' => 0, 'msg' => '设置失败']);

        }

        $last_user = User::where('last', 1)->first();

        if (in_array($last_user->id, $userIds)) {

            return response()->json(['status' => 0, 'msg' => '面试官不能设置为审核人']);

        }

        /*格式化数据*/
        $user_ids = [];
        foreach ($userIds as $key => $userId) {

            $user_ids[$userId] = ['index' => $key + 1];

        }

        $subscribe = Subscribe::find($id);
        $subscribe->offer_date = $offer_date;
        $subscribe->address = $address;
        $subscribe->result = 0;
        $subscribe->remark = $remark;
        $subscribe->examine_id = $examine_id;
        $subscribe->resume_id = $resume_id;

        $send_flag = Functions::sendMessages($userIds, $subscribe->id);/*推送消息*/

        $is_update = false;

        if ($send_flag) {

            $subscribe->users()->detach();/*删除审核人*/
            $subscribe->users()->attach($user_ids);/*添加审核人*/
            $subscribe->update();

            $is_update = Functions::isUpdate($subscribe->updated_at);
        }

        return response()->json($is_update ? ['status' => 1, 'msg' => '操作成功'] : ['status' => 0, 'msg' => '操作失败']);
    }


    /**
     * 复制
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function copy($id)
    {

        $subscribe = Subscribe::find($id);
        $users = Functions::get_user_data($subscribe);

        $sub_counts = Functions::getCounts();

        return view('subscribe.create', compact('subscribe', 'users', 'sub_counts'));
    }


    /**
     * 取消
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $remark = $request->get('remark');
        $subscribe = Subscribe::find($id);

        if ($subscribe->status !== 3) {

            $subscribe->status = 4;
            $subscribe->remark_destroy = $remark;/*取消*/
            $subscribe->update();

            $is_update = Functions::isUpdate($subscribe->updated_at);

            if ($is_update) {

                $status = 1;
                $msg = '操作成功';

            } else {

                $status = 0;
                $msg = '操作失败';

            }

        } else {

            $status = 0;
            $msg = '不能取消进行中的预约！！';

        }

        return response()->json(['status' => $status, 'msg' => $msg]);
    }


}
