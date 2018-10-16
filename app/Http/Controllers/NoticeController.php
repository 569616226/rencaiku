<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\Resume;
use App\Models\Subscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Notice as UserResource;
use Illuminate\Support\Facades\Mail;

class NoticeController extends BaseController
{

    /**
     * CustomerController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('notice.index');
    }


    /**
     * 录取通知
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function all_data()
    {
        return UserResource::collection(Notice::with('subscribe')->get());
    }

    /**
     * 创建录取通知
     * @param Resume $subscribe
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Subscribe $subscribe)
    {
        if ($subscribe) {

            return view('notice.create', compact('subscribe'));

        } else {

            return view('notice.create');

        }

    }

    /**
     * 保存
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {

        try {

            Notice::insertGetId($request->all());

            return redirect(route('notice.review'));

        } catch (\Exception $e) {

            report($e);

            return response()->json(['status' => false, 'msg' => '操作失败']);
        }
    }

    /**
     * 查看
     * @param Notice $notice
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Notice $notice)
    {
        return view('notice.show', compact('notice'));
    }

    /**
     * 发送邮件
     * @param Request $request
     * @param Notice $notice
     */
    public function ship(Request $request, Notice $notice)
    {

        $name = $request->get('name');
        $wechat_pos = $request->get('wechat_position');
        $email = $request->get('email');
        $shakedown_period = $request->get('shakedown_period');
        $offer_date = Carbon::createFromFormat('Y-m-d', $request->get('offer_date'));
        $probation_salary = $request->get('probation_salary');
        $basic_pay = $request->get('basic_pay');
        $link = $request->get('link');

        try {

            // Mail::send()的返回值为空，所以可以其他方法进行判断

            Mail::send('emails.notice.shipped', [
                'name'             => $name,
                'wechat_position'  => $wechat_pos,
                'email'            => $email,
                'shakedown_period' => $shakedown_period,
                'offer_date'       => $offer_date,
                'probation_salary' => $probation_salary,
                'basic_pay'        => $basic_pay,
                'link'             => $link,

            ], function ($message) use ($request) {

                $message->to($request->get('email'))->subject('东华国际_录用通知书');

            });

            // 返回的一个错误数组，利用此可以判断是否发送成功
            if (Mail::failures()) {

                return response()->json(['msg' => '发送失败', 'status' => false]);

            } else {

                $notice->update([
                    'type'         => 1,
                    'email'        => $email,
                    'training'     => $shakedown_period,
                    'entry_at'     => $offer_date,
                    'trial_salary' => $probation_salary,
                    'salary'       => $basic_pay,
                    'notice_url'   => $link,
                ]);

                return response()->json(['msg' => '发送成功', 'status' => true]);
            }

        } catch (\Exception $exception) {

            report($exception);

            return response()->json(['msg' => '发送失败', 'status' => false]);
        }

    }

}
