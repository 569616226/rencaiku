<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\Models\Salary;
use App\Models\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class SettingController extends BaseController
{


    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private $setting;

    /**
     * SettingController constructor.
     * @param $setting
     */
    public function __construct()
    {
        parent::__construct();
        $this->setting = Setting::findOrFail(1);
    }


    /*系统设置*/
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $first_user = User::where('first', 1)->first();
        $last_user = User::where('last', 1)->first();

        if ($last_user && $last_user) {

            return view('setting.index', compact('first_user', 'last_user'));

        } elseif ($last_user) {

            return view('setting.index', compact('last_user'));

        } elseif ($last_user) {

            return view('setting.index', compact('first_user'));

        } else {

            return view('setting.index');

        }
    }

    /*访问权限设置*/
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function leader()
    {
        $see_all_datas = $this->get_users('see_all_data', 0)->count();
        $users = User::all()->count();
        $checked = false;

        if ($see_all_datas && $users == $see_all_datas) {

            $checked = true;

        }

        return view('setting.setting', compact('checked'));
    }

    /*设置访问权限*/
    /**
     * @param $flag
     * @return \Illuminate\Http\JsonResponse
     */
    public function setSeeing($flag)
    {
        $users = User::all();
        $x = 0;

        foreach ($users as $user) {

            if ($flag) {

                $user->see_all_data = 0;
                $user->save();

            } else {

                $user->see_all_data = 1;
                $user->save();

            }

            $is_update = Functions::isUpdate($user->updated_at);

            if ($is_update) {

                $x++;

            }
        }

        return response()->json($users->count() == $x ? ['msg' => '设置成功'] : ['msg' => '设置失败']);
    }

    /*设置审核人*/
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function settingUser(Request $request)
    {
        $first_id = $request->get('first_id');//第一审核人
        $last_id = $request->get('last_id');//面试官
        $user_first_olds = $this->get_users('first', 1);

        foreach ($user_first_olds as $user_first_old) {

            $user_first_old->first = 0;
            $user_first_old->save();

        }

        $user_last_olds = $this->get_users('last', 1);

        foreach ($user_last_olds as $user_last_old) {

            $user_last_old->last = 0;
            $user_last_old->save();

        }

        if ($first_id && $last_id && $this->get_users('last', 1)->count() == 0 && $this->get_users('first', 1)->count() == 0) {

            $user_first = User::find($first_id);
            $user_first->first = 1;
            $user_first->save();

            $user_last = User::find($last_id);
            $user_last->last = 1;
            $user_last->save();

            $is_update_first = Functions::isUpdate($user_first->updated_at);
            $is_update_last = Functions::isUpdate($user_last->updated_at);

            if ($is_update_first && $is_update_last) {

                $msg = '设置成功';

            } else {

                $msg = '设置失败';
            }

        } else {

            $msg = '设置失败';
        }

        return response()->json(['msg' => $msg]);
    }

    /*简历访问设置*/
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resume_setting()
    {

        $users = $this->get_users('see_resume', 1);

        return view('setting.resume_setting', compact('users'));

    }

    /*保存简历访问设置*/
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store_resume_setting(Request $request)
    {
        $userIds = $request->get('user_ids');
        $user_olds = $this->get_users('see_resume', 1);

        foreach ($user_olds as $user_old) {

            $user_old->see_resume = 0;
            $user_old->save();

        }

        if (count($userIds) !== 0) {

            if ($this->get_users('see_resume', 1)->count() == 0) {

                foreach ($userIds as $userId) {

                    $user = User::find($userId);
                    $user->see_resume = 1;
                    $user->save();

                }

                $user_new_counts = $this->get_users('see_resume', 1)->count();

                if ($user_new_counts == count($userIds)) {

                    $msg = '设置成功';

                } else {

                    $msg = '设置失败';

                }

            } else {

                $msg = '设置失败';

            }

        } else {

            $msg = '设置成功';
        }


        return response()->json(['msg' => $msg]);
    }

    /*admin访问设置*/
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function admin()
    {

        $users = $this->get_users('is_admin', 1);

        return view('setting.admin', compact('users'));

    }

    /*管理员设置*/
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store_admin(Request $request)
    {
        $userIds = $request->get('user_ids');
        $user_olds = $this->get_users('is_admin', 1);

        foreach ($user_olds as $user_old) {

            $user_old->is_admin = 0;
            $user_old->save();

        }

        if (count($userIds) !== 0) {

            if ($this->get_users('is_admin', 1)->count() == 0) {

                foreach ($userIds as $userId) {

                    $user = User::find($userId);
                    $user->is_admin = 1;
                    $user->save();

                }

                $user_new_counts = $this->get_users('is_admin', 1)->count();

                if ($user_new_counts == count($userIds)) {

                    $msg = '设置成功';

                } else {

                    $msg = '设置失败';

                }

            } else {

                $msg = '设置失败';

            }

        } else {

            $msg = '设置成功';
        }

        return response()->json(['msg' => $msg]);
    }

    /*获取用户数据*/
    /**
     * @param $type
     * @param $type_var
     * @return \Illuminate\Support\Collection
     */
    public function get_users($type, $type_var)
    {
        $users = User::where($type, $type_var)->get();

        return $users;
    }

    /*提醒设置*/
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function notice_index()
    {

        $user_fulls = $this->setting->full[1] ? User::whereIn('id', $this->setting->full[1])->get() : null;
        $user_agrees = $this->setting->renew[1] ? User::whereIn('id', $this->setting->renew[1])->get() : null;
        $user_years = $this->setting->year[1] ? User::whereIn('id', $this->setting->year[1])->get() : null;
        $user_birthdays = $this->setting->birthday[1] ? User::whereIn('id', $this->setting->birthday[1])->get() : null;
        $user_families = $this->setting->family_birthday[1] ? User::whereIn('id', $this->setting->family_birthday[1])->get() : null;

        $setting = $this->setting;

        return view('setting.notice',compact('setting','user_agrees','user_fulls','user_years','user_birthdays','user_families'));
    }

    /*提醒设置保存*/
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function notice_store(Request $request)
    {
        $data = $request->all(['full','year','birthday','renew','family_birthday']);

        try{

            $this->setting->update($data);

            return response()->json(['status' => true, 'msg' => '操作成功']);

        }catch (\Exception $e){

            report($e);

            return response()->json(['status' => false, 'msg' => '操作失败']);
        }
    }

    /*薪资查看设置*/
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function archive_index()
    {

        $users = $this->setting->archives ? User::whereIn('id', $this->setting->archives)->get() : null;

        return view('setting.archive',compact('users'));
    }

    /*薪资查看设置*/
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function archive_store(Request $request)
    {
        $archives = $request->get('archives');

        try{

            $this->setting->update(['archives' => $archives]);

            return response()->json(['status' => true, 'msg' => '操作成功']);

        }catch (\Exception $e){

            report($e);

            return response()->json(['status' => false, 'msg' => '操作失败']);
        }

    }

    /**
     * 同步设置页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sync()
    {

        $setting = $this->setting;
        $user_sync_last_date = Cache::get('user_sync_last_date');
        $sync_salary_date = Cache::get('sync_salary_date');
        $sync_work_date = Cache::get('sync_work_date');

        return view('setting.sync',compact('setting','sync_work_date','sync_salary_date','user_sync_last_date'));
    }

    /**
     * 同步设置保存
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sync_store(Request $request)
    {

        try{

            $this->setting->update(['sync' =>  $request->get('sync')]);

            return response()->json(['status' => true, 'msg' => '操作成功']);

        }catch (\Exception $e){

            report($e);

            return response()->json(['status' => false, 'msg' => '操作失败']);
        }
    }

    /**
     * 手动同步薪资
     * @return \Illuminate\Http\JsonResponse
     */
    public function sync_salary()
    {
        try{

          Functions::syncSalaryData();

            return response()->json(['status' => true, 'msg' => '同步成功']);

        }catch (\Exception $e){

            report($e);

            return response()->json(['status' => false, 'msg' => '同步失败']);
        }
    }


    /**
     * 手动同步岗位
     * @return \Illuminate\Http\JsonResponse
     */
    public function sync_pro()
    {
        try{

            Functions::syncWorkData();

            return response()->json(['status' => true, 'msg' => '同步成功']);

        }catch (\Exception $e){

            report($e);

            return response()->json(['status' => false, 'msg' => '同步失败']);
        }
    }

}
