<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        if (!env('ENABLE_MOCK')) {
            $this->middleware('wechat.auth');
        }
    }
}
