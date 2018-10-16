<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Notice extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->subscribe->resumes->origin_id == 0) {
            $origin = '智通';
        } elseif ($this->subscribe->resumes->origin_id == 1) {
            $origin = '卓博';
        } elseif ($this->subscribe->resumes->origin_id == 2) {
            $origin = '内部推荐';
        } elseif ($this->subscribe->resumes->origin_id == 3) {
            $origin = '人才市场';
        }


        if ($this->type == 0) {
            $type = '<span class="status-span-3">未发送</span>';
            $type_search = '未发送';
            $html = '<div class="operate">
                    <a href="javascript:void(0)" class="btn btn-sm operate-btn">
                        <i class="iconfont">&#xe632;</i>操作
                    </a>
                        <div class="operate-group">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-black seed">发送通知书</button>
                                <button type="button" class="btn btn-black subscribe">查看预约</button>
                            </div>
                        </div>
                    </div>';
        } elseif ($this->type == 1) {
            $type = '<span class="status-span-2">已发送</span>';
            $type_search = '已发送';
            $html = '<div class="operate">
                        <a href="javascript:void(0)" class="btn btn-sm operate-btn">
                            <i class="iconfont">&#xe632;</i>操作
                        </a>
                            <div class="operate-group">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-black create">新建档案</button>
                                    <button type="button" class="btn btn-black subscribe">查看预约</button>
                                    <button type="button" class="btn btn-black show">查看通知书</button>
                                </div>
                            </div>
                        </div>';
        }

        return [
            $this->subscribe->resumes->name,
            $this->subscribe->examines->position,
            $type,
            $this->created_at->toDatetimeString(),
            $origin,
            $html,
            $type_search,
            $this->subscribe->id,
            $this->id,
        ];
    }
}
