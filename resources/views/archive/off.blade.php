@extends('layouts.app')
<!--中间内容区域-->
@section('content')
    <!--中间内容区域-->
    <div class="container container-responsive">
        <div class="row hr-main-bg">
            @include('_parties.archive_menu')
            <div class="right-side col-xs-12 col-sm-10 col-md-9 col-lg-10">
                <div class="right-side-header margin-left">
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
                                                                <th class=""></th>
                                                                <th class=""></th>
                                                                <th class=""></th>
                                                                <th class=""></th>
                                                                <th class="">
                                                                    离职时间
                                                                </th>
                                                                <th class="">
                                                                    离职原因
                                                                </th>
                                                                <th class="">
                                                                    离职情况
                                                                </th>
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
    {{--取消模态框--}}
    <div class="modal fade" id="Edit_remark_modal">
        <div class="modal-dialog modalwidth-xs" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">填写关闭原因</h4>
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                        <div class="padding-left padding-right">
                            <textarea id="remark" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="submit_remark" class="btn btn-primary">保存</button>
                        <button type="button" class="btn btn-default margin-left-xs" data-dismiss="modal">关闭</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @parent
    <script type="text/javascript">
        require(['DataTable','layer'], function (DataTable) {
            var table = $('#DataTables_Table_0').DataTable( {
                "ajax": "/archive/off_data",
//        "autoWidth": true,
//        "flexibleWidth":true,
//        "responsive":true,
                "ordering" : false,
                "bAutoWidth": true,
                "columnDefs": [
                    {
                        "targets": 4,
                        "visible": false,
                        "searchable": true

                    }, {
                        "targets": 5,
                        "visible": false,
                        "searchable": true

                    },{
                        "targets": 6,
                        "visible": false,
                        "searchable": true

                    },{
                        "targets": 7,
                        "visible": false,
                        "searchable": true

                    }
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

            $("div.toolbar").html('<span class="margin-left-xs" id="select_status"></span>');
            $("#DataTables_Table_0_filter input[type=search]").attr("placeholder","可输入日期/职位/姓名");

            //查看
            $('#DataTables_Table_0 tbody').on( 'click', '.show', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var url = '/archive/' + data[12] + '/show';

                window.location.href= url;
            });

            //复职
            $('#DataTables_Table_0 tbody').on( 'click', '.again', function () {
                var data = table.row( $(this).parents('tr') ).data();
                window.location.href='/archive/'+ data[12] + '/reOffer'

            });
        });

    </script>
@endsection