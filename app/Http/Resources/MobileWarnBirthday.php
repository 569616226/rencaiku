<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MobileWarnBirthday extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        $birthday_type = $this->birthday_type ? '阳历' : '阴历';
        if ($this->relation == 1) {
            $relation = '父亲';
        } elseif ($this->relation == 2) {
            $relation = '母亲';
        } elseif ($this->relation == 3) {
            $relation = '儿子';
        } elseif ($this->relation == 4) {
            $relation = '女儿';
        } elseif ($this->relation == 5) {
            $relation = '夫妻';
        }

        $info = '<div class="myjob_time_div row">
				<div class="col-xs-12 full_content">
					<div><p>' . $this->name . ' :' . $this->birthday->month . '月' . $this->birthday->day
            . '日,' . $birthday_type . '(' . $this->archive->name . ' - ' . $relation
            . '）</p></div>
				</div>
			</div>';

        return [
            'info' => $info,
        ];
    }
}
