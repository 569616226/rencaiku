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
							<!-- uiView: --
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
																	<th  tabindex="0" rowspan="1" colspan="1">
																		标题
																	</th>
																	<th  tabindex="0" rowspan="1" colspan="1">
																		状态
																	</th>
																	<th  tabindex="0" rowspan="1" colspan="1">
																		申请部门
																	</th>
																	<th  tabindex="0" rowspan="1" colspan="1">
																		申请岗位
																	</th>
																	<th class="text-center" tabindex="0" rowspan="1" colspan="1">
																		申请名额
																	</th>
																	<th  tabindex="0" rowspan="1" colspan="1">
																		计划完成日期
																	</th>
																	<th  tabindex="0" rowspan="1" colspan="1">
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
	require(['bootstrap','DataTable','layer'], function (DataTable) {
	var table = $('#DataTables_Table_0').DataTable( {
	"ajax": "/examine/all_data",
	"ordering" : false,
	"columnDefs": [
	    {
			"targets": 6,
			"render":function (data,tyepe,row,meta) {
                switch (data)
                {
                    case 1:
                        return '<div class="operate"><a href="javascript:void(0)" class="btn btn-sm operate-btn"><i class="iconfont">&#xe632;</i>操作</a><div class="operate-group"><div class="btn-group" role="group"><button type="button" class="btn btn-black show">查看</button><button type="button" class="btn btn-black order">预约</button><button type="button" class="btn btn-black abolish">关闭</button></div></div></div>'
                        break;
                    case 2:
                        return '<div class="operate"><a href="javascript:void(0)" class="btn btn-sm operate-btn"><i class="iconfont">&#xe632;</i>操作</a><div class="operate-group"><div class="btn-group" role="group"><button type="button" class="btn btn-black show">查看</button><button type="button" class="btn btn-black order">预约</button><button type="button" class="btn btn-black finish">完成</button><button type="button" class="btn btn-black abolish">关闭</button></div></div></div>'
                        break;
                    case 3:
                        return '<div class="operate"><a href="javascript:void(0)" class="btn btn-sm operate-btn"><i class="iconfont">&#xe632;</i>操作</a><div class="operate-group"><div class="btn-group" role="group"><button type="button" class="btn btn-black show">查看</button></div></div></div>'
                        break;
//                    case 4:
//                        return '<div class="operate"><a href="javascript:void(0)" class="btn btn-sm operate-btn"><i class="iconfont">&#xe632;</i>操作</a><div class="operate-group"><div class="btn-group" role="group"><button type="button" class="btn btn-black show">查看</button></div></div></div>'
//                        break;
                    default:
                        return '<div class="operate"><a href="javascript:void(0)" class="btn btn-sm operate-btn"><i class="iconfont">&#xe632;</i>操作</a><div class="operate-group"><div class="btn-group" role="group"><button type="button" class="btn btn-black show">查看</button></div></div></div>'
//                        alert("返回状态码有误，请联系开发人员");
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
//                    case 4:
//                        return '<span  class="status-span-4">已取消</span>'
//                        break;
                    default:
                        return '<span  class="status-span-4">已关闭</span>';
//                        alert("返回状态码有误，请联系开发人员");
                        break;
                }
            },
        },
	],
	"dom": '<"toolbar">frtip',
	//创建表格的时候的动作
	"createdRow": function ( row, data, index ) {
		$('td', row).eq(4).addClass('tr-center');
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
//                        function delHtmlTag(str) {
//                            return str.replace(/<[^>]+>/g, "");//去掉html标签
//                        }
//
//                        d = delHtmlTag(d);
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
                        });
                        $span.append(select)
                        //判断地址栏传过来的参数，选择筛选不同的数据
                        if(GetQuery('root')==2){
                            $(".form-control option").eq(2).attr("selected",true).click();
                        }else if(GetQuery('root')==3){
                            $(".form-control option").eq(3).attr("selected",true).click();
                        };
                    }
                });
            }
	    }

	});

		$("div.toolbar").html('<input class="btn btn-primaryxs" id="update" type="button" value="同步申请单" /><span class="margin-left-sm" id="select_status"></span><span class="margin-left-xs text-gray">最近同步：<time>{{ $latest }}</time></span>');
		$("#DataTables_Table_0_filter input[type=search]").attr("placeholder","可输入申请职位/部门")
//	同步申请单
	$("#update").click(function () {
        get_examine_sync()
        //$.get("/examine/sync",function(data){
//            $('.fakeloader').fadeOut(100);
//            layer.msg(data.msg);
//            if(data.status === 1){
//                setTimeout(function () {
//                    window.location.reload();
//                },1000);
//            }
//        })

    });
	//请求同步申请单
	function get_examine_sync() {
        $('.fakeloader').fadeIn(100);
        $.ajax({
            url:"/examine/sync/1",
            type: "get",
            dataType: "json",
            timeout:180000,
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
            error: function (xhr,status,error) {
                console.log(xhr)
                console.log(status)
                console.log('失败原因' + error)
                $('.fakeloader').fadeOut(100);
                layer.msg('哎呦，网络开了小差。是否重新同步吗？', {
                    time: 0 //不自动关闭
                    ,btn: ['重新同步', '稍后再试']
                    ,yes: function(index){
                        layer.close(index);
                        get_examine_sync()
                    }
                });
            }
        });
    }

	//查看
	$('#DataTables_Table_0 tbody').on( 'click', '.show', function () {
		var data = table.row( $(this).parents('tr') ).data();
        var url = '/examine/' + data[ 7 ] + '/show';
//      window.location.href = url;
        window.open(url);
	});

	//预约
	$('#DataTables_Table_0 tbody').on( 'click', '.order', function () {
		var data = table.row( $(this).parents('tr') ).data();
        var url = '/subscribe/getCreateView?examine_id=' + data[ 7 ];
		window.location.href = url;
	});

	//完成
	$('#DataTables_Table_0 tbody').on( 'click', '.finish', function () {
		var data = table.row( $(this).parents('tr') ).data();
        var url = '/examine/' + data[ 7 ] + '/complate';
        layer.msg('确定完成吗？', {
            time: 0 //不自动关闭
            ,btn: ['确定', '取消']
            ,yes: function(index){
                $.get(url,function(data){
                    if(data.status === 1){
                        layer.msg(data.msg);
                        setTimeout(function () {
                            window.location.reload();
                        },1000);
                    }else {
                        layer.msg(data.msg);
                    }
                });
            }
        });

	});

	//取消
	$('#DataTables_Table_0 tbody').on( 'click', '.abolish', function () {
		var data = table.row( $(this).parents('tr') ).data();
        var url = '/examine/' + data[ 7 ] + '/destroy';
        layer.msg('确定关闭吗？', {
            time: 0 //不自动关闭
            ,btn: ['确定', '取消']
            ,yes: function(index){
                $.get(url,function(data){
                    if(data.status === 1){
                        layer.msg(data.msg);
                        setTimeout(function () {
                            window.location.reload();
                        },1000);
                    }else {
                        layer.msg(data.msg);
                    }
                });
            }
        });
	});
});


</script>
@endsection