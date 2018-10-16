<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MobileBirthday extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $info = '<div class="myjob_time_div row">
				<div class="col-xs-12 full_content">
					<div><p>'. $this->name . '（'. $this->birthday->month .'月'. $this->birthday->day .'日）</p></div>
				</div>
			</div>';

        return [
            'info' => $info,
        ];
    }
}
