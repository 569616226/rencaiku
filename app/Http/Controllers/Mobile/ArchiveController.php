<?php

namespace App\Http\Controllers\Mobile;

use App\Helpers\Functions;
use App\Http\Controllers\BaseController;
use App\Models\Archive;
use App\Models\Depart;
use App\Models\Setting;
use App\User;
use Illuminate\Http\Request;


class ArchiveController extends BaseController
{

    /**
     * CustomerController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 部门选择
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $local_user = Functions::getLoginUser();

        if (in_array($local_user->user_wechat_id, config('system.admin_user'))) {
            return view('mobile.archive.selcet_depart');
        } else {
            return view('auth.index');
        }
    }


    /**
     * 员工管理页面
     * @param $depart_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function depart($depart_id)
    {
        $user_ids = $this->get_depart_user_ids($depart_id);

        $archive_all_off_counts = Archive::whereIn('user_id',$user_ids)->get()->filter(function($item){
            return $item->offer_status == 0;
        })->count();//所有离职

        $archive_counts = Archive::whereIn('user_id',$user_ids)->get()->filter(function ($item) {
            return $item->offer_status !== 0;
        })->count();//员工数

        $archive_on_counts = Archive::whereIn('user_id',$user_ids)->get()->filter(function ($item)  {
            return $item->offer_status !== 0 && $item->offer_on_date->year === today()->year && $item->offer_on_date->month === today()->month;
        })->count();//入职数

        $archive_off_counts = Archive::whereIn('user_id',$user_ids)->get()->filter(function ($item)  {
            return $item->offer_status == 0 && $item->offer_off_date && $item->offer_off_date->year === today()->year && $item->offer_off_date->month === today()->month;
        })->count();//离职数

        return view('mobile.archive.index', compact('archive_all_off_counts','archive_counts','archive_on_counts','archive_off_counts','depart_id'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all($depart_id)
    {
        return view('mobile.archive.all',compact('depart_id'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function on($depart_id)
    {
        return view('mobile.archive.on',compact('depart_id'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function off($depart_id)
    {
        return view('mobile.archive.off',compact('depart_id'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all_off($depart_id)
    {
        return view('mobile.archive.all_off',compact('depart_id'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_all($depart_id)
    {

        $keyWord = urldecode(request('keyWord'));
        $offer_status = request('offer_status');
        $offer_depart = request('offer_depart');

        return view('mobile.archive.search.all', compact('keyWord', 'offer_status', 'offer_depart','depart_id'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_on($depart_id)
    {

        $keyWord = urldecode(request('keyWord'));
        $offer_status = request('offer_status');
        $offer_depart = request('offer_depart');

        return view('mobile.archive.search.on', compact('keyWord', 'offer_status', 'offer_depart','depart_id'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_off($depart_id)
    {

        $keyWord = urldecode(request('keyWord'));
        $offer_status = request('offer_status');
        $offer_depart = request('offer_depart');

        return view('mobile.archive.search.off', compact('keyWord', 'offer_status', 'offer_depart','depart_id'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search_all_off($depart_id)
    {

        $keyWord = urldecode(request('keyWord'));
        $offer_status = request('offer_status');
        $offer_depart = request('offer_depart');

        return view('mobile.archive.search.all_off', compact('keyWord', 'offer_status', 'offer_depart','depart_id'));
    }

    /**
     * 我的档案
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function me()
    {
        try {

            $archive_data = Functions::getLoginUser()->archive;

            if ($archive_data) {

                $archive = Functions::archiveFormat($archive_data);
                return view('mobile.archive.show', compact('archive'));

            } else {

                return view('mobile.archive.show');

            }

        } catch (\Exception $exception) {

            report($exception);

            return view('mobile.archive.show');
        }

    }


    /**
     * 员工详情
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Archive $archive)
    {

        $archive = Functions::archiveFormat($archive);

        return view('mobile.archive.show', compact('archive'));
    }

    /**
     * 所有员工数据
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function get_all($depart_id)
    {
        $last = request('last');
        $amount = request('amount');

        return $this->get_datas(null, $last, $amount,$depart_id);
    }

    /**
     * 入职员工数据
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function get_on($depart_id)
    {
        $last = request('last');
        $amount = request('amount');

        return $this->get_datas('offer_on_date', $last, $amount,$depart_id);
    }

    /**
     * 离职员工数据
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function get_off($depart_id)
    {
        $last = request('last');
        $amount = request('amount');

        return $this->get_datas('offer_off_date', $last, $amount,$depart_id);
    }

    /**
     * 离职员工数据
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function get_all_off($depart_id)
    {
        $last = request('last');
        $amount = request('amount');

        return $this->get_datas('all_off', $last, $amount,$depart_id);
    }

    /**
     * 获取数据
     * @param $col
     * @param null $type
     * @return mixed
     */
    public function get_datas($col, $last, $amount,$depart_id)
    {
        $user_ids = $this->get_depart_user_ids($depart_id);

        $archives =Archive::whereIn('user_id',$user_ids)
        ->when(!$col, function ($query) use ($col) {

            $query->where('offer_status', '>', 0);

        })->when($col == 'offer_off_date', function ($query) {

            $query->where('offer_status', 0)->whereMonth('offer_off_date', today()->month)->whereYear('offer_off_date', today()->year);

        })->when($col == 'offer_on_date', function ($query) {

            $query->where('offer_status', '>', 0)->whereMonth('offer_on_date', today()->month)->whereYear('offer_on_date', today()->year);

        })->when($col == 'all_off', function ($query) {

            $query->where('offer_status', 0);

        })->offset($last)->limit($amount)->get();

        return \App\Http\Resources\MobileArchive::collection($archives);
    }


