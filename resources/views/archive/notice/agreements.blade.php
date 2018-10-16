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
				@foreach($archives['archive_agrees'] as $archive_agree)
					<div class="afterboottom3 padding-bottom padding-top">
						<b>{{ $archive_agree->name }} </b>{{ $archive_agree->content }}
						<a href="javascript:void(0);" id="fansh" name="{{ $archive_agree->id }}" class="btn btn-default pull-right  {{ $archive_agree->status ? '' : 'fansh' }}" style="position: relative;top: -6px;">√ {{ $archive_agree->status ? '已完成' : '完成' }}</a>
					</div>
				@endforeach
	 		</div>
	 	</div>
 	 </div>
</div>

@endsection

@section('javascript')
	@parent
	<script>
		require(['bootstrap','layer','server'],function (bootstrap,layer,server){
			$(".fansh").click(function(){
				var id = $(this).attr('name')
				server.fansh_msg(id,function(data){
					if(data.status){
						layer.msg(data.msg);
						setTimeout(function(){
							window.location.reload();
						},2000);
					}
				})
			})
			 
		});
	</script>
@endsection