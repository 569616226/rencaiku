<?php

namespace App\Http\Controllers\Mobile;

use App\Helpers\Functions;
use App\Http\Controllers\BaseController;
use App\Models\Depart;
use App\Models\Resume;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResumeController extends BaseController
{

    /**
     * DepartController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }


    /*首页*/
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $local_user = Functions::getLoginUser();
        if( in_array($local_user->user_wechat_id, config('system.admin_user'))){
            return view('mobile.resume.index');
        }else{
//            print ('您没有权限使用该应用！！！');
            return view('auth.index');
        }

    }

    /*简历数据*/
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function all_data(Request $request)
    {
        $last = $request->get('last');
        $amount = $request->get('amount');

        $user = Functions::getLoginUser();

        if (Functions::seeData($user)) {

            $resumes = Resume::where('blacklist', 0)
                ->offset($last)
                ->limit($amount)
                ->get();

        } else {

            $resumes = Resume::where('blacklist', 0)
                ->offset($last)
                ->limit($amount)
                ->get();

            $resumes = Functions::get_resumes($resumes, $user);

        }

        $array = [];

        foreach ($resumes as $resume) {

            /*头像*/
            $img = $resume->sex === '男' ? url('img/boy.png') : url('img/girl.png');
            $origin_id = '智通';

            if ($resume->origin_id == 0) {

                $origin_id = '智通';

            } elseif ($resume->origin_id == 1) {

                $origin_id = '卓博';

            } elseif ($resume->origin_id == 2) {

                $origin_id = '内部推荐';

            } else {

                $origin_id = '人才市场';

            }

            $html = '<a href="' . url('/mobile/resume/' . $resume->id . '/show') . '"
                        <div class="inner-settings-item flexbox">
                            <div class="avator"> 
                                <img src="' . $img . '"> 
                            </div>
                            <div class="title description_title flexItem">
                                <p class="name">' . $resume->name . '·' . $resume->wechat_position . '</p>
                                <p class="description description_ellipsis"> 
                                    <span>年限：' . $resume->work_experience . '丨 来源：' . $origin_id . '   </span> 
                                </p>
                            </div>
                        </div>
                    </a>';

            array_unshift($array, ["info" => $html]);
        }


        return response()->json(['data' => $array]);
    }

    /*搜索*/
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $keyWord = $request->get('keyWord');

        $origin = $request->get('origin');
        $sex = $request->get('sex');
        $education = $request->get('educationLevel');
        $workingYears = $request->get('workingYears');
        $position = $request->get('position');

        $user = Functions::getLoginUser();

        if (Functions::seeData($user)) {

            $resumes = $this->get_serche_data($keyWord, $origin, $sex, $education, $workingYears, $position);

        } else {

            $resumes = $this->get_serche_data($keyWord, $origin, $sex, $education, $workingYears, $position);

            $resumes = Functions::get_resumes($resumes, $user);

        }

        return view('mobile.resume.search', compact('resumes'));
    }

    /*查询数据*/
    /**
     * @param $keyWord
     * @param $origin
     * @param $sex
     * @param $education
     * @param $workingYears
     * @param $position
     * @return null
     */
    public function get_serche_data($keyWord, $origin, $sex, $education, $workingYears, $position)
    {
        $resumes = null;

        if (strlen($keyWord)) {

            $resumes = Resume::where(function ($query) use ($keyWord) {

                $query->where('wechat_position', 'LIKE', '%' . $keyWord . '%')
                    ->orwhere('name', 'LIKE', '%' . $keyWord . '%');

            })->get();

        } else {

            if ($origin !== null) {

                $resumes = Resume::where('origin_id', $origin);

            }

            if ($sex) {

                if ($resumes) {

                    $resumes = $resumes->where('sex', $sex);

                } else {

                    $resumes = Resume::where('sex', $sex);

                }
            }

            if ($education) {

                if ($resumes) {

                    $resumes = $resumes->where('education', $education);

                } else {

                    $resumes = Resume::where('education', $education);

                }

            }

            if ($workingYears) {

                if ($resumes) {

                    $resumes = $resumes->where('work_experience', 'LIKE', $workingYears . '%');

                } else {

                    $resumes = Resume::where('work_experience', 'LIKE', $workingYears . '%');

                }

            }

            if ($position) {

                if ($resumes) {

                    $resumes = $resumes->where('position', 'LIKE', '%' . $position . '%');

                } else {

                    $resumes = Resume::where('position', 'LIKE', '%' . $position . '%');

                }
            }

            if ($resumes) {

                $resumes = $resumes->get();

            } else {

                $resumes = Resume::where('blacklist', 0)->get();

            }

        }

        return $resumes;
    }

    /*详情*/
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $resume = Resume::find($id);

        $resume = Functions::rebulid_resume($resume);

        return view('mobile.resume.show', compact('resume'));
    }
}