    /**
     * 所有员工搜索
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search_all_data($depart_id)
    {
        $keyWord = urldecode(request('keyWord'));
        $offer_status = request('offer_status');
        $offer_depart = request('offer_depart');

        return $this->get_search_data($keyWord, $offer_depart, $offer_status, 'all',$depart_id);
    }


    /**
     * 入职员工搜索
     * @param
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search_on_data($depart_id)
    {
        $keyWord = urldecode(request('keyWord'));
        $offer_status = request('offer_status');
        $offer_depart = request('offer_depart');

        return $this->get_search_data($keyWord, $offer_depart, $offer_status, 'on',$depart_id);

    }


    /**
     * 离职员工搜索
     * @param
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search_off_data($depart_id)
    {
        $keyWord = urldecode(request('keyWord'));
        $offer_status = request('offer_status');
        $offer_depart = request('offer_depart');

        return $this->get_search_data($keyWord, $offer_depart, $offer_status, 'off',$depart_id);
    }

    /**
     * 离职员工搜索
     * @param
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function search_all_off_data($depart_id)
    {
        $keyWord = urldecode(request('keyWord'));
        $offer_status = request('offer_status');
        $offer_depart = request('offer_depart');

        return $this->get_search_data($keyWord, $offer_depart, $offer_status, 'all_off',$depart_id);
    }

    /**
     * 搜索数据公用方法
     * @param $keyWord
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    protected function get_search_data($keyWord, $offer_depart, $offer_status, $search_type,$depart_id)
    {
        $user_ids = $this->get_depart_user_ids($depart_id,$offer_depart);

        $archives =Archive::whereIn('user_id',$user_ids)

        ->when($search_type === 'all', function ($query) use ($search_type) {

             $query->where('offer_status', '!=', 0);

        })->when($search_type === 'on', function ($query) use ($search_type) {

             $query->where('offer_status', '!=', 0)->whereMonth('offer_on_date', today()->month)->whereYear('offer_on_date', today()->year);

        })->when($search_type === 'off', function ($query) use ($search_type) {

             $query->where('offer_status', 0)->whereMonth('offer_off_date', today()->month)->whereYear('offer_off_date', today()->year);

        })->when($search_type === 'all_off', function ($query) use ($search_type) {

             $query->where('offer_status', 0);

        })->when($keyWord, function ($query) use ($keyWord) {

             $query->where(function ($query) use ($keyWord) {

                $query->where('name', 'like', '%' . $keyWord . '%')->orWhere('offer_name', 'like', '%' . $keyWord . '%')->orWhere(['tel' => $keyWord]);

            });

        })->when($offer_status !== null, function ($query) use ($offer_status) {

             $query->where('offer_status', $offer_status);

        })->get();


        return \App\Http\Resources\MobileArchive::collection($archives);
    }

    /*判断公司部门显示数据*/
    protected function get_depart_user_ids($depart_id,$offer_depart=null)
    {

        if($offer_depart){
            $user_ids = Depart::findOrFail($offer_depart)->users()->withTrashed()->pluck('id')->toArray();
        }else{
            if($depart_id == 1){//所有
                $departs = Depart::with(['users'])->get();
            }elseif($depart_id == 0){//除了报关公司
                $departs = Depart::with(['users'])->where('id','!=',16)->get();
            }elseif($depart_id == 16){//报关公司
                $departs = Depart::with(['users'])->whereId(16)->get();
            }

            $user_array = [];//
            foreach ($departs as $depart){
                $user_id = $depart->users()->withTrashed()->pluck('id')->toArray();

                array_push($user_array,$user_id);
            }

            $user_ids = array_collapse($user_array);

        }

        return $user_ids;

    }
}
