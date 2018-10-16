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
		<link rel="stylesheet" href="{{ url('/css/wap_show.css?v=1') }}">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
    	<script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    	<script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
	</head>

	<body style="background-color: #f8fbfe;">
		<div class="archive_index">
			<p class="archive_index_p1">员工总数</p>
			<span class="archive_index_span1">{{ $archive_counts }}</span>
		</div>
		<div class="archive_relative">
			<div class="archive_absolute">
				<a href="{{ url('mobile/archive/'.$depart_id.'/all') }}">查看在职员工档案</a>
			</div>
		</div>
		<div class="archive_row row">
			<a href="{{ url('mobile/archive/'.$depart_id.'/on') }}">
				<div class="col-xs-6">
					<div class="archive_number">
						<p>{{ $archive_on_counts }}</p>
						<span>本月入职</span>
					</div>
				</div>
				<div class="archive_col col-xs-6">
					<img src="{{ url('/img/archive1.png') }}" />
				</div>
			</a>
		</div>

		<div class="archive_row row">
			<a href="{{ url('mobile/archive/'.$depart_id.'/off') }}">
				<div class="col-xs-6">
					<div class="archive_number">
						<p>{{ $archive_off_counts }}</p>
						<span>本月离职</span>
					</div>
				</div>
				<div class="archive_col2 col-xs-6">
					<img src="{{ url('/img/archive2.png') }}" />
				</div>
			</a>
		</div>

		<div class="archive_data">
			<a href="{{ url('mobile/archive/'.$depart_id.'/all_off') }}">
				查看离职员工档案({{ $archive_all_off_counts }}人)
			</a>
		</div>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>

</html>
