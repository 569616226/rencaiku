@foreach($archive->archive_logs()->latest()->get() as $archive_log)

	<div class="wap_basic_bottom wap_padding iconfont">
		<div class="row">
			<div class="wap_col_xs_4">
				<p>
					{{ $archive_log->type }}：
				</p>
			</div>
			<div class="wap_col_xs_8">
				<p>
					{{ $archive_log->content }}
				</p>
			</div>
			<div class="wap_col_xs_2">
				<p>
					{{ $archive_log->created_at->toDateTimeString() }}
				</p>
			</div>
		</div>
	</div>
@endforeach

