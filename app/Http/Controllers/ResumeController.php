<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\Models\Resume;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ResumeController extends BaseController
{
    /**
     * ResumeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*简历*/
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('resume.index');
    }

    /*简历数据*/
    /**
     * @param bool $flag
     * @return string
     */
    public function all_data($flag = false)
    {
        $user = Functions::getLoginUser();

        if (Functions::seeData($user)) {

            $resumes = Resume::where('blacklist', 0)->get();

        } else {

            $resumes = Resume::where('blacklist', 0)->get();
            $resumes = Functions::get_resumes($resumes, $user);

        }

        return $this->get_all_data($resumes, $flag);
    }

    /*
     * get_all_data
     * */
    /**
     * @param $resumes
     * @param $flag
     * @return string
     */
    public function get_all_data($resumes, $flag)
    {
        $data = [];
        $array = [];
        $origin_id = '';

        foreach ($resumes as $resume) {

            $url = url('/resume/' . $resume->id . '/show');

            if ($flag) {

                if (!in_array(2, $resume->subscribes()->pluck('result')->toArray())) {/*通过面试的不能选择*/

                    array_unshift($array, [
                        '<div class="check-box" name="' . $resume->id . '"><img class="check" src="' . url('img/check.png') . '"/><img class="uncheck" src="' . url('img/uncheck.png') . '"/></div>',
                        '<a target="_blank" href="' . $url . '" >' . $resume->name . '</a>',
                        $resume->origin_id,
                        $resume->wechat_position,
                        $resume->work_experience,
                        $resume->sex,
                        $resume->education,
                        $resume->remark,
                        $resume->created_at->toDateTimeString(),
                        $resume->id,
                    ]);

                }

            } else {

                array_unshift($array, [
                    '<input type="checkbox" name="resume" value="' . $resume->id . '">',
                    '<a href="' . $url . '" target="_blank" >' . $resume->name . '</a>',
                    $resume->origin_id,
                    $resume->wechat_position,
                    $resume->work_experience,
                    $resume->sex,
                    $resume->education,
                    $resume->remark,
                    $resume->created_at->toDateTimeString(),
                    $resume->id,
                ]);
            }

        }

        $data['data'] = $array;

        return json_encode($data);
    }

    /*删除*/
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $resume = Resume::find($id);

        if ($resume->subscribes()->where('result', 2)->get()->isEmpty() && $resume->subscribes()->whereIn('status', [1, 2])->get()->isEmpty()) {/*只能删除没有通过和取消的预约的简历*/

            $resume->delete();

            $is_delete = Functions::isCreate(Resume::withTrashed(), $id);
            if ($is_delete) {

                $status = 1;
                $msg = '操作成功';

            } else {

                $status = 0;
                $msg = '操作失败';

            }

        } else {

            $status = 0;
            $msg = '不能删除预约中和面试通过的简历！';

        }

        return response()->json(['status' => $status, 'msg' => $msg]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get_remark($id)
    {
        $resume = $resume = Resume::find($id);

        return $resume->remark;
    }

    /*修改备注*/
    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function remark(Request $request, $id)
    {
        $remark = $request->get('remark');

        $resume = $resume = Resume::find($id);
        $resume->remark = $remark;
        $resume->update();

        $is_update = Functions::isUpdate($resume->updated_at);

        return response()->json($is_update ? ['status' => 1, 'msg' => '操作成功'] : ['status' => 0, 'msg' => '操作失败']);
    }

    /*黑名单*/
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function blacklist()
    {
        return view('resume.blacklist');
    }

    /*加入黑名单*/
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function black_in($id)
    {
        $resume = $resume = Resume::find($id);

        if ($resume->subscribes()->where('result', 2)->get()->isEmpty()
            && $resume->subscribes()->whereIn('status', [1, 2])->get()->isEmpty()) {/*只能删除没有通过和取消的预约的简历*/

            $resume->blacklist = 1;
            $resume->update();

            $is_update = Functions::isUpdate($resume->updated_at);
            if ($is_update) {
                $status = 1;
                $msg = '操作成功';
            } else {
                $status = 0;
                $msg = '操作失败';
            }

        } else {

            $status = 0;
            $msg = '不能拉黑预约中和通过面试的简历！';
        }

        return response()->json(['status' => $status, 'msg' => $msg]);
    }

    /*批量加入黑名单*/
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function black_in_all(Request $request)
    {
        $resume_ids = $request->get('resume_ids');
        $x = 0;

        foreach ($resume_ids as $resume_id) {

            $resume = $resume = Resume::find($resume_id);

            if ($resume->subscribes()->where('result', 2)->get()->isEmpty() && $resume->subscribes()->whereIn('status', [1, 2])->get()->isEmpty()) {/*只能删除没有通过和取消的预约的简历*/

                $resume->blacklist = 1;
                $resume->update();

                $is_update = Functions::isUpdate($resume->updated_at);
                $is_update ? $x++ : $x += 0;
            }
        }

        return response()->json(['status' => 1, 'msg' => '操作成功' . $x . '条数据']);
    }

    /*移除黑名单*/
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function black_out($id)
    {
        $resume = $resume = Resume::find($id);
        $resume->blacklist = 0;
        $resume->update();

        $is_update = Functions::isUpdate($resume->updated_at);

        return response()->json($is_update ? ['status' => 1, 'msg' => '操作成功'] : ['status' => 0, 'msg' => '操作失败']);
    }

    /*批量移除黑名单*/
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function black_out_all(Request $request)
    {
        $resume_ids = $request->get('resume_ids');
        $x = 0;

        foreach ($resume_ids as $resume_id) {

            $resume = $resume = Resume::find($resume_id);
            $resume->blacklist = 0;
            $resume->update();

            $is_update = Functions::isUpdate($resume->updated_at);
            $is_update ? $x++ : $x += 0;

        }

        return response()->json(['status' => 1, 'msg' => '操作成功' . $x . '条数据']);
    }

    /*黑名单*/
    /**
     * @return string
     */
    public function black_data()
    {

        $user = Functions::getLoginUser();

        if (Functions::seeData($user)) {

            $resumes = Resume::where('blacklist', 1)->get();

        } else {

            $resumes = Resume::where('blacklist', 1)->get();
            $resumes = Functions::get_resumes($resumes, $user);

        }

        return $this->get_all_data($resumes, false);
    }

    /*查看*/
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $resume = Resume::find($id);

        return view('resume.show', compact('resume'));
    }

    /** 导入简历* */
    public function import(Request $request)
    {
        $msg = '';
        $y = 0;
        $status = 0;
        $excelfiles = $request->file('files');

        foreach ($excelfiles as $excelfile) {

            $file_name = $excelfile->getClientOriginalName();

            $ext = substr($file_name, -3, 3);

            if ($ext === 'xls' || $ext === 'csv') {

                if ($excelfile) {
                    /*
                     * 上传文件
                     * return bool $reslut
                     * */
                    $name = $this->uploadFile($excelfile);

                    if (!$name) {

                        return response()->json(['status' => 0, 'msg' => '简历导入失败']);

                    }

                    //客户导入文件保存路径
                    $path = $this->getPath($name);

                    Excel::load($path, function ($reader) use (&$status, &$msg, &$y) {

                        $head = ['应聘职位', '姓名', '性别', '年龄', '民族', '籍贯', '现居地址', '身高', '出生日期',
                            '学历', 'email', '专业', '联系方式', '婚姻状况', '到岗日期', '期望薪资', '教育经历', '工作经历',
                            '语言能力', '兴趣爱好', '应聘渠道'
                        ];

                        $head_zt = ['姓名', '简历编号', '应聘职位', '应聘日期', '性别', '年龄',
                            '现居住地', '户口', '工作年限', '学历', '毕业学校', '专业', '联系电话',
                            '电子邮件', '地址', '最近一家公司', '最近一个职位', '目前月薪', '期望薪水', '求职状态'
                        ];

                        $head_zb = ['简历编号', '应聘职位', '应聘日期', '姓名（CN）', '姓名（EN）', '出生年月',
                            '性别', '年龄', '身高', 'Email', '手机号码', '最高学历', '最快到岗',
                            '现所在地', '户籍', '意向地区', '意向职位', '待遇要求', '最近毕业学校', '专业',
                            '工作经验', '最近公司（CN）', '最近公司（EN）', '最近职位', '语言能力'
                        ];

                        $origin_id = 0;//简历来源,0:智通，1：卓博;2:内部推荐；3：人才市场
                        $origin_no = '';
                        $local_no = '';
                        $wechat_position = '';
                        $name = '';
                        $age = '';
                        $sex = '';
                        $national = '';
                        $origin_aderss = '';
                        $aderss = '';
                        $marriage = '';
                        $height = '';
                        $education = '';
                        $email = '';
                        $tel = '';
                        $work_experience = '';
                        $evaluation = '';
                        $position = '';
                        $area = '';
                        $salary = '';
                        $fastest_date = '';
                        $Welfare = '';
                        $language = '';
                        $wrok_experiences = '';
                        $evaluations = '';

                        /*本地简历编号*/
                        $local = $this->getLocalNo();

                        $results = $reader->all()->toArray();/*获取所有数据*/

                        list($keys, $values) = array_divide($results[0][0]);

                        if ($keys === $head_zt) {

                            $origin_id = 0;

                        } elseif ($keys === $head_zb) {

                            $origin_id = 1;

                        } elseif ($keys === $head) {

                            if ($values[20] === '内部推荐') {

                                $origin_id = 2;

                            } else {

                                $origin_id = 3;

                            }

                        } else {

                            return response()->json(['status' => 0, 'msg' => '模板不对']);
                        }

                        if ($origin_id == 0) {//智通

                            $origin_no = $values[1];
                            $local_no = 'DHT' . $local;
                            $wechat_position = $values[2];
                            $name = $values[0];
                            $age = $values[5];
                            $sex = $values[4];
                            $origin_aderss = $values[7];
                            $aderss = $values[6];
                            $education = $values[9];
                            $email = $values[13];
                            $tel = $values[12];
                            $work_experience = $values[8];
                            $salary = $values[18];

                            foreach ($results[1] as $key => $row_datas) {

                                if (in_array('婚姻状况', $row_datas)) {

                                    $marriage = $row_datas[2];

                                } elseif (in_array('身高', $row_datas)) {

                                    $height = $row_datas[2];

                                } elseif (in_array('评价与技能', $row_datas)) {

                                    $evaluation = $row_datas[2];

                                } elseif (in_array('希望职位', $row_datas)) {

                                    $position = $row_datas[2];

                                } elseif (in_array('目标地点', $row_datas)) {

                                    $area = $row_datas[2];

                                } elseif (in_array('到岗时间', $row_datas)) {

                                    $fastest_date = $row_datas[2];

                                } elseif (in_array('工作经验', $row_datas)) {

                                    $wrok_experiences = str_replace('********************', '<div class="widget_hr_dotted"></div>', $row_datas[2]);

                                } elseif (in_array('教育经历', $row_datas)) {

                                    $evaluations = $row_datas[2];

                                } elseif (in_array('语言能力', $row_datas)) {

                                    foreach (explode('，', $row_datas[2]) as $lang) {

                                        if (substr_count($lang, '普通话') === 1) {

                                            $language .= '语言能力：&nbsp;&nbsp;普通话&nbsp;&nbsp;&nbsp;&nbsp;能力评价：' . mb_substr($lang, 3, null, 'utf-8') . '<br/><br/><div class="widget_hr_dotted"></div>';

                                        } elseif (substr_count($lang, '英语') === 1) {

                                            $language .= '语言能力：&nbsp;&nbsp;英语&nbsp;&nbsp;&nbsp;&nbsp;能力评价：' . mb_substr($lang, 2, null, 'utf-8') . '<br/><br/><div class="widget_hr_dotted"></div>';

                                        } elseif (substr_count($lang, '粤语') === 1) {

                                            $language .= '语言能力：&nbsp;&nbsp;粤语&nbsp;&nbsp;&nbsp;&nbsp;能力评价：' . mb_substr($lang, 2, null, 'utf-8') . '<br/><br/>';

                                        }
                                    }
                                }
                            }

                        } elseif ($origin_id == 1) {//卓博

                            $origin_no = $values[0];
                            $local_no = 'DHD' . $local;
                            $wechat_position = $values[1];
                            $name = $values[3];
                            $age = $values[7];
                            $sex = $values[6];
                            $origin_aderss = $values[14];
                            $aderss = $values[13];
                            $height = $values[8];
                            $education = $values[11];
                            $email = $values[9];
                            $tel = $values[10];
                            $work_experience = $values[20];
                            $position = $values[16];
                            $area = $values[15];
                            $salary = $values[17];
                            $fastest_date = $values[12];

                            foreach ($results[1] as $key => $row_datas) {

                                if (in_array('婚姻状况：', $row_datas)) {

                                    $marriage = $row_datas[1];

                                } elseif (in_array('教育', $row_datas)) {

                                    $row_data_keys = array_keys($row_datas);

                                    for ($x = 1; $results[1][$key + $x][$row_data_keys[0]] !== '工作经历'; $x++) {

                                        $evaluations .= $results[1][$key + $x][$row_data_keys[0]] . '&nbsp;&nbsp;';
                                        $evaluations .= $results[1][$key + $x][1];
                                        $evaluations .= '<br/><div class="widget_hr_dotted"></div>';
                                    }

                                } elseif (in_array('工作经历', $row_datas)) {

                                    $row_data_keys = array_keys($row_datas);

                                    if (in_array('项目经验', array_flatten($results[1]))) {

                                        for ($x = 1; $results[1][$key + $x][$row_data_keys[0]] !== '项目经验'; $x++) {

                                            $wrok_experiences .= $results[1][$key + $x][$row_data_keys[0]];
                                            $wrok_experiences .= $results[1][$key + $x][1];
                                            $wrok_experiences .= '<br/><br/>';

                                            if ($results[1][$key + $x][$row_data_keys[0]] === '离职原因：') {

                                                $wrok_experiences .= '<div class="widget_hr_dotted"></div>';

                                            }
                                        }

                                    } elseif (in_array('语言能力', array_flatten($results[1]))) {

                                        for ($x = 1; $results[1][$key + $x][$row_data_keys[0]] !== '语言能力'; $x++) {

                                            $wrok_experiences .= $results[1][$key + $x][$row_data_keys[0]];
                                            $wrok_experiences .= $results[1][$key + $x][1];
                                            $wrok_experiences .= '<br/><br/>';

                                            if ($results[1][$key + $x][$row_data_keys[0]] === '离职原因：') {

                                                $wrok_experiences .= '<div class="widget_hr_dotted"></div>';

                                            }
                                        }
                                    }

                                } elseif (in_array('语言能力', $row_datas)) {

                                    foreach (explode('，', $results[1][$key + 1][1]) as $lang) {

                                        if (substr_count($lang, '普通话') === 1) {

                                            $language .= '语言能力：&nbsp;&nbsp;普通话&nbsp;&nbsp;&nbsp;&nbsp;能力评价：' . mb_substr($lang, 3, null, 'utf-8') . '<br/><br/><div class="widget_hr_dotted"></div>';

                                        } elseif (substr_count($lang, '英语') === 1) {

                                            $language .= '语言能力：&nbsp;&nbsp;英语&nbsp;&nbsp;&nbsp;&nbsp;能力评价：' . mb_substr($lang, 2, null, 'utf-8') . '<br/><br/><div class="widget_hr_dotted"></div>';

                                        } elseif (substr_count($lang, '粤语') === 1) {

                                            $language .= '语言能力：&nbsp;&nbsp;粤语&nbsp;&nbsp;&nbsp;&nbsp;能力评价：' . mb_substr($lang, 2, null, 'utf-8') . '<br/><br/>';
                                        }
                                    }

                                } elseif (in_array('自我评述', $row_datas)) {

                                    $evaluation = $results[1][$key + 1][1];
                                }
                            }

                        } else {

                            $local_no = 'DHD' . $local;
                            $wechat_position = $values[0];
                            $name = $values[1];
                            $age = $values[3];
                            $sex = $values[2];
                            $origin_aderss = $values[5];
                            $aderss = $values[6];
                            $height = $values[7];
                            $education = $values[9];
                            $email = $values[10];
                            $tel = $values[12];
                            $work_experience = $values[11];
                            $position = '';
                            $area = '';
                            $salary = $values[15];
                            $fastest_date = $values[14];
                            $language = $values[18];
                            $wrok_experiences = $values[17];
                            $evaluations = $values[16];
                            $marriage = $values[13];
                        }

                        $is_empty = Resume::where('origin_no', $origin_no)->get()->isEmpty();

                        if ($is_empty) {

                            $resume = new Resume();
                            $resume->origin_id = $origin_id;//简历来源,0:智通，1：卓博
                            $resume->origin_no = $origin_no;
                            $resume->local_no = $local_no;
                            $resume->wechat_position = $wechat_position;
                            $resume->name = $name;
                            $resume->age = $age;
                            $resume->sex = $sex;
                            $resume->national = $national;
                            $resume->origin_aderss = $origin_aderss;
                            $resume->aderss = $aderss;
                            $resume->marriage = $marriage;
                            $resume->height = $height;
                            $resume->work_experience = $work_experience;
                            $resume->evaluation = $evaluation;
                            $resume->education = $education;
                            $resume->email = $email;
                            $resume->tel = $tel;
                            $resume->position = $position;
                            $resume->area = $area;
                            $resume->salary = $salary;
                            $resume->fastest_date = $fastest_date;
                            $resume->lang = htmlentities(addslashes($language));
                            $resume->wrok_experiences = htmlentities(addslashes($wrok_experiences));
                            $resume->evaluations = htmlentities(addslashes($evaluations));
                            $resume->save();

                            $is_create = Functions::isCreate(Resume::all(), $resume->id);

                            if ($is_create) {

                                $y++;

                            } else {

                                $msg = '简历导入失败';
                                $status = 0;

                            }

                        } else {

                            $msg = "简历:" . $origin_no . "已存在";
                            $status = 0;

                        }

                        if ($y) {

                            $msg = '简历导入' . $y . '份简历';
                            $status = 1;

                        }

                    });

                } else {

                    $msg = '请选择文件';
                    $status = 0;
                }

            } else {

                $msg = '模板不对';
                $status = 0;

            }
        }
        return response()->json(['status' => $status, 'msg' => $msg]);
    }

    /** 导出客户* */
    public function export()
    {
        $users = Resume::all();
        $cellData = [
            ['企业名称', '地址', '传真', '海关识别码', '贸易方式', '营业期限', 'AEO认证', '加工贸易手册管理方式', '主要进出口贸易方式', '生产项目类别', '注册资本', '企业性质', '成立日期'],
        ];
        foreach ($users as $user) {

            $userData = [$user->name, $user->address, $user->fax, $user->code, $user->trade, $user->end_date,
                $user->aeo, $user->trade_manual, $user->main_trade, $user->pro_item_type, $user->capital,
                $user->company_type, $user->create_date,];
            array_push($cellData, $userData);
        }

        $name = iconv('UTF-8', 'GBK', '客户数据' . $this->getTime());//文件名称
        $dir = $this->getDir() . '/exports/';//导出客户文件保存路径

        Excel::create($name, function ($excel) use ($cellData) {

            $excel->sheet('score', function ($sheet) use ($cellData) {
                $sheet->rows($cellData);
            });

        })->store('xls', $dir)->export('xls');
    }

    /*
     * 上传文件到本地服务器
     * return bool $exists
    */
    /**
     * @param $excelfile
     * @return bool|string
     */
    public function uploadFile($excelfile)
    {
        $original_name = $excelfile->getClientOriginalName();
        $filename = (substr($original_name, 0, strlen($original_name) - 4));
        $ext = substr($original_name, -3);
        $name = false;

        /*文件是否存在*/
        $exist_files = Storage::disk('local')->exists('resumes/imports/' . $original_name);

        if ($exist_files) {

            $file_name = $this->createUniqueFilename($filename);

            /*上传文件*/
            $excelfile->storeAs('resumes/imports/', $file_name . '.' . $ext);

            /*文件是否存在*/
            Storage::disk('local')->exists('resumes/imports/' . $file_name . '.' . $ext);

            $name = $file_name . '.' . $ext;

        } else {

            /*上传文件*/
            $excelfile->storeAs('resumes/imports/', $original_name);

            /*文件是否存在*/
            Storage::disk('local')->exists('resumes/imports/' . $original_name);

            $name = $original_name;
        }

        return $name;
    }

    /*
     * 获取上传目录
     *
     * return string $dir
     * */
    /**
     * @return string
     */
    public function getDir()
    {
        $dir = storage_path() . '/app/resumes/';

        return $dir;
    }

    /*
      * 获取上传文件的路径
      * return bool $path
      * */
    /**
     * @param $file_name
     * @return string
     */
    public function getPath($file_name)
    {
        $path = $this->getDir() . '/imports/' . $file_name;
        return $path;
    }

    /*
     * 获取当前时间
     *
     * return string $time
     *
     * */
    /**
     * @return string
     */
    public function getTime()
    {
        $time = Carbon::now()->year . Carbon::now()->month . Carbon::now()->day . Carbon::now()->hour . Carbon::now()->minute . Carbon::now()->second;
        return $time;
    }

    /**
     * @param $filename
     * @return string
     */
    private function createUniqueFilename($filename)
    {
        // Generate token for image
        $image_token = substr(sha1(mt_rand()), 0, 5);

        return $filename . '-' . $image_token;

    }

    /*
     * 生成简历编码
     * */
    /**
     * @return string
     */
    public function getLocalNo()
    {
        $local_no = Carbon::now()->year . Carbon::now()->month . Carbon::now()->day . rand(1, 999);
        return $local_no;
    }
}
