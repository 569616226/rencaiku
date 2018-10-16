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
		<link rel="stylesheet" href="{{ url('css/show.css') }}">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>
	<body>
		<div class="container main">
			<div class="nav_li2">
				<div class="header">
					<div class="row m0">
						<div class="col-md-2">
							<div class="header_img">
								<img src="{{ $resume->sex === '男' ? url('img/boy.png') : url('img/girl.png') }}" class="img-responsive" />
							</div>
						</div>
						<div class="col-md-6">
							<p class="hr_head_p1">{{ $resume->name }}<i class="iconfont icon-{{ $resume->sex === '男' ? 'boy' : 'girl' }}"></i></p>
							<p class="hr_head_p2">简历来源：
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
							<p class="hr_head_p2">来源编号：{{ $resume->origin_no }}</p>
							<p class="hr_head_p2"><span class="hr_head_p2_span1">简历备注：</span><span class="hr_head_p2_span2">{{ $resume->remark }}</span></p>
						</div>
						<div class="col-md-4 hr_right">
							<p class="hr_head_p3 m1">ID：{{ $resume->local_no }}</p>
							<p class="hr_head_p2 m1">联系电话：{{ $resume->tel }}</p>
							<p class="hr_head_p2 m1">电子邮箱：{{ $resume->email }}</p>
						</div>
					</div>
				</div>
				<div class="widget">
					<div class="widget_little">
						<h3 class="widget_h3">基本信息</h3>
						<div class="row m0">
							<div class="col-md-6">
								<div class="widget_hr_1">
									<div class="widget_hr_2">
										年龄：
									</div>
									<div class="widget_hr_3">
										{{ $resume->age }}
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="widget_hr_1">
									<div class="widget_hr_2">
										身高：
									</div>
									<div class="widget_hr_3">
										{{ $resume->height }}
									</div>
								</div>
							</div>
						</div>
						<div class="row m0">
							<div class="col-md-6">
								<div class="widget_hr_1">
									<div class="widget_hr_2">
										现居住地：
									</div>
									<div class="widget_hr_3">
										{{ $resume->aderss }}
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="widget_hr_1">
									<div class="widget_hr_2">
										户籍：
									</div>
									<div class="widget_hr_3">
										{{ $resume->origin_aderss }}
									</div>
								</div>
							</div>
						</div>
						<div class="row m0">
							<div class="col-md-6">
								<div class="widget_hr_1">
									<div class="widget_hr_2">
										婚姻状况：
									</div>
									<div class="widget_hr_3">
										{{ $resume->marriage }}
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="widget_hr_1">
									<div class="widget_hr_2">
										最高学历：
									</div>
									<div class="widget_hr_3">
										{{ $resume->education }}
									</div>
								</div>
							</div>
						</div>
						<div class="row m0">
							<div class="col-md-12">
								<div class="widget_hr_1">
									<div class="widget_hr_4">
										自我评价：
									</div>
									<div class="widget_hr_5">
										{{ $resume->evaluation }}
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="widget_little2">
						<h3 class="widget_h3">求职意向</h3>
						<div class="row m0">
							<div class="col-md-6">
								<div class="widget_hr_1">
									<div class="widget_hr_2">
										意向职位：
									</div>
									<div class="widget_hr_3">
										{{ $resume->position }}
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="widget_hr_1">
									<div class="widget_hr_2">
										意向地区：
									</div>
									<div class="widget_hr_3">
										{{ $resume->area }}
									</div>
								</div>
							</div>
						</div>
						<div class="row m0">
							<div class="col-md-6">
								<div class="widget_hr_1">
									<div class="widget_hr_2">
										期望月薪：
									</div>
									<div class="widget_hr_3">
										{{ $resume->salary }}
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="widget_hr_1">
									<div class="widget_hr_2">
										最快到岗：
									</div>
									<div class="widget_hr_3">
										{{ $resume->fastest_date }}
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="widget_little">
						<h3 class="widget_h3">工作经历</h3>
						{!!  html_entity_decode(stripslashes(str_replace('▌','公司名称：',$resume->wrok_experiences))) !!}

					</div>
					<div class="widget_little2">
						<h3 class="widget_h3">教育经历</h3>
						{!!  html_entity_decode(stripslashes( $resume->evaluations)) !!}
					</div>
					<div class="widget_little">
						<h3 class="widget_h3">语言能力</h3>
						{!!  html_entity_decode(stripslashes( $resume->lang)) !!}
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
				                <th>面试职位</th>
				                <th>面试时间</th>
				                <th>状态</th>
				                <th>面试结果</th>
				                <th>地点</th>
				                <th>操作</th>
			                </tr>
		                </thead>
		                <tbody>
						@if(!$resume->subscribes()->get()->isEmpty())
						@foreach($resume->subscribes as $subscribe)
			                <tr>
				                <td><span class="history_zhiwei">{{ $subscribe->examines->position }}</span></td>
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
					{{ $resume->name }} 个人简历
				</div>
				<div class="footer_button">
					{{--<a href="javascript:window.history.go(-1);">返回</a>--}}
					<a href="javascript:window.close();">关闭</a>
				</div>
			</div>
		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script>
			$(function() {
				$(".revise_cha").click(function() {
					$('html, body').animate({
						scrollTop: $(".comment").offset().top
					}, 500);
				});
			})
		</script>
	</body>

</html>