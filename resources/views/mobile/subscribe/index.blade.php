<!DOCTYPE html>
<html lang="zh-CN">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	<title>东华国际·人力资源</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href=" {{ url('/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ url('/css/wap_show.css') }}">
	<link rel="stylesheet" href="{{ url('/css/mobiscroll.2.13.2.min.css') }}" />
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body style="background: #F0F0F2;">
<div class="header">
	<div class="row wap-exa">
		<a href="{{ url( '/mobile/subscribe' ) }} " >
			<div class="col-xs-4 padding-0 {{ $flag == 'today' ? 'active' : ''  }}">
				<p class="exa-date">今天</p>
				<p class="exa-num">{{ $today }}</p>
			</div>
		</a>

		<a href="{{ url('/mobile/subscribe/tomorrow') }} " >
			<div class="col-xs-4 padding-0 {{ $flag == 'tomorrow' ? 'active' : ''  }}">
				<p class="exa-date">明天</p>
				<p class="exa-num">{{ $tomorrow }}</p>
			</div>
		</a>

		<a href="{{ url('/mobile/subscribe/week') }} " >
			<div class="col-xs-4 padding-0 {{ $flag == 'week' ? 'active' : ''  }}">
				<p class="exa-date">本周</p>
				<p class="exa-num">{{ $week }}</p>
			</div>
		</a>
	</div>
</div>
<div class="container">

	@if($subscribes->count())
	@foreach($subscribes as $subscribe)
	<a href="{{ url('/mobile/subscribe/'.$subscribe->id.'/show') }}" style="color: #080808;">
		<div class="panel-box">
			<p class="text-center margin-sm">{{ $subscribe->created_at->toDateTimeString() }}</p>
			<div class="panel panel-default">
				<div class="panel-body">
					<p class="title">面试职位：<span>{{ $subscribe->examines->position }}</span></p>
					<dl class="dl-list">
						<dt>状态：</dt>
						<!--/*状态样式*/--><!--/*1---未开始，2---进行中，3---已完成，4---已取消*/-->
						<dd>
							@if($subscribe->status == 1)
								<span class="status-span-1">未开始</span>
							@elseif($subscribe->status == 2)
							   <span class="status-span-2">进行中</span>
							@elseif($subscribe->status == 3)
								<span  class="status-span-3">已完成</span>
							@else
								<span  class="status-span-4">已关闭</span>
							@endif
						</dd>
						<dt>时间：</dt>
						<dd><time>{{ $subscribe->offer_date->toDateTimeString() }}</time></dd>
						<dt>地点：</dt>
						<dd><span>{{ $subscribe->address }}</span></dd>
						<dt>备注：</dt>
						<dd><span>{{ $subscribe->remark }}</span></dd>
					</dl>
				</div>
				<div class="panel-footer">详情<i class="iconfont pull-right">&#xe63c;</i></div>
			</div>
		</div>
	</a>
    {{--<div class="text-center">--}}
        {{--<a href="#" class="btnsp btn-default" style="width: 90%;">查看更多</a>--}}
    {{--</div>--}}
	@endforeach
	@else
		<div class="text-center">
			<img style="max-width: 80%" src="{{ url('img/raw_1501664235.png') }}" alt="">
			<p>没有面试预约哦！</p>
		</div>
	@endif
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script src="{{ url('js/jquery.more.js?v=1') }}"></script>
<script type="text/javascript" src="{{ url('js/mobiscroll.2.13.2.min.js') }}" ></script>
</body>
</html>