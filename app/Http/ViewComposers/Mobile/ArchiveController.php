<?php

namespace App\Http\ViewComposers\Mobile;


use App\Models\Depart;
use Illuminate\View\View;


class ArchiveViewComposer
{


    /**
     * 将数据绑定到视图。
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $departs = Depart::select('id','name')->get();
        $view->with('departs', $departs);
    }

}
