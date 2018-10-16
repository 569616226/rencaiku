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

            {{-- 家庭档案 --}}
            <div class="row afterboottom3 margin-left-lg margin-right-lg  padding-bottom-lg">
                <div class="archiveTitle">
                    家庭档案
                    <span class="pull-right cbtnBox">
                        <a href="javascript:void(0);" class="left" id="familyDeleteBtn">删除</a> |
                        <a href="javascript:void(0);" class="right" id="familyAddBtn">新增</a>
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="allfamily" id="allfamily">
                                </th>
                                <th>姓名</th>
                                <th>关系</th>
                                <th>职业</th>
                                <th>生日</th>
                                <th>年龄</th>
                                <th>生日祝福提醒</th>
                                <th>住址</th>
                            </tr>
                        </thead>
                        <tbody id="familyMain" class="">
                        @foreach( $families as $family)
                            <tr class="main">
                                <td><input type="checkbox" name="id" value="{{ $family->id }}"></td>
                                <td class="form-group">
                                    <input class="form-control" type="text" name="name" value="{{ $family->name }}">
                                </td>
                                <td class="form-group">
                                    <select class="form-control" name="relation">
                                      <option value="1" {{ $family->relation == 1 ? 'selected' : '' }}>父亲</option>
                                      <option value="2" {{ $family->relation == 2 ? 'selected' : '' }}>母亲</option>
                                      <option value="3" {{ $family->relation == 3 ? 'selected' : '' }}>儿子</option>
                                      <option value="4" {{ $family->relation == 4 ? 'selected' : '' }}>女儿</option>
                                      <option value="5" {{ $family->relation == 5 ? 'selected' : '' }}>夫妻</option>
                                    </select>
                                </td>
                                <td class="form-group">
                                    <input class="form-control" type="text" name="offer" value="{{ $family->offer }}">
                                </td>
                                <td class="form-group">
                                    <input class="form-control dataV" type="text" name="birthday" value="{{ $family->birthday->toDateString() }}">
                                </td>
                                <td class="form-group">
                                    <input class="form-control" type="text" name="age" value="{{ $family->age }}">
                                </td>
                                <td class="form-group">
                                    <select class="form-control" name="birthday_type">
                                      <option value="1" {{ $family->birthday_type == 1 ? 'selected' : '' }}>按阳历</option>
                                      <option value="0" {{ $family->birthday_type == 0 ? 'selected' : '' }}>按农历</option>
                                    </select>
                                </td>
                                <td class="form-group">
                                    <input class="form-control" type="text" name="address" value="{{ $family->address }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row afterboottom3 margin-left-lg margin-right-lg  padding-bottom-lg">
                <div class="archiveTitle">
                    家庭情况记录
                </div>
                <div class="col-md-2 text-right">
                    内容：
                </div>
                <div class="col-md-10">
                    <textarea class="form-control" id="family_discrible" rows="4">{{ $archive->family_discrible }}</textarea>
                </div>
                <div style="clear: both;"></div>
            </div>
            {{-- 劳动合同 --}}
            <div class="row afterboottom3 margin-left-lg margin-right-lg  padding-bottom-lg">
                <div class="archiveTitle">
                    劳动合同
                    <span class="pull-right cbtnBox">
                        <a href="javascript:void(0);" class="left" id="laborDeleteBtn">删除</a> |
                        <a href="javascript:void(0);" class="right" id="laborAddBtn">新增</a>
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="alllabor" id="alllabor">
                                </th>
                                <th>合同类型</th>
                                <th>签订情况</th>
                                <th>合同编号</th>
                                <th>生效时间</th>
                                <th>到期时间</th>
                            </tr>
                        </thead>
                        <tbody id="laborMain">
                        @foreach( $agrees as $agree)
                            <tr class="main">
                                <td><input type="checkbox" name="id" value="{{ $agree->id }}"></td>
                                {{--'合同类型0：非固定期限合同 1：固定期限合同'--}}
                                <td class="form-group">
                                    <select class="form-control" name="type">
                                      <option value="1" {{ $agree->type == 1 ? 'selected' : '' }}>固定期限合同</option>
                                      <option value="0" {{ $agree->type == 0 ? 'selected' : '' }}>非固定期限合同</option>
                                    </select>
                                </td>
                                <td class="form-group">
                                    <select class="form-control" name="sign_type">
                                      <option value="0" {{ $agree->sign_type == 0 ? 'selected' : '' }}>首签</option>
                                      <option value="1" {{ $agree->sign_type == 1 ? 'selected' : '' }}>续签</option>
                                    </select>
                                </td>
                                 <td class="form-group">
                                    <input class="form-control" type="text" name="no" value="{{  $agree->no  }}">
                                </td>
                                <td class="form-group">
                                    <input class="form-control dataV" type="text" name="effect_at" value="{{ $agree->effect_at->toDateString() }}">
                                </td>
                                 <td class="form-group">
                                    <input class="form-control dataV" type="text" name="expire_at" value="{{ $agree->expire_at->toDateString() }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- 教育经历 --}}
            <div class="row afterboottom3 margin-left-lg margin-right-lg  padding-bottom-lg">
                <div class="archiveTitle">
                    教育经历
                    <span class="pull-right cbtnBox">
                        <a href="javascript:void(0);" class="left" id="educationDeleteBtn">删除</a> |
                        <a href="javascript:void(0);" class="right" id="educationAddBtn">新增</a>
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="alleducation" id="alleducation">
                                </th>
                                <th>学历</th>
                                <th>开始时间</th>
                                <th>结束时间</th>
                                <th>学校名称</th>
                                <th>专业</th>
                                <th>是否毕业</th>
                            </tr>
                        </thead>
                        <tbody id="educationMain">
                        @foreach( $educations as $education)
                            <tr class="main">
                                <td><input type="checkbox" name="id" value="{{ $education->id }}"></td>
                                {{--学历 0:初中 1：高中/中专 2：大专 3；大学--}}
                                 <td class="form-group">
                                    <select class="form-control" name="education">
                                        @if($education->education == 0)
                                          <option value="0" selected="selected">初中</option>
                                      <option value="1" >高中/中专</option>
                                      <option value="2" >大专</option>
                                      <option value="3" >本科</option>
                                        @elseif($education->education == 1)
                                        <option value="0" >初中</option>
                                      <option value="1" selected="selected">高中/中专</option>
                                      <option value="2" >大专</option>
                                      <option value="3" >本科</option>
                                        @elseif($education->education == 2)
                                         <option value="0" >初中</option>
                                      <option value="1" >高中/中专</option>
                                      <option value="2" selected="selected" >大专</option>
                                      <option value="3" >本科</option>
                                        @elseif($education->education == 3)
                                        <option value="0" >初中</option>
                                      <option value="1" >高中/中专</option>
                                      <option value="2" >大专</option>
                                      <option value="3" selected="selected">本科</option>
                                        @endif
                                    </select>
                                </td>
                                <td class="form-group">
                                    <input class="form-control dataV" type="text" name="start_at" value="{{ $education->start_at->toDateString() }}">
                                </td>
                                <td class="form-group">
                                    <input class="form-control dataV" type="text" name="end_at" value="{{ $education->end_at->toDateString() }}">
                                </td>
                                 <td class="form-group">
                                    <input class="form-control" type="text" name="name" value="{{ $education->name }}">
                                </td>
                                 <td class="form-group">
                                    <input class="form-control" type="text" name="major" value="{{ $education->major }}">
                                </td>
                                {{--是否毕业 0:没有，1：有--}}
                                <td class="form-group">
                                    <select class="form-control" name="is_finish">
                                      <option value="1" {{ $education->is_finish == 1 ? 'selected' : '' }}>是</option>
                                      <option value="0" {{ $education->is_finish == 0 ? 'selected' : '' }}>否</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            {{-- 工作经历 --}}
            <div class="row afterboottom3 margin-left-lg margin-right-lg  padding-bottom-lg">
                <div class="archiveTitle">
                    工作经历
                    <span class="pull-right cbtnBox">
                        <a href="javascript:void(0);" class="left" id="workDeleteBtn">删除</a> |
                        <a href="javascript:void(0);" class="right" id="workAddBtn">新增</a>
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="allwork" id="allwork">
                                </th>
                                <th>工作单位</th>
                                <th>开始时间</th>
                                <th>结束时间</th>
                                <th>职位</th>
                                <th>离职原因</th>
                                <th>最终薪资（元）</th>
                                <th>联系电话</th>
                            </tr>
                        </thead>
                        <tbody id="workMain">
                        @foreach( $works as $work)
                            <tr class="main">
                                <td><input type="checkbox" name="id" value="{{ $work->id }}"></td>
                                <td class="form-group">
                                    <input class="form-control" type="text" name="name" value="{{ $work->name }}">
                                </td>
                                <td class="form-group">
                                    <input class="form-control dataV" type="text" name="start_at" value="{{ $work->start_at->toDateString() }}">
                                </td>
                                <td class="form-group">
                                    <input class="form-control dataV" type="text" name="end_at" value="{{ $work->end_at->toDateString() }}">
                                </td>
                                <td class="form-group">
                                    <input class="form-control" type="text" name="position" value="{{ $work->position }}">
                                </td>
                                <td class="form-group">
                                    <input class="form-control" type="text" name="reason" value="{{ $work->reason }}">
                                </td>
                                <td class="form-group">
                                    <input class="form-control" type="text" name="salary" value="{{ $work->salary }}">
                                </td>
                                <td class="form-group">
                                    <input class="form-control" type="text" name="tel" value="{{ $work->tel }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- 奖惩记录 --}}
            <div class="row afterboottom3 margin-left-lg margin-right-lg  padding-bottom-lg">
                <div class="archiveTitle">
                    奖惩记录
                    <span class="pull-right cbtnBox">
                        <a href="javascript:void(0);" class="left" id="rpDeleteBtn">删除</a> |
                        <a href="javascript:void(0);" class="right" id="rpAddBtn">新增</a>
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="allrp" id="allrp">
                                </th>
                                <th>惩罚类型</th>
                                <th>执行时间</th>
                                <th>记录名称</th>
                                <th>备注</th>
                            </tr>
                        </thead>
                        <tbody id="rpMain">
                        @foreach( $sanctions as $sanction)
                            <tr class="main">
                                <td><input type="checkbox" name="id" value="{{ $sanction->id }}"></td>
                                {{--奖惩类型 0:奖励 1：惩罚2：荣誉--}}
                                <td class="form-group">
                                    <select class="form-control" name="type">
                                      <option value="0" {{ $sanction->type == 0 ? 'selected' : '' }}>奖励</option>
                                      <option value="1" {{ $sanction->type == 1 ? 'selected' : '' }}>惩罚</option>
                                      <option value="2" {{ $sanction->type == 2 ? 'selected' : '' }}>荣誉</option>
                                    </select>
                                </td>
                                <td class="form-group">
                                    <input class="form-control dataV" type="text" name="execute_at" value="{{ $sanction->execute_at->toDateString() }}">
                                </td>
                                <td class="form-group">
                                    <input class="form-control" type="text" name="name" value="{{ $sanction->name }}">
                                </td>
                                <td class="form-group">
                                    <input class="form-control" type="text" name="remark" value="{{ $sanction->remark }}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



            {{-- 升迁记录 --}}
            <div class="row afterboottom3 margin-left-lg margin-right-lg  padding-bottom-lg">
                <div class="archiveTitle">
                    岗位调整记录
                    <span class="pull-right cbtnBox">
                        <a href="javascript:void(0);" class="left" id="udDeleteBtn">删除</a> |
                        <a href="javascript:void(0);" class="right" id="udAddBtn">新增</a>
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="allud" id="allud">
                                </th>
                                <th>调整类型</th>
                                <th>调岗部门</th>
                                <th>调岗职位</th>
                                <th>调岗时间</th>
                                <th>备注</th>
                            </tr>
                        </thead>
                        <tbody id="udMain">
                        @foreach( $promotions as $promotion)
                           <tr class="main">
                                <td><input type="checkbox" name="id" value="{{ $promotion->id }}"></td>
                                {{--升迁类型 0:升职1:降职 2:调岗 复职 入职--}}
                                <td class="form-group">
                                    <select class="form-control" name="type">
                                      <option value="0" {{ $promotion->type == 0 ? 'selected' : '' }}>升职</option>
                                      <option value="1" {{ $promotion->type == 1 ? 'selected' : '' }}>降职</option>
                                      <option value="2" {{ $promotion->type == 2 ? 'selected' : '' }}>调岗</option>
                                      <option value="3" {{ $promotion->type == 3 ? 'selected' : '' }}>复职</option>
                                      <option value="4" {{ $promotion->type == 4 ? 'selected' : '' }}>入职</option>
                                    </select>
                                </td>
                             {{--    <td class="form-group">
                                    <select class="form-control" name="old_depart">
                                        @foreach( $departs as $depart )
                                      <option value="{{ $depart->id }}" {{in_array($depart->id, [$promotion->old_depart]) ? 'selected' : '' }}>{{ $depart->name }}</option>
                                      @endforeach
                                    </select>
                                </td> --}}
                  {{--               <td class="form-group">
                                    <input class="form-control" type="text" name="old_offer" value="{{ $promotion->old_offer }}">
                                </td> --}}
                                <td class="form-group">
                                    <input class="form-control" type="text" name="new_depart" value="{{ $promotion->new_depart }}">
                                     {{--<select class="form-control" name="new_depart">--}}

                                        {{--@foreach( $departs as $depart )--}}
                                      {{--<option value="{{ $depart->name }}" {{ in_array($depart->id, [ $promotion->new_depart ]) ? 'selected' : '' }}>{{ $depart->name }}</option>--}}
                                      {{--@endforeach--}}
                                    {{--</select>--}}
                                </td>
                                <td class="form-group">
                                    <input class="form-control" type="text" name="new_offer" value="{{ $promotion->new_offer }}">
                                </td>
                                <td class="form-group">
                                    <input class="form-control dataV" type="text" name="chang_at" value="{{ $promotion->chang_at->toDateString() }}">
                                </td>
                                <td class="form-group">
                                    <input class="form-control" type="text" name="remark" value="{{ $promotion->remark}}">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
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

  <div class="fakeloader" style="position: fixed;width: 100%;height: 100%;top: 0px;left: 0px;background-color: rgba(134, 134, 134,0.2);z-index: 999; display: none; ">
        <div class="mop-css-2 wave" style="position: absolute; top: 0;left: 0;right: 0;bottom: 0;margin: auto;">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
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
    select[name=birthday_type], select[name=type] {
        min-width: 100px;
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
        require(['bootstrap','dataimepicker','DataTable','layer','validform','ztree','jcrop'], function (DataTable) {

             //日期控件初始化
             function dataconfig(){
                var date = new Date();
                $(".dataV").datetimepicker({
                    format: 'yyyy-mm-dd',
    //                   language: 'zh-CN',
                    // startDate: date,    //设置起始时间，设置当前时间的话就不能选择今天之前的日期
                    autoclose :true,
                     minView:'month',    //选择到日，
                });
             }

            dataconfig();

         // 家庭档案
          $("#familyDeleteBtn").click(function(){
            var ad = 0;
            $("#familyMain input[name=id]").each(function(){
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
                        $("#familyMain input[name=id]").each(function(){
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
          $("#familyAddBtn").click(function(){
             var strVar = "";
             strVar +='<tr class="main"><td><input type="checkbox" class="family" name="id" value=""></td>';
             strVar +='<td class="form-group"><input class="form-control" type="text" name="name" datatype="*" nullmsg="姓名不能为空" maxlength="20" onKeypress="javascript:space_val()"></td>'
             strVar +='<td class="form-group"><select class="form-control" name="relation"><option value="1">父亲</option><option value="2">母亲</option><option value="3">儿子</option><option value="4">女儿</option><option value="5">夫妻</option></select></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="offer" datatype="*" nullmsg="职业不能为空" onKeypress="javascript:space_val()"></td>'
             strVar +='<td class="form-group"><input class="form-control dataV" type="text" name="birthday" datatype="*" nullmsg="生日不能为空" onkeyup="convert(this.value,$(this))"></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="age" datatype="*" nullmsg="年龄不能为空" maxlength="11" onkeyup="number(this.value,$(this))"  onafterpaste="number(this.value,$(this))"></td>'
             strVar +='<td class="form-group"><select class="form-control" name="birthday_type"><option value="1">按阳历</option><option value="0">按农历</option></select></td>';
             strVar +='<td class="form-group"><input class="form-control" type="text" name="address" datatype="*" nullmsg="住址不能为空"></td>'
             $("#familyMain").append(strVar);
             dataconfig();
          });
          //全选功能
            var ftfamily = false;
            $("#allfamily").click(function () {
                ftfamily = !ftfamily;
                $("#familyMain input[name='id']").prop("checked", ftfamily)
            });
// -------------------------------------------------------------------------------------------------------------------------------------

            // 劳动合同
          $("#laborDeleteBtn").click(function(){
            var ad = 0;
            $("#laborMain input[name=id]").each(function(){
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
                        $("#laborMain input[name=id]").each(function(){
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
          $("#laborAddBtn").click(function(){
             var strVar = "";
             strVar +='<tr class="main"><td><input type="checkbox" class="labor" name="id" value=""></td>';
             strVar +='<td class="form-group"><select class="form-control" name="type"><option value="1">固定期限合同</option><option value="0">非固定期限合同</option></select></td>'
             strVar +='<td class="form-group"><select class="form-control" name="sign_type"><option value="0">首签</option><option value="1">续签</option></select></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="no" datatype="*" nullmsg="合同编号不能为空"></td>'
             strVar +='<td class="form-group"><input class="form-control dataV" type="text" name="effect_at" datatype="*" nullmsg="生效时间不能为空" onkeyup="convert(this.value,$(this))"></td>'
             strVar +='<td class="form-group"><input class="form-control dataV" type="text" name="expire_at" datatype="*" nullmsg="到期时间不能为空" onkeyup="convert(this.value,$(this))"></td>'
             $("#laborMain").append(strVar);
             dataconfig();
          });
          //全选功能
            var ftlabor = false;
            $("#alllabor").click(function () {
                ftlabor = !ftlabor;
                $("#laborMain input[name='id']").prop("checked", ftlabor)
            });

// -------------------------------------------------------------------------------------------------------------------------------------

              // 教育经历
          $("#educationDeleteBtn").click(function(){
            var ad = 0;
            $("#educationMain input[name=id]").each(function(){
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
                        $("#educationMain input[name=id]").each(function(){
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
          $("#educationAddBtn").click(function(){
             var strVar = "";
             strVar +='<tr class="main"><td><input type="checkbox" class="education" name="id" value=""></td>';
             strVar +='<td class="form-group"><select class="form-control" name="education"><option value="0">初中</option><option value="1">高中</option><option value="2">大专</option><option value="3">本科</option></select></td>'
             strVar +='<td class="form-group"><input class="form-control dataV" type="text" name="start_at" datatype="*" nullmsg="开始时间不能为空" onkeyup="convert(this.value,$(this))"></td>'
             strVar +='<td class="form-group"><input class="form-control dataV" type="text" name="end_at" datatype="*" nullmsg="结束时间不能为空" onkeyup="convert(this.value,$(this))"></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="name" datatype="*" nullmsg="学校名称不能为空"></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="major" datatype="*" nullmsg="专业不能为空"></td>'
             strVar +='<td class="form-group"><select class="form-control" name="is_finish"><option value="1">是</option><option value="0">否</option></select></td>'
             $("#educationMain").append(strVar);
             dataconfig();
          });

          //全选功能
            var fteducation = false;
            $("#alleducation").click(function () {
                fteducation = !fteducation;
                $("#educationMain input[name='id']").prop("checked", fteducation)
            });

// -------------------------------------------------------------------------------------------------------------------------------------

      // 工作经历
          $("#workDeleteBtn").click(function(){
            var ad = 0;
            $("#workMain input[name=id]").each(function(){
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
                        $("#workMain input[name=id]").each(function(){
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
          $("#workAddBtn").click(function(){
             var strVar = "";
             strVar +='<tr class="main"><td><input type="checkbox" class="work" name="id" value=""></td>';
             strVar +='<td class="form-group"><input class="form-control" type="text" name="name" datatype="*" nullmsg="工作单位不能为空"></td>'
             strVar +='<td class="form-group"><input class="form-control dataV" type="text" name="start_at" datatype="*" nullmsg="开始时间不能为空" onkeyup="convert(this.value,$(this))"></td>'
             strVar +='<td class="form-group"><input class="form-control dataV" type="text" name="end_at" datatype="*" nullmsg="结束时间不能为空" onkeyup="convert(this.value,$(this))"></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="position" datatype="*" nullmsg="职位不能为空"></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="reason" datatype="*" nullmsg="离职原因不能为空"></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="salary" datatype="*" nullmsg="最终薪资不能为空" maxlength="11" onkeyup="number(this.value,$(this))"  onafterpaste="number(this.value,$(this))"></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="tel" datatype="*" nullmsg="联系电话不能为空" maxlength="20" onkeyup="number_h(this.value,$(this))"  onafterpaste="number_h(this.value,$(this))"></td>'

             $("#workMain").append(strVar);
             dataconfig();
          });

          //全选功能
            var ftwork = false;
            $("#allwork").click(function () {
                ftwork = !ftwork;
                $("#workMain input[name='id']").prop("checked", ftwork)
            });

// -------------------------------------------------------------------------------------------------------------------------------------

      // 奖惩
          $("#rpDeleteBtn").click(function(){
            var ad = 0;
            $("#rpMain input[name=id]").each(function(){
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
                        $("#rpMain input[name=id]").each(function(){
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
          $("#rpAddBtn").click(function(){
             var strVar = "";
             strVar +='<tr class="main"><td><input type="checkbox" class="rp" name="id" value=""></td>';
             strVar +='<td class="form-group"><select class="form-control" name="type"><option value="0">奖励</option><option value="1">惩罚</option><option value="2">荣誉</option></select></td>'
             strVar +='<td class="form-group"><input class="form-control dataV" type="text" name="execute_at" datatype="*" nullmsg="执行时间不能为空" onkeyup="convert(this.value,$(this))"></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="name" datatype="*" nullmsg="记录名称不能为空"></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="remark" datatype="*" nullmsg="备注不能为空"></td>'

             $("#rpMain").append(strVar);
             dataconfig();
          });

          //全选功能
            var ftrp = false;
            $("#allrp").click(function () {
                ftrp = !ftrp;
                $("#rpMain input[name='id']").prop("checked", ftrp)
            });

// -------------------------------------------------------------------------------------------------------------------------------------

      // 升迁
          $("#udDeleteBtn").click(function(){
            var ad = 0;
            $("#udMain input[name='id']").each(function(){
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
                        $("#udMain input[name='id']").each(function(){
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
          $("#udAddBtn").click(function(){
             var strVar = "";
             var opt = '{!! $opt !!}'
             console.log(opt)
             strVar +='<tr class="main"><td><input type="checkbox" class="ud" name="id" value=""></td>';
             strVar +='<td class="form-group"><select class="form-control" name="type"><option value="2">升职</option><option value="1">调岗</option><option value="0">降职</option><option value="3">复职</option><option value="4">入职</option></select></td>'
             // strVar +='<td class="form-group"><select class="form-control" name="old_depart">'+ opt +'</select></td>'
             // strVar +='<td class="form-group"><input class="form-control" type="text" name="old_offer" datatype="*" nullmsg="原职位不能为空"></td>'
             // strVar +='<td class="form-group"><select class="form-control" name="new_depart">'+ opt +'</select></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="new_depart" datatype="*" nullmsg="调岗部门不能为空"></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="new_offer" datatype="*" nullmsg="调岗职位不能为空"></td>'
             strVar +='<td class="form-group"><input class="form-control dataV" type="text" name="chang_at" datatype="*" nullmsg="调岗时间不能为空" onkeyup="convert(this.value,$(this))"></td>'
             strVar +='<td class="form-group"><input class="form-control" type="text" name="remark"></td>'

             $("#udMain").append(strVar);
             dataconfig();
          });

          //全选功能
            var ftud = false;
            $("#allud").click(function () {
                ftud = !ftud;
                $("#udMain input[name='id']").prop("checked", ftud)
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
                    //获取家庭档案
                    var families = [];
                    $("#familyMain tr.main").each(function(){
                        var $this = $(this);
                        families.push(GetWebControls($this))
                    })
                    // console.log(families)
                    // 获取劳动合同
                    var agreements = [];
                    $("#laborMain tr.main").each(function(){
                        var $this = $(this);
                        agreements.push(GetWebControls($this))
                    })
                    // console.log(agreements)
                    // 获取教育经历
                    var educations = [];
                    $("#educationMain tr.main").each(function(){
                        var $this = $(this);
                        educations.push(GetWebControls($this))
                    })
                    // console.log(educations)
                    // 获取工作经历
                    var works = [];
                    $("#workMain tr.main").each(function(){
                        var $this = $(this);
                        works.push(GetWebControls($this))
                    })
                    // console.log(works)
                    // 获取奖惩记录
                    var sanctions = [];
                    $("#rpMain tr.main").each(function(){
                        var $this = $(this);
                        sanctions.push(GetWebControls($this))
                    })
                    // console.log(sanctions)
                     // 获取升迁记录
                    var promotions = [];
                    $("#udMain tr.main").each(function(){
                        var $this = $(this);
                        promotions.push(GetWebControls($this))
                    })
                    // console.log(promotions)
                    // 家庭情况
                    var family_discrible =  $("#family_discrible").val()

                    var postData = {};
                    postData.families = families;
                    postData.agrees = agreements;
                    postData.educations = educations;
                    postData.works = works;
                    postData.sanctions = sanctions;
                    postData.promotions = promotions;
                    postData.family_discrible = family_discrible;
                    console.log(postData);
                    var url = '/archive/'+ "{{ $archive->id }}" +'/update_archive';
                     AjaxJson(url,postData,function(data){
                        if(data.status) {
                            layer.msg(data.msg);
                            setTimeout(function(){
                                window.location.reload();
                            },2000)
                        }else {
                            layer.msg(data.msg);
                        }
                     })
                    return false;
                }
            });
        })
    </script>
@endsection