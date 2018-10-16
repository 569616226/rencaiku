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
@include('_parties.mobile_notice_menu')
<div class="container">
	@if($archives['archive_agree_counts'])
		<div class="myjob_index">
			@foreach($archives['archive_agrees'] as $archive_agree)
				@if(!$archive_agree->status)
					<div class="myjob_time_div row">
						<div class="col-xs-1 myjob_checkbox">
							<div class="clickable">
								<span class="CheckState btn_check" data-id="{{ $archive_agree->id }}">
									<svg width="13" height="8" viewBox="0 0 13 8"><path d="M1 4.5L4.5 8l8-8"></path></svg>
								</span>
							</div>
						</div>
						<div class="col-xs-11 full_content">
							<p><b>{{ $archive_agree->name }}</b> {{ $archive_agree->content }}</p>
						</div>
					</div>
				@endif
			@endforeach
			<a class="btn_show_oldnotice_ol" href="{{ url( '/mobile/notice/history/agree' ) }}">查看已完成待办</a>
		</div>
	@else
		<div class="text-center">
			<img style="max-width: 80%" src="{{ url('img/raw_1501664235.png') }}" alt="">
			<p>当前没有要完成的待办！</p>
			<a class="btn_show_oldnotice" href="{{ url( '/mobile/notice/history/agree' ) }}">查看已完成待办<i class="iconfont icon_btn_show_oldnotice"></i></a>
		</div>
	@endif
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
		$(".btn_check").on('click',function(){
			let json = {
				msg: "真的要确定完成吗？",
				buttons:[
					{ title:"取消",color:"rgb(0, 118, 255)",click:function(val, content, dom){
						dom.removeClass('CheckState_check');
					}},
					{ title:"确定",color:"rgb(0, 118, 255)",click:function(val, content, dom){
						let id = dom.attr("data-id");
					    $.ajax({
					        url:"/mobile/notice/"+id+"/complate",
					        type: "get",
					        // data: postData,
					        dataType: "json",
					        headers: {
					            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					        },
					        async: true,
					        success: function (data) {
					            $("#agree").text(data.count)
								dom.parents('.myjob_time_div').addClass('zoomOutLeft animated').hide(1000, () => {
									dom.parents('.myjob_time_div').remove()
								});
					        },
					        error: function (data) {
					            console.log(data);
					            console.log('跳入了error');
					        }
					    });
					}}
				],
				dom: $(this)
			}
			$(this).addClass('CheckState_check');
			$.alertView(json);
		})
	})
</script>
</body>
</html>