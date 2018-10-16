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
		<link rel="stylesheet" href="{{ url('/css/wap_show.css?v=1') }}">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
    	<script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    	<script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
	</head>

	<body style="background-color: #f8fbfe;">
		<div class="select_depart">
			<!--<div class="select_all">
				<a href="{{ url('mobile/archive/1/depart') }}">
					<img  src="{{ url('/img/512.png') }}" />
					<span>全部</span>
					<i class="iconfont icon-chevron-right"></i>
				</a>
			</div>-->
			<div class="select_all">
				<a href="{{ url('mobile/archive/0/depart') }}">
					<img  src="{{ url('/img/512.png') }}" />
					<span>广东东华供应链科技有限公司</span>
					<i class="iconfont icon-chevron-right"></i>
				</a>
			</div>
			<div class="select_all">
				<a href="{{ url('mobile/archive/16/depart') }}">
					<img  src="{{ url('/img/512.png') }}" />
					<span>东莞东华报关服务有限公司</span>
					<i class="iconfont icon-chevron-right"></i>
				</a>
			</div>
		</div>
		<div class="select_bottom">
			<a href="{{ url('mobile/archive/1/depart') }}">
				<span>查看所有子公司</span>
			</a>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>

</html>
