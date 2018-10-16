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
                    <p style="font-size: 16px;padding-top: 2rem;padding-bottom: 2rem; border-bottom: #E3E3E3 1px solid">简历查看设置</p>
                </div>
                <div class="main-content padding afterboottom">
                    <div class="clearfix" style="margin-bottom: 20px;">
                        <label class="pull-left" style="margin-top: 2rem;color: #A3A3A3; width: 8rem">选择成员：</label>
                        <div class="pull-left">
                            <div class="approver">
                                <div class="shr_box" id="shrfirst">
                                    @if($users)
                                        @foreach($users as $user)
                                        <div class="approver listapp">
                                            <div class="approver_o">
                                                <i onclick="deletefun(this)" class="iconfont">&#xe634;</i>
                                                <input type="hidden"  name="user_id" value="{{ $user->id }}" >
                                                <div class="listapp_img">
                                                    <img src="{{ $user->avatar }}" class="img-responsive">
                                                </div>
                                                <p>{{ $user->name }}</p>
                                            </div>

                                        </div>
                                        @endforeach
                                    @endif
                                    <div class="approver_add" id="sprmodalfirst">
                                        <img src="{{ url('/img/jia.png') }}" class="app_jia"/>
                                    </div>
                                </div>
                            </div>
                            <div class="approver_text margin-0">只有选择后的成员，可以访问简历库的人员名单：其余成员不能操作人才库，包括查看，导入，删除</div>
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
                        layer.msg('该成员已存在');
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
//               if(user_ids.length){
                   var url = '/setting/resume'
                   AjaxJson(url,{'user_ids':user_ids},function (data) {
                       layer.msg(data.msg);
                       setTimeout(function () {
                           window.location.reload();
                       },1000);
                   });
//               }else {
//                   layer.msg('请选择成员');
//               }
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