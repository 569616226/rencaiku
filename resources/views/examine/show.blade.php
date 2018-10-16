<!DOCTYPE html>
<html lang="zh-CN">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
		<title>东华国际·人力资源</title>
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ url('css/show.css') }}" />
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>

	<body>
		<div class="container main">
			<div class="header">
				<span>人员增补申请单详情</span>
			</div>
			<div class="widget">
				<div class="widget_little">
					<div class="widget_head">
						<img src="{{ url('/img/boy.png') }}" class="img-responsive" />
					</div>
					<span class="widget_ren">{{ $examine->apply_name }}的人员增补申请单</span>
					@if($examine->status === 1)
						<span class="widget_state_k">未开始</span>
					@elseif($examine->status === 2)
						<span class="widget_state_i">进行中</span>
					@elseif($examine->status === 3)
						<span class="widget_state_s">已完成</span>
					@else
						<span class="widget_state_q">已关闭</span>
					@endif

				</div>
				<div class="widget_little">
					<div class="row">
						<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
							<p class="widget_p1">申请部门：</p>
						</div>
						<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
							<p>{{ $examine->depart }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
							<p class="widget_p1">申请岗位：</p>
						</div>
						<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
							<p>{{ $examine->position }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
							<p class="widget_p1">申请名额：</p>
						</div>
						<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
							<p>{{ $examine->places }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
							<p class="widget_p1">计划完成日期：</p>
						</div>
						<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
							<p>{{ $examine->complate_date->toDateString() }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
							<p class="widget_p1">申请原因：</p>
						</div>
						<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
							<p>{{ $examine->reason }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
							<p class="widget_p1">性别：</p>
						</div>
						<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
							<p>{{ $examine->sex }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
							<p class="widget_p1">年龄：</p>
						</div>
						<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
							<p>{{ $examine->age }}岁</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
							<p class="widget_p1">学历：</p>
						</div>
						<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
							<p>{{ $examine->education }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
							<p class="widget_p1">工作经验：</p>
						</div>
						<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
							{!!  html_entity_decode(stripslashes($examine->wrok_experiences)) !!}
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
							<p class="widget_p1">其他要求：</p>
						</div>
						<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
							<p>{{ $examine->other }}</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
							<p class="widget_p1">岗位职责：</p>
						</div>
						<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
							{!!  html_entity_decode(stripslashes($examine->describe)) !!}
						</div>
					</div>
				</div>
			</div>
			<div class="history">
				<div class="history_head">
					所有面试预约
				</div>
				<div class="history_table">
                    <table class="table">
		                <thead>
			                <tr>
				                <th>姓名</th>
				                <th>面试职位</th>
				                <th>面试时间</th>
				                <th>状态</th>
				                <th>面试结果</th>
				                <th>地点</th>
				                <th>操作</th>
			                </tr>
		                </thead>
		                <tbody>
						@if(!$examine->subscribes()->get()->isEmpty())
						@foreach($examine->subscribes as $subscribe)
			                <tr>
				                <td><span class="history_zhiwei">{{ $subscribe->resumes->name }}</span></td>
				                <td><span class="history_zhiwei">{{ $examine->position }}</span></td>
				                <td><span class="history_time">{{ $subscribe->offer_date->toDateTimeString() }}</span></td>
				                <td><span class="history_time">
										@if($subscribe->status == 1)
											<span class="status-span-1">未开始</span>
										@elseif($subscribe->status == 2)
											<span class="status-span-2">进行中</span>
										@elseif($subscribe->status == 3)
											<span class="status-span-3">已完成</span>
										@else
											<span class="status-span-4">已关闭</span>
										@endif
									</span></td>
				                <td>
										@if($subscribe->result == 2)
											<span class="history_tai1">面试通过</span>
										@elseif($subscribe->result == 1)
											<span class="history_tai2">不合适</span>
										@else
											<span class="history_tai3">待面试</span>
										@endif
									</td>
				                <td><span class="history_dizhi">{{ $subscribe->address }}</span></td>
				                <td><a target="_blank" href="{{ url('/subscribe/'.$subscribe->id.'/show') }}" class="history_a">查看</a></td>
			                </tr>
						@endforeach
						@endif
		                </tbody>
	                </table>
				</div>
			</div>
		</div>
		<div class="h60"></div>
		<div class="footer">
			<div class="container">
				<div class="footer_little">
					{{ $examine->apply_name }}的人员增补申请单
				</div>
				<div class="footer_button">
					{{--<a href="javascript:window.history.go(-1);">返回</a>--}}
					@if($examine->status !== 1)
						<a id="finish" href="javascript:void(0);" class="revise_cha {{ $examine->status == 2 ? '' : 'hide' }}">完成</a>
					@else
						<a href="{{url('subscribe/create/'.$examine->id)}}" class="revise_cha">预约</a>
					@endif
						<div class="footer_button">
							<a href="javascript:window.close();">关闭</a>
						</div>
				</div>
			</div>
		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		{{--<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}
		<script src="{{ url('js/main.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ url('js/require.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ url('js/config.js') }}" type="text/javascript" charset="utf-8"></script>
		<script>
            require(['bootstrap','DataTable','layer'], function (DataTable) {
                $("#finish").click(function () {
                    $.get('/examine/' + {{$examine->id}} +'/complate',function (data) {
                        layer.msg(data.msg);
                        setTimeout(function () {
                            window.location.reload();
                        },2000)
                    })
                });
			});

		</script>
	</body>
</html>