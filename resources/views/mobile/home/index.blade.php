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
		<div class="wap_index">
			<div class="home_bg">
				<div class="home_top_a">
					<i class="iconfont icon-donghua home_top_logo"></i>
					<p class="home_top_p">欢迎使用东华国际人力资源系统</p>
				</div>
			</div>
			<div class="row home_con  ">
				<div class="col-xs-4 home_con_center ">
					<a href="{{ url('/mobile/archive/me') }}">
						<div class="iconfont icon-account-circle home_con_event"></div>
						<p class="home_con_p">我的档案</p>
					</a>
				</div>
				<div class="col-xs-4 home_con_center {{in_array($user->user_wechat_id, config('system.admin_user')) || $user->is_admin ? '' : 'hide'}}">
					<a href="{{ url('/mobile/subscribe') }} ">
						<div class="iconfont icon-ic_event_note home_con_event"></div>
						<p class="home_con_p">预约管理</p>
					</a>
				</div>
				<div class="col-xs-4 home_con_center {{in_array($user->user_wechat_id, config('system.admin_user')) || $user->is_admin ? '' : 'hide'}} ">
					<a href="{{ url('/mobile/subscribe/histroy') }}">
						<div class="iconfont icon-ic_alarm home_con_event"></div>
						<p class="home_con_p">历史面试预约</p>
					</a>
				</div>
			</div>
			<div class="row home_con_two">
				<div class="col-xs-4 home_con_center {{in_array($user->user_wechat_id, config('system.admin_user')) ? '' : 'hide'}} ">
					<a href="{{ url('/mobile/archive') }}">
						<div class="iconfont icon-contact-mail home_con_event"></div>
						<p class="home_con_p">员工管理</p>
					</a>
				</div>
				<div class="col-xs-4 home_con_center {{in_array($user->user_wechat_id, config('system.admin_user')) ? '' : 'hide'}}">
					<a href="{{ url('/mobile/notice/full') }}">
						<div class="iconfont icon-clipboard-check home_con_event"></div>
						<p class="home_con_p">我的待办</p>
					</a>
				</div>
				<div class="col-xs-4 home_con_center {{in_array($user->user_wechat_id, config('system.admin_user')) ? '' : 'hide'}}">
					<a href="{{ url('/mobile/resume') }}">
						<div class="iconfont icon-ic_assignment_ind home_con_event"></div>
						<p class="home_con_p">简历管理</p>
					</a>
				</div>
			</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>