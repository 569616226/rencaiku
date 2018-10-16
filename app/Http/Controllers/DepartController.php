<?php

namespace App\Http\Controllers;

use App\Http\Resources\User;
use App\Models\Depart;
use Illuminate\Http\Request;

class DepartController extends BaseController
{

    /**
     * CustomerController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*部门树形结构数据*/
    public function index()
    {
        return $this->get_depart_data();
    }

    /*带用户的 部门树形结构*/
    public function depart_user()
    {
        return $this->get_depart_data(true);
    }

    public function depart($depart_id)
    {
        $data = [];
        $array = [];
        $user_ids = [];
        $departs = Depart::with(['users'])->get();
        $depart_first = Depart::find($depart_id);


        foreach ($departs as $depart) {

            if ($depart_first->fid == 0) {

                $user_ids = array_merge($user_ids, $depart->users->pluck('id')->toArray());

            } else {

                /*公司通讯录四级树形获取数据*/
                $depart_parent = Depart::find($depart->fid);

                if ($depart->fid == $depart_id || $depart->id == $depart_id || $depart_parent && $depart_parent->fid == $depart_id) {

                    $user_ids = array_merge($user_ids, $depart->users->pluck('id')->toArray());

                }
            }
        }

        $users = \App\User::whereIn('id', $user_ids)->get();

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

    /**
     * 后去部门
     * @param $array
     * @return array
     */
    protected function get_depart_data($is_with_user = null)
    {
        $datas = [];
        $departs = Depart::with(['users'])->get();

        foreach ($departs as $depart) {

            $array['id'] = $depart->id;
            $array['prId'] = $depart->fid;
            $array['MaxId'] = $departs->max('id');
            $array['name'] = $depart->name;
            $array['icon'] = url('js/ztree/css/zTreeStyle/img/diy/wenjian.png');

            if ($depart->fid == 0) {

                $array['open'] = true;

            }

            array_push($datas, $array);

            /*返回部门下用户数据*/
            if ($is_with_user) {
                foreach ($depart->users ?? $depart->users as $user) {

                    $array['id'] = $user->id + $departs->max('id');
                    $array['prId'] = $depart->id;
//                    $array['MaxId'] = $departs->max('id');
                    $array['name'] = $user->name;
                    $array['icon'] = url('js/ztree/css/zTreeStyle/img/diy/user.png');

                    array_push($datas, $array);
                }
            }
        }

        return $datas;
    }

}
