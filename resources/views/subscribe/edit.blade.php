@extends('layouts.app')
<!--中间内容区域-->
@section('content')
    <div class="container container-responsive">
        <div class="row hr-main-bg">
            @include('_parties.notice_menu')
            <div class="right-side col-xs-12 col-sm-10 col-md-9 col-lg-10">
                <div class="right-side-header margin-left">
                    {{--<div class="goback">--}}
                        {{--<a href="javascript:window.history.go(-1);" class="btn btn-default">返回</a>--}}
                    {{--</div>--}}
                    <p class="title">编辑预约</p>
                </div>
                <div>
                    <div class="main-content padding">
                        <div class="add-order-header">
                            <i class="iconfont">&#xe601;</i>
                            <span class="margin-left-xs">请选择人员增补申请单后才可以编辑预约</span>
                        </div>
                        <form class="form-horizontal margin-top add-order-form" id="add_form">
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span class="must-icon">* </span>人员申请增补单：</label>
                                <div class="col-sm-6 check-modal"  id="{{ $subscribe->status == 2 ? '' : 'rymodal' }}">
                                    <input type="text" id="examine_val" name="examine_val" value="{{ isset($subscribe) ? $subscribe->examines->apply_name.'的人员申请单' : '' }}" class="form-control" readonly="readonly" placeholder="请选择" datatype="*" nullmsg="请选择人员申请增补单">
                                    <input type="hidden" id="examine_id" value="{{ isset($subscribe) ? $subscribe->examines->id : '' }}" name="examine_id" datatype="*" nullmsg="获取申请单id失败，请联系开发人员">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span class="must-icon">* </span>面试职位：</label>
                                <div class="col-sm-6">
                                    <input type="text" id="work_zw" name="work_zw" readonly="readonly" value="{{ isset($subscribe) ? $subscribe->examines->position : '' }}" class="form-control" datatype="*" nullmsg="获取面试职位失败，请联系开发人员">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span class="must-icon">* </span>面试时间：</label>
                                <div class="col-sm-6 check-time input-append date">
                                    <input readonly="readonly" type="text" id="offer_date" name="offer_date" class="form-control" value="{{ isset($subscribe) ? $subscribe->offer_date->format('Y-m-d H:i') : '' }}" datatype="*" nullmsg="请选择面试时间" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span class="must-icon">* </span>面试地点：</label>
                                <div class="col-sm-6">
                                    @if($subscribe->status == 2)
                                        <input type="text" readonly="readonly" name="address" class="form-control" value="{{ isset($subscribe) ? $subscribe->address : '广东省东莞市松山湖中科创新广场A座1108' }}" datatype="*" nullmsg="请填写面试地点" >
                                    @else
                                        <input type="text" id="address" name="address"  class="form-control" value="{{ isset($subscribe) ? $subscribe->address : '广东省东莞市松山湖中科创新广场A座1108' }}" datatype="*" nullmsg="请填写面试地点" >
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span class="must-icon">* </span>选择简历：</label>
                                <div class="col-sm-6 check-modal" id="{{ $subscribe->status == 2 ? '' : 'jlmodal' }}">
                                    <input type="text" id="resume_val" name="resume_val" value="{{ isset($subscribe) ? $subscribe->resumes->name : '' }}" readonly class="form-control" placeholder="请选择" datatype="*" nullmsg="请选择简历">
                                    <input type="hidden" id="resume_id" value="{{ isset($subscribe) ? $subscribe->resumes->id : '' }}" name="resume_id" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><span class="must-icon">* </span>简历来源：</label>
                                <div class="col-sm-6">
                                    @if(isset($subscribe) && $subscribe->resumes->origin_id == 0)
                                        <input readonly="readonly" name="resume_ly" id="resume_ly" value="智通" type="text" class="form-control" datatype="*" nullmsg="简历来源获取失败，请联系开发人员">
                                    @elseif(isset($subscribe) && $subscribe->resumes->origin_id == 1)
                                        <input readonly="readonly" name="resume_ly" id="resume_ly" value="卓博" type="text" class="form-control" datatype="*" nullmsg="简历来源获取失败，请联系开发人员">
                                    @elseif(isset($subscribe) && $subscribe->resumes->origin_id == 2)
                                        <input readonly="readonly" name="resume_ly" id="resume_ly" value="内部推荐" type="text" class="form-control" datatype="*" nullmsg="简历来源获取失败，请联系开发人员">
                                    @elseif(isset($subscribe) && $subscribe->resumes->origin_id == 3)
                                        <input readonly="readonly" name="resume_ly" id="resume_ly" value="人才市场" type="text" class="form-control" datatype="*" nullmsg="简历来源获取失败，请联系开发人员">
                                    @else
                                        <input readonly="readonly" name="resume_ly" id="resume_ly" value="" type="text" class="form-control" datatype="*" nullmsg="简历来源获取失败，请联系开发人员">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">备注：</label>
                                <div class="col-sm-6">
                                    @if($subscribe->status == 2)
                                        <textarea class="form-control" readonly="readonly" rows="3" cols="">{{ isset($subscribe) ? $subscribe->remark : '' }}</textarea>
                                    @else
                                        <textarea class="form-control" id="remark" name="remark" rows="3" cols="">{{ isset($subscribe) ? $subscribe->remark : '' }}</textarea>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">审核人：</label>
                                <div class="col-sm-6">
                                    <div class="approver" id="shrlist">
                                        @if(isset($subscribe))
                                            @foreach($users as $key=>$user)
                                                @if($key==0)
                                                <div class="approver listapp">
                                                    <div class="approver_o">
                                                        {{--<i onclick="deletefun(this)" class="iconfont {{ $subscribe->status == 2 ? 'hide' : '' }}">&#xe634;</i>--}}
                                                        <input type="hidden"  name="user_id" value="{{ $user->id }}" >
                                                        <img src="{{ $user->avatar }}" class="img-responsive">
                                                        <p>{{ $user->name }}</p>
                                                    </div>
                                                    <div class="approver_di">···</div>
                                                </div>
                                                @else
                                                <div class="approver listapp">
                                                    <div class="approver_o">
                                                        <i onclick="deletefun(this)" class="iconfont {{ $subscribe->status == 2 ? 'hide' : '' }}">&#xe634;</i>
                                                        <input type="hidden"  name="user_id" value="{{ $user->id }}" >
                                                        <img src="{{ $user->avatar }}" class="img-responsive">
                                                        <p>{{ $user->name }}</p>
                                                    </div>
                                                    <div class="approver_di">···</div>
                                                </div>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if($subscribe->status !== 2)
                                            <div class="approver_add" id="sprmodal">
                                                <i class="iconfont">&#xe7cf;</i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">面试官：</label>
                                <div class="col-sm-6">
                                    <div class="approver listapp">
                                        <div class="approver_o">
                                            {{--<input type="hidden"  name="user_id" value="{{ $user_last->id }}" >--}}
                                            <img src="{{ $user_last->avatar }}" class="img-responsive">
                                            <p>{{ $user_last->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary {{ $subscribe->appraises()->get()->isEmpty() ? '' : 'hide'}}">&nbsp;&nbsp;&nbsp;提交&nbsp;&nbsp;&nbsp;</button>
                                    <a href="javascript:window.history.go(-1);" class="btn btn-default margin-left-sm">&nbsp;&nbsp;返回&nbsp;&nbsp;</a>
                                </div>
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
    <div class="modal-box">
        {{--选择增补单的模态框--}}
        <div class="modal fade" id="choose_ry_modal">
            <div class="modal-dialog modalwidth-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">选择人员增补申请单</h4>
                    </div>
                    <div class="content-view ng-scope" ui-view="">
                        <!-- uiView: -->
                        <div ui-view="" class="ng-scope">
                            <!-- uiView: -->
                            <div ui-view="" class="ng-scope">
                                <div class="" data-ng-controller="tableCtrl as datatable">
                                    <div class="">
                                        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table maxwidth" ui-jq="dataTable" ui-options="datatable.dataTableOpt" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                                        <thead>
                                                        <tr role="row">
                                                            <th class="text-center checkboxth" tabindex="0" rowspan="1" colspan="1">
                                                                {{--<input type="checkbox" name="allchoose">--}}
                                                            </th>
                                                            <th class="" tabindex="0" rowspan="1" colspan="1">
                                                                标题
                                                            </th>
                                                            <th class="" tabindex="0" rowspan="1" colspan="1">
                                                                状态
                                                            </th>
                                                            <th class="" tabindex="0" rowspan="1" colspan="1">
                                                                申请部门
                                                            </th>
                                                            <th class="" tabindex="0" rowspan="1" colspan="1">
                                                                申请岗位
                                                            </th>
                                                            <th class="" tabindex="0" rowspan="1" colspan="1">
                                                                申请名额
                                                            </th>
                                                            <th class="" tabindex="0" rowspan="1" colspan="1">
                                                                计划完成日期
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer margin-0">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" id="submitry">提交</button>
                    </div>
                </div>
            </div>
        </div>
        {{--选择简历的模态框--}}
        <div class="modal fade" id="choose_jl_modal">
            <div class="modal-dialog modalwidth-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">选择简历</h4>
                    </div>
                    <div class="content-view ng-scope" ui-view="">
                        <!-- uiView: -->
                        <div ui-view="" class="ng-scope">
                            <!-- uiView: -->
                            <div ui-view="" class="ng-scope">
                                <div class="" data-ng-controller="tableCtrl as datatable">
                                    <div class="">
                                        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table maxwidth" ui-jq="dataTable" ui-options="datatable.dataTableOpt" id="DataTables_Table_1" role="grid" aria-describedby="DataTables_Table_1_info">
                                                        <thead>
                                                        <tr role="row">
                                                            <th class="text-center checkboxth" tabindex="0" rowspan="1" colspan="1">
                                                                {{--<input type="checkbox" name="allchoose">--}}
                                                            </th>
                                                            <th class="" tabindex="0" rowspan="1" colspan="1">
                                                                姓名
                                                            </th>
                                                            <th class="" tabindex="0" rowspan="1" colspan="1">
                                                                简历来源
                                                            </th>
                                                            <th class="" tabindex="0" rowspan="1" colspan="1">
                                                                期望职位
                                                            </th>
                                                            <th class="" tabindex="0" rowspan="1" colspan="1">
                                                                工作年限
                                                            </th>
                                                            <th class="" tabindex="0" rowspan="1" colspan="1">
                                                                性别
                                                            </th>
                                                            <th class="" tabindex="0" rowspan="1" colspan="1">
                                                                学历
                                                            </th>
                                                            <th class="hide" tabindex="0" rowspan="1" colspan="1">
                                                                备注
                                                            </th>
                                                            <th class="" tabindex="0" rowspan="1" colspan="1">
                                                                创建时间
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer margin-0">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" id="submitjl">提交</button>
                    </div>
                </div>
            </div>
        </div>
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
        require(['bootstrap','dataimepicker','layer','DataTable','bootstrap-select','validform','icheck'], function (DataTable) {
            //增补单数据
            var table = $('#DataTables_Table_0').DataTable( {
                "ajax": "/examine/all_data/" + true,
                "ordering" : false,
                "columnDefs": [
                    {
                        "targets": 2,
                        "render":function (data,tyepe,row,meta) {
                            switch (data)
                            {
                                case 1:
                                    return '<span class="status-span-1">未开始</span>';
                                    break;
                                case 2:
                                    return '<span class="status-span-2">进行中</span>';
                                    break;
                                case 3:
                                    return '<span  class="status-span-3">已完成</span>';
                                    break;
//                        case 4:
//                            return '<span  class="status-span-4">已关闭</span>';
//                            break;
                                default:
                                    return '<span  class="status-span-4">已关闭</span>';
//                            alert("返回状态码有误，请联系开发人员");
                                    break;
                            }
                        },
                    },
                    { "width": "30%", "targets": 4 }

                ],
                "dom": '<"toolbar">frtip',
                "createdRow": function ( row, data, index ) {
                    $('td', row).eq(0).addClass('tr-center');
                },
                "oLanguage": {
                    "sLengthMenu": "每页显示 _MENU_ 条记录",
                    "sZeroRecords": "对不起，查询不到任何相关数据",
                    "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_条记录",
                    "sInfoEmtpy": "找不到相关数据",
                    "sInfoFiltered": "数据表中共为 _MAX_ 条记录)",
                    "sProcessing": "正在加载中...",
                    "sSearch": "搜索",
                    "oPaginate": {
                        "sFirst": "第一页",
                        "sPrevious":" 上一页 ",
                        "sNext": " 下一页 ",
                        "sLast": " 最后一页 "
                    }
                }
            });
            $('#DataTables_Table_0 tbody').on( 'click', 'tr', function () {
                table.$('tr.trchecked').removeClass('trchecked');
                $(this).addClass('trchecked');
            });
            $("#DataTables_Table_0_filter input[type=search]").attr("placeholder","请输入搜索内容");



            //简历列表数据
            var table1 = $('#DataTables_Table_1').DataTable( {
                "ajax": "/resume/all_data/"+true,
                "ordering" : false,
                "columnDefs": [
                    {
                        "targets": 2,
                        "render":function (data,tyepe,row,meta) {
                            switch (data)
                            {
                                case 1:
                                    return '<span>卓博</span>';
                                    break;
                                case 0:
                                    return '<span>智通</span>';
                                    break;
                                case 2:
                                    return '<span>内部推荐</span>';
                                    break;
//                                case 3:
//                                    return '<span>人才市场</span>';
//                                    break;
                                default:
                                    return '<span>人才市场</span>';
//                                    alert("返回简历来源状态码有误，请联系开发人员");
                                    break;
                            }
                        },
                    },
                ],
                "dom": '<"toolbar">frtip',
                "createdRow": function ( row, data, index ) {
                    $('td', row).eq(0).addClass('tr-center');
                    $('td', row).eq(7).addClass('hide');
                },
                "oLanguage": {
                    "sLengthMenu": "每页显示 _MENU_ 条记录",
                    "sZeroRecords": "对不起，查询不到任何相关数据",
                    "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_条记录",
                    "sInfoEmtpy": "找不到相关数据",
                    "sInfoFiltered": "数据表中共为 _MAX_ 条记录)",
                    "sProcessing": "正在加载中...",
                    "sSearch": "搜索",
                    "oPaginate": {
                        "sFirst": "第一页",
                        "sPrevious":" 上一页 ",
                        "sNext": " 下一页 ",
                        "sLast": " 最后一页 "
                    }
                }
            });
            $('#DataTables_Table_1 tbody').on( 'click', 'tr', function () {
                table1.$('tr.trchecked').removeClass('trchecked');
                $(this).addClass('trchecked');
            } );
            $("#DataTables_Table_1_filter input[type=search]").attr("placeholder","请输入搜索内容")
            //日期控件初始化
            var date = new Date();
            $("#offer_date").datetimepicker({
                format: 'yyyy-mm-dd hh:ii:ss',
//				     language: 'zh-CN',
                startDate: date,
                autoclose :true,
                //  minView:'month',    //选择到日，
            });
            //选择增补单
            $("#rymodal").click(function(){
                $("#choose_ry_modal").modal();
            })
            //点击提交
            $("#submitry").click(function () {
                var trobj = table.$('tr.trchecked'); //选择行的tr对象
                var examine_id = trobj.find('.check-box').attr("name"); //获取增补单id
                var strhtml1 = trobj.find('td').eq(1).text();  //获取到第2列的html()
                var strhtml4 = trobj.find('td').eq(4).text();  //获取到第5列的html()
                $("#examine_id").val(examine_id);
                $("#examine_val").val(strhtml1);
                $("#work_zw").val(strhtml4);
                $('#choose_ry_modal').modal('hide');
                console.log(examine_id)
                console.log(strhtml1)
                console.log(strhtml4)
            });
            //选择简历
            $("#jlmodal").click(function(){
                $("#choose_jl_modal").modal();
            });
            //点击提交
            $("#submitjl").click(function () {
                var trobj = table1.$('tr.trchecked'); //选择行的tr对象
                var resume_id = trobj.find('.check-box').attr("name"); //获取增补单id
                var strhtml1 = trobj.find('td').eq(1).text();  //获取到第2列的html()
                var strhtml2 = trobj.find('td').eq(2).text();  //获取到第3列的html()
                $("#resume_id").val(resume_id);
                $("#resume_val").val(strhtml1);
                $("#resume_ly").val(strhtml2);
                $('#choose_jl_modal').modal('hide');
                console.log(resume_id)
                console.log(strhtml1)
                console.log(strhtml2)
            });
            //选择审核人
            $("#sprmodal").click(function () {
                // 在模态框出现的时候调用垂直居中函数
                $('#choose_spr_modal').on('show.bs.modal', centerModals);
                // 在窗口大小改变的时候调用垂直居中函数
                $(window).on('resize', centerModals);
                $("#choose_spr_modal").modal();
                var url = '/user/user_lists';
                $.get(url,function (data) {
                    $("#selectpicker_spr").html(data.html);
                    $("#choose_spr_modal .filter-option").html($("#selectpicker_spr option").eq(0).html())
                    $('#selectpicker_spr').selectpicker({
                        liveSearch: true,
                        maxOptions: 1
                    });
                })
            })
            //点击提交，将选中的数据id传给后台
            $("#submitspr").click(function () {
                $('.fakeloader').fadeIn(100);
                var user_id = $("#selectpicker_spr").val();
                var orfalse = true;
                $("#shrlist").find("input[name='user_id']").each(function (i) {
                    if(user_id ==$(this).val()){
                        $('.fakeloader').fadeOut(100);
                        layer.msg('不能重复添加同一审核人');
                        orfalse = false;
                    };
                });
                if(orfalse) {
                    $.get('/user/data/'+ user_id,function(data){
                        var applist = $("#shrlist").find('.listapp');
                        if(applist.length < 3){
                            $("#sprmodal").before(data.html);
                        }else {
                            layer.msg("最多添加三个审核人")
                        }
                        $("#choose_spr_modal").modal('hide');
                        $('.fakeloader').fadeOut(100);
                    });
                };
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
                    $('.fakeloader').fadeIn(100);
                    //给时间添加上秒的格式
                    var subtime = $("#offer_date").val();
                    $("#offer_date").val(subtime);
                    var postData = {};
                    postData = GetWebControls('#add_form');
                    postData.user_ids= hiddenboxValshu('user_id');
                    var subscribe_id = '{{ $subscribe->id }}';
                    var url = '/subscribe/'+ subscribe_id +'/update';
                    $.ajax({
                        url:url,
                        type: "post",
                        data: postData,
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        async: true,
                        success: function (data) {
                            if(data.status === 1){
                                $('.fakeloader').fadeOut(100);
                                layer.msg(data.msg);
                                setTimeout(function () {
                                    window.location.href = '/subscribe';
                                },1000);
                            }else {
                                $('.fakeloader').fadeOut(100);
                                layer.msg(data.msg);
                                setTimeout(function () {
                                    window.location.reload();
                                },1000);
                            }
                        },
                        error: function (xhr,status,error) {
                            console.log(xhr);
                            console.log(status);
                            console.log(error);
                            $('.fakeloader').fadeOut(100);
                            layer.msg('网络开了小差，请重新提交');
                            if(error == 'Gateway Time-out'){
                                setTimeout(function () {
                                window.location.reload();
                                },1000);
                            }

                        }
                    });
                    return false;
                }
            });
            deletefun = function(e) {
                var thise= $(e);
                var useid = $(e).attr('name');
                layer.msg('确定删除该审核人吗？', {
                    time: 0 //不自动关闭
                    ,btn: ['确定', '取消']
                    ,yes: function(index){
                        layer.close(index);
                        thise.parents('.listapp').remove();
                    }
                });
            }
        });
    </script>
@endsection