@extends('layouts.app')
<!--中间内容区域-->
@section('content')
    <link rel="stylesheet" href="{{ url('css/titatoggle-dist-min.css')}}">
    <style>
        .magic-radio + label, .magic-checkbox + label{
            top:-6px;}
    </style>
    <div class="container container-responsive">
        <div class="row hr-main-bg">
            {{-- 系统设置 --}}
            @include('_parties.sys_menu')
            <div class="right-side col-xs-12 col-sm-10 col-md-9 col-lg-10 padding-bottom" style="min-height: 640px;">
                <div class="right-side-header margin-left">
                    {{--<div class="goback">--}}
                    {{--<a href="{{ back()->getTargetUrl() }}" class="btn btn-default">返回</a>--}}
                    {{--</div>--}}
                    <p style="font-size: 16px;padding-top: 2rem;padding-bottom: 2rem; border-bottom: #E3E3E3 1px solid">通用设置</p>
                </div>
                <div class="main-content padding afterboottom2">
                    <div class="pull-left" style="margin-top: 1rem;color: #A3A3A3; width: 8rem">面试预约设置</div>
                        <div class="pull-left checkbox">
                            <span>设置面试预约中的第一审核人和第二审人</span>
                        </div>
                        <div class="pull-right settingB">
                            <a href="{{ url('setting') }}">设置</a>
                        </div>
                    <div style="clear: both"></div>
                </div>
                <div class="main-content padding afterboottom2">
                    <div class="pull-left" style="margin-top: 1rem;color: #A3A3A3; width: 8rem">同步管理设置</div>
                        <div class="pull-left checkbox">
                            <span>对通信录、岗位调整、薪资调整的同步进行管理</span>
                        </div>
                        <div class="pull-right settingB">
                            <a href="{{ url('setting/sync') }}">设置</a>
                        </div>
                    <div style="clear: both"></div>
                </div>
                <div class="main-content padding afterboottom2">
                    <div class="pull-left" style="margin-top: 1rem;color: #A3A3A3; width: 8rem">简历查看设置</div>
                        <div class="pull-left checkbox">
                            <span>只有选择后的成员，可以访问简历库的人员名单</span>
                        </div>
                        <div class="pull-right settingB">
                            <a href="{{ url('setting/resume') }}">设置</a>
                        </div>
                    <div style="clear: both"></div>
                </div>
                <div class="main-content padding afterboottom2">
                    <div class="pull-left" style="margin-top: 1rem;color: #A3A3A3; width: 8rem">待办提醒设置</div>
                        <div class="pull-left checkbox">
                            <span>设置待办提醒的提醒时间和提醒人员</span>
                        </div>
                        <div class="pull-right settingB">
                            <a href="{{ url('setting/notice') }}">设置</a>
                        </div>
                    <div style="clear: both"></div>
                </div>
                <div class="main-content padding afterboottom2">
                    <div class="pull-left" style="margin-top: 1rem;color: #A3A3A3; width: 8rem">薪资查看设置</div>
                        <div class="pull-left checkbox">
                            <span>只有设置指定人员，才可以查看/访问全公司人员的人事档案-薪资信息</span>
                        </div>
                        <div class="pull-right settingB">
                            <a href="{{ url('setting/archive') }}">设置</a>
                        </div>
                    <div style="clear: both"></div>
                </div>
           
                 <div class="main-content padding afterboottom2">
                    <div class="pull-left" style="margin-top: 1rem;color: #A3A3A3; width: 8rem">查看权限设置</div>
                        <div class="pull-left  checkbox">开启后，用户仅能查看所属部门有关的增补单及面试预约详情</div>
                        <div class="pull-right checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 3px">
                        <label>
                        {{-- 这里页面对接后需要判断是否被勾选勾选上 --}}
                        <input type="checkbox" {{ $checked ? 'checked' : '' }} name="revamp"><span></span>
                        </label>
                        </div>
                    <div style="clear: both"></div>
                </div>
                {{--<div class="main-content padding">--}}
                    {{--<a id="submit_setting" style="margin-left: 100px" href="javascript:void(0);" class="btn btn-primaryxs">&nbsp;&nbsp;提交&nbsp;&nbsp;</a>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
    <div class="fakeloader" style="position: fixed;width: 100%;height: 100%;top: 0px;left: 0px;background-color: rgba(134, 134, 134,0.2);z-index: 999; display: none; ">
        <div class="mop-css-2 wave" style="position: absolute; top: 0;left: 0;right: 0;bottom: 0;margin: auto;">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div>
    <div class="modal-box">

    </div>

@endsection
@section('javascript')
    @parent
    <script type="text/javascript">

        require(['bootstrap','dataimepicker','layer','DataTable','bootstrap-select','validform','icheck','modules/server'], function (bootstrap,dataimepicker,layer,DataTable,bootstrapselect,validform,icheck,server) {
            $('input[name=revamp]').change(function () {
                $('.fakeloader').fadeIn(100);
                var ischeck;
                if($('input[name=revamp]').is(':checked')){
                    ischeck = 1;
                }else {
                    ischeck = 0;
                }
                var url = '/setting/see_all_data/' + ischeck;
                $.get(url,function (data) {
                    $('.fakeloader').fadeOut(100);

                   layer.msg(data.msg);

                });
            });
        });
    </script>
@endsection