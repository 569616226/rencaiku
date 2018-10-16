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
	<link rel="stylesheet" href="{{ url('/css/uiAlertView-1.0.0.css') }}" />
	<link rel="stylesheet" href="{{ url('/css/animate.css') }}" />
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body style="background: #F0F0F2;">
<div class="container">
		<div class="myjob_index">
			<div class="home_con_center">
				<a class="btn_show_oldnotice" href="{{ url( '/mobile/notice/agree' ) }}">隐藏已完成待办<i class="iconfont icon_btn_show_oldnotice_top"></i></a>
			</div>
			<div id="main" class="wrap_inner">
				<div class="address_list">
					<!-- 模板数据 -->
					<div id="more">
						<div class="single_item info">
						</div>
						<a href="javascript:;" class="get_more"> </a>
					</div>
				</div>
			</div>

			{{--<div class="myjob_time_div row btn_check">--}}
				{{--<div class="col-xs-1 myjob_checkbox">--}}
					{{--<div class="clickable">--}}
						{{--<span class="CheckState CheckState_check" data-id="1">--}}
							{{--<svg width="13" height="8" viewBox="0 0 13 8"><path d="M1 4.5L4.5 8l8-8"></path></svg>--}}
						{{--</span>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="col-xs-11 full_content">--}}
					{{--<p><b>蒋勇</b> 的试用期将于 2018-01-05 结束，请及时办理转正手续！</p>--}}
				{{--</div>--}}
			{{--</div>--}}

		</div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
<script src="{{ url('js/jquery.more.js?v=1') }}"></script>
<script type="text/javascript" src="{{ url('js/mobiscroll.2.13.2.min.js') }}" ></script>
<script src="{{ url('js/uiAlertView/jquery.uiAlertView-1.0.0.js') }}"></script>
<script>
	$(function(){
		var url = '{{ url('/mobile/notice/history/history_agree_all') }}';
		$('#more').more({
			'address': url
		});
		$("body").on("click",".btn_check",function(){
			$.alertView("该待办已经完成！");
		})
	})
</script>
</body>
</html>