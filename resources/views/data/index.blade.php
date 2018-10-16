@extends('layouts.app')
<!--中间内容区域-->
@section('content')
    <!--中间内容区域-->
    <div class="container container-responsive">
        <div class="row hr-main-bg">
            @include('_parties.data_menu')
            <div class="right-side col-xs-12 col-sm-10 col-md-9 col-lg-10">
            	<div class="statistics_time">
            		<span>时间：</span>
            		<span class="statistics_time_span" data-time="1">本月</span>
            		<span class="statistics_time_span active" data-time="3">三月</span>
            		<span class="statistics_time_span" data-time="6">半年</span>
            		<span class="statistics_time_span" data-time="year">今年</span>
            		<span class="statistics_time_span" data-time="all">全部</span>
            	</div>
            	<div id="container"></div>
            	<div class="table_data">
            		<p class="table_data_p1">详细数据</p>
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
                                            <div id="DataTables_Table_0_wrapper" class="form-inline dt-bootstrap4 no-footer">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table class="table" ui-jq="dataTable" ui-options="datatable.dataTableOpt" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                                            <thead>
                                                            <tr role="row">
                                                                <th class="">姓名</th>
                                                                <th class="">性别</th>
                                                                <th class="">部门</th>
                                                                <th class="">职位</th>
																<th class="">联系方式</th>
                                                                <th class="">入职时间</th>
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
    </div>

@endsection

@section('javascript')
    @parent
<script type="text/javascript">
    	require(['DataTable', 'layer'], function (DataTable) {
    	    $(function () {
    	        var table = $('#DataTables_Table_0').DataTable({
    	            "ajax": "/data/table_all_data?time=3",
    	            "ordering": false,
    	            "bAutoWidth": true,
    	            "searching": false,

    	            "dom": '<"toolbar">frtip',
    	            "createdRow": function (row, data, index) {
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
    	                        "sPrevious": " 上一页 ",
    	                        "sNext": " 下一页 ",
    	                        "sLast": " 最后一页 "
    	                    }
    	                }

    	        });
    	        let options = {
    	            "xAxis": [{
    	                "type": "category",
    	                "categories": [],
    	                "index": 0,
    	                "isX": true
    	            }],
    	            "series": [{
    	                "name": "新入职",
    	                "data": [],
    	                "_colorIndex": 0,
    	                "_symbolIndex": 0
    	            }],
    	            "yAxis": [{
    	                "title": {
    	                    "text": "人数"
    	                },
    	                "index": 0,
    	                "allowDecimals": false
    	            }],
    	            "chart": {
    	                "style": {
    	                    "fontFamily": "\"微软雅黑\", Arial, Helvetica, sans-serif",
    	                    "color": "#333",
    	                    "fontSize": "12px",
    	                    "fontWeight": "normal",
    	                    "fontStyle": "normal"
    	                },
    	                "zoomType": 'xy'
    	            },
    	            "title": {
    	                "text": "新入职员工统计",
    	                "x": -20
    	            },
    	            "subtitle": {
    	                "text": "",
    	                "x": -20
    	            },
    	            "tooltip": {
    	                "valueSuffix": "人"
    	            },
    	            "legend": {
    	                "layout": "vertical",
    	                "align": "right",
    	                "verticalAlign": "middle"
    	            },
    	            "plotOptions": {
    	                "series": {
    	                    "animation": false
    	                }
    	            },
    	            "exporting": {
    	                "enabled": false
    	            },
    	            "credits": {
    	                "enabled": false
    	            }
    	        }
    	        $.ajax({
    	            type: "get",
    	            url: "/data/all_data?time=3",
    	            async: false,
    	            success: function (data) {
    	                options.xAxis[0].categories = data.keys
    	                options.series[0].data = data.value
    	                Highcharts.chart('container', options)
    	            }
    	        });
    	        $('.statistics_time_span').on('click', function () {
    	            $(this).addClass('active').siblings().removeClass('active')
    	            let time = $(this).attr('data-time')
    	            $.ajax({
    	                type: "get",
    	                url: "/data/all_data?time=" + time,
    	                async: false,
    	                success: function (data) {
    	                    console.log(data)
    	                    options.xAxis[0].categories = data.keys
    	                    options.series[0].data = data.value
    	                    Highcharts.chart('container', options)
    	                }
    	            })
    	            table.ajax.url('/data/table_all_data?time=' + time).load()
    	        })
    	        if(GetQuery('time') == '1'){
    	    		setTimeout(function(){
    	    			$(".statistics_time_span").first().trigger("click");
    	    		},1000)
    	    	}
    	    });
    	})
</script>
@endsection