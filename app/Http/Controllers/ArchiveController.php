<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\Models\Agreement;
use App\Models\Archive;
use App\Models\Image;
use App\Models\Warns;
use App\User;
use Illuminate\Support\Facades\Input;
use App\Models\Depart;
use App\Models\Education;
use App\Models\Promotion;
use App\Models\Resume;
use App\Models\Family;
use App\Models\Salary;
use App\Models\Sanction;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\Archive as ArchiveResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;

class ArchiveController extends BaseController
{

    /**
     * CustomerController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('archive.index');
    }

    public function on()
    {
        return view('archive.on');
    }

    public function off()
    {
        return view('archive.off');
    }

    /**
     * 在职员工档案数据
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function on_data()
    {
        $users = User::with(['archive'])->where('user_wechat_id', '!=', 'HanBin')->latest()->get();

//        $archive = Archive::where('offer_status','!=',0)->orderBy('offer_on_date','desc')->get();


        return \App\Http\Resources\User::collection($users);

    }

    /**
     * 离职档案员工数据
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function off_data()
    {
        $archive = Archive::where('offer_status', 0)->orderBy('offer_off_date','desc')->get();

        return ArchiveResource::collection($archive);
    }


    /**
     * 创建
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(User $user)
    {

        try {

            $resume = Resume::where('tel', $user->tel)->firstOrFail();

            return view('archive.edit.index', compact('resume', 'user'));

        } catch (\Exception $e) {

            report($e);

            return view('archive.edit.index', compact('user'));
        }

    }

    /**
     * 保存
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Archive $archive = null)
    {
        $offer_depart = $request->get('offer_depart');
        $offer_name = $request->get('offer_name');
        $offer_on_date = $request->get('offer_on_date');
        $offer_des = htmlentities(addslashes($request->get('offer_des')));
        $internal = $request->get('internal') == 'NaN' ? null : $request->get('internal');

        if ($archive) {

            try {

                $archive->update(array_merge(array_except($request->all(), ['offer_des', 'user_id','offer_depart']), ['offer_des' => $offer_des,'internal'=>$internal ]));

                $archive->user->departs()->sync($offer_depart);

                return response()->json(['status' => true, 'msg' => '操作成功', 'archive_id' => $archive->id]);

            } catch (\Exception $e) {

                report($e);

                return response()->json(['status' => false, 'msg' => '操作失败']);
            }

        } else {

            try {

                $archive = Archive::create(array_merge(array_except($request->all(), ['offer_des','offer_depart']), ['offer_des' => $offer_des,'internal'=>$internal]));
                $archive->user->departs()->sync($offer_depart);

                Promotion::create([
                    'type' => 4,//入职
                    'sp_num' => '入职',
                    'new_offer' => $offer_name,
                    'new_depart' => Functions::getDepartName($archive->user->departs->pluck('id')->toArray()) ,
                    'chang_at' => $offer_on_date,//转换时间
                    'remark' => '入职',
                    'archive_id' => $archive->id,
                    'created_at' => now()
                ]);

                Functions::notice_birthday_message($archive);//新入职员工提醒

                /*记录入职*/
                Functions::create_archive_log('入职', $archive, '加入公司', $archive->offer_on_date->toDateString());

