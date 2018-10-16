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
	 				<div class="pull-left margin-right" style="display: inline-block;"><b>员工亲属生日：</b></div>
	 				<div style="display: inline-block;">
						@foreach($archives['families'] as $family)

							<p>{{ $family->name }} :{{ $family->birthday->month }}月{{ $family->birthday->day }}日,{{$family->birthday_type ? '阳历' : '阴历'}}({{ $family->archive->name }} -
								@if($family->relation == 1)
									父亲)
								@elseif($family->relation == 2)
									母亲)
								@elseif($family->relation == 3)
									儿子)
								@elseif($family->relation == 4)
									女儿)
								@elseif($family->relation == 5)
									夫妻)
								@endif
							</p>
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