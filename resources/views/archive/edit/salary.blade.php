@extends('layouts.app')
<!--中间内容区域-->
@section('content')
<div class="container container-responsive">
	 
	<div class="row" style="background: #ffffff;">
        <div class="archiveMenu">
            <nav class="navbar navbar-default hr-nav" style="border: none">
                <!--<div class="container">-->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav flex" style="float: none; border-bottom: 1px solid #BBBBBB;">
                        <li class="{{ active_class(if_route('archive.edit')) }}">
                            <a href="{{ route('archive.edit',[$archive->id]) }}" ><span><i class="iconfont">&#xe605;</i>个人信息</span></a>
                        </li>
                        @include('_parties.edit_archive_menu')
                    </ul>
                </div>

                <!--</div>-->
            </nav>
        </div>

		 <form class="form-horizontal margin-top add-order-form padding-top-lg" id="add_form" style="padding-left: 4rem;padding-right: 4rem;">
 
            {{-- 薪资待遇 --}}
            <div class="row afterboottom3 margin-left-lg margin-right-lg  padding-bottom-lg">
                <div class="archiveTitle">
                    薪资调整记录
                    <span class="pull-right cbtnBox">
                        <a href="javascript:void(0);" class="left" id="salaryDeleteBtn">删除</a> |
                        <a href="javascript:void(0);" class="right" id="salaryAddBtn">新增</a>
                    </span>
                </div>
                <div class="table-responsive">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="allsalary" id="allsalary">
                                </th>
                                <th>薪资状态</th>
                                <th>基本工资（元）</th>
                                <th>绩效</th>
                                <th>合计（元）</th>
                                <th>开始时间</th>
                                <th>备注</th>
                            </tr>
                        </thead>
                        @if($archive->salaries)
                        <tbody id="salaryMain">
                            @foreach( $archive->salaries as $salary)
                                <tr class="main">
                                    <td class="form-group">
                                        <input class="form-control" type="checkbox" name="id" value="{{ $salary->id }}">
                                    </td>
                                    <td class="form-group">
                                        <select class="form-control" name="status">
                                          <option value="0" {{ $salary->status == 0 ? 'selected' : '' }}>入职</option>
                                          <option value="1" {{ $salary->status == 1 ? 'selected' : '' }}>转正</option>
                                          <option value="2" {{ $salary->status == 2 ? 'selected' : '' }}>加薪</option>
                                          <option value="3" {{ $salary->status == 3 ? 'selected' : '' }}>减薪</option>
                                        </select>
                                    </td>
                                    <td class="form-group">
                                        <input class="form-control" onkeyup="number(this.value,$(this));addtoal(this)" type="text" name="basic" value="{{ $salary->basic }}" maxlength="11">
                                    </td>
                                    <td class="form-group">
                                        <input class="form-control" onkeyup="number(this.value,$(this));addtoal(this)" type="text" name="added" value="{{ $salary->added }}" maxlength="11">
                                    </td>
                                     <td class="form-group">
                                        <input class="form-control"  readonly="readonly" type="text" name="total" value="{{ $salary->total }}" maxlength="11">
                                    </td>
                                    <td class="form-group">
                                        <input class="form-control" type="text" name="start_at" value="{{ $salary->start_at->toDateString() }}">
                                    </td>
                                    <td class="form-group">
                                        <input class="form-control" type="text" name="remark" value="{{ $salary->remark }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>

            <div class="text-center margin-bottom">
                <button type="submit" class="btn btn-primary margin-right" id="submitspr">保存</button>
                <a href="/archive/on" class="btn btn-default">返回</a>
            </div>
         </form>
	</div>
</div>
 
    
<style type="text/css">
	.add-order-form .control-label {
		color: #101010;
	}
    .table>tbody>tr.main>td {
        border-top: none;
    }
    .afterboottom3 .table {
        border-bottom: none;
    }
    input[type=checkbox] {
        width: 18px;
        height: 18px;
        position: relative;
        top: 4px;
     }
     .table>thead>tr>th {
        background: none;
     }
</style>
@endsection

@section('javascript')
	@parent
	<script>
        var addtoal;
		require(['bootstrap','dataimepicker','DataTable','layer','validform','ztree','jcrop'], function (DataTable) {

			 //日期控件初始化
             function dataconfig(){
                var date = new Date();
                $(".dataV").datetimepicker({
                    format: 'yyyy-mm-dd',
    //                   language: 'zh-CN',
                    // startDate: date,
                    autoclose :true,
                     minView:'month',    //选择到日，
                });
             }
            dataconfig();




 
            // 薪资
          $("#salaryDeleteBtn").click(function(){
            var ad = 0;
            $("#salaryMain input[name=id]").each(function(){
                var $th = $(this);
                if($th.is(':checked')){
                    ad++
                }
            }); 
            if(ad > 0){
                 layer.msg('确定删除吗？', {
                    time: 0 //不自动关闭
                    ,btn: ['确定', '取消']
                    ,yes: function(index){
                        $("#salaryMain input[name=id]").each(function(){
                            var $this = $(this);
                            if($this.is(':checked')){
                               $this.parents('.main').remove(); 
                            }
                        }); 
                        layer.close(index);
                    }
                });
             }else {
                 layer.msg('请勾选要删除的项')
             }
               
          });
          $("#salaryAddBtn").click(function(){
             var strVar = "";
             strVar +='<tr class="main"><td><input type="checkbox" class="salary" name="id" value=""></td>';
             strVar +='<td class="form-group"><select class="form-control" name="status"><option value="0">入职</option><option value="1">转正</option><option value="2">加薪</option><option value="3">减薪</option></select></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="basic" datatype="*" nullmsg="基本工资不能为空" onkeyup="number(this.value,$(this));addtoal(this)" maxlength="11"></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="added" datatype="*" nullmsg="绩效不能为空" onkeyup="number(this.value,$(this));addtoal(this)" maxlength="11"></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="total" datatype="*" nullmsg="合计不能为空" readonly="readonly" maxlength="11"></td>'
             strVar +='<td class="form-group"><input class="form-control dataV" type="text" name="start_at" datatype="*" nullmsg="生效时间不能为空" onkeyup="convert(this.value,$(this))"></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="remark"  nullmsg="备注"></td>'
             $("#salaryMain").append(strVar);
             dataconfig();
          });
          //全选功能
            var ft = false;
            $("#allsalary").click(function () {
                ft = !ft;
                $("#salaryMain input[name='id']").prop("checked", ft)
            });

// -------------------------------------------------------------------------------------------------------------------------------------

 




             $("#add_form").Validform({
                tiptype: function (msgs, o, cssctl) {
                    if (o.type != 2) {     //只有不正确的时候才出发提示，输入正确不提示
                        layer.msg(msgs);
                    }
                },
                ajaxPost: true,//true用ajax提交，false用form方式提交
                tipSweep: true,//true只在提交表单的时候开始验证，false每输入完一个输入框之后就开始验证
                beforeSubmit: function (curform) {
                    $('.fakeloader').fadeIn(100);
                    //给时间添加上秒的格式
                    var salaries = [];
                    $("#salaryMain tr.main").each(function(){
                        var $this = $(this);
                        salaries.push(GetWebControls($this))
                    })
                    var url = '/archive/salary/'+ {{ $archive->id }} +'/update';
                    AjaxJson(url,{'salaries':salaries},function(data){
                        if(data.status){
                            layer.msg(data.msg);
                            setTimeout(function(){
                                // window.location.reload();
                            },2000)
                        }else {
                            layer.msg(data.msg)
                        }
                    })
                    return false;
                }
            });


            addtoal = function (dos){
            
                var basicval = $(dos).parents('tr').find('input[name=basic]').val();
                var addedval = $(dos).parents('tr').find('input[name=added]').val();
                $(dos).parents('tr').find('input[name=total]').val(Number(basicval) + Number(addedval));
            }

		})
	</script>
@endsection