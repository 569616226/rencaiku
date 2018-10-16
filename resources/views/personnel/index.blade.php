@extends('layouts.app')
<!--中间内容区域-->
@section('content')
	{{--隐藏搜素框--}}
	<style>
		#DataTables_Table_0_filter {
			display: none;
		}
		#treeBranch li {
			display: block;
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}
	</style>
	<!--中间内容区域-->
	<div class="container container-responsive">
		<div class="row hr-main-bg">
			{{-- <div class="left-side col-xs-12 col-sm-2 col-md-3 col-lg-2">
				<ul class="nav nav-pills nav-stacked custom-nav">
					<li class="active">
						<a href="{{ url('user') }}" ><i class="fa fa-bullhorn"></i> <span>通信录管理</span></a>
					</li>
				</ul>
			</div> --}}
			{{-- 系统设置 --}}
            @include('_parties.sys_menu')
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
											{{--<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap4 no-footer">--}}
											<div>
												<div class="row">
													<div class="col-md-3 padding-0">
														{{--存放同步按钮的容器--}}
														<div id="same_box" style="white-space: nowrap;"></div>
														<div id="menuContent" class="menuContent">
															<div class="tree_search">
																<label>
																	<i class="iconfont"></i>
																	<input type="text" id="citySel" onkeyup="AutoMatch(this)" class="form-control tree-search input-md" placeholder="可输入部门"></label>
															</div>
															<ul id="treeBranch" class="ztree"></ul>
														</div>
													</div>
													<div class="col-md-9 padding-left-0">
														<table class="table tabletree" ui-jq="dataTable" ui-options="datatable.dataTableOpt" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
															<thead>
																<tr role="row">
																	<th  tabindex="0" rowspan="1" colspan="1">
																		头像
																	</th>
																	<th  tabindex="0" rowspan="1" colspan="1">
																		姓名
																	</th>
																	<th  tabindex="0" rowspan="1" colspan="1">
																		同步时间
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
	var AutoMatch;
	require(['bootstrap','DataTable','layer','ztree'], function (DataTable) {
//        var table =  gettable();
        var table = $('#DataTables_Table_0').DataTable( {
                "ajax": '/user/all_data',
                "ordering" : false,
                "dom": '<"toolbar">frtip',
                //创建表格的时候的动作
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
                initComplete: function (settings, json) {

                    //同步左右树形结构和表单的高度
//                    $(".menuContent").css('height',$(".tabletree ").css('height'))
                },
            });


	$("#same_box").html('<a id="user_sync" class="btn btn-primaryxs"  type="button">同步通讯录</a><span class="margin-left-sm" id="select_status"></span><span class="margin-left-xs text-gray">最近同步：<time>{{ $latest }}</time></span>');
        $("#DataTables_Table_0_filter input[type=search]").attr("placeholder","可输入姓名");
	table.on( 'draw', function () {
	    setTimeout(function () {
             if($(".menuContent").css('height')<$(".tabletree ").css('height')){
                 // $(".menuContent").css('height',$(".tabletree ").css('height'))
			 }
        },1500);
        $('.fakeloader').fadeOut(100);
	} );
//	同步审核人
	$("#user_sync").click(function () {
        window.location.href="{{ url('setting/sync') }}"
//		$('.fakeloader').fadeIn(100);
//		$.get("/user/sync",function(data){
//			$('.fakeloader').fadeOut(100);
//		    layer.msg(data.msg);
//			if(data.status === 1){
//                setTimeout(function () {
//                    window.location.reload();
//                },1000);
//			}
//		})
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
        var zNodes;
		var url = '/depart/';
        $(document).ready(function(){
            $.get(url,function (data) {
                zNodes = data;
                InitialZtree();

            });
        });

        var setting = {
            view: {
                showLine: false,
            },
            data: {
                //如果使用的是通过父id和id来实现结构的，需要添加设置simpleData下的enable设置
                simpleData: {
                    enable: true,
                    idKey: "id",   //设置id的字段
                    pIdKey: "prId", //设置父id的字段
                },
                key: {
//					name: "id"    //将 treeNode 的 fullName 属性当做节点名称
                }
            },
            callback: {
                onClick: nodeClick
            }
        };

        function nodeClick(event, treeId, treeNode){
            $('.fakeloader').fadeIn(100);
            table.ajax.url('/depart/'+ treeNode.id +'/data').load();
        }

        //点击某个节点 然后将该节点的名称赋值值文本框
        function onClick(e, treeId, treeNode) {
            var zTree = $.fn.zTree.getZTreeObj("treeBranch");
            //获得选中的节点
            var nodes = zTree.getSelectedNodes(),
                v = "";
            //根据id排序
            nodes.sort(function compare(a, b) { return a.id - b.id; });
            for (var i = 0, l = nodes.length; i < l; i++) {
                v += nodes[i].name + ",";
            }
            //将选中节点的名称显示在文本框内
            if (v.length > 0) v = v.substring(0, v.length - 1);
            var cityObj = $("#citySel");
            cityObj.attr("value", v);
            //隐藏zTree
            hideMenu();
            return false;
        }
        //显示树
        function showMenu() {
            var cityObj = $("#citySel");
            var cityOffset = $("#citySel").offset();
            $("#menuContent").css({ left: cityOffset.left + "px", top: cityOffset.top + cityObj.outerHeight() + "px" }).slideDown("fast");
        }

        //隐藏树
        function hideMenu() {
            $("#menuContent").fadeOut("fast");
            $("body").unbind("mousedown", onBodyDown);
        }
        function InitialZtree() {
            $.fn.zTree.init($("#treeBranch"), setting, zNodes);
        }
        ///根据文本框的关键词输入情况自动匹配树内节点 进行模糊查找
        AutoMatch = function(txtObj) {
            if (txtObj.value.length > 0) {
                InitialZtree();
                var zTree = $.fn.zTree.getZTreeObj("treeBranch");
                var nodeList = zTree.getNodesByParamFuzzy("name", txtObj.value);
                //将找到的nodelist节点更新至Ztree内
                $.fn.zTree.init($("#treeBranch"), setting, nodeList);
                showMenu();
            } else {
                //隐藏树
                //              hideMenu();
                InitialZtree();
            }
        }
});


</script>
@endsection