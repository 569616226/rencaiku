@extends('layouts.app')
<!--中间内容区域-->
@section('content')
    <!--中间内容区域-->
    <div class="container container-responsive">
        <div class="row hr-main-bg">
            @include('_parties.notice_menu')
            <div class="right-side col-xs-12 col-sm-10 col-md-9 col-lg-10">
                  <div class="right-side col-xs-12 col-sm-12 col-md-12 col-lg-12">
                   <div class="row margin-top-lg padding-left-lg padding-right-lg">
                        <div class="text-center afterboottom3 padding-bottom-lg">
                            <h2 style="font-size: 28px;">发送录取通知书</h2>
                        </div>
                        <form class="form-horizontal margin-top add-order-form" id="add_form">
                             <div class="margin-top-lg">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><span class="must-icon">* </span>应聘者：</label>
                                    <div class="col-sm-6">
                                         <span class="form-control" style="border: none;box-shadow:none;">{{ $subscribe->resumes->name }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><span class="must-icon">* </span>应聘职位：</label>
                                    <div class="col-sm-6">
                                         <span class="form-control" style="border: none;box-shadow:none;">{{ $subscribe->examines->position }}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><span class="must-icon">* </span>接收人邮箱：</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="email" name=""  class="form-control" value="{{ $subscribe->resumes->email }}" datatype="e" nullmsg="请输入接收人邮箱" errormsg="邮箱格式错误" onKeypress="javascript:space_val()">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><span class="must-icon">* </span>试用期：</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="shakedown_period" name=""  class="form-control" value="" datatype="n1-8" nullmsg="请输入试用期" errormsg="只能输入1到8位数字" onKeypress="javascript:space_val()" maxlength="8" onkeyup="number(this.value,$(this))"  onafterpaste="number(this.value,$(this))">
                                    </div>
                                    <label class="col-sm-2 control-label" style="text-align: left;">个月</label>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><span class="must-icon">* </span>报道时间：</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="offer_date" name=""  class="form-control" value="" datatype="*" nullmsg="请输入报道时间" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><span class="must-icon">* </span>试用期薪资（元）：</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="probation_salary" name=""  class="form-control" value="" datatype="n1-8" nullmsg="请输入试用期薪资" errormsg="只能输入1到8位数字" onKeypress="javascript:space_val()" maxlength="8" onkeyup="number(this.value,$(this))"  onafterpaste="number(this.value,$(this))">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-sm-4 control-label"><span class="must-icon">* </span>基本薪资（元）：</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="basic_pay" name=""  class="form-control" value="" datatype="n1-8" nullmsg="请输入基本薪资" errormsg="只能输入1到8位数字" onKeypress="javascript:space_val()" maxlength="8" onkeyup="number(this.value,$(this))"  onafterpaste="number(this.value,$(this))">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><span class="must-icon">* </span>入职须知连接：</label>
                                    <div class="col-sm-6">
                                        <input type="text" id="link" name=""  class="form-control" value="http://doc.elinkport.com" datatype="*" nullmsg="请输入入职须知" >
                                    </div>
                                </div>
                            
                        </div>
                        <div class="text-center margin-top-xl">
                            <button type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp;预览通知书&nbsp;&nbsp;&nbsp;</button>
                            <a href="javascript:;" id="check_back" class="btn btn-default">返回</a>
                        </div>
                        </form>
                   </div>
            </div>
            </div>
        </div>
    </div>
 
@endsection

@section('javascript')
    @parent
<script type="text/javascript">
var new_time = getNowFormatDate(),check_input;
require(['bootstrap', 'dataimepicker', 'DataTable', 'layer', 'validform'], function(DataTable) {
	//日期控件初始化
	var date = new Date();
	$("#offer_date").datetimepicker({
		format: 'yyyy-mm-dd',
		startDate: date,
		autoclose: true,
		minView: 'month',
		//选择到日
	});
	$("#add_form").Validform({
		tiptype: function(msgs, o, cssctl) {
			if (o.type != 2) { //只有不正确的时候才出发提示，输入正确不提示
				layer.msg(msgs);
			}
		},
		ajaxPost: true,
		//true用ajax提交，false用form方式提交
		tipSweep: true,
		//true只在提交表单的时候开始验证，false每输入完一个输入框之后就开始验证
		beforeSubmit: function(curform) {
			let dom_show = '@include("notice.create.show")';
			layer.open({
				type: 1 //Page层类型
				,
				area: ['860px', '610px'],
				title: '预览录取通知书',
				shade: 0.6 //遮罩透明度
				,
				maxmin: true //允许全屏最小化
				,
				anim: 1 //0-6的动画形式，-1不开启
				,
				content: dom_show
			});
			$(".notice_time").text($("#offer_date").val());
			$(".shakedown_period").text($("#shakedown_period").val());
			$(".probation_salary").text($("#probation_salary").val());
			$(".basic_pay").text($("#basic_pay").val());
			$(".getNowFormatDate").text(new_time);
			$("#link_yu").attr("href",$("#link").val())
			$("#link_yu").text($("#link").val())
			$("#notice_btn_form").attr("onclick", "btn_form()");
			return false
		}
	});
	$("input").bind("input propertychange change",function(event){
		check_input = 1
	})
	$("#check_back").on("click",function(){
		if(check_input == 1){
	        layer.msg('确定关闭吗？', {
	            time: 0 //不自动关闭
	            ,btn: ['确定', '取消']
	            ,yes: function(index){
	                window.history.go(-1)
	            }
	        });
		}else{
			window.history.go(-1)
		}
	})
});

function btn_form() {
	$('.fakeloader').fadeIn(100);
	//给时间添加上秒的格式
	var postData = {
		name: "{{ $subscribe->resumes->name }}",
		wechat_position: "{{ $subscribe->resumes->wechat_position }}",
		email: $("#email").val(),
		shakedown_period: $("#shakedown_period").val(),
		offer_date: $("#offer_date").val(),
		probation_salary: $("#probation_salary").val(),
		basic_pay: $("#basic_pay").val(),
		link: $("#link").val()
	};
	var url = '/notice/' + "{{$subscribe->notice->id}}"  + '/ship';
	$.ajax({
		url: url,
		type: "post",
		data: postData,
		dataType: "json",
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		async: true,
		success: function(data) {
			if (data.status == true) {
				$('.fakeloader').fadeOut(100);
                setTimeout(function () {
                    window.location.href = "{{ url('/notice') }}";
                },1000);
				layer.msg(data.msg);

			} else {
				$('.fakeloader').fadeOut(100);
				layer.msg(data.msg);
			}
		},
		error: function(xhr, status, error) {
			console.log(xhr);
			console.log(status);
			console.log(error);
			$('.fakeloader').fadeOut(100);
			layer.msg('网络开了小差，请重新提交');
			if (error == 'Gateway Time-out') {
				setTimeout(function() {
					window.location.reload();
				}, 1000);
			}
		}
	});
}
</script>
@endsection