@extends('layouts.app')
<!--中间内容区域-->
@section('content')
	<!--中间内容区域-->
	<div class="container container-responsive">
		<div class="row hr-main-bg">
            @include('_parties.notice_menu')

			<div class="right-side col-xs-12 col-sm-10 col-md-9 col-lg-10">
				<div class="right-side-header margin-left">
					<div>

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
																		面试职位
																	</th>
																	<th class="">
																		状态
																	</th>
																	<th class="">
																		面试时间
																	</th>
																	<th class="">
																		面试结果
																	</th>
																	<th class="">
																		地点
																	</th>
																	<th class="">
																		应聘者
																	</th>
																	<th class="">
																		来源
																	</th>
																	{{--<th class="" tabindex="0" rowspan="1" colspan="1">--}}
																		{{--备注--}}
																	{{--</th>--}}
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
	"ajax": "/subscribe/all_data",
//        "autoWidth": true,
//        "flexibleWidth":true,
//        "responsive":true,
        "ordering" : false,
        "bAutoWidth": true,
        "columnDefs": [
            {
                "targets": 7,
                "render":function (data,tyepe,row,meta) {
                    switch (data)
                    {
                        case 1:
                            return '<div class="operate"><a href="javascript:void(0)" class="btn btn-sm operate-btn"><i class="iconfont">&#xe632;</i>操作</a><div class="operate-group"><div class="btn-group" role="group"><button type="button" class="btn btn-black show">查看</button><button type="button" class="btn btn-black edit">修改</button><button type="button" class="btn btn-black copy">复制</button><button type="button" class="btn btn-black closeds">关闭</button></div></div></div>';
                            break;
                        case 2:
                            return '<div class="operate"><a href="javascript:void(0)" class="btn btn-sm operate-btn"><i class="iconfont">&#xe632;</i>操作</a><div class="operate-group"><div class="btn-group" role="group"><button type="button" class="btn btn-black show">查看</button><button type="button" class="btn btn-black edit">修改</button><button type="button" class="btn btn-black copy">复制</button><button type="button" class="btn btn-black closeds">关闭</button></div></div></div>';
                            break;
                        case 3:
                            return '<div class="operate"><a href="javascript:void(0)" class="btn btn-sm operate-btn"><i class="iconfont">&#xe632;</i>操作</a><div class="operate-group"><div class="btn-group" role="group"><button type="button" class="btn btn-black show">查看</button><button type="button" class="btn btn-black copy">复制</button></div></div></div>';
                            break;
//                        case 4:
//                            return '<div class="operate"><a href="javascript:void(0)" class="btn btn-sm operate-btn"><i class="iconfont">&#xe632;</i>操作</a><div class="operate-group"><div class="btn-group" role="group"><button type="button" class="btn btn-black show">查看</button><button type="button" class="btn btn-black copy">复制</button></div></div></div>';
//                            break;
                        default:
                            return '<div class="operate"><a href="javascript:void(0)" class="btn btn-sm operate-btn"><i class="iconfont">&#xe632;</i>操作</a><div class="operate-group"><div class="btn-group" role="group"><button type="button" class="btn btn-black show">查看</button><button type="button" class="btn btn-black copy">复制</button></div></div></div>';
//                            alert("返回操作码有误，请联系开发人员");
                            break;
                    }
                },
            },
            {
                "targets": 3,
                "render":function (data,tyepe,row,meta) {
                    switch (data)
                    {
                        case 0:
                            return '<span style="color: #ffa520;">待面试</span>';
                            break;
//						case 1:
//                            return '<span style="color: #EE6C70;">不合适</span>';
//                            break;
                        case 2:
                            return '<span style="color: #8DCD8D">面试通过</span>';
                            break;
                        default:
                            return '<span style="color: #fd7d7e;">不合适</span>';
//                            alert("返回的面试结果状态码有误，请联系开发人员");
                            break;
                    }
                },
            },
            {
                "targets": 6,
                "render":function (data,tyepe,row,meta) {
                    switch (data)
                    {
                        case 0:
                            return '<span>智通</span>';
                            break;
                        case 1:
                            return '<span>卓博</span>';
                            break;
                        case 2:
                            return '<span>内部推荐</span>';
                            break;
//                        case 3:
//                            return '<span>人才市场</span>';
//                            break;
                        default:
                            return '<span>人才市场</span>';
//                            alert("返回的简历来源状态码有误，请联系开发人员");
                            break;
                    }
                },
            },
            {
                "targets": 1,
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
        ],
	"dom": '<"toolbar">frtip',
	"createdRow": function ( row, data, index ) {
        $('td', row).eq(4).addClass('tddz');
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
                    if (i == 1) {//删除第一列与第二列的筛选框
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
                            var dstr;
                            if(d == 1) {
                                dstr = '未开始'
                            }else  if(d == 2){
                                dstr = '进行中'
                            }else  if(d == 3){
                                dstr = '已完成'
                            }else {
                                dstr = '已关闭'
                            }
                            select.append('<option value="' + dstr + '">' + dstr + '</option>')
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

		$("div.toolbar").html('<a class="btn btn-primaryxs" id="add_subscrilbe" href="javascript:void(0);">新增预约</a><span class="margin-left-xs" id="select_status"></span>');
        $("#DataTables_Table_0_filter input[type=search]").attr("placeholder","可输入日期/职位/姓名")

        //查看
        $('#DataTables_Table_0 tbody').on( 'click', '.show', function () {
            var data = table.row( $(this).parents('tr') ).data();
            var url = '/subscribe/' + data[ 8 ] + '/show';
//            window.location.href = url;
            window.open(url);

        });

        // 新增预约
        $("#add_subscrilbe").click(function(){
            Ajaxget('/subscribe/create',function(data){
                console.log(data)
                if(data.status){
                    if(data.examine_id) {
                        window.location.href = '/subscribe/getCreateView?examine_id=' + data.examine_id
                    }else {
                        window.location.href = '/subscribe/getCreateView'
                    }
                }else {
                    layer.msg(data.msg)
                }
            });
        })

        //修改
        $('#DataTables_Table_0 tbody').on( 'click', '.edit', function () {
            var data = table.row( $(this).parents('tr') ).data();
            //判断是否能够修改，data[9]，是后台返回来判断条件，true则可以修改，false则提示不能修改
            if(data[9]){
                var url = '/subscribe/' + data[ 8 ] + '/edit';
                window.location.href = url;
            }else {
                layer.msg('已经有面试评价的预约不能修改信息！');
            }

        });

        //复制
        $('#DataTables_Table_0 tbody').on( 'click', '.copy', function () {
            var data = table.row( $(this).parents('tr') ).data();
            var url = '/subscribe/' + data[ 8 ] + '/copy';
            window.location.href = url;
        });
        //取消
        $('#DataTables_Table_0 tbody').on( 'click', '.closeds', function () {
            var data = table.row( $(this).parents('tr') ).data();
            // 在模态框出现的时候调用垂直居中函数
            $('.modal').on('show.bs.modal', centerModals);
            // 在窗口大小改变的时候调用垂直居中函数
            $(window).on('resize', centerModals);
            $("#submit_remark").attr("name",data[ 8 ]);
            $("#Edit_remark_modal").modal();

        });

        //提交取消原因
        $("#submit_remark").click(function () {
            var id = $("#submit_remark").attr("name");
            var url = '/subscribe/' + id + '/destroy';
            if($("#remark").val() == ''){
                layer.msg("请填写关闭原因");
                return false;
            }
            AjaxJson(url,{'remark':$("#remark").val()},function (data) {
                console.log(data)
                if(data.status === 1){
                    layer.msg(data.msg);
                    setTimeout(function () {
                        window.location.reload();
                    },1000)

                }else {
                    layer.msg(data.msg);
                }
            })
        });
});

</script>
@endsection