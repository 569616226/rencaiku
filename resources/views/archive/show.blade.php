@extends('layouts.app')
<!--中间内容区域-->
@section('content')
    <!--中间内容区域-->
    <div class="archive_show_top">
    	<div class="archive_show_top_left">
			@if($archive->avatar)
    			<img style="width: 100px; height: 100px;" src="{{ $archive->avatar }}" />
			@else
				@if( $archive->sex == 0 )
					<img style="width: 100px; height: 100px;" src="{{ url('/img/boy.png') }}" />
				@elseif($archive->sex == 1)
					<img style="width: 100px; height: 100px;" src="{{ url('/img/girl.png') }}" />
				@endif
			@endif
    	</div>
    	<div class="archive_show_top_left margin-left-lg">
    		<div class="archive_show_top_name">
    			<span class="archive_show_span1">{{ $archive->name }}</span>
    			<span class="archive_show_span2 {{ $archive->sex == 0 ? 'man' : 'woman' }} ">{{ $archive->sex == 0 ? '男' : '女' }}</span>
    			@if($archive->offer_status == 1)
					<span class="archive_show_span_on">在职(已转正)</span>
				@elseif($archive->offer_status == 2)
					<span class="archive_show_span_on_false">在职(试用期)</span>
				@elseif($archive->offer_status == 0)
					<span class="archive_show_span_off_false">离职</span>
				@endif
    		</div>
    		<div class="margin-top-sm">
    			<span class="archive_show_num1">内部编号：</span>
    			<span class="archive_show_num2">{{ $archive->local_no }}</span>
    		</div>
    		<div class="margin-top-sm">
    			<span class="f_s1">
	    			<span class="archive_show_num1">手机号：</span>
	    			<span class="margin-left-sm">{{ $archive->tel }}</span>
    			</span>
    			<span class="margin-left-lg">
	    			<span class="archive_show_num1">邮箱：</span>
	    			<span class="margin-left-sm">{{ $archive->email }}</span>
    			</span>
    		</div>
    	</div>
    	<div class="archive_show_top_right">
    		<div class="margin-top-sm {{ $archive->offer_status == 0 ? 'hide' : '' }}" >
    			<a href="{{ route('archive.edit',[$archive->id]) }}" class="btn btn-primaryxs show_edit">编辑</a>
    		</div>
    		<div class="margin-top-sm">
    			<a href="{{ back()->getTargetUrl() }}" class="btn btn-default show_edit">返回列表</a>
    		</div>
    	</div>
    </div>
    <div class="archive_show_top margin-top-lg">
		<div class="archiveMenu">
			<nav class="navbar navbar-default hr-nav" style="border: none">
				<div class="collapse navbar-collapse" id="navbar-collapse" style="padding: 0;">
					<ul class="nav navbar-nav flex" style="float: none; border-bottom: 1px solid #BBBBBB;">
						<li class="active" data-index="1">
							<a href="javascript:void(0);">
								<span><i class="iconfont">&#xe605;</i>个人信息</span>
							</a>
						</li>
						<li class="" data-index="2">
							<a href="javascript:void(0);">
								<span><i class="iconfont">&#xe6b2;</i>档案信息</span>
							</a>
						</li>
						<li class="{{ $archive->salaries ? '' : 'hide' }}" data-index="3">
							<a href="javascript:void(0); ">
								<span><i class="iconfont">&#xe6d8;</i>薪资信息</span>
							</a>
						</li>
						<li class="" data-index="4">
							<a href="javascript:void(0);">
								<span><i class="iconfont">&#xe6bb;</i>附件</span>
							</a>
						</li>
						<li class="{{ $archive->salaries ? '' : 'hide' }}" data-index="5">
							<a href="javascript:void(0);">
								<span><i class="iconfont">&#xe664;</i>档案记录</span>
							</a>
						</li>
					</ul>
				</div>
				<!--</div>-->
			</nav>
		</div>
		<section class="section_tab" data-tab="1" style="display: block;">
			@include('archive.show.personal')
		</section>
		<section class="section_tab" data-tab="2" style="display: none;">
			@include('archive.show.archival')
		</section>
		<section class="section_tab" data-tab="3" style="display: none;">
			@include('archive.show.salary')
		</section>
		<section class="section_tab" data-tab="4" style="display: none;">
			@include('archive.show.attachment')
		</section>
		<section class="section_tab" data-tab="5" style="display: none;">
			@include('archive.show.record')
		</section>
    </div>
    <div class="height60"></div>

@endsection

@section('javascript')
    @parent
<script type="text/javascript">
    require(['DataTable','layer'], function (DataTable) {
    			$(".navbar-nav li").on('click',function(){
					$(this).addClass('active').siblings().removeClass('active')
					let index = $(this).attr('data-index')
					$('.section_tab').each(function(){
						let tab = $(this).attr('data-tab')
						if(index == tab){
							$(this).css('display','block')
						}else{
							$(this).css('display','none')
						}
					})
				})
    });

</script>
@endsection