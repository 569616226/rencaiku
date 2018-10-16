<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\Models\Archive;
use App\Models\Salary;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SalaryController extends BaseController
{

    /**
     * CustomerController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 编辑
     * @param Archive $archive
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Archive $archive)
    {
        $archive = Functions::archiveFormat($archive);

        return view('archive.edit.salary', compact('salaries', 'archive'));
    }


    /**
     * 更新
     * @param Archive $archive
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Archive $archive)
    {
        $salaries = $request->get('salaries');

        if ($salaries) {

            $status = true;
            $msg = '操作成功';

            try {

                $archive->salaries->isEmpty() ? null : $archive->salaries()->whereNotIn('id', array_pluck($salaries, 'id'))->delete();

            } catch (\Exception $e) {

                report($e);
                $status = false;
                $msg = '薪资记录删除错误';
            }

            try {

                DB::beginTransaction();

                foreach ($salaries as $salary) {

//                    $salary['total'] = $salary['basic'] + $salary['added'];

                    if ($salary['id']) {

                        Salary::find($salary['id'])->update($salary);

                    } else {

                        Salary::create(array_merge($salary, ['archive_id' => $archive->id]));
                        Functions::create_salary_log($salary, $archive);

                    }

                }

                DB::commit();

            } catch (\Exception $e) {

                DB::rollBack();

                $status = false;
                $msg = '薪资记录存储失败';
            }


        } else {

            try {

                $archive->salaries->isEmpty() ? null : $archive->salaries()->delete();
                $status = true;
                $msg = '操作成功';

            } catch (\Exception $e) {

                report($e);

                $status = false;
                $msg = '薪资记录删除错误';
            }
        }

        return response()->json(['status' => $status, 'msg' => $msg]);
    }
}