                return response()->json(['status' => true, 'msg' => '操作成功', 'archive_id' => $archive->id]);

            } catch (\Exception $e) {

                report($e);

                return response()->json(['status' => false, 'msg' => '操作失败']);
            }
        }

    }

    /**
     * 编辑
     * @param Archive $archive
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Archive $archive)
    {
        $archive = Functions::archiveFormat($archive);


        return view('archive.edit.index', compact('archive'));
    }


    /**
     * 编辑
     * @param Archive $archive
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit_archive(Archive $archive)
    {
        $families = Family::with('archive')->where('archive_id', $archive->id)->get();
        $agrees = Agreement::with('archive')->where('archive_id', $archive->id)->get();
        $educations = Education::with('archive')->where('archive_id', $archive->id)->get();
        $works = Work::with('archive')->where('archive_id', $archive->id)->get();
        $promotions = Promotion::with('archive')->where('archive_id', $archive->id)->get();
        $sanctions = Sanction::with('archive')->where('archive_id', $archive->id)->get();

        $archive = Functions::archiveFormat($archive);//格式化档案数据

        $opt = '';
        $departs = Depart::all();

        foreach ($departs as $depart) {

            $opt .= '<option value="' . $depart->id . '">' . $depart->name . '</option>';

        }

        return view('archive.edit.archive', compact('families', 'agrees', 'educations', 'works', 'promotions', 'sanctions', 'archive', 'opt'));
    }


    /**
     * 更新
     * @param Archive $archive
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update_archive(Archive $archive, Request $request)
    {

        $status = true;
        $msg = '操作成功';

        $families = $request->get('families');
        $agrees = $request->get('agrees');
        $educations = $request->get('educations');
        $works = $request->get('works');
        $promotions = $request->get('promotions');
        $sanctions = $request->get('sanctions');
        $family_discrible = $request->get('family_discrible');

        try {

            DB::beginTransaction();

            $archive->update(['family_discrible' => $family_discrible]);//更新家庭情况

            DB::commit();

        } catch (\Exception $e) {

            report($e);

            $status = false;
            $msg = '家庭情况数据更新错误';
        }

        //需要增加事务回滚功能
        if ($families) {//新增更新家庭关系

            try {

                DB::beginTransaction();

                foreach ($families as $family) {

                    if ($family["id"]) {

                        Family::find($family["id"])->update($family);

                    } else {

                        $fam = Family::create(array_merge($family, ['archive_id' => $archive->id]));

                        Functions::notice_families_message($fam);

                    }
                }

                $archive->families->isEmpty() ? null : $archive->families()->whereNotIn('id', array_pluck($families, 'id'))->delete();


                DB::commit();

            } catch (\Exception $e) {

                DB::rollBack();
                report($e);

                $status = false;
                $msg = '家庭关系更新错误';
            }


        } else {

            try {

                $archive->families->isEmpty() ? null : $archive->families()->delete();

            } catch (\Exception $e) {

                report($e);

                $status = false;
                $msg = '家庭关系删除错误';
            }

        }


        if ($agrees) {//新增更新合同
            try {

                DB::beginTransaction();

                foreach ($agrees as $agree) {

                    if ($agree['id']) {

                        Agreement::find($agree['id'])->update($agree);

                    } else {

                        Agreement::create(array_merge($agree, ['archive_id' => $archive->id]));

                        $agree = $archive->agreements()->latest()->first();
                        $warn = Warns::whereType(3)->whereStatus(0)->where('agree_id', $agree->id)->get();

                        if (!$warn->isEmpty()) {
                            $warn->first()->update(['status' => 1]);
                        }
                    }
                }

                $archive->agreements->isEmpty() ? null : $archive->agreements()->whereNotIn('id', array_pluck($agrees, 'id'))->delete();

                DB::commit();

            } catch (\Exception $e) {

                DB::rollBack();
                report($e);

                $status = false;
                $msg = '合同更新错误';
            }


        } else {

            try {

                $archive->agreements->isEmpty() ? null : $archive->agreements()->delete();

            } catch (\Exception $e) {

                report($e);

                $status = false;
                $msg = '合同删除错误';
            }

        }


        if ($educations) {//新增更新教育经历
            try {

                DB::beginTransaction();

                foreach ($educations as $education) {

                    if ($education['id']) {

                        Education::find($education['id'])->update($education);

                    } else {

                        Education::create(array_merge($education, ['archive_id' => $archive->id]));

                    }
                }

                $archive->educations->isEmpty() ? null : $archive->educations()->whereNotIn('id', array_pluck($educations, 'id'))->delete();

                DB::commit();


            } catch (\Exception $e) {

                DB::rollBack();
                report($e);

                $status = false;
                $msg = '教育经历更新错误';

            }

        } else {

            try {

                $archive->educations->isEmpty() ? null : $archive->educations()->delete();

            } catch (\Exception $e) {

                report($e);

                $status = false;
                $msg = '教育经历删除错误';
            }

        }


        if ($works) {//新增更新工作经历
            try {

                DB::beginTransaction();

                foreach ($works as $work) {

                    if ($work['id']) {

                        Work::find($work['id'])->update($work);

                    } else {

                        Work::create(array_merge($work, ['archive_id' => $archive->id]));

                    }
                }

                $archive->works->isEmpty() ? null : $archive->works()->whereNotIn('id', array_pluck($works, 'id'))->delete();

                DB::commit();

            } catch (\Exception $e) {

                DB::rollBack();
                report($e);

                $status = false;
                $msg = '工作经历更新错误';
            }

        } else {

            try {

                $archive->works->isEmpty() ? null : $archive->works()->delete();

            } catch (\Exception $e) {

                report($e);

                $status = false;
                $msg = '工作经历删除错误';
            }

        }

        if ($sanctions) {//新增更新奖惩记录

            try {
                DB::beginTransaction();

                foreach ($sanctions as $sanction) {

                    if ($sanction['id']) {

                        Sanction::find($sanction['id'])->update($sanction);

                    } else {

                        Sanction::create(array_merge($sanction, ['archive_id' => $archive->id]));

                        /*奖惩记录*/
                        if ($sanction['type'] == 0) {

                            $type = '奖励';
                            $content = '获得'.$sanction['name'].'，备注：' . $sanction['remark'];

                        } elseif ($sanction['type'] == 1) {

                            $type = '惩罚';
                            $content = '获得'.$sanction['name'].'，备注：' . $sanction['remark'];

                        } elseif ($sanction['type'] == 2) {

                            $type = '荣誉';
                            $content = '获得'.$sanction['name'].'，备注：' . $sanction['remark'];
                        }
                        /*记录奖惩记录*/
                        Functions::create_archive_log($type, $archive, $content, $sanction['execute_at']);
                    }
                }

                $archive->sanctions->isEmpty() ? null : $archive->sanctions()->whereNotIn('id', array_pluck($sanctions, 'id'))->delete();

                DB::commit();

            } catch (\Exception $e) {

                DB::rollBack();
                report($e);

                $status = false;
                $msg = '奖惩记录更新错误';
            }

        } else {

            try {

                $archive->sanctions->isEmpty() ? null : $archive->sanctions()->delete();

            } catch (\Exception $e) {

                report($e);

                $status = false;
                $msg = '奖惩记录删除错误';
            }

        }


        if ($promotions) {//新增更新升迁记录
            try {

                DB::beginTransaction();

                foreach ($promotions as $promotion) {

                    if ($promotion['id']) {

                        Promotion::find($promotion['id'])->update($promotion);

                    } else {

                        Promotion::create(array_merge($promotion, ['archive_id' => $archive->id]));

                    }

                    Functions::create_pro_log($promotion,$archive);

                }

                $archive->promotions->isEmpty() ? null : $archive->promotions()->whereNotIn('id', array_pluck($promotions, 'id'))->delete();

                DB::commit();


            } catch (\Exception $e) {

                DB::rollBack();
                report($e);

                $status = false;
                $msg = '升迁记录更新错误';
            }

        } else {

            try {

                $archive->promotions->isEmpty() ? null : $archive->promotions()->delete();

            } catch (\Exception $e) {

                report($e);

                $status = false;
                $msg = '升迁记录删除错误';
            }

        }

        return response()->json(['status' => $status, 'msg' => $msg]);
    }


    /**
     * 离职
     * @param Archive $archive
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function offer_off(Archive $archive)
    {

        try {
            DB::beginTransaction();

            $data = [
                'offer_status'   => 0,
                'offer_off_date' => request('offer_off_date'),
            ];

            $data = request('offer_off_reason') ? array_merge($data, ['offer_off_reason' => request('offer_off_reason')]) : $data;

            $archive->update($data);

//            $user_offs = User::all()->filter(function ($query) {//自动删除离职人员账号
//
//                return $query->archive && $query->archive->offer_status == 0;
//            });
//            User::whereIn('id', $user_offs->pluck('id')->toArray())->delete();
//            Functions::delWechatUser($archive->user->user->wechat_id);//删除企业微信成员

            $archive->user()->delete();

            /*记录离职*/
            Functions::create_archive_log('离职', $archive, '从公司离职', $archive->offer_off_date->toDateString());

            DB::commit();

            return response()->json(['status' => true, 'msg' => '操作成功']);

        } catch (\Exception $exception) {

            DB::rollBack();
            report($exception);

            return response()->json(['status' => false, 'msg' => '操作失败']);
        }
    }

    /**
     * 转正
     * @param Archive $archive
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function offer_on(Archive $archive)
    {
        try {

            $archive->update(['offer_status' => 1]);

            $warn = $archive->warns ? $archive->warns()->whereType(1)->whereStatus(0)->whereDate('warn_date', $archive->offer_date->toDateString())->first() : null;

            if ($warn)
                $warn->update(['status' => 1]);


            /*记录转正*/
            Functions::create_archive_log('转正', $archive, '由试用期员工转正为正式员工', $archive->offer_date->toDateString());

            return response()->json(['status' => true, 'msg' => '操作成功']);

        } catch (\Exception $exception) {

            report($exception);

            return response()->json(['status' => false, 'msg' => '操作失败']);
        }
    }

    /**
     * 延长试用期
     * @param Archive $archive
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function training(Archive $archive, Request $request)
    {
        $offer_date = $request->get('offer_date');

        try {

            $archive->update(['offer_date' => $archive->offer_date->addMonths($offer_date)]);

            /*延长试用期*/
            Functions::create_archive_log('延长试用期', $archive, '延长试用期(' . $offer_date . ')个月',  $archive->offer_date->toDateString());

            return response()->json(['status' => true, 'msg' => '操作成功']);

        } catch (\Exception $exception) {

            report($exception);

            return response()->json(['status' => false, 'msg' => '操作失败']);
        }
    }

    /**
     * 复职页面
     * @param Archive $archive
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getReOffer(Archive $archive)
    {
        return view('archive.reOffer', compact('archive'));
    }

    /**
     * 复职
     * @param Archive $archive
     * @return \Illuminate\Http\JsonResponse
     */
    public function reOffer(Archive $archive, Request $request)
    {
        $offer_datas = $request->all(['offer_status', 'offer_depart', 'offer_name', 'offer_on_date', 'offer_date']);

        try {

            $offer_datas['offer_depart'] = [$offer_datas['offer_depart']];

            if (!$offer_datas['offer_date']) {
                $offer_datas = array_except($offer_datas, ['offer_date']);
            }

            $archive->update($offer_datas);

            $user_reOffers = User::onlyTrashed()->get()->filter(function ($query) {//自动恢复复职人员账号

                return $query->archive && $query->archive->offer_status > 0;

            });

            User::onlyTrashed()->whereIn('id', $user_reOffers->pluck('id')->toArray())->restore();

            /*记录离职*/
            Functions::create_archive_log('复职', $archive, '复职为' . $archive->offer_name, $archive->offer_on_date->toDateString());

            return response()->json(['status' => true, 'msg' => '操作成功']);

        } catch (\Exception $exception) {

            report($exception);

            return response()->json(['status' => false, 'msg' => '操作失败']);
        }
    }


    /**
     * 提醒完成
     * @param Warns $warns
     * @return \Illuminate\Http\JsonResponse
     */
    public static function complate(Warns $warns)
    {
        try {

            $warns->update(['status' => 1]);

            return response()->json(['status' => true, 'msg' => '操作成功']);

        } catch (\Exception $exception) {

            report($exception);

            return response()->json(['status' => false, 'msg' => '操作失败']);
        }
    }

    /**
     * 查看
     * @param Archive $archive
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Archive $archive)
    {
        $archive = Functions::archiveFormat($archive);

        return view('archive.show', compact('archive'));
    }

    /**
     * 删除
     * @param Archive $archive
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destory(Archive $archive)
    {

        try {

            $archive->delete();

            return response()->json(['status' => true, 'msg' => '操作成功']);

        } catch (\Exception $exception) {

            report($exception);

            return response()->json(['status' => false, 'msg' => '操作失败']);
        }
    }

    /**
     * 七天转正
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forOnNotice()
    {
        return view('archive.notice.on', compact('archives'));
    }

    /**
     * 家属生日
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forFamiliesBirthdayNotice()
    {
        return view('archive.notice.familiesBirthday');
    }

    /**
     * 员工生日
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forBirthdayNotice()
    {
        return view('archive.notice.birthday');
    }

    /**
     * 周年
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forYearNotice()
    {
        return view('archive.notice.year');
    }

    /**
     * 合同
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forAgreementsNotice()
    {
        return view('archive.notice.agreements');
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
    *
    * */
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload()
    {

        $username = '/uploads/avater/';//目录路径
        $photo_data = Input::all();
        $validator = Validator::make($photo_data, Image::$rules, Image::$messages);

        if ($validator->fails()) {

            return response()->json(['status' => false, 'message' => $validator->messages()->first()]);

        }

        return Functions::upload($photo_data, $username);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCrop()
    {

        $username = '/uploads/avater/';//目录路径
        $form_data = Input::all();

        $image_url = $form_data['photo'];

        $imgW = $form_data['width'];
        $imgH = $form_data['height'];
        $imgX1 = $form_data['x'];
        $imgY1 = $form_data['y'];
        $cropW = $form_data['w'];
        $cropH = $form_data['h'];

        $filename_array = explode('/', $image_url);
        $filename = $filename_array[sizeof($filename_array) - 1];

        $manager = new ImageManager();
        $image = $manager->make($image_url);
        $image->resize($imgW, $imgH)
            ->crop($cropW, $cropH, $imgX1, $imgY1)
            ->save(public_path() . $username . 'cropped-' . $filename);

        if (!$image) {

            return response()->json(['status' => 0, 'msg' => '图片上传错误']);

        }


        return response()->json(['status' => 1, 'msg' => '图片上传成功', 'url' => $username . $image->basename]);
    }
}
