@extends('layouts.app')
<!--中间内容区域-->
@section('content')
	<!--中间内容区域-->
	<div class="container container-responsive">
		<div class="row hr-main-bg">
			<div class="left-side col-xs-12 col-sm-2 col-md-3 col-lg-2">
				<ul class="nav nav-pills nav-stacked custom-nav">
					<li class="active">
						<a href="{{ url('resume') }}" ><i class="fa fa-bullhorn"></i> <span>简历管理</span></a>
					</li>
					<li>
						<a href="{{ url('resume/blacklist') }}" ><i class="fa fa-bullhorn"></i><span>黑名单</span></a>
					</li>
				</ul>
			</div>

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
                                                                    <th class="text-center checkboxth sorting_none" tabindex="0" rowspan="1" colspan="1">
                                                                        <input type="checkbox" name="allchoose">
                                                                    </th>
																	<th class="" tabindex="0" rowspan="1" colspan="1">
																		姓名
																	</th>
																	<th class="" tabindex="0" rowspan="1" colspan="1">
																		简历来源
																	</th>
																	<th class="" tabindex="0" rowspan="1" colspan="1">
																		应聘职位
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
                                                                    <th class="text-center" tabindex="0" rowspan="1" colspan="1">
                                                                        备注
                                                                    </th>
																	<th class="" tabindex="0" rowspan="1" colspan="1">
																		创建时间
																	</th>
																	<th class="tr-center" tabindex="0" rowspan="1" colspan="1">
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

    <div class="modal-box">
        <!--填写备注模态框-->
        <div class="modal fade" id="Edit_remark_modal">
            <div class="modal-dialog modalwidth-xs" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">填写备注</h4>
                    </div>
                    <form class="form-horizontal">
                        <div class="modal-body">
                            <div class="padding-left padding-right">
                                <textarea id="remark" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="submit_remark" class="btn btn-primary">保存</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        </div>
                    </form>
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
	require(['DataTable','layer'], function (DataTable) {
        var table = $('#DataTables_Table_0').DataTable( {
        "ajax": "/resume/all_data",
//        对后台返回来的数据进行操作，render将返回来数据放到表格中
        "columnDefs": [
            {
                "targets": -1,
                "render":function (data,tyepe,row,meta) {
                    return '<div class="operate"><a href="javascript:void(0)" class="btn btn-sm operate-btn"><i class="iconfont">&#xe632;</i>操作</a><div class="operate-group"><div class="btn-group" role="group"><button type="button" class="btn btn-black show">查看</button><button type="button" class="btn btn-black Edit_remark">备注</button><button type="button" class="btn btn-black deletebtn black_in">加入黑名单</button><button type="button" class="btn btn-black delete">删除</button></div></div></div>'
                },
            },
            {
                "targets": 2,
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
//                            alert("返回的简历来源代码有误，请联系开发人员");
                            break;
                    }
                },
            },
            {
                "targets": 7,
                "render":function (data,tyepe,row,meta) {
                   if(data != "" && data != null){
                       return '<div class="remark-box"><div class="remark-text">'+ data +'</div><span class="remark-re">有</span></div>'
                   }else {
                       return '无'
                   }
                },
            },
        ],
        "ordering" : false,
        "dom": '<"toolbar">frtip',
        "createdRow": function ( row, data, index ) {
            $('td', row).eq(0).addClass('tr-center');
//            $('td', row).eq(7).addClass('tddz');
            $('td', row).eq(7).addClass('tr-center');
            $('td', row).eq(9).addClass('tr-center');
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
            }
		});
		    $("div.toolbar").html('<input id="uploadbtn" class="btn btn-primaryxs margin-right-sm pull-left" type="button" value="导入简历"></input><input id="black_in" class="btn btn-default margin-right pull-left" type="button" value="拉入黑名单"></input>');
            $("#DataTables_Table_0_filter input[type=search]").attr("placeholder","可输入职位/姓名")
            //查看简历
            $('#DataTables_Table_0 tbody').on( 'click', '.show', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var url = '/resume/' + data[ 9 ] + '/show';
                //window.location.href = url;
                window.open(url);
            } );

            //编辑备注
            $('#DataTables_Table_0 tbody').on( 'click', '.Edit_remark', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var url = '/resume/' + data[ 9 ] + '/remark';
                $.get(url,function (data) {
                    $("#remark").val(data)
                });
                // 在模态框出现的时候调用垂直居中函数
                $('.modal').on('show.bs.modal', centerModals);
                // 在窗口大小改变的时候调用垂直居中函数
                $(window).on('resize', centerModals);
                $("#submit_remark").attr("name",data[ 9 ]);
                $("#Edit_remark_modal").modal();
            });

            //提交备注
            $("#submit_remark").click(function () {
                var id = $("#submit_remark").attr("name");
                var url = '/resume/' + id + '/remark';
                AjaxJson(url,{'remark':$("#remark").val()},function (data) {
                    if(data.status === 1){
                        layer.msg(data.msg);
                        window.location.reload();
                    }else {
                        layer.msg(data.msg);
                    }
                })
            });

            //加入黑名单
            $('#DataTables_Table_0 tbody').on( 'click', '.black_in', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var url = '/resume/' + data[ 9 ] + '/black_in';
                $.get(url,function(data,status){
                    if(data.status === 1){
                        layer.msg(data.msg);
                        setTimeout(function () {
                            window.location.reload();
                        },1000);
                    }else {
                        layer.msg(data.msg);
                    }
                });
            });

            //删除
            $('#DataTables_Table_0 tbody').on( 'click', '.delete', function () {
                var data = table.row( $(this).parents('tr') ).data();
                var url = '/resume/' + data[ 9 ] + '/destroy';
                layer.msg('确定删除该简历吗？', {
                    time: 0 //不自动关闭
                    ,btn: ['确定', '取消']
                    ,yes: function(index){
                        layer.close(index);
                        Ajaxdelete(url,null,function (data) {
                            if(data.status === 1){
                                layer.msg(data.msg);
                                setTimeout(function () {
                                    window.location.reload();
                                },1000);
                            }else {
                                layer.msg(data.msg);
                            }
                        })
                    }
                });

            });

            //全选功能
            var ft = false;
            $("input[name='allchoose']").click(function () {
                ft = !ft;
                $("input[name='resume']").prop("checked", ft)
            });
            //多选拉入黑名单
            $("#black_in").click(function () {
                //获取勾选上的复选框的值，数组形式
                var arr = CheckboxValshu('resume');
                var url = '/resume/black_in_all';
                AjaxJson(url,{resume_ids:arr},function (data) {
                    if(data.status === 1){
                        layer.msg(data.msg);
                        setTimeout(function () {
                            window.location.reload();
                        },1000);
                    }else {
                        layer.msg(data.msg);
                    }
                })
            });

            //导入简历
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
                Ajaxupload('/resume/import',formData,function (data) {
                	$('.fakeloader').fadeOut(100);
                    if(data.status === 1){
                        layer.msg(data.msg);
                        setTimeout(function () {
                            window.location.reload();
                        },1000);
                    }else {
                        layer.msg(data.msg);
                    }
                })
            });
        });
</script>
@endsection