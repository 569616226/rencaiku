<div class="personal_section">
	<div class="personal_key active" data-index="1">
		<i class="icon-account-box iconfont"></i>
		<span>个人信息</span>
	</div>
	<div class="personal_key" data-index="2">
		<i class="icon-clipboard-text iconfont"></i>
		<span>档案信息</span>
	</div>
	<div class="personal_key {{ $archive->salaries ? '' : 'hide' }}" data-index="3">
		<i class="icon-credit-card iconfont"></i>
		<span>薪资信息</span>
	</div>

	<div class="personal_key" data-index="4">
		<i class="icon-cloud-download iconfont"></i>
		<span>附件</span>
	</div>
	<div class="personal_key {{ $archive->salaries ? '' : 'hide' }}" data-index="5">
		<i class="icon-book-open iconfont"></i>
		<span>档案记录</span>
	</div>
</div>