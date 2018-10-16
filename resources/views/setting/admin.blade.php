@extends('layouts.app')
<!--中间内容区域-->
@section('content')
    <link rel="stylesheet" href="{{ url('css/titatoggle-dist-min.css')}}">
    <style>
        .magic-radio + label, .magic-checkbox + label{
            top:-6px;}
        .listapp {
            margin-right: 2rem;
            float: left;
        }
        #sprmodalfirst {float: left;}
        .approver_di {display: none}
    </style>
    <div class="container container-responsive">
        <div class="row hr-main-bg">
            {{-- 系统设置 --}}
            @include('_parties.sys_menu')
            {{-- <div class="left-side col-xs-12 col-sm-2 col-md-3 col-lg-2">
                <ul class="nav nav-pills nav-stacked custom-nav">
                    <li>
                        <a href="{{ url('setting') }}" ><i class="fa fa-bullhorn"></i> <span>面试预约设置</span></a>
                    </li>
                    <li>
                        <a href="{{ url('setting/leader') }}" ><i class="fa fa-bullhorn"></i> <span>系统设置</span></a>
                    </li>
                    <li>
                        <a href="{{ url('setting/resume') }}" ><i class="fa fa-bullhorn"></i> <span>简历查看设置</span></a>
                    </li>
                    <li class="active">
                        <a href="{{ url('setting/admin') }}" ><i class="fa fa-bullhorn"></i> <span>管理员设置</span></a>
                    </li>
                </ul>
            </div> --}}
            <div class="right-side col-xs-12 col-sm-10 col-md-9 col-lg-10 padding-bottom">
                <div class="right-side-header margin-left">

                    <p style="font-size: 16px;padding-top: 2rem;padding-bottom: 2rem; border-bottom: #E3E3E3 1px solid">管理员设置</p>
                </div>
                @inject('appPresenter','App\Presenters\AppPresenter')
                <div class="main-content padding afterboottom">
                    <div class="clearfix" style="margin-bottom: 20px;">
                        <label class="pull-left" style="margin-top: 2rem;color: #A3A3A3; width: 8rem">管理员：</label>
                        <div class="pull-left">
                            <div class="approver">
                                <div class="shr_box" id="shrfirst">
                                    @foreach($users as $user)
                                        <div class="approver listapp">
                                            <div class="approver_o">
                                                <i onclick="deletefun(this)" class="iconfont  {{ in_array($appPresenter->getUserId(),config('system.admin_user') )?  '' : 'hide' }}">&#xe634;</i>
                                                <input type="hidden"  name="user_id" value="{{ $user->id }}" >
                                                <img src="{{ $user->avatar }}" class="img-responsive">
                                                <p>{{ $user->name }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="approver_add {{ in_array($appPresenter->getUserId(),config('system.admin_user') ) ?  '' : 'hide' }}" id="sprmodalfirst">
                                        <img src="{{ url('/img/jia.png') }}" class="app_jia"/>
                                    </div>
                                </div>

                            </div>
                            <div class="approver_text margin-0">设置为管理员由超级管理员进行管理，管理员具备了所有模块的操作权限</div>
                        </div>
                    </div>

                </div>

                <div class="main-content padding">
                    <a id="submit_setting_user" style="margin-left: 100px" href="javascript:void(0);" class="btn btn-primaryxs  {{ in_array($appPresenter->getUserId(),config('system.admin_user') )?  '' : 'hide' }}">&nbsp;&nbsp;提交&nbsp;&nbsp;</a>
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
                        <h4 class="modal-title">选择管理员</h4>
                    </div>
                    <form class="form-horizontal padding">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">成员</label>
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
//                $("#submitspr").attr('name','first');
                server.get_user_lists_modal();
            });
            //点击提交，将选中的数据id传给后台
            $("#submitspr").click(function () {
                $('.fakeloader').fadeIn(100);
                var user_id = $("#selectpicker_spr").val();
                var orfalse = true;
                $(document).find("input[name='user_id']").each(function (i) {
                    if(user_id == $(this).val()){
                        $('.fakeloader').fadeOut(100);
                        layer.msg('该管理成员已存在');
                        orfalse = false;
                    };
                });
                if(orfalse){
                    server.get_user_msg(user_id,function (data) {
//                        $("#shrfirst").html(data.html);
                        $("#sprmodalfirst").before(data.html);
                        $("#shrfirst").find('.approver_di').remove();
                        console.log(data);
                        $('.fakeloader').fadeOut(100);
                        $("#choose_spr_modal").modal('hide');
                    });
                }

            });

            $("#submit_setting_user").click(function () {
                var user_ids= hiddenboxValshu('user_id');
//                if(user_ids.length){
                    var url = '/setting/admin'
                    AjaxJson(url,{'user_ids':user_ids},function (data) {
                        layer.msg(data.msg);
                        setTimeout(function () {
                            window.location.reload();
                        },1000);
                    });
//                }else {
//                    layer.msg('请选择管理');
//                }
            });
            deletefun = function(e) {
                var thise= $(e);
                var useid = $(e).attr('name');
                layer.msg('确定删除该管理员吗？', {
                    time: 0 //不自动关闭
                    ,btn: ['确定', '取消']
                    ,yes: function(index){
                        layer.close(index);
                        thise.parents('.listapp').remove();
                    }
                });
            }
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