@extends('layouts.app')
<!--中间内容区域-->
@section('content')
<div class="container container-responsive">
	<div class="row states-info">
		<div class="col-md-3">
			<a href="{{ url('examine?root=2') }}">
				<div class="panel rblue-bg">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-8">
								<span class="state-title">进行中人员增补单</span>
								<h2>{{ $examin_ings }}</h2>
							</div>
							<div class="col-xs-4">
								<i class="iconfont">&#xe62e;</i>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-md-3">
			<a href="{{ url('subscribe?root=1') }}">
				<div class="panel blue-bg">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-8">
								<span class="state-title">未开始面试预约</span>
								<h2>{{ $subscribes }}</h2>
							</div>
							 <div class="col-xs-4">
								<i class="iconfont">&#xe62d;</i>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-md-3">
			<a href="{{ url('resume') }}">
				<div class="panel green-bg">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-8">
								<span class="state-title">人才库</span>
								<h2>{{ $resumes }}</h2>
							</div>
							  <div class="col-xs-4">
								<i class="iconfont">&#xe62f;</i>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-md-3">
			<a href="{{ url('examine?root=3') }}">
				<div class="panel orange-bg">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-8">
								<span class="state-title">已完成人员增补单</span>
								<h2>{{ $examin_complates }}</h2>
							</div>
							<div class="col-xs-4">
								<i class="iconfont">&#xe630;</i>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>


	<div class="row img-info">
		<div class="col-xs-12">
			{{-- <img src="{{ url('img/index.png') }}" alt="" />
			<h4 class="margin-top-lg">欢迎使用东华人力资源管理系统</h4> --}}
			<div class="home-wait">
				<p class="home-wait-title afterboottom3">
					<i class="iconfont">&#xe65e;</i>
					<span> 待办提醒</span>
				</p>
				<div class="cl-box">
					<div class="cl-row">
						<div class="cl-td">
							<p class="num">{{ $archives['archive_full_counts'] }}</p>
							<p class="numtip">7天内待转正员工</p>
						</div>
						<div class="cl-td">
							{{ $archives['archive_full_names'] }}
						</div>
						<div class="cl-td">
							<a class="btn btn-default" href="{{ url('archive/full') }}">查看更多</a>
						</div>
					</div>
				</div>
				<div class="cl-box">
					<div class="cl-row">
						<div class="cl-td">
							<p class="num">{{ $archives['archive_agree_counts'] }}</p>
							<p class="numtip">7天内合同续签员工</p>
						</div>
						<div class="cl-td">
							{{ $archives['archive_agree_names'] }}
						</div>
						<div class="cl-td">
							<a class="btn btn-default" href="{{ url('archive/agree') }}">查看更多</a>
						</div>
					</div>
				</div>
				<div class="cl-box">
					<div class="cl-row">
						<div class="cl-td">
							<p class="num">{{ $archives['archive_year_counts'] }}</p>
							<p class="numtip">7天内员工周年提醒</p>
						</div>
						<div class="cl-td">
							{{ $archives['archive_year_names'] }}
						</div>
						<div class="cl-td">
							<a class="btn btn-default" href="{{ url('archive/year') }}">查看更多</a>
						</div>
					</div>
				</div>
				<div class="cl-box">
					<div class="cl-row">
						<div class="cl-td">
							<p class="num">{{ $archives['archive_quarter_counts'] }}</p>
							<p class="numtip">本季度员工生日</p>
						</div>
						<div class="cl-td">
							<div class="cl-child-row">
								<div class="cl-child-td">{{ $archives['archive_quarter_names'] }}</div>
							</div>
						</div>
						<div class="cl-td">
							<a class="btn btn-default" href="{{ url('archive/birthday') }}">查看更多</a>
						</div>
					</div>
				</div>
				<div class="cl-box">
					<div class="cl-row">
						<div class="cl-td">
							<p class="num"> {{ $archives['familie_counts']}} </p>
							<p class="numtip">本周亲属生日</p>
						</div>
						<div class="cl-td">

							<div class="cl-child-row">
								<div class="cl-child-td"> {{$archives['familie_count_names'] }}</div>
							</div>
						</div>
						<div class="cl-td">
							<a class="btn btn-default" href="{{ url('archive/family_birthday') }}">查看更多</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('javascript')
	@parent
	<script>
		require(['bootstrap']);
	</script>
@endsection