<?php

namespace App\Http\Controllers;

use App\Helpers\Functions;
use App\Models\Archive;
use App\Models\Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ClsoureController extends BaseController
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
//        $clsoures = Closure::with('archive')->where('archive_id', $archive->id)->get();

        $archive = Functions::archiveFormat($archive);
        return view('archive.edit.clsoure', compact('clsoures', 'archive'));
    }

    /**
     *删除附件
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destory(Closure $closure)
    {

        try{

            $closure->delete();

            return response()->json(['status' => true, 'msg' => '操作成功']);

        }catch (\Exception $e){

            report($e);

            return response()->json(['status' => false, 'msg' => '操作失败']);

        }

    }

    /**
     * 上传附件
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request,Archive $archive)
    {
        $username = '/storage/uploads/clsoure/';//目录路径

        $file = Functions::uploadClsoure($username, $request);

        try{

            Closure::create([
                'name'       => $file['name'],
                'path'       => $file['path'],
                'uploader'   => Functions::getLoginUser()->name,
                'archive_id' => $archive->id

            ]);

            return response()->json(['status' => true, 'msg' => '操作成功']);

        }catch (\Exception $e){

            report($e);

            return response()->json(['status' => false, 'msg' => '操作失败']);
        }

    }


    /**
     * 文件下载
     * @param Closure $closure
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Closure $closure)
    {

        $path = $closure->path;

        return response()->download(storage_path().'/app/public/uploads/'.$path);
    }
}
