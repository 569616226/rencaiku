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

	<body style="background-color: rgb(240, 240, 242);">
		<div style="text-align: center;">
			<img src="{{url('/img/raw_1501664235.png')}}" />
			<p style="font-size: 20px;margin-bottom: 20px;">暂无权限</p>
			<p>没有权限查看此模块，请联系管理员</p>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>