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
                    <p style="font-size: 16px;padding-top: 2rem;padding-bottom: 2rem; border-bottom: #E3E3E3 1px solid">提醒设置</p>
                </div>
                <div class="main-content padding">
                    <div id="formBox">
                        <div class="setting-box">
                            <div class="clearfix message-set-t">
                                <span class="pull-left setting-child-l">人员转正：</span>
                                 <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
                                    <label>
                                        <input type="checkbox" {{ $setting->full[0] ? 'checked' : '' }} id="fullcheck" value=""><span class="l-tip">
                                            @if($setting->full[0])
                                                <span class="text-success">已开启</span>
                                            @else
                                                <span class="text-danger">已关闭</span>
                                            @endif
                                        </span>
                                    </label>
                                    <p class="margin-top">开启后，将在员工试用结束前7天/3天/1天进行提醒，完成待办后不再提醒！</p>
                                </div>
                            </div>
                            <div class="clearfix message-set-t">
                                <span class="pull-left setting-child-l">提醒人：</span>
                                <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
			                        <div class="pull-left">
			                            <div class="approver">
			                                <div class="shr_box" id="shrfirst">
			                                    @if($user_fulls)
			                                        @foreach($user_fulls as $user)
			                                            <div class="approver listapp">
			                                                <div class="approver_o">
			                                                    <i onclick="deletefun(this)" class="iconfont" id="delete_icon">&#xe634;</i>
			                                                    <input type="hidden"  name="full_user_id" value="{{ $user->id }}" >
			                                                    <div class="listapp_img">
			                                                        <img src="{{ $user->avatar }}" class="img-responsive">
			                                                    </div>
			                                                    <p>{{ $user->name }}</p>
			                                                </div>
			                                            </div>
			                                        @endforeach
			                                    @endif
			                                    <div class="approver_add" id="sprmodalfirst" data-name="full_user_id">
			                                        <img src="{{ url('/img/jia.png') }}" class="app_jia"/>
			                                    </div>
			                                </div>
			                            </div>
			                            <div class="approver_text margin-0">设置接受提醒的成员，在设置好的时间内，会在企业微信中进行提醒</div>
	                                </div>
                            	</div>
                        	</div>
                        </div>
                        <div class="setting-box">
                            <div class="clearfix message-set-t">
                                <span class="pull-left setting-child-l">合同续签提醒：</span>
                                 <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
                                    <label>
                                        <input type="checkbox" {{ $setting->renew[0] ? 'checked' : '' }}  id="renewcheck"><span class="l-tip">
                                             @if($setting->renew[0])
                                                <span class="text-success">已开启</span>
                                            @else
                                                <span class="text-danger">已关闭</span>
                                            @endif
                                        </span>
                                    </label>
                                    <p class="margin-top">开启后，将在员工合同结束时间前7天/3天/1天进行提醒，完成待办后不再提醒！</p>
                                </div>
                            </div>
                            <div class="clearfix message-set-t">
                                <span class="pull-left setting-child-l">提醒人：</span>
                                <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
			                        <div class="pull-left">
			                            <div class="approver">
			                                <div class="shr_box" id="shrfirst">
			                                    @if($user_agrees)
			                                        @foreach($user_agrees as $user_agree)
			                                            <div class="approver listapp">
			                                                <div class="approver_o">
			                                                    <i onclick="deletefun(this)" class="iconfont" id="delete_icon">&#xe634;</i>
			                                                    <input type="hidden"  name="renew_user_id" value="{{ $user_agree->id }}" >
			                                                    <div class="listapp_img">
			                                                        <img src="{{ $user_agree->avatar }}" class="img-responsive">
			                                                    </div>
			                                                    <p>{{ $user_agree->name }}</p>
			                                                </div>
			                                            </div>
			                                        @endforeach
			                                    @endif
			                                    <div class="approver_add" id="sprmodalfirst" data-name="renew_user_id">
			                                        <img src="{{ url('/img/jia.png') }}" class="app_jia"/>
			                                    </div>
			                                </div>
			                            </div>
			                            <div class="approver_text margin-0">设置接受提醒的成员，在设置好的时间内，会在企业微信中进行提醒</div>
	                                </div>
                            	</div>
                        	</div>
                        </div>

                        <div class="setting-box">
                            <div class="clearfix message-set-t">
                                <span class="pull-left setting-child-l">员工周年提醒：</span>
                                 <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
                                    <label>
                                        <input type="checkbox" {{ $setting->year[0] ? 'checked' : '' }} id="yearcheck"><span class="l-tip">
                                             @if($setting->year[0])
                                                <span class="text-success">已开启</span>
                                            @else
                                                <span class="text-danger">已关闭</span>
                                            @endif
                                        </span>
                                    </label>
                                    <p class="margin-top">开启后，将在员工工作满指定年份前7天/3天/1天进行提醒，完成待办后不再提醒！</p>
                                </div>
                            </div>
                            <div class="clearfix message-set-t">
                                <span class="pull-left setting-child-l">提醒人：</span>
                                <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
			                        <div class="pull-left">
			                            <div class="approver">
			                                <div class="shr_box" id="shrfirst">
			                                    @if($user_years)
			                                        @foreach($user_years as $user_year)
			                                            <div class="approver listapp">
			                                                <div class="approver_o">
			                                                    <i onclick="deletefun(this)" class="iconfont" id="delete_icon">&#xe634;</i>
			                                                    <input type="hidden"  name="year_user_id" value="{{ $user_year->id }}" >
			                                                    <div class="listapp_img">
			                                                        <img src="{{ $user_year->avatar }}" class="img-responsive">
			                                                    </div>
			                                                    <p>{{ $user_year->name }}</p>
			                                                </div>
			                                            </div>
			                                        @endforeach
			                                    @endif
			                                    <div class="approver_add" id="sprmodalfirst" data-name="year_user_id">
			                                        <img src="{{ url('/img/jia.png') }}" class="app_jia"/>
			                                    </div>
			                                </div>
			                            </div>
			                            <div class="approver_text margin-0">设置接受提醒的成员，在设置好的时间内，会在企业微信中进行提醒</div>
	                                </div>
                            	</div>
                        	</div>
                        </div>

                         <div class="setting-box">
                            <div class="clearfix message-set-t">
                                <span class="pull-left setting-child-l">员工生日提醒：</span>
                                 <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
                                    <label>
                                        <input type="checkbox" {{ $setting->birthday && $setting->birthday[0] ? 'checked' : '' }} id="birthdaycheck"><span class="l-tip">
                                             @if($setting->birthday[0])
                                                <span class="text-success">已开启</span>
                                            @else
                                                <span class="text-danger">已关闭</span>
                                            @endif
                                        </span>
                                    </label>
                                    <p class="margin-top">开启后，将在每个季度结束前14天进行提醒，完成待办后不再提醒！</p>
                                </div>
                            </div>
                            <div class="clearfix message-set-t">
                                <span class="pull-left setting-child-l">提醒人：</span>
                                <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
			                        <div class="pull-left">
			                            <div class="approver">
			                                <div class="shr_box" id="shrfirst">
			                                    @if($user_birthdays)
			                                        @foreach($user_birthdays as $user_birthday)
			                                            <div class="approver listapp">
			                                                <div class="approver_o">
			                                                    <i onclick="deletefun(this)" class="iconfont" id="delete_icon">&#xe634;</i>
			                                                    <input type="hidden"  name="birthday_user_id" value="{{ $user_birthday->id }}" >
			                                                    <div class="listapp_img">
			                                                        <img src="{{ $user_birthday->avatar }}" class="img-responsive">
			                                                    </div>
			                                                    <p>{{ $user_birthday->name }}</p>
			                                                </div>
			                                            </div>
			                                        @endforeach
			                                    @endif
			                                    <div class="approver_add" id="sprmodalfirst" data-name="birthday_user_id">
			                                        <img src="{{ url('/img/jia.png') }}" class="app_jia"/>
			                                    </div>
			                                </div>
			                            </div>
			                            <div class="approver_text margin-0">设置接受提醒的成员，在设置好的时间内，会在企业微信中进行提醒</div>
	                                </div>
                            	</div>
                        	</div>
                        </div>

                        <div class="setting-box">
                            <div class="clearfix message-set-t">
                                <span class="pull-left setting-child-l">亲属生日提醒：</span>
                                <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
                                    <label>
                                        <input type="checkbox" {{ $setting->family_birthday && $setting->family_birthday[0] ? 'checked' : '' }} id="family_birthdaycheck"><span class="l-tip">
                                             @if($setting->family_birthday[0])
                                                <span class="text-success">已开启</span>
                                            @else
                                                <span class="text-danger">已关闭</span>
                                            @endif
                                        </span>
                                    </label>
                                    <p class="margin-top">开启后，每周一和每周三早上9点对所有提醒人进行提醒，提醒本周内亲属生日的信息！</p>
                                </div>
                            </div>
                            <div class="clearfix message-set-t">
                                <span class="pull-left setting-child-l">提醒人：</span>
                                <div class="pull-left checkbox checkbox-slider--b-flat checkbox-slider-md" style="margin-top: 1.8rem;">
			                        <div class="pull-left">
			                            <div class="approver">
			                                <div class="shr_box" id="shrfirst">
			                                    @if($user_families)
			                                        @foreach($user_families as $user_family)
			                                            <div class="approver listapp">
			                                                <div class="approver_o">
			                                                    <i onclick="deletefun(this)" class="iconfont" id="delete_icon">&#xe634;</i>
			                                                    <input type="hidden"  name="family_birthday_user_id" value="{{ $user_family->id }}" >
			                                                    <div class="listapp_img">
			                                                        <img src="{{ $user_family->avatar }}" class="img-responsive">
			                                                    </div>
			                                                    <p>{{ $user_family->name }}</p>
			                                                </div>
			                                            </div>
			                                        @endforeach
			                                    @endif
			                                    <div class="approver_add" id="sprmodalfirst" data-name="family_birthday_user_id">
			                                        <img src="{{ url('/img/jia.png') }}" class="app_jia"/>
			                                    </div>
			                                </div>
			                            </div>
			                            <div class="approver_text margin-0">设置接受提醒的成员，在设置好的时间内，会在企业微信中进行提醒</div>
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
    <div class="modal-box">
        {{--选择审批人模态框--}}
        <div class="modal fade" id="choose_spr_modal">
            <div class="modal-dialog modalwidth-xs" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">选择成员</h4>
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
                        <button type="button" class="btn btn-primary" id="submitspr" data-name="#">提交</button>
                    </div>
                </div>
            </div>
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
                    'full': qarray('full'),
                    'renew': qarray('renew'),
                    'birthday': qarray('birthday'),
                    'year': qarray('year'),
                    'family_birthday': qarray('family_birthday')

               };
                var dataForm = inputs
                console.log(dataForm)
                var url = '/setting/notice';
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
                    // ischeck = 1;
                }else {
                    $(this).parents('.setting-box').find('.message-set-b').hide();
                    $(this).next().html('<span class="text-danger">已关闭<span>')
                    // ischeck = 0;
                }
                $('.fakeloader').fadeOut(100);
              
            });

            // 获取开关和输入框的集合（返回数组）
            function qarray(name) {
                var nameArray = [];
                var id ='#' + name + 'check';
                var a = null;
                var b = [];
                if($(id).is(':checked')){
                    a = '1';
                }else {
                    a = '0';
                }
                $("input[name="+ name +"_user_id]").each(function(){
                	b.push($(this).val())
                })
                nameArray = [a,b];
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
        });
    </script>
@endsection