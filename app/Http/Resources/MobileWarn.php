<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MobileWarn extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $info = '<div class="myjob_time_div row btn_check">
				<div class="col-xs-1 myjob_checkbox">
					<div class="clickable">
						<span class="CheckState CheckState_check" data-id="1">
							<svg width="13" height="8" viewBox="0 0 13 8"><path d="M1 4.5L4.5 8l8-8"></path></svg>
						</span>
					</div>
				</div>
				<div class="col-xs-11 full_content">
					<p class="full_content_p"><b>'.$this->name.'</b> '.$this->content.'</p>
				</div>
			</div>';

        return [
            'info' => $info,
        ];
    }
}
