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

	<body>
		<div class="wap_main">
			<div class="wap_basic">
				<!--<img src="img/success.png" class="wap_suer" />-->
				<div class="wap_basic_top">
					<span class="wap_basic_top_p">基础信息</span><!--<i class="iconfont icon-up"></i>-->
				</div>
				<div class="wap_basic_cneter">
					<div class="wap_basic_img">
						<img src="{{ $resume->sex === '男' ? url('img/boy.png') : url('img/girl.png') }}" class="img-responsive" />
					</div>
					<div class="wap_basic_li">
						<p>{{ $resume->name }}<i class="iconfont icon-{{ $resume->sex === '男' ? 'boy' : 'girl' }}"></i></p>
						<p class="wap_p1">简历编号：{{ $resume->local_no }}</p>
						<p class="wap_p2">{{ $resume->sex }} 丨 {{ $resume->age }}丨{{ $resume->height }} 丨 {{ $resume->marriage }} 丨 {{ $resume->work_experience }} </p>
					</div>
				</div>
				<div class="wap_basic_bottom">
					<div class="row">
						<div class="wap_col_xs_4">
							<p>手机号码：</p>
						</div>
						<div class="wap_col_xs_8">
							<p>{{ $resume->tel }}</p>
						</div>
					</div>
					<div class="row">
						<div class="wap_col_xs_4">
							<p>电子邮箱：</p>
						</div>
						<div class="wap_col_xs_8">
							<p>{{ $resume->email }}</p>
						</div>
					</div>
					<div class="row">
						<div class="wap_col_xs_4">
							<p>户籍：</p>
						</div>
						<div class="wap_col_xs_8">
							<p>{{ $resume->origin_aderss }}</p>
						</div>
					</div>
					<div class="row">
						<div class="wap_col_xs_4">
							<p>现居住地：</p>
						</div>
						<div class="wap_col_xs_8">
							<p>{{ $resume->aderss }}</p>
						</div>
					</div>
					<div class="row">
						<div class="wap_col_xs_4">
							<p>最高学历：</p>
						</div>
						<div class="wap_col_xs_8">
							<p>{{ $resume->education }}</p>
						</div>
					</div>
					<div class="row">
						<div class="wap_col_xs_4">
							<p>简历来源：</p>
						</div>
						<div class="wap_col_xs_8">
							<p>
								@if($resume->origin_id == 0)
									智通
								@elseif($resume->origin_id == 1)
									卓博
								@elseif($resume->origin_id == 2)
									内部推荐
								@else
									人才市场
								@endif
							</p>
						</div>
					</div>
					<div class="row">
						<div class="wap_col_xs_4">
							<p>来源编号：</p>
						</div>
						<div class="wap_col_xs_8">
							<p>{{ $resume->origin_no }}</p>
						</div>
					</div>
					<div class="row">
						<div class="wap_col_xs_4">
							<p>简历备注：</p>
						</div>
						<div class="wap_col_xs_8">
							<p>{{ $resume->remark }}</p>
						</div>
					</div>
					<div class="row">
						<div class="wap_col_xs_4">
							<p>自我评价：</p>
						</div>
						<div class="wap_col_xs_8">
							<p class="wap_pli">
						        {{ $resume->evaluation }}
						    </p>
							<span class="wap_col_xs_span">查看更多</span>
						</div>
					</div>
				</div>
			</div>
			<div class="wap_basic">
				<div class="wap_basic_top">
					<span class="wap_basic_top_p">求职意向</span><!--<i class="iconfont icon-up"></i>-->
				</div>
				<div class="wap_basic_bottom">
					<div class="row">
						<div class="wap_col_xs_4">
							<p>意向职位：</p>
						</div>
						<div class="wap_col_xs_8">
							<p>{{ $resume->position }}</p>
						</div>
					</div>
					<div class="row">
						<div class="wap_col_xs_4">
							<p>意向地区：</p>
						</div>
						<div class="wap_col_xs_8">
							<p>{{ $resume->area }}</p>
						</div>
					</div>
					<div class="row">
						<div class="wap_col_xs_4">
							<p>期望月薪：</p>
						</div>
						<div class="wap_col_xs_8">
							<p>{{ $resume->salary }}</p>
						</div>
					</div>
					<div class="row">
						<div class="wap_col_xs_4">
							<p>最快到岗：</p>
						</div>
						<div class="wap_col_xs_8">
							<p>{{ $resume->fastest_date }}</p>
						</div>
					</div>
				</div>
			</div>
			<div class="wap_basic">
				<div class="wap_basic_top">
					<span class="wap_basic_top_p">工作经历</span><!--<i class="iconfont icon-up"></i>-->
				</div>
				{!!  html_entity_decode(stripslashes($resume->wrok_experiences)) !!}
			</div>
			<div class="wap_basic">
				<div class="wap_basic_top">
					<span class="wap_basic_top_p">教育经历</span><!--<i class="iconfont icon-up"></i>-->
				</div>
				{!!  html_entity_decode(stripslashes($resume->evaluations)) !!}
			</div>
			<div class="wap_basic">
				<div class="wap_basic_top">
					<span class="wap_basic_top_p">语言能力</span><!--<i class="iconfont icon-up"></i>-->
				</div>
				{!!  html_entity_decode(stripslashes($resume->lang)) !!}
			</div>
			
			<div class="wap_basic">
				<div class="wap_basic_top">
					<span class="wap_basic_top_p">所有面试预约</span><!--<i class="iconfont icon-up"></i>-->
				</div>
				@if(!$resume->subscribes()->get()->isEmpty())
				@foreach($resume->subscribes as $subscribe)
				<a href="{{ url('/subscribe/'.$subscribe->id.'/show') }}">
					<div class="wap_basic_bottom">
						<div class="row">
							<div class="wap_col_xs_4">
								<p class="wap_header_p">面试职位：</p>
							</div>
							<div class="wap_col_xs_8">
								<p class="wap_header_p">{{ $subscribe->examines->position }}</p>
							</div>
						</div>
						<div class="row">
							<div class="wap_col_xs_3">
								<p>状态：</p>
							</div>
							<div class="wap_col_xs_9">
								@if($subscribe->status == 1)
									<span class="wap_ba_status1">未开始</span>
								@elseif($subscribe->status == 2)
									<span class="wap_ba_status2">进行中</span>
								@elseif($subscribe->status == 3)
									<span class="wap_ba_status3">已完成</span>
								@else
									<span class="wap_ba_status4">已取消</span>
								@endif
							</div>
						</div>
						<div class="row">
							<div class="wap_col_xs_3">
								<p>时间：</p>
							</div>
							<div class="wap_col_xs_9">
								<p>{{ $subscribe->offer_date->toDateTimeString() }}</p>
							</div>
						</div>
						<div class="row">
							<div class="wap_col_xs_3">
								<p>地点：</p>
							</div>
							<div class="wap_col_xs_9">
								<p>{{ $subscribe->address }}</p>
							</div>
						</div>
						{{--<div class="row">--}}
							{{--<div class="wap_col_xs_3">--}}
								{{--<p>备注：</p>--}}
							{{--</div>--}}
							{{--<div class="wap_col_xs_9">--}}
								{{--<p>{{ $subscribe->remark }}</p>--}}
							{{--</div>--}}
						{{--</div>--}}
					</div>
					<div class="wap_basic_top">
						<span class="wap_basic_top_p">详情</span><i class="iconfont icon-up-tran"></i>
					</div>
				</a>
				<div class="wap_geli"></div>
				@endforeach
				@endif
			</div>

		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script>
			$(function() {
				$('.wap_col_xs_span').on('click', function() {
					if($(this).text() == '查看更多') {
						$('.wap_pli').css("height", "auto");
						$(this).html('收起');
					} else {
						$('.wap_pli').css("height", "54px");
						$(this).html('查看更多');
					}
				})
			})
		</script>
	</body>

</html>