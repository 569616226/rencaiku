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
           {{--  <div class="left-side col-xs-12 col-sm-2 col-md-3 col-lg-2">
                <ul class="nav nav-pills nav-stacked custom-nav">
                    <li class="active">
                        <a href="{{ url('setting') }}" ><i class="fa fa-bullhorn"></i> <span>面试预约设置</span></a>
                    </li>
                    <li>
                        <a href="{{ url('setting/leader') }}" ><i class="fa fa-bullhorn"></i> <span>系统设置</span></a>
                    </li>
                    <li>
                        <a href="{{ url('setting/resume') }}" ><i class="fa fa-bullhorn"></i> <span>简历查看设置</span></a>
                    </li>
                    <li>
                        <a href="{{ url('setting/admin') }}" ><i class="fa fa-bullhorn"></i> <span>管理员设置</span></a>
                    </li>
                </ul>
            </div> --}}
            <div class="right-side col-xs-12 col-sm-10 col-md-9 col-lg-10 padding-bottom">
                <div class="right-side-header margin-left">
                    {{--<div class="goback">--}}
                    {{--<a href="{{ back()->getTargetUrl() }}" class="btn btn-default">返回</a>--}}
                    {{--</div>--}}
                    <p style="font-size: 16px;padding-top: 2rem;padding-bottom: 2rem; border-bottom: #E3E3E3 1px solid">预约设置</p>
                </div>
                <div class="main-content padding afterboottom">
                    <div class="clearfix" style="margin-bottom: 20px;">
                        <label class="pull-left" style="margin-top: 2rem;color: #A3A3A3; width: 8rem">第一审核人：</label>
                        <div class="pull-left">
                         <div class="approver">
                             <div class="shr_box" id="shrfirst">
                             @if(isset($first_user))
                             <div class="approver listapp">
                                <div class="approver_o">
                                    <i onclick="deletefun(this)" class="iconfont">&#xe634;</i>
                                    <input type="hidden"  name="" value="{{ $first_user->id }}" >
                                    <img src="{{ $first_user->avatar }}" class="img-responsive">
                                    <p>{{ $first_user->name }}</p>
                                </div>
                            </div>
                             @else
                             <div class="approver_add" id="sprmodalfirst">
                                <img src="{{ url('/img/jia.png') }}" class="app_jia"/>
                            </div>
                             @endif
                            </div>
                             <div class="approver approver_text">面试预约中第一位审核人</div>
                         </div>

                        </div>
                    </div>
                    <div class="clearfix">
                        <label class="pull-left" style="margin-top: 2rem;color: #A3A3A3; width: 8rem">面试官：</label>
                        <div class="pull-left">
                            <div class="approver">
                            <div class="shr_box" id="shrend">
                                @if(isset($last_user))
                                <div class="approver listapp">
                                    <div class="approver_o">
                                        <i onclick="deletefun(this)" class="iconfont">&#xe634;</i>
                                        <input type="hidden"  name="" value="{{ $last_user->id }}" >
                                        <img src="{{ $last_user->avatar }}" class="img-responsive">
                                        <p>{{ $last_user->name }}</p>
                                    </div>
                                </div>
                                @else
                                <div class="approver_add" id="sprmodalend">
                                    <img src="{{ url('/img/jia.png') }}" class="app_jia"/>
                                </div>
                                @endif
                            </div>
                                <span class="approver_text">面试预约的最后一位审核人，最后的决策者</span>
                            </div>
                        </div>
                    </div>

                </div>

                {{--<div class="main-content padding afterboottom2">--}}
                    {{--<div class="pull-left" style="margin-top: 1rem;color: #A3A3A3; width: 8rem">修改权限：</div>--}}
                    {{--<div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md">--}}
                        {{--<label>--}}
                            {{--<input type="checkbox" name=""><span>用户仅能查看所属部门有关的增补单及面试预约详情</span>--}}
                        {{--</label>--}}
                    {{--</div>--}}
                    {{--<div style="clear: both"></div>--}}
                {{--</div>--}}

                <div class="main-content padding">
                    <a id="submit_setting_user" style="margin-left: 100px" href="javascript:void(0);" class="btn btn-primaryxs">&nbsp;&nbsp;提交&nbsp;&nbsp;</a>
                    <a href="{{ back()->getTargetUrl() }}" class="btn btn-default">返回</a>
                </div>
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
        {{--选择审批人模态框--}}
        <div class="modal fade" id="choose_spr_modal">
            <div class="modal-dialog modalwidth-xs" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">选择审核人</h4>
                    </div>
                    <form class="form-horizontal padding">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">审核人</label>
                            <div class="col-sm-10">
                                <select id="selectpicker_spr" class="maxwidth">
                                </select>

                            </div>
                        </div>
                    </form>
                    <div class="modal-footer margin-0">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" id="submitspr">提交</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('javascript')
    @parent
    <script type="text/javascript">
        var deletefun;
        require(['bootstrap','dataimepicker','layer','DataTable','bootstrap-select','validform','icheck','modules/server'], function (bootstrap,dataimepicker,layer,DataTable,bootstrapselect,validform,icheck,server) {
            $("#sprmodalfirst").click(function () {
                $("#submitspr").attr('name','first');
                server.get_user_lists_modal();
            });
            $("#sprmodalend").click(function () {
                $("#submitspr").attr('name','end')
                server.get_user_lists_modal();
            });
            //点击提交，将选中的数据id传给后台
            $("#submitspr").click(function () {
                $('.fakeloader').fadeIn(100);
                var user_id = $("#selectpicker_spr").val();
                server.get_user_msg(user_id,function (data) {
//                    alert($("#submitspr").attr('name'))
                    if($("#submitspr").attr('name') == 'first'){
                        $("#shrfirst").html(data.html);
                        $("#shrfirst").find('.approver_di').remove();
                    }else {
                        $("#shrend").html(data.html);
                        $("#shrend").find('.approver_di').remove();
                    }
                    console.log(data);
                    $('.fakeloader').fadeOut(100);
                    $("#choose_spr_modal").modal('hide');
                });
            });
            //删除
            deletefun = function(e) {
                var thise= $(e);
                var useid = $(e).attr('name');
                layer.msg('确定删除该审核人吗？', {
                    time: 0 //不自动关闭
                    ,btn: ['确定', '取消']
                    ,yes: function(index){
                        if(thise.parents('.shr_box').attr('id') == 'shrfirst'){
                            layer.close(index);
                            thise.parents('.shr_box').html('<div class="approver_add" id="sprmodalfirst"><img src="{{ url('/img/jia.png') }}" class="app_jia"/></div>');
                            $("#sprmodalfirst").click(function () {
                                server.get_user_lists_modal();
                                $("#submitspr").attr('name','first');
                            });
                        }else {
                            layer.close(index);
                            thise.parents('.shr_box').html('<div class="approver_add" id="sprmodalend"><img src="{{ url('/img/jia.png') }}" class="app_jia"/></div>');
                            $("#sprmodalend").click(function () {
                                server.get_user_lists_modal();
                                $("#submitspr").attr('name','end');
                            });
                        }

                    }
                });
            };
            //提交两个审核人的id到后台
            $("#submit_setting_user").click(function () {
                var first_id = $("#shrfirst").find('input').val();
                var end_id = $("#shrend").find('input').val();
                if(first_id == undefined || end_id == undefined ) {
                    layer.msg('第一审核人和面试官不能为空！');
                    return false;
                }
                var url = '/setting/setting_user';
                $('.fakeloader').fadeIn(100);
                server.save_setting_user(url,{'first_id':first_id,'last_id':end_id},function (data) {
//                    console.log(data);
                    $('.fakeloader').fadeOut(100);

                    layer.msg(data.msg);

                });
            });
            $(".app_jia").on('mouseover',function(){
            	let img = "{{ url('/img/jia-hover.png') }}";
            	$(this).attr('src', img)
            })
            $(".app_jia").on('mouseout',function(){
            	let img = "{{ url('/img/jia.png') }}";
            	$(this).attr('src', img)
            })
        });
    </script>
@endsection