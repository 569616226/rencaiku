<div class="personal_row row">
	<table class="table">
		<thead>
		<tr>
			<th>文件名</th>
			<th>上传者</th>
			<th>上传时间</th>
			<th>操作</th>
		</tr>
		</thead>
		@if($archive->closures)
			<tbody>
			@foreach($archive->closures as $closure)
				<tr>
					<th>{{ $closure->name }}</th>
					<td>{{ $closure->uploader }}</td>
					<td>{{ $closure->created_at->toDateTimeString() }}</td>
					<td><a href="{{ url('/archive/clsoure/'.$closure->id.'/download') }}" target="_blank" class="btn btn-default personal_a"><i class="iconfont">&#xe74a;</i>下载</a></td>
				</tr>
			@endforeach
			</tbody>
		@endif
	</table>
</div>