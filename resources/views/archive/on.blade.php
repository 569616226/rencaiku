@extends('layouts.app')
<!--中间内容区域-->
@section('content')
    <!--中间内容区域-->
    <div class="container container-responsive">
        <div class="row hr-main-bg">
            @include('_parties.archive_menu')
            <div class="right-side col-xs-12 col-sm-10 col-md-9 col-lg-10">
                <div class="right-side-header margin-left">
                    <div>
                        {{--导入简历的表单--}}
                        <form id="import-form" class="hide" enctype="multipart/form-data" method="post">
                            <input id="uploadify" type="file" name="excelfile" multiple />
                        </form>
                    </div>
                </div>
                <div>
                    <div class="main-content">
                        <!-- uiView: -->
                        <div class="content-view ng-scope" ui-view="">
                            <!-- uiView: -->
                            <div ui-view="" class="ng-scope">
                                <!-- uiView: -->
                                <div ui-view="" class="ng-scope">
                                    <div class="card ng-scope" data-ng-controller="tableCtrl as datatable">
                                        <div class="card-block">
                                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="table" ui-jq="dataTable" ui-options="datatable.dataTableOpt" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                                            <thead>
                                                            <tr role="row">
                                                                <th class="">
                                                                    姓名
                                                                </th>
                                                                <th class="">
                                                                    性别
                                                                </th>
                                                                <th class="">
                                                                    部门
                                                                </th>
                                                                <th class="">
                                                                    职位
                                                                </th>
                                                                <th class="">
                                                                    手机号
                                                                </th>
                                                                <th class="">
                                                                    员工状态
                                                                </th>
                                                                <th class="">
                                                                    入职时间
                                                                </th>
                                                                <th class=""></th>
                                                                <th class="">
                                                                    操作
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--离职模态框--}}
    <div class="modal fade" id="Edit_remark_modal">
        <div class="modal-dialog modalwidth-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">选择离职原因</h4>
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="row">
                            <label class="control-label col-md-2" style="text-align: left;">离职原因：</label>
                            <select id="offSelect" class="form-control col-md-6" name="offer_off_reason">
                              <option value="0">正常离职</option>
                              <option value="1">自离</option>
                              <option value="2">辞退</option>
                              <option value="3">试用期不通过</option>
                            </select>
                        </div>
                        <div class="row">
                             <label class="control-label col-md-2" style="text-align: left;">离职时间</label>
                             <div class="col-md-6" style="padding-left: 0">
                                <input type="text" class="form-control Mdata" name="offer_off_date" id="offer_off_date">
                             </div>
                            
                        </div>
                        <div class="row">
                             <label class="control-label col-md-2" style="text-align: left;">&nbsp;</label>
                             <div class="col-md-8" style="padding-left: 0">
                                 <textarea id="reason" class="form-control" rows="3" placeholder="请填写离职原因"></textarea>
                             </div>
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="submit_remark" class="btn btn-primary">提交</button>
                        <button type="button" class="btn btn-default margin-left-xs" data-dismiss="modal">关闭</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--延长试用期模态框--}}
    <div class="modal fade" id="add_time_modal">
        <div class="modal-dialog modalwidth-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">试用期延长</h4>
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="row">
                            <label class="control-label col-md-4" style="">试用期延长时间：</label>
                            <select id="add_time" class="form-control col-md-6" name="add_time">
                              <option value="3">3个月</option>
                              <option value="2">2个月</option>
                              <option value="1">1个月</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="submit_add_time" class="btn btn-primary">提交</button>
                        <button type="button" class="btn btn-default margin-left-xs" data-dismiss="modal">关闭</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--转正模态框--}}
    <div class="modal fade" id="on_modal">
        <div class="modal-dialog modalwidth-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">员工转正</h4>
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="row padding-top text-center">
                             <span style="font-size: 18px;">真的要转正该员工吗？</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="submit_on" class="btn btn-primary">提交</button>
                        <button type="button" class="btn btn-default margin-left-xs" data-dismiss="modal">关闭</button>
                    </div>
                </form>
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
        require(['bootstrap','dataimepicker','DataTable','layer','server'], function (bootstrap,dataimepicker,DataTable,layer,server) {

            //日期控件初始化
            var date = new Date();
            $(".Mdata").datetimepicker({
                format: 'yyyy-mm-dd',
//                   language: 'zh-CN',
                // startDate: date,
                autoclose :true,
                 minView:'month',    //选择到日，
            });

            var table = $('#DataTables_Table_0').DataTable( {
                "ajax": "/archive/on_data",
//        "autoWidth": true,
//        "flexibleWidth":true,
//        "responsive":true,
                "ordering" : false,
                "bAutoWidth": true,
                "columnDefs": [
                    {
                        "targets": 7,
                        "visible": false,
                        "searchable": true

                    },
               
                ],

                "dom": '<"toolbar">frtip',
                "createdRow": function ( row, data, index ) {
                    $('td', row).addClass('tr-middle');
                },
                "oLanguage": {
                    "sLengthMenu": "每页显示 _MENU_ 条记录",
                    "sZeroRecords": "对不起，查询不到任何相关数据",
                    "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_条记录",
                    "sInfoEmtpy": "找不到相关数据",
                    "sInfoFiltered": "",
                    "sProcessing": "正在加载中...",
                    "sSearch": "<i class='iconfont seachicon'>&#xe639;</i>",
                    "oPaginate": {
                        "sFirst": "第一页",
                        "sPrevious":" 上一页 ",
                        "sNext": " 下一页 ",
                        "sLast": " 最后一页 "
                    }
                },
                initComplete: function (settings, json) {//列筛选
                    console.log(json.data.length);
                    console.log(json);
                    if(json.data.length !=0){
                        var api = this.api();
                        api.columns().indexes().flatten().each(function (i) {

                            if (i == 7) {//删除第一列与第二列的筛选框
                                var column = api.column(i);
                                var $span = $('<span class="addselect"></span>').appendTo($("#select_status"))
                                var select = $('<select class="form-control"><option value="">全部</option></select>')
                                    .appendTo($(column.header()))
                                    .on('click', function (evt) {
                                        evt.stopPropagation();
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );
                                        column
                                            .search(val ? '^' + val + '$' : '', true, false)
                                            .draw();
                                    });


                                column.data().unique().sort().each(function (d, j) {
                                    select.append('<option value="' + d + '">' + d + '</option>')
                                    $span.append(select);
                                    //判断地址栏传过来的参数，选择筛选不同的数据
                                    if(GetQuery('root')==1){
                                        $(".form-control option").eq(1).attr("selected",true).click();
                                    };
                                });

                            }
                        });

                    }

                }

            });
            $("div.toolbar").html('<span class="margin-right-xs" id="select_status"></span></span><input class="btn btn-primaryxs" id="update" type="button" value="同步通讯录" />');
            // $("div.toolbar").html('<span class="margin-left-xs" id="select_status"></span>');
            $("#DataTables_Table_0_filter input[type=search]").attr("placeholder","可输入日期/职位/姓名");

            //查看
            $('#DataTables_Table_0 tbody').on( 'click', '.show', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var url = '/archive/' + data[9] + '/show';

                window.location.href= url;
            });

            //完善档案
            $('#DataTables_Table_0 tbody').on( 'click', '.archive', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var url = '/archive/create/' + data[ 10 ];

                window.location.href= url;
            });
            //编辑
            $('#DataTables_Table_0 tbody').on( 'click', '.edit', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var url = '/archive/' + data[9] + '/edit';
                window.location.href= url;
            });

            // 监听离职原因
            $("#offSelect").change(function(){
                if($("#offSelect").val() == 0){
                    $("#reason").show();
                }else {
                    $("#reason").hide();
                }
            })
            //离职
            $('#DataTables_Table_0 tbody').on( 'click', '.off', function () {
                var data = table.row( $(this).parents('tr') ).data();
                // 在模态框出现的时候调用垂直居中函数
                $('.modal').on('show.bs.modal', centerModals);
                // 在窗口大小改变的时候调用垂直居中函数
                $(window).on('resize', centerModals);
                $("#submit_remark").attr("name",data[ 9 ]);
                $("#Edit_remark_modal").modal();
            });
            // 离职提交
            $("#submit_remark").click(function () {
                var id = $("#submit_remark").attr("name");
                // 离职的请求地址，待修改
                var url = '/archive/' + id + '/offer_off';
                if($("#offSelect").val() == 0 && $("#reason").val() == ''){
                    layer.msg("请填写离职原因");
                    return false;
                }
                console.log({'offer_off_reason':[$("#offSelect").val(),$("#reason").val()]})
                AjaxJson(url,{'offer_off_reason':[$("#offSelect").val(),$("#reason").val()],'offer_off_date': $("#offer_off_date").val()},function (data) {
                    if(data.status){
                        layer.msg(data.msg);
                        setTimeout(function () {
                            window.location.reload();
                        },1000)

                    }else {
                        layer.msg(data.msg);
                    }
                })
            });

            //延长试用期
            $('#DataTables_Table_0 tbody').on( 'click', '.addtime', function () {
                var data = table.row( $(this).parents('tr') ).data();
                // 在模态框出现的时候调用垂直居中函数
                $('.modal').on('show.bs.modal', centerModals);
                // 在窗口大小改变的时候调用垂直居中函数
                $(window).on('resize', centerModals);
                $("#submit_add_time").attr("name",data[ 9 ]);
                $("#add_time_modal").modal();
            });
            // 延长试用期提交
            $("#submit_add_time").click(function () {
                var id = $("#submit_add_time").attr("name");
                // 延长试用期的请求地址，待修改
                var url = '/archive/' + id + '/training';
                AjaxJson(url,{'offer_date': $("#add_time").val()},function (data) {
                    if(data.status){
                        layer.msg(data.msg);
                        setTimeout(function () {
                            window.location.reload();
                        },1000)

                    }else {
                        layer.msg(data.msg);
                    }
                })
            });

            // 转正
            $('#DataTables_Table_0 tbody').on( 'click', '.on', function () {
                var data = table.row( $(this).parents('tr') ).data();
                // 在模态框出现的时候调用垂直居中函数
                $('.modal').on('show.bs.modal', centerModals);
                // 在窗口大小改变的时候调用垂直居中函数
                $(window).on('resize', centerModals);
                $("#submit_on").attr("name",data[ 9 ]);
                $("#on_modal").modal();
            });
            // 转正提交
            $("#submit_on").click(function () {
                var id = $("#submit_on").attr("name");
                // 转正的请求地址，待修改
                var url = '/archive/' + id + '/offer_on';
                Ajaxget(url,function (data) {
                    if(data.status){
                        layer.msg(data.msg);
                        setTimeout(function () {
                            window.location.reload();
                        },1000)

                    }else {
                        layer.msg(data.msg);
                    }
                })
            });



             //导入档案
            $("#uploadbtn").click(function () {
                $("#uploadify").click();
            });
            $("#uploadify").change(function () {

                var files = $('#uploadify')[0].files;
                var formData = new FormData();
                for(i=0;i<files.length;i++){
                    formData.append("files["+i+"]", files[i]);
                }
                console.log(formData)
                //发送数据
                $('.fakeloader').fadeIn(100);
                Ajaxupload('/archive/import',formData,function (data) {
                    $('.fakeloader').fadeOut(100);
                    if(data.status){
                        layer.msg(data.msg);

                    }else {
                        layer.msg(data.msg);
                    }
                    setTimeout(function () {
                        window.location.reload();
                    },1000);
                })
            });

            //  同步
                $("#update").click(function () {
                    window.location.href="{{ url('setting/sync') }}"
                });
                

                function get_user_sync() {
                $('.fakeloader').fadeIn(100);
                $.ajax({
                    url:"/user/sync",
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