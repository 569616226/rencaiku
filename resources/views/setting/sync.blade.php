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
            height: 110px;
        }
        .listapp_img{
        	height: 74px;
        }
        #sprmodalfirst {float: left;}
        .approver_di {display: none}
    </style>
    <div class="container container-responsive">
        <div class="row hr-main-bg">
            {{-- 系统设置 --}}
            @include('_parties.sys_menu')
            <div class="right-side col-xs-12 col-sm-10 col-md-9 col-lg-10 padding-bottom">
                <div class="right-side-header margin-left">
                    <p style="font-size: 16px;padding-top: 2rem;padding-bottom: 2rem; border-bottom: #E3E3E3 1px solid">同步管理设置</p>
                </div>
                <div class="main-content padding">
                    <div id="formBox">
                        <div class="setting-box">
                            <div class="clearfix message-set-t">
                                <span class="pull-left setting-child-l">通信录同步：</span>
                                 <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
                                    <a id="update" href="javascript:void(0);" class="btn btn-primaryxs">&nbsp;&nbsp;同步通信录&nbsp;&nbsp;</a>
                                </div>
                            </div>
                            <div class="clearfix message-set-t">
                                <span class="pull-left setting-child-l">最近同步：</span>
                                 <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
                                    <p class="sync_time">{{ $user_sync_last_date }}</p>
                                    <p class="margin-top">当有新员工加入企业微信后，需要手动同步通信录，才可以创建新员工的员工档案</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-content padding">
                    <div id="formBox">
                        <div class="setting-box">
                            <div class="clearfix message-set-t">
                                <span class="pull-left setting-child-l">自动同步申请单：</span>
                                 <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
                                    <label>
                                        <input type="checkbox" {{ $setting->sync ? 'checked' : '' }} id="synccheck" value=""><span class="l-tip">
                                            @if($setting->sync)
                                                <span class="text-success">已开启</span>
                                            @else
                                                <span class="text-danger">已关闭</span>
                                            @endif
                                        </span>
                                    </label>
                                    <p class="margin-top">开启后，每天早上9点会从企业微信自动同步“员工薪资调整”、“岗位调整”的申请单</p>
                                </div>
                            </div>
                            <div id="sync_show" style="display: {{ $setting->sync ? 'block' : 'none' }};">
	                            <div class="clearfix message-set-t">
	                                <span class="pull-left setting-child-l">薪资调整同步：</span>
	                                 <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
	                                    <a id="update_xz" href="javascript:void(0);" class="btn btn-primaryxs">&nbsp;&nbsp;手动同步&nbsp;&nbsp;</a>
	                                </div>
	                            </div>
	                            <div class="clearfix message-set-t">
	                                <span class="pull-left setting-child-l">最近同步：</span>
	                                 <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
	                                    <p class="sync_time">{{ $sync_salary_date }}</p>
	                                    <p class="margin-top">开启自动同步申请后，每天早上9点会自动同步"员工薪资调整"的申请单，若同步失败可以使用手动同步！</p>
	                                </div>
	                            </div>
	                            <div class="clearfix message-set-t">
	                                <span class="pull-left setting-child-l">岗位调整同步：</span>
	                                 <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
	                                    <a id="update_gw" href="javascript:void(0);" class="btn btn-primaryxs">&nbsp;&nbsp;手动同步&nbsp;&nbsp;</a>
	                                </div>
	                            </div>
	                            <div class="clearfix message-set-t">
	                                <span class="pull-left setting-child-l">最近同步：</span>
	                                 <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
	                                    <p class="sync_time">{{ $sync_work_date }}</p>
	                                    <p class="margin-top">开启自动同步申请后，每天早上9点会自动同步"岗位调整"的申请单，若同步失败可以使用手动同步！</p>
	                                </div>
	                            </div>
                            </div>
                        </div>
                    </div>
                </div>
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
@endsection
@section('javascript')
    @parent
    <script type="text/javascript">
        var deletefun, btn_dom, dom_name;
        require(['bootstrap','dataimepicker','layer','DataTable','bootstrap-select','validform','icheck','modules/server'], function (bootstrap,dataimepicker,layer,DataTable,bootstrapselect,validform,icheck,server) {
            $(".approver_add").click(function () {
//                $("#submitspr").attr('name','first');
                $("#submitspr").attr("data-name",$(this).attr("data-name"))
                server.get_user_lists_modal($(this),$(this).attr("data-name"));
            });
            //点击提交，将选中的数据id传给后台
            $("#submitspr").click(function () {
                $('.fakeloader').fadeIn(100);
                var user_id = $("#selectpicker_spr").val();
                var orfalse = true;
                let name = $(this).attr("data-name")
                $(document).find("input[name='"+name+"']").each(function (i) {
                    if(user_id == $(this).val()){
                        $('.fakeloader').fadeOut(100);
                        layer.msg('该成员已存在');
                        orfalse = false;
                    };
                });
                if(orfalse){
                    server.get_user_msg(user_id, function (data) {
//                        $("#shrfirst").html(data.html);
                        btn_dom.before(data.html);
                        $("#shrfirst").find('.approver_di').remove();
                        console.log(data);
                        $('.fakeloader').fadeOut(100);
                        $("#choose_spr_modal").modal('hide');
                    },dom_name);
                }

            });

            $("#submit_setting_user").click(function () {
            	var inputs = {
                    'sync': qarray('sync'),

               };
                var dataForm = inputs
                console.log(dataForm)
                var url = '/setting/sync';
                AjaxJson(url,dataForm,function (data) {
                    layer.msg(data.msg);
                    setTimeout(function () {
                        // window.location.reload();
                    },1000);
                });

            });
            deletefun = function(e) {
                var thise= $(e);
                var useid = $(e).attr('name');
                layer.msg('确定删除该成员吗？', {
                    time: 0 //不自动关闭
                    ,btn: ['确定', '取消']
                    ,yes: function(index){
                        layer.close(index);
                        thise.parents('.listapp').remove();
                    }
                });
            }
            // 同步开关状态
            $('.message-set-t').find('input[type=checkbox]').change(function () {
                $('.fakeloader').fadeIn(100);
                // var ischeck;
                if($(this).is(':checked')){
                    $(this).parents('.setting-box').find('.message-set-b').show();
                    $(this).next().html('<span class="text-success">已开启<span>')
                    $("#sync_show").css("display","block")
                    // ischeck = 1;
                }else {
                    $(this).parents('.setting-box').find('.message-set-b').hide();
                    $(this).next().html('<span class="text-danger">已关闭<span>')
                    $("#sync_show").css("display","none")
                    // ischeck = 0;
                }
                $('.fakeloader').fadeOut(100);
              
            });

            // 获取开关和输入框的集合（返回数组）
            function qarray(name) {
                var nameArray = "";
                var id ='#' + name + 'check';
                var a = null;
                if($(id).is(':checked')){
                    a = '1';
                }else {
                    a = '0';
                }
                nameArray = a;
                return nameArray;
            }
            $(".app_jia").on('mouseover',function(){
            	let img = "{{ url('/img/jia-hover.png') }}";
            	$(this).attr('src', img)
            })
            $(".app_jia").on('mouseout',function(){
            	let img = "{{ url('/img/jia.png') }}";
            	$(this).attr('src', img)
            })
            //  同步
                $("#update").click(function () {
                    get_user_sync("user/sync");
                });
                $("#update_xz").click(function () {
                    get_user_sync("sync/salary");
                });
                $("#update_gw").click(function () {
                    get_user_sync("sync/pro");
                });
                

                function get_user_sync(name_url) {
	                $('.fakeloader').fadeIn(100);
	                let url =  name_url
	                $.ajax({
	                    url:url,
	                    type: "get",
	                    dataType: "json",
	                    timeout:60000,
	                    headers: {
	                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                    },
	                    async: true,
	                    success: function (data) {
	                        $('.fakeloader').fadeOut(100);
	                        layer.msg(data.msg);
	                        if(data.status === 1){
	                            setTimeout(function () {
	                                window.location.reload();
	                            },1000);
	                        }
	                    },
	                    error: function (data) {
	                        $('.fakeloader').fadeOut(100);
	                        layer.msg('哎呦，网络开了小差。是否重新同步吗？', {
	                            time: 0 //不自动关闭
	                            ,btn: ['重新同步', '稍后再试']
	                            ,yes: function(index){
	                                layer.close(index);
	                                get_user_sync()
	                            }
	                        });
	                    }
	                });
            	}
        });
    </script>
@endsection