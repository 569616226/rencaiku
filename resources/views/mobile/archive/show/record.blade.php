<div class="wap_main">
    <div class="wap_basic_per">
		@if($archive->salaries)
			@foreach( $archive->archive_logs()->latest()->get() as $archive_log)
			<div class="row">
				<div class="record_row_1 blue">
					<span class="record_xs">{{ $archive_log->type }}</span>
				</div>
				<div class="record_row_11">
					<div class="wap_basic_bottom wap_padding iconfont">
						<p class="record_p1">
							{{ $archive_log->content }}
						</p>
						<p class="record_time">
							{{ $archive_log->created_at->toDateTimeString() }}
						</p>
					</div>
				</div>
			</div>
			@endforeach
		@endif
    </div>
    <div style="height: 6rem;"></div>
</div>