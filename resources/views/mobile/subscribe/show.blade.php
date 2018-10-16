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
	<!-- 本例主要代码 Start ================================ -->
	<div id="leftTabBox" class="tabBox">
		<div class="hd">
			<ul class=" ">
				<li>
					<a href="javascript:void(0);">预约信息</a>
				</li>
				<li>
					<a href="javascript:void(0);">简历信息</a>
				</li>
			</ul>
		</div>
		<div class="bd margin-top">
			<ul class="wap_bd_ul">
				@if($subscribe->result == 2)
					<img src="{{ url('img/success.png') }}" class="wap_suer" />
				@elseif($subscribe->result == 1)
					<img src="{{ url('img/fail.png') }}" class="wap_suer" />
				@endif
				<table class="table table-4-6">
					<tbody>
					<tr>
						<td class="tdleft" style="padding-top: 14px !important;">人员增补单：</td>
						<td class="tdright" style="padding-top: 14px !important;"><span class="status-span-5">{{ $subscribe->examines->apply_name }}的人员增补单</span></td>
					</tr>
					<tr>
						<td class="tdleft">预约状态：</td>

						@if($subscribe->status === 1)
							<td class="tdright"><span class="status-span-1-1">未开始</span></td>
						@elseif($subscribe->status === 2)
							<td class="tdright"><span class="status-span-2-2">进行中</span></td>
						@elseif($subscribe->status === 3)
							<td class="tdright"><span class="status-span-3-3">已完成</span></td>
						@elseif($subscribe->status === 4)
							<td class="tdright"><span class="status-span-4-4">已关闭</span></td>
						@endif

					</tr>
					<tr>
						<td class="tdleft">面试职位：</td>
						<td class="tdright">{{ $subscribe->examines->position }}</td>
					</tr>
					<tr>
						<td class="tdleft">面试时间：</td>
						<td class="tdright"><time>{{ $subscribe->offer_date->toDateTimeString() }}</time></td>
					</tr>
					<tr>
						<td class="tdleft">面试地点：</td>
						<td class="tdright">{{ $subscribe->address }}</td>
					</tr>
					<tr>
						<td class="tdleft">求职者：</td>
						<td class="tdright"><span class="status-span-5">{{  $resume->name }}</span></td>
					</tr>
					<tr>
						<td class="tdleft">简历来源：</td>
						<td class="tdright">
							@if( $resume->origin_id == 0)
								智通
							@elseif( $resume->origin_id == 1)
								卓博
							@elseif( $resume->origin_id == 2)
								内部推荐
							@else
								人才市场
							@endif
						</td>
					</tr>
					<tr>
						<td class="tdleft">备注：</td>
						<td class="tdright">{{ $subscribe->remark }}</td>
					</tr>

					@if($subscribe->status === 4)
					<tr>
						<td class="tdleft">关闭原因：</td>
						<td class="tdright">{{ $subscribe->remark_destroy }}</td>
					</tr>
					@endif

					<tr>
						<td class="tdleft">审核人：</td>
						<td class="tdright">
							<div class="approver">
								@foreach( $users as $user)
									<div class="approver_o">
										<img src=" {{$user->avatar }}" class="img-responsive" />
										<p>{{ $user->name }}</p>
									</div>

									@if(!$loop->last)
										<div class="approver_di">···</div>
									@endif
								@endforeach
							</div>
						</td>
					</tr>
					<tr>
						<td class="tdleft">面试官：</td>
						<td class="tdright">
							<div class="approver">
								<div class="approver_o">
									<img src=" {{$user_last->avatar }}" class="img-responsive" />
									<p>{{ $user_last->name }}</p>
								</div>
							</div>
						</td>
					</tr>
					</tbody>
				</table>
				<div class="wap_basic">
						<div class="wap_basic_top_2">
							<span class="wap_basic_top_p">面试评价</span>
						</div>
						<div class="wap_basic_bottom">
							<div class="widget_little3" id="pjcontent">
								@if(!$subscribe->appraises->isEmpty())
								<!--<p class="widget_hr_p0">面试评价</p>-->
									@foreach( $subscribe->appraises as $appraise)
										<div class="widget_hr_discuss">
											<div class="widget_hr_discuss_img">
												<img src="{{ $appraise->users()->withTrashed()->first()->avatar }}" class="img-responsive" />
											</div>
											<div class="widget_hr_discuss_p1">
												<p class="pd">{{ $appraise->users()->withTrashed()->first()->name }} ·
													@if($appraise->status == 1)
														<span class="iconfont success">同意</span>
													@else
														<span class="iconfont error">不合适</span>
													@endif
												</p>

												<p class="pf">
													@foreach($users as $user)
														@if($appraise->users()->withTrashed()->first()->id === $user->id)
															@if($user->pivot->index === 1)
																第一审核人
															@elseif($user->pivot->index === 2)
																第二审核人
															@elseif($user->pivot->index === 3)
																第三审核人
															@elseif($user->pivot->index === 4)
																第四审核人
															@elseif($user->pivot->index === 5)
																第五审核人
															@endif
														@endif
													@endforeach

													@if($appraise->users()->withTrashed()->first()->last == 1)
														面试官
													@endif
												</p>
											</div>

											<div class="widget_hr_discuss_time">
												<p>{{ $appraise->created_at->toDateTimeString() }}</p>
											</div>
										</div>
										<div class="widget_hr_discuss_ding">
											{{ $appraise->content }}
										</div>
										

										@if(!$loop->last)
											<div class="wap_solid"></div>
										@endif
									@endforeach
								@endif
							</div>
						</div>
					</div>
			</ul>

			<ul id="page2" style="display: none">
				<div class="wap_main">
					<div class="wap_basic" style="margin-top: 0;">
						
						<div class="wap_basic_top">
							<span class="wap_basic_top_p">基础信息</span><!--<i class="iconfont icon-up"></i>-->
						</div>
						<div class="wap_basic_cneter">
							<div class="wap_basic_img">
								<img src="{{ $resume->sex === '男' ? url('img/boy.png') : url('img/girl.png') }}" class="img-responsive" />
							</div>
							<div class="wap_basic_li">
								<p>{{ $resume->name }}<i class="iconfont icon-{{  $resume->sex === '男' ? 'boy' : 'girl' }}"></i></p>
								<p class="wap_p1">简历编号：{{ $resume->origin_no }}</p>
								<p class="wap_p2"> {{ $resume->sex }}丨{{ $resume->age }}丨 {{ $resume->height }}丨{{ $resume->marriage }}丨 {{ $resume->work_experience }}</p>
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
										@if( $resume->origin_id == 0)
											智通
										@elseif( $resume->origin_id == 1)
											卓博
										@elseif( $resume->origin_id == 2)
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
									<p>	{{ $resume->area }}</p>
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

						{!!  html_entity_decode(stripslashes( $resume->wrok_experiences)) !!}
					</div>
					<div class="wap_basic">
						<div class="wap_basic_top">
							<span class="wap_basic_top_p">教育经历</span><!--<i class="iconfont icon-up"></i>-->
						</div>

						{!!  html_entity_decode(stripslashes( $resume->evaluations)) !!}
					</div>
					<div class="wap_basic">
						<div class="wap_basic_top">
							<span class="wap_basic_top_p">语言能力</span><!--<i class="iconfont icon-up"></i>-->
						</div>

						{!!  html_entity_decode(stripslashes( $resume->lang)) !!}
					</div>
					
				</div>
			</ul>
		</div>
	</div>
	@if($is_appraise)
	<footer class="wap-pj-footer">
		<span>请对面试结果作评价！！！</span>
		<a href="{{ url('/mobile/appraise/'.$subscribe->id) }}" class="go-pj">面试评价</a>
	</footer>
	@endif
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="{{ url('js/jquery.more.js?v=1') }}"></script>
	<script type="text/javascript" src="{{ url('js/mobiscroll.2.13.2.min.js') }}" ></script>
	<script type="text/javascript" src="{{ url('js/TouchSlide/TouchSlide.js') }}" ></script>
	<script type="text/javascript">
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
        TouchSlide(
            {
                slideCell: "#leftTabBox" ,
                //滑动开始执行的动作
                startFun:function(i,c){
                    //返回到顶部
                    $(window).scrollTop(0);
                    if(i == 1){
                        $("#page2").show()
					}
                    if(i == 0){
                        $("#page2").hide()
                    }
                },
                //滑动结束后执行的动作
                endFun:function(i,c){
                    if(i == 0){
                        $(".wap-pj-footer").show();
                    }else {
                        $(".wap-pj-footer").hide();
                    }
                }
            }
        );
	</script>
</body>

</html>