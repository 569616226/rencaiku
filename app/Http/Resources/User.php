<?php

namespace App\Http\Resources;

use App\Models\Depart;
use Illuminate\Http\Resources\Json\Resource;

class User extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $name = $this->name;
        $offer_status = '-';
        $offer_status_name = '-';
        $html = '<div class="operate">
                <a href="javascript:void(0)" class="btn btn-sm operate-btn">
                    <i class="iconfont">&#xe632;</i>操作
                </a>
                    <div class="operate-group">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-black archive">完善档案</button>
                        </div>
                    </div>
                </div>';
        $offer_depart = '-';
        $sex = '-';
        $offer_name = '-';
        $tel = '-';
        $offer_on_date = '-';
        $id = '-';

        if ( $this->archive) {
            if ($this->archive->offer_status == 0) {

                $html = '<div class="operate">
                <a href="javascript:void(0)" class="btn btn-sm operate-btn">
                    <i class="iconfont">&#xe632;</i>操作
                </a>
                    <div class="operate-group">
                        <div class="btn-group" role="group">
                        </div>
                    </div>
                </div>';

            } elseif ($this->archive->offer_status == 1) {
                $offer_status = '<span class="status-span-2">在职（已转正）</span>';
                $offer_status_name = '在职（已转正）';
                $html = '<div class="operate">
                    <a href="javascript:void(0)" class="btn btn-sm operate-btn">
                        <i class="iconfont">&#xe632;</i>操作
                    </a>
                        <div class="operate-group">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-black show">查看</button>
                                <button type="button" class="btn btn-black edit">编辑</button>
                                <button type="button" class="btn btn-black off">离职</button>
                            </div>
                        </div>
                    </div>';
            } elseif ($this->archive->offer_status == 2) {
                $offer_status = '<span class="status-span-1">在职（试用期）</span>';
                $offer_status_name = '在职（试用期）';
                $html = '<div class="operate">
                    <a href="javascript:void(0)" class="btn btn-sm operate-btn">
                        <i class="iconfont">&#xe632;</i>操作
                    </a>
                        <div class="operate-group">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-black addtime">延长试用期</button>
                                <button type="button" class="btn btn-black on">转正</button>
                                <button type="button" class="btn btn-black show">查看</button>
                                <button type="button" class="btn btn-black edit">编辑</button>
                                <button type="button" class="btn btn-black off">离职</button>
                            </div>
                        </div>
                    </div>';
            }


            $name = '<a href="'.route('archive.show',[$this->archive->id]).'">'.$this->name.'</a>';
            $offer_depart = implode('、', $this->departs->pluck('name')->toArray());
            $sex = $this->archive->sex == 0 ? '男' : '女';
            $offer_name = $this->archive->offer_name;
            $tel = $this->archive->tel;
            $offer_on_date = $this->archive->offer_on_date->toDateString();
            $id = $this->archive->id;

        }

        return [
            $name,
            $sex,
            $offer_depart,
            $offer_name,
            $tel,
            $offer_status,
            $offer_on_date,
            $offer_status_name,
            $html,
            $id,
            $this->id,
        ];
    }
}
