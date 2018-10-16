<?php

namespace App\Http\Resources;

use App\Models\Depart;
use Illuminate\Http\Resources\Json\Resource;

class Archive extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        $offer_status = '<span class="status-span-3">离职</span>';
        $offer_status_name = '离职';
        $html = '<div class="operate">
                <a href="javascript:void(0)" class="btn btn-sm operate-btn">
                    <i class="iconfont">&#xe632;</i>操作
                </a>
                    <div class="operate-group">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-black show">查看</button>
                            <button type="button" class="btn btn-black again">复职</button>
                        </div>
                    </div>
                </div>';

        if($this->offer_off_reason[0] == 0){
            $offer_off_reason = '正常离职';
            $rhtml = '<div class="offer-off-reason"><span class="red">有</span><p class="reason">'.  $this->offer_off_reason[1] .'</p></div>';
        }elseif($this->offer_off_reason[0] == 1){
            $offer_off_reason = '自离';
            $rhtml = '<span>无</span>';
        }elseif($this->offer_off_reason[0] == 2){
            $offer_off_reason = '辞退';
            $rhtml = '<span>无</span>';
        }elseif($this->offer_off_reason[0] == 3){
            $offer_off_reason = '试用期不通过';
            $rhtml = '<span>无</span>';
        }

        $sex = $this->sex == 0 ? '男' : '女';

        return [
            '<a href="'.route('archive.show',[$this->id]).'">'.$this->name.'</a>',
            $sex,
            implode('、', $this->user()->withTrashed()->first()->departs->pluck('name')->toArray()),
            $this->offer_name,
            $this->tel,
            $offer_status,
            $this->offer_on_date->toDateString(),
            $offer_status_name,
            $this->offer_off_date ? $this->offer_off_date->toDateString() : null,
            $offer_off_reason,
            $rhtml,
            $html,
            $this->id,

        ];
    }
}
