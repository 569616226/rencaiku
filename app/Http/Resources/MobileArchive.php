<?php

namespace App\Http\Resources;

use App\Models\Depart;
use Illuminate\Http\Resources\Json\Resource;

class MobileArchive extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        if($this->offer_status == 0){
            $offer_status_name = '离职';
        }elseif($this->offer_status == 1){
            $offer_status_name = '在职（已转正）';
        }elseif($this->offer_status == 2){
            $offer_status_name = '在职（试用期）';
        }elseif($this->offer_status == 3){
            $offer_status_name = '复职';
        }

        if($this->avatar){
            $this->avater = $this->avatar;
        }else{
            if( $this->sex == 0 ){
                $this->avater = url('/img/boy.png');
            }elseif($this->sex == 1){
                $this->avater = url('/img/girl.png');
            }
        }

        $offer_depart = $this->user()->withTrashed()->first()->departs->pluck('name')->toArray();

        $info = '<a href="' . url('/mobile/archive/' . $this->id . '/show') . '"
                        <div class="inner-settings-item flexbox">
                            <div class="avator">
                                <img src="' . $this->avater . '">
                            </div>
                            <div class="title description_title flexItem">
                                <p class="name">' . $this->name . '·' . $this->offer_name . '</p>
                                <p class="description description_ellipsis">
                                    <span>部门：' . implode('|',$offer_depart). '丨 状态：' . $offer_status_name . '   </span>
                                </p>
                            </div>
                        </div>
                    </a>';

        return [
            'info' => $info,
        ];

    }
}
