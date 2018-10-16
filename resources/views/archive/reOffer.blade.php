@extends('layouts.app')
<!--中间内容区域-->
@section('content')
    <!--中间内容区域-->
    <div class="container container-responsive">
        <div class="row hr-main-bg">
            @include('_parties.archive_menu')
            <div class="right-side col-xs-12 col-sm-10 col-md-9 col-lg-10">
                  <div class="right-side col-xs-12 col-sm-10 col-md-9 col-lg-10">
                   <div class="row margin-top-lg padding-left-lg padding-right-lg">
                        <div class="text-center afterboottom3 padding-bottom-lg">
                            <h2 style="font-size: 28px;">复职员工</h2>
                            <p class="text-left margin-top"><i class="iconfont" style="color: #908BC4; margin-right: 1rem;position: relative;top: 2px;">&#xe601;</i>设置复职员工的相关信息后才可以复职成功！</p>
                        </div>
                        <form class="form-horizontal margin-top add-order-form" id="add_form">
                             <div class="margin-top-lg">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><span class="must-icon">* </span>复职员工：</label>
                                    <div class="col-sm-6">
                                         <span class="form-control" style="border: none;box-shadow:none;">{{ $archive->name }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><span class="must-icon">* </span>复职部门：</label>
                                    <div class="col-sm-6">
                                         {{-- <input type="text" id="" name="offer_depart"  class="form-control" value="" datatype="*" nullmsg="请输入复职部门" > --}}
                                         <select class="form-control" name="offer_depart">
                                            @foreach( $departs as $depart )
                                                <option value="{{ $depart->id }}">{{ $depart->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><span class="must-icon">* </span>复职岗位：</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="" name="offer_name"  class="form-control" value="{{ $archive->offer_name }}" datatype="*" nullmsg="请输入复职岗位" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><span class="must-icon">* </span>复职时间：</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="offer_on_date" name="offer_on_date"  class="form-control dateV" value="" datatype="*" nullmsg="请输入复职时间" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><span class="must-icon">* </span>复职后员工状态：</label>
                                    <div class="col-sm-6">
                                         <select id="offer_status" class="form-control col-md-6" name="offer_status">
                                          <option value="2">在职（试用期）</option>
                                          <option value="1">在职（已转正）</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="offer_date_box">
                                    <label class="col-sm-4 control-label"><span class="must-icon">* </span>转正时间：</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="offer_date" name="offer_date"  class="form-control dateV" value="" >
                                    </div>
                                </div>
                            
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;提交&nbsp;&nbsp;&nbsp;</button>
                            <a class="btn btn-default" href="javascript:window.history.go(-1);" >返回</a>
                        </div>
                        </form>
                   </div>
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
    require(['bootstrap','dataimepicker','DataTable','layer','validform'], function (DataTable) {
        //日期控件初始化
            var date = new Date();
            $(".dateV").datetimepicker({
                  format: 'yyyy-mm-dd',
//                   language: 'zh-CN',
                startDate: date,
                autoclose :true,
                 minView:'month',    //选择到日，
            });
        
            $("#offer_status").change(function(){
                if($(this).val() == 2){
                    $("#offer_date_box").show();
                }else {
                    $("#offer_date_box").hide();
                }
            });

        $("#add_form").Validform({
                tiptype: function (msgs, o, cssctl) {
                    if (o.type != 2) {     //只有不正确的时候才出发提示，输入正确不提示
                        layer.msg(msgs);
                    }
                },
                ajaxPost: true,//true用ajax提交，false用form方式提交
                tipSweep: true,//true只在提交表单的时候开始验证，false每输入完一个输入框之后就开始验证
                beforeSubmit: function (curform) {
                    if($("#offer_status").val() == 2 && $("#offer_date").val() == ""){ 
                        layer.msg("请输入转正时间");
                        return false;
                     }
                    $('.fakeloader').fadeIn(100);
                    //给时间添加上秒的格式
                    var postData = GetWebControls("#add_form");
                    console.log(postData)
                    var url = '/archive/'+ {{ $archive->id }} +'/reOffer';
                       AjaxJson(url,postData,function(data){
                            if(data.status){
                                layer.msg(data.msg);
                                setTimeout(function(){
                                    window.location.href = '/archive/off'
                                },2000)
                            }else {
                                layer.msg(data.msg);
                            }
                       });
                    return false;
                }
            });
       });
</script>
@endsection