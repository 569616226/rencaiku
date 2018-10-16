<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /*发票抬头*/
    public function index()
    {
        return view('receipt.index');
    }
}
