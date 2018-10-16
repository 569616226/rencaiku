@extends('layouts.app')
<!--中间内容区域-->
@section('content')
<div class="container container-responsive">
	 <div class="row">
	 	<div class="ToDotitle">
	 		<a href="{{ url('archive') }}"><i class="iconfont">&#xe63f;</i></a>
	 		<span>待办提醒</span>
	 	</div>
	 	<div class="ToDocontent">
	 		@include('_parties.archive_notice_menu')
	 		<div class="padding">
	 			<div class="afterboottom3 padding-bottom padding-top">
	 				<div class="pull-left margin-right" style="display: inline-block;"><b>员工生日：</b></div>
	 				<div style="display: inline-block;">
						@foreach($archives['archive_quarters'] as $archive_quarter)
						<p><b>{{ $archive_quarter->name }} </b>（{{ $archive_quarter->birthday->month }}月{{ $archive_quarter->birthday->day }}日）</p>
						@endforeach
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