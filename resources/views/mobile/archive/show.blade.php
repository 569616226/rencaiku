<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
		<title>东华国际·人力资源</title>

		<!-- Bootstrap -->
		<link rel="stylesheet" href=" {{ url('/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ url('/css/wap_show.css') }}">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
    	<script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    	<script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
	</head>

	<body style="background-color: #f5f5f5;">
		@if(isset($archive))
			@include('mobile.archive.show.menu')
			<section class="section_top">
				@if($archive->avatar)
					<img style="width: 100px; height: 100px;" src="{{ $archive->avatar }}" />
				@else
					@if( $archive->sex == 0 )
						<img style="width: 100px; height: 100px;" src="{{ url('/img/boy.png') }}" />
					@elseif($archive->sex == 1)
						<img style="width: 100px; height: 100px;" src="{{ url('/img/girl.png') }}" />
					@endif
				@endif
				<div class="section_name">
					<span>{{ $archive->name }}</span>
					<i class="{{ $archive->sex == 0 ? 'icon-boy iconfont section_boy' : 'icon-girl iconfont section_girl' }}"></i>
					<div>{{ $archive->offer_depart }} / {{ $archive->offer_name }}</div>
				</div>
			</section>
			<section class="section_tab" data-tab="1" style="display: block;">
				@include('mobile.archive.show.personal')
			</section>
			<section class="section_tab" data-tab="2" style="display: none;">
				@include('mobile.archive.show.archival')
			</section>
			<section class="section_tab" data-tab="3" style="display: none;">
				@include('mobile.archive.show.salary')
			</section>
			<section class="section_tab" data-tab="4" style="display: none;">
				@include('mobile.archive.show.attachment')
			</section>
			<section class="section_tab" data-tab="5" style="display: none;">
				@include('mobile.archive.show.record')
			</section>
		@else
			<section class="archive_show_off">
				<img src="{{ url('/img/raw_1501664235.png') }}" />
				<p>档案还没完善，请稍后重试！</p>
			</section>
		@endif
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="{{ url('/js/previewImage/previewImage.js') }}"></script>
		<script>
			$(function(){
				$(".personal_key").on('click',function(){
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
				$(".attachment_span").on('click',function(){
					let file = $(this).attr('data-file')
					if(file){
						let obj = {
							urls: [file],
							current: file
						}
						previewImage.start(obj)
					}
				})
			})
		</script>
	</body>

</html>
