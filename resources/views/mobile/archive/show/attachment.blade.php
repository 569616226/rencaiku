<div class="attachment_content">
	<p class="attachment_p1">目前手机端只允许查看图片，其他格式请前往PC端查看</p>
	@foreach($archive->closures as $closure)
	<div class="attachment_flex row">
		<div class="attachment_flex_1 col-xs-2">
			<i class="icon-wenjian1 iconfont attachment_text_icon"></i>
		</div>
		<div class="attachment_flex_1 col-xs-7">
			<p class="attachment_p2">{{ $closure->name }}</p>
			<p class="attachment_time">{{ $closure->uploader }} · {{ $closure->created_at->toDateTimeString() }}</p>
		</div>

		<div class="attachment_flex_1 col-xs-3">
			@if( in_array(strtolower(explode('.',$closure->name)[count(explode('.',$closure->name))-1]), ['png', 'gif', 'jpeg', 'jpg']) )
				<span class="attachment_span attachment_blue" data-file="{{ url('/storage/uploads/'.$closure->path)}}">查看</span>
			@endif
		</div>
	</div>
	@endforeach
</div>
<div style="height: 6rem;"></div>