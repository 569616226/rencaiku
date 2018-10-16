<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\Models\Archive;
use App\Models\Depart;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*管理用户信息*/

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $latest = Cache::get('user_sync_last_date');/*最新更新*/

        return view('personnel.index', compact('latest'));
    }

    /*用户列表 */
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function user_lists()
    {
        $users = User::all();
        $html = '';

        foreach ($users as $user) {

            $html .= '<option value="' . $user->id . '">' . $user->name . '</option>';

        }

        return response()->json(['html' => $html]);
    }

    /*审核人信息*/
    /**
     * @param $id
     * @param string $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function data($id, $name = 'user_id')
    {
        $user = User::find($id);
        $html = '<div class="approver listapp"><div class="approver_o"><i  onclick="deletefun(this)" class="iconfont" >&#xe634;</i><input type="hidden"  name="' . $name . '" value="' . $user->id . '" ><img src="'
            . $user->avatar . '" class="img-responsive"><p>'
            . $user->name
            . '</p></div><div class="approver_di">···</div></div>';

        return response()->json(['html' => $html]);
    }

    /*用户列表 */
    /**
     * @return string
     */
    public function all_data()
    {
        $users = User::all();

        $data = [];
        $array = [];

        foreach ($users as $user) {

            array_unshift($array, [
                '<img src=' . $user->avatar . ' class="img-responsive" width=60 />',
                $user->name,
                $user->created_at->toDateTimeString(),
            ]);

        }

        $data['data'] = $array;

        return json_encode($data);
    }


    /*同步管理用户信息*/
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function sync()
    {

        /*应用可见用户范围id*/
        $app = Functions::getApp();
//        $userids = array_flatten($app['allow_userinfos']['user']);//可见用户
        $partyids = array_flatten($app['allow_partys']['partyid']);//可见部门
        $user_wechat_ids = [];//公司所有用户
//        $user_ids = [];//公司所有用户

        /*同步部门*/
        $this->depart();
        $departs = Depart::all();

        try {

            DB::beginTransaction();

            foreach ($departs as $depart) {

                if (in_array($depart->id, $partyids) || in_array(1, $partyids)) {

                    $depart_users = Functions::getDepartmentUser($depart->wechat_depart_id);

                    if ($depart_users) {
                        $user_wechat_ids = array_merge($user_wechat_ids, array_pluck($depart_users, 'userid'));//循环获取用户wechat_id
//                        $user_ids = array_merge($user_ids,User::whereIn('user_wechat_id',$user_wechat_ids)->get()->pluck('id')->toArray());//循环获取用户id

                        foreach ($depart_users as $depart_user) {

                            $is_in = User::withTrashed()->where('user_wechat_id', $depart_user['userid'])->get()->isEmpty();

                            if ($depart_user['gender'] == 1) {//企业微信1是男，2是女
                                $gender = 0;
                            } elseif ($depart_user['gender'] == 2) {
                                $gender = 1;
                            }

                            $arr = [
                                'user_wechat_id' => $depart_user['userid'],
                                'name'           => $depart_user['name'],
                                'avatar'         => $depart_user['avatar'],
                                'tel'            => $depart_user['mobile'],
                                'email'          => $depart_user['email'],
                                'position'       => $depart_user['position'],
                                'gender'         => $gender,
                            ];

                            if ($is_in) {//如果存在

                                $user = User::create($arr);

                                $user->departs()->attach($depart->id);

                            } else {

                                $ids = Archive::with('user')->get()->pluck('user_id')->toArray();
                                $user_old = User::withTrashed()->where('user_wechat_id', $depart_user['userid'])->first();

                                if(in_array($user_old->id,$ids)){

                                    $offer_status = $user_old->archive->offer_status;

                                    if($offer_status != 0 ){

                                        $this->update_user_data($user_old, $arr, $depart);
                                    }
                                }else{
                                    $this->update_user_data($user_old, $arr, $depart);
                                }

                            }
                        }
                    }
                }
            }


            /*删除*/
            User::when(count($user_wechat_ids), function ($item) use ($user_wechat_ids) {
                $item->whereNotIn('user_wechat_id', $user_wechat_ids);
            })->get();

//            foreach ($users as $user) {
//                $user->departs()->detach();
//            }

            User::when(count($user_wechat_ids), function ($item) use ($user_wechat_ids) {
                $item->whereNotIn('user_wechat_id', $user_wechat_ids);
            })->delete();

            DB::commit();

            Cache::forever('user_sync_last_date',now()->toDateTimeString());

            return response()->json(['status' => 1, 'msg' => '同步成功']);

        } catch (\Exception $exception) {

            report($exception);

            DB::rollBack();

            return response()->json(['status' => 0, 'msg' => '用户同步失败']);
        }

    }

    /*获取部门*/
    /**
     *
     */
    public function depart()
    {

        $departs = Functions::getDeparts();

        foreach ($departs as $depart) {/*增加新部门*/

            $depart_old = Depart::where('wechat_depart_id', $depart['id'])->get()->isEmpty();

            if ($depart_old) {

                $depart_old = new Depart();
                $depart_old->wechat_depart_id = $depart['id'];
                $depart_old->fid = $depart['parentid'];
                $depart_old->name = $depart['name'];
                $depart_old->save();

            }else{
                $depart_old = Depart::where('wechat_depart_id', $depart['id'])->first();
                $depart_old->wechat_depart_id = $depart['id'];
                $depart_old->fid = $depart['parentid'];
                $depart_old->name = $depart['name'];
                $depart_old->save();
            }
        }

    }

    /*获取部门内成员*/
    /**
     * @param $department_id
     * @return bool
     */
    public function members($department_id)
    {

        $members = Functions::getDepartmentUser($department_id);

        return $members;
    }

    /**
     * 更新员工数据
     * @param $user_old
     * @param $arr
     * @param $depart
     * @return array
     */
    protected function update_user_data($user_old, $arr, $depart)
    {
        if (optional($user_old->deleted_at)->timestamp) {//恢复删除的员工

            $user_old->restore();

        }

        $user_old->update($arr);

        /*加入另一个部门*/
        if (!in_array($depart->id, $user_old->departs->pluck('id')->toArray())) {

            $user_old->departs()->attach($depart->id);
        }

    }

}
