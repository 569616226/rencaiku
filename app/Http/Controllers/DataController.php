<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArchiveCollection;
use App\Models\Archive;
use App\Models\Depart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataController extends BaseController
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
        return view('data.index');
    }

    public function off()
    {
        return view('data.off');
    }

    /**
     * 入职数据
     * @return \Illuminate\Http\JsonResponse
     */
    public function all_data()
    {

        $archive_groups = $this->get_date(request('time'),1)[0];

        return response()->json(['keys' =>$archive_groups->keys()->toArray(),'value' => $archive_groups->values()->all()]);

    }

    /**
     * 离职数据统计
     * @return \Illuminate\Http\JsonResponse
     */
    public function off_data()
    {

        $archive_groups = $this->get_date(request('time'),0)[0];

        return response()->json(['keys' => $archive_groups->keys()->toArray() ,'value' => $archive_groups->values()->all()]);
    }

    /**
     *
     * 入职详细数据
     * @return \Illuminate\Http\JsonResponse
     */
    public function table_all_data()
    {

        return $this->get_date(request('time'),1)[1];

    }

    /**
     * 离职详细数据
     * @return \Illuminate\Http\JsonResponse
     */
    public function table_off_data()
    {
        return $this->get_date(request('time'),0)[1];

    }

    /**
     * 数据统计表格数据格式
     * @param $archives
     * @return array
     */
    protected function fromat_archive_data($archives)
    {

        $archive_datas = [];

        foreach ($archives as $archive){
            if(!$archive->user()->withTrashed()->get()->isEmpty()){
                $offer_depart = $archive->user()->withTrashed()->first()->departs->pluck('name')->toArray();

                $sex = $archive->sex == 0 ? '男' : '女';

                array_push($archive_datas,[
                    '<a href="'.route('archive.show',[$archive->id]).'">'.$archive->name.'</a>',
                    $sex,
                    implode('、', $offer_depart),
                    $archive->offer_name,
                    $archive->tel,
                    $archive->offer_on_date->toDateString(),
                    $archive->offer_off_date ? $archive->offer_off_date->toDateString() : null,
                    $archive->offer_off_reason ? $archive->offer_off_reason[1] : null
                ]);
            }

        }

        return ['data' => $archive_datas];

    }


    /**
     * 数据格式化
     * @param $time
     * @return array
     */
    protected function get_date($time,$type)
    {

        /*
         * $time
      * 选择数据时间类型
      * 1：本月 3：三月 6：半年 year：今年 all：全部
      * */

        /*根据转正时间分组数据*/
        if($type){

            $archives = Archive::where('offer_status', '!=' , 0)->get();
            $archives = $this->fromt_date($time, $archives,$type);

            $archive_groups = $archives->sortBy('on_date')->groupBy('on_date')//根据转正时间分组数据
            ->map(function ($item) {//转化数据会数值

                return $item->count();

            });//返回数量

        }else{

            $archives = Archive::where('offer_status', 0)->get();
            $archives = $this->fromt_date($time, $archives,$type);

            $archive_groups = $archives->sortBy('off_date')->groupBy('off_date')//根据转正时间分组数据
            ->map(function ($item) {//转化数据会数值

                return $item->count();

            });//返回数量

        }

        return [$archive_groups,$this->fromat_archive_data($archives)];
    }

    /**
     * 格式化图表数据
     * @param $time
     * @param $archives
     * @return mixed
     */
    protected function fromt_date($time, $archives,$type)
    {
        if($type){
            $archives = $archives->filter(function ($item) use ($time) {
                if ($time == 'year') {
                    return $item->offer_on_date->year === today()->year;
                } elseif ($time == 'all') {
                    return true;
                } elseif ($time == 1) {
                    return $item->offer_on_date->diffInMonths(today()) <= $time && $item->offer_on_date->month == today()->month;
                } else {

                    return $item->offer_on_date->diffInMonths(today()) <= $time;
                }

            });

            foreach ($archives as $archive) {

                if ($time == 'all') {
                    $archive->on_date = $archive->offer_on_date->year;
                } elseif ($time == 1) {
                    $archive->on_date = $archive->offer_on_date->toDateString();
                } else {
                    $archive->on_date = $archive->offer_on_date->year . '-' . $archive->offer_on_date->month;
                }

            };
        }else{
            $archives = $archives->filter(function ($item) use ($time) {

                if ($item->offer_off_date) {
                    if ($time == 'year') {
                        return $item->offer_off_date->year === today()->year;
                    } elseif ($time == 'all') {
                        return true;
                    } elseif ($time == 1) {
                        return $item->offer_off_date->diffInMonths(today()) <= $time && $item->offer_off_date->month == today()->month;
                    } else {

                        return $item->offer_off_date->diffInMonths(today()) <= $time;
                    }

                }else{
                    return false;
                }

            });

            foreach ($archives as $archive) {

                if($archive->offer_off_date){
                    if ($time == 'all') {
                        $archive->off_date = $archive->offer_off_date->year;
                    } elseif ($time == 1) {
                        $archive->off_date = $archive->offer_off_date->toDateString();
                    } else {
                        $archive->off_date = $archive->offer_off_date->year . '-' . $archive->offer_off_date->month;
                    }
                }

            };
        }


        return $archives;
    }

}
