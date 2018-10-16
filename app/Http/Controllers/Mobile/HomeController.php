<?php

namespace App\Http\Controllers\Mobile;

use App\Helpers\Functions;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends BaseController
{
    /**
     * DepartController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*
     * 项目首页
     * */
    public function index()
    {

        $user = Functions::getLoginUser();

        return view('mobile.home.index',compact('user'));
    }

}
