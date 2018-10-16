<?php

namespace App\Http\ViewComposers;

use App\Helpers\Functions;
use App\Models\Family;
use App\Models\Archive;
use App\Models\Setting;
use App\Models\Warns;
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

        $view->with('archives', $this->getdata());
    }

    /**
     * 格式首页数据
     * @return array
     */
    protected function getdata()
    {

        $user = Functions::getLoginUser();
        $setting = Setting::findOrFail(1);

        if (today()->month >= 1 && today()->month <= 3) {
            $array_months = [1, 2, 3];
        } elseif (today()->month >= 4 && today()->month <= 6) {
            $array_months = [4, 5, 6];
        } elseif (today()->month >= 7 && today()->month <= 9) {
            $array_months = [7, 8, 9];
        } else {
            $array_months = [10, 11, 12];
        }

        $archive_counts = Archive::all()->filter(function ($query) {
            return $query->offer_status !== 0;
        })->count();//员工数

        $archive_on_counts = Archive::all()->filter(function ($query) {
            return $query->offer_status !== 0 && $query->offer_on_date->year === today()->year && $query->offer_on_date->month === today()->month;
        })->count();//入职数

        $archive_off_counts = Archive::all()->filter(function ($query) {
            return $query->offer_status == 0 && $query->offer_off_date && $query->offer_off_date->year === today()->year && $query->offer_off_date->month === today()->month;
        })->count();//离职数

        if (in_array($user->id, $setting->full[1])) {
            $archive_fulls = Warns::whereType(1)->get();
            $archive_full_data = Warns::whereType(1)->whereStatus(0)->get();
            $archive_full_counts = $archive_full_data->count();
            $archive_full_names = implode(' , ', $archive_full_data->pluck('name')->toArray());
        } else {
            $archive_fulls = null;
            $archive_full_counts = 0;
            $archive_full_names = null;
        }

        if (in_array($user->id, $setting->renew[1])) {
            $archive_agrees = Warns::whereType(3)->get();
            $archive_agree_data = Warns::whereType(3)->whereStatus(0)->get();
            $archive_agree_counts = $archive_agree_data->count();
            $archive_agree_names = implode(' , ', $archive_agree_data->pluck('name')->toArray());
        } else {
            $archive_agrees = null;
            $archive_agree_counts = 0;
            $archive_agree_names = null;
        }

        $archives = Archive::whereIn('offer_status', [1, 2, 3])->get();

        /*员工生日*/
        if (in_array($user->id, $setting->birthday[1])) {

            $archive_quarters = $archives->filter(function ($item) use ($array_months) {
                return in_array($item->birthday->month, $array_months);
            })->all();
            $archive_quarter_counts = count($archive_quarters);
            $archive_quarter_names = implode(' , ', collect($archive_quarters)->pluck('name')->toArray());

        } else {
            $archive_quarters = null;
            $archive_quarter_counts = 0;
            $archive_quarter_names = null;
        }

        /*员工周年庆*/
        if (in_array($user->id, $setting->year[1])) {
            $archive_years = Warns::whereType(2)->get();
            $archive_year_data = Warns::whereType(2)->whereStatus(0)->get();
            $archive_year_counts = $archive_year_data->count();
            $archive_year_names = implode(' , ', $archive_year_data->pluck('name')->toArray());
        } else {
            $archive_years = null;
            $archive_year_counts = 0;
            $archive_year_names = null;
        }

        if (in_array($user->id, $setting->family_birthday[1])) {

            $families_data = Family::whereIn('archive_id', $archives->pluck('id')->toArray())->get();
            $families = $families_data->filter(function ($item) use ($array_months) {
                return in_array($item->birthday->month, $array_months);
            })->all();
            $familie_counts = collect($families)->count();
            $familie_count_names = implode(' , ', $families_data->pluck('name')->toArray());

        } else {
            $families = null;
            $familie_counts = 0;
            $familie_count_names = null;
        }

        return [
            'archive_counts'     => $archive_counts,
            'archive_off_counts' => $archive_off_counts,
            'archive_on_counts'  => $archive_on_counts,

            'archive_full_counts'    => $archive_full_counts,
            'archive_agree_counts'   => $archive_agree_counts,
            'archive_quarter_counts' => $archive_quarter_counts,
            'archive_year_counts'    => $archive_year_counts,
            'familie_counts'         => $familie_counts,

            'archive_year_names'    => $archive_year_names,
            'archive_quarter_names' => $archive_quarter_names,
            'archive_agree_names'   => $archive_agree_names,
            'archive_full_names'    => $archive_full_names,
            'familie_count_names'   => $familie_count_names,

            'archive_years'      => $archive_years,
            'archive_quarters'   => $archive_quarters,
            'archive_agrees'     => $archive_agrees,
            'archive_full_datas' => $archive_fulls,
            'families'           => $families,
        ];
    }
}
