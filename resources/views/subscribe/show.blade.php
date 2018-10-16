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
			<div class="tab">
				<ul class="nav nav-tabs">
					<li class="active" data-index='1'>预约信息</li>
					<li data-index='2'>{{ $subscribe->resumes->name }}-简历</li>
				</ul>
			</div>
			<div class="nav_li1">
				<div class="header">
					<span>面试预约详情</span>
				</div>
				<div class="widget">
					<div class="widget_little">
						<div class="row">
							@if($subscribe->result == 2)
								<img src="{{ url('img/success.png') }}" class="img-responsive icon_hr" />
							@elseif($subscribe->result == 1)
								<img src="{{ url('img/fail.png') }}" class="img-responsive icon_hr" />
							@else

							@endif
							<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
								<p class="widget_p1">人员增补申请单：</p>
							</div>

							<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
								<span class="sub_p">{{ $subscribe->examines->apply_name }}的人员增补申请单</span>
								<a target="_blank" href="{{ url('examine/'.$subscribe->examines->id.'/show') }}" class="sub_a">查看</a>
							</div>
						</div>
						<div class="row">

							<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
								<p class="widget_p1">预约状态：</p>
							</div>
							<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
								@if($subscribe->status === 1)
									<span class="widget_state_k m0">未开始</span>
								@elseif($subscribe->status === 2)
									<span class="widget_state_i m0">进行中</span>
								@elseif($subscribe->status === 3)
									<span class="widget_state_s m0">已完成</span>
								@elseif($subscribe->status === 4)
									<span class="widget_state_q m0">已关闭</span>
								@endif
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
								<p class="widget_p1">面试职位：</p>
							</div>
							<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
								<p>{{ $subscribe->examines->position }}</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
								<p class="widget_p1">面试时间：</p>
							</div>
							<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
								<p>{{ $subscribe->offer_date->toDateTimeString() }}</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
								<p class="widget_p1">面试地点：</p>
							</div>
							<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
								<p>{{ $subscribe->address }}</p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
								<p class="widget_p1">求职者：</p>
							</div>
							<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
								<a href="javascript:void(0);" onclick="job_hunter()">{{ $subscribe->resumes->name }}</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
								<p class="widget_p1">简历来源：</p>
							</div>
							<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
								<p>@if($subscribe->resumes->origin_id == 0)
										智通
									@elseif($subscribe->resumes->origin_id == 1)
										卓博
									@elseif($subscribe->resumes->origin_id == 2)
										内部推荐
									@else
										人才市场
									@endif
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
								<p class="widget_p1">备注：</p>
							</div>
							<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
								<p>{{ $subscribe->remark }}</p>
							</div>
						</div>
						@if($subscribe->status === 4)
						<div class="row">
							<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
								<p class="widget_p1">关闭原因：</p>
							</div>
							<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
								<p>{{ $subscribe->remark_destroy }}</p>
							</div>
						</div>
						@endif
						<div class="row">
							<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
								<p class="widget_p1">审批人：</p>
							</div>
							<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
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
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
								<p class="widget_p1">面试官：</p>
							</div>
							<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
								<div class="approver listapp">
									<div class="approver_o">
										{{--<input type="hidden"  name="user_id" value="{{ $user_last->id }}" >--}}
										<img src="{{ $user_last->avatar }}" class="img-responsive">
										<p>{{ $user_last->name }}</p>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 col-lg-2 col-xs-4 col-sm-2">
							</div>
							<div class="col-md-10 col-lg-10 col-xs-6 col-sm-10">
								@if($subscribe->status === 1 || $subscribe->status === 2)
								<a href="{{ url('/subscribe/'.$subscribe->id.'/edit') }}" class="revise {{ $subscribe->appraises()->get()->isEmpty() ? '' : 'hide'}}">修改预约</a>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="comment">
					<div class="comment_head">
						<span>面试评价</span>
					</div>
					<div class="widget_little">
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
									<div class="widget_hr_dotted_2"></div>
								@endif
							@endforeach
							@endif
						</div>
					</div>
					@if($is_appraise)
						<div class="widget_little2">
							<p class="widget_hr_p0">面试评价</p>
							<div class="widget_little2_choice">
								<span>面试结果：</span>
								<label class="radio-inline">
									<input type="radio" name="inlineRadioOptions" checked id="inlineRadio1" value="1"> 同意
								</label>
								<label class="radio-inline">
									<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="0"> 不合适
								</label>
							</div>
							<textarea id="content" style="padding:5px 8px;color: #333333;" placeholder="请写下您对求职者的评价"></textarea>
							<a id="submitpj" name="{{ $subscribe->id }}" href="javascript:void(0);" class="revise buttom_revi">提交评价</a>
						</div>
					@endif
				</div>
			</div>

			<div class="nav_li2" style="display: none;">
				<div class="header">
					<div class="row m0">
						<div class="col-md-2">
							<div class="header_img">
								<img src="{{ $subscribe->resumes->sex === '男' ? url('img/boy.png') : url('img/girl.png') }}" class="img-responsive" />
							</div>
						</div>
						<div class="col-md-6">
							<p class="hr_head_p1">{{ $subscribe->resumes->name }}<i class="iconfont icon-{{  $subscribe->resumes->sex === '男' ? 'boy' : 'girl' }}"></i></p>
							<p class="hr_head_p2">简历来源：
								@if($subscribe->resumes->origin_id == 0)
									智通
								@elseif($subscribe->resumes->origin_id == 1)
									卓博
								@elseif($subscribe->resumes->origin_id == 2)
									内部推荐
								@else
									人才市场
								@endif
							</p>
							<p class="hr_head_p2">来源编号：{{ $subscribe->resumes->origin_no }}</p>
							<p class="hr_head_p2"><span class="hr_head_p2_span1">简历备注：</span><span class="hr_head_p2_span2">{{ $subscribe->resumes->remark }}</span></p>
						</div>
						<div class="col-md-4 hr_right">
							<p class="hr_head_p3 m1">ID：{{ $subscribe->resumes->local_no }}</p>
							<p class="hr_head_p2 m1">联系电话：{{ $subscribe->resumes->tel }}</p>
							<p class="hr_head_p2 m1">电子邮箱：{{ $subscribe->resumes->email }}</p>
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
										{{ $subscribe->resumes->age }}
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="widget_hr_1">
									<div class="widget_hr_2">
										身高：
									</div>
									<div class="widget_hr_3">
										{{ $subscribe->resumes->height }}
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
										{{ $subscribe->resumes->aderss }}
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="widget_hr_1">
									<div class="widget_hr_2">
										户籍：
									</div>
									<div class="widget_hr_3">
										{{ $subscribe->resumes->origin_aderss }}
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
										{{ $subscribe->resumes->marriage }}
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="widget_hr_1">
									<div class="widget_hr_2">
										最高学历：
									</div>
									<div class="widget_hr_3">
										{{ $subscribe->resumes->education }}
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
										{{ $subscribe->resumes->evaluation }}
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
										{{ $subscribe->resumes->position }}
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="widget_hr_1">
									<div class="widget_hr_2">
										意向地区：
									</div>
									<div class="widget_hr_3">
										{{ $subscribe->resumes->area }}
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
										{{ $subscribe->resumes->salary }}
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="widget_hr_1">
									<div class="widget_hr_2">
										最快到岗：
									</div>
									<div class="widget_hr_3">
										{{ $subscribe->resumes->fastest_date }}
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="widget_little">
						<h3 class="widget_h3">工作经历</h3>

						{!!  html_entity_decode(stripslashes(str_replace('▌','公司名称：',$subscribe->resumes->wrok_experiences))) !!}

					</div>
					<div class="widget_little2">
						<h3 class="widget_h3">教育经历</h3>

						{!!  html_entity_decode(stripslashes( $subscribe->resumes->evaluations )) !!}

					</div>
					<div class="widget_little">
						<h3 class="widget_h3">语言能力</h3>

						{!!  html_entity_decode(stripslashes( $subscribe->resumes->lang )) !!}
					</div>
				</div>
			</div>
		</div>
		<div class="h60"></div>
		<div class="footer">
			<div class="container">
				<div class="footer_little">
					查看面试预约
				</div>
				<div class="footer_button">
					{{--<a href="javascript:window.history.go(-1);">返回</a>--}}
					{{--<a href="javascript:void(0);" class="revise_cha">查看评论</a>--}}
					<a href="javascript:window.close();">关闭</a>
				</div>
				<div class="footer_button">
					{{--<a href="javascript:window.history.go(-1);">返回</a>--}}
					<a href="javascript:void(0);" class="revise_cha">查看评论</a>
					{{--<a href="javascript:window.close();">关闭</a>--}}
				</div>
			</div>
		</div>
		<div class="fakeloader" style="position: fixed;width: 100%;height: 100%;top: 0px;left: 0px;background-color: rgba(134, 134, 134,0.2);z-index: 999; display: none; ">
			<div class="mop-css-2 wave" style="position: absolute; top: 0;left: 0;right: 0;bottom: 0;margin: auto;">
				<div class="rect1"></div>
				<div class="rect2"></div>
				<div class="rect3"></div>
				<div class="rect4"></div>
				<div class="rect5"></div>
			</div>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="{{ url('js/layer/layer.js') }}" type="text/javascript" charset="utf-8"></script>
		<script src="{{ url('js/main.js') }}" type="text/javascript" charset="utf-8"></script>
		<script>
        	//切换tab
        	$(function(){
        		$('.nav-tabs li').on('click',function(){
        			 $(this).siblings('li').removeClass('active'); 
        			 $(this).addClass('active');   
        			 if($(this).attr('data-index') == '2'){
        			 	$('.nav_li2').fadeIn();
        			 	$('.nav_li1').hide();
        			 	$('.revise_cha').hide();
        			 }else{
        			 	$('.nav_li2').hide();
        			 	$('.nav_li1').fadeIn();
        			 	$('.revise_cha').show();
        			 }
        		})
        	});
        	//点击姓名跳到简历tab
        	function job_hunter(){
			    $('.nav-tabs li:eq(1)').click();
			}
			//滚动到评价
			$(function() {
				$(".revise_cha").click(function() {
					$('html, body').animate({
						scrollTop: $(".comment").offset().top
					}, 500);
				});
			})
        	$("#submitpj").click(function () {
                $('.fakeloader').fadeIn(100);
				var radioval = $("input[name='inlineRadioOptions']:checked").val(); //勾选上的单选框的值
				var content = $("#content").val();
				var subscribe_id = $("#submitpj").attr('name');
				var url = '/appraise';
					AjaxJson(url,{subscribe_id:subscribe_id,status:radioval, content:content},function (data) {
						if(data.status == 1){
                            $('.fakeloader').fadeOut(100);
                            layer.msg(data.msg);
                            setTimeout(function () {
                                window.location.reload();
                            },1000);
						}else {
                            layer.msg(data.msg);
						}
                })
            });
        </script>
	</body>

</html>