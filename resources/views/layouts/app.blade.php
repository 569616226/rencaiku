<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="keywords" content="东华国际·人力资源">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="ThemeBucket">

    <title>东华国际·人力资源</title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/show.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/main-responsive.css') }}" />
</head>


<body style="background: #EDEDED;">
<!--头部信息-->
<header class="hr-header">
    <!--<div class="container">-->
    <div class="hr-header-left">
        <!--logo-->
      <i class="iconfont">&#xe631;</i>
      <div class="logo-text">
          <p>东华国际人力资源管理系统</p>
          <p>HRMS MANAGEMENT SYSTEM</p>
      </div>
    </div>
    <div class="hr-header-right">
        <div class="dropdown header-dropdown">
				<a class="btn dropdown-toggle" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                @inject('appPresenter','App\Presenters\AppPresenter')
                {{--用户名--}}
                <i class="iconfont margin-right-xs">&#xe62c;</i><span>{{ $appPresenter->getUserName() }}</span>
				<span class="caret"></span>
				</a>
            <ul class="dropdown-menu pc_menu_right" aria-labelledby="dropdownMenu">
                <li>
                    <a href="{{url('/logout')}}">退出账号</a>
                </li>
            </ul>
        </div>
    </div>
</header>

@include('_parties.item_menu')

<!--中间内容区域-->
@yield('content')

@section('javascript')
    <script src="https://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    {{--<script src="{{ secure_url('js/bootstrap.min.js') }} " type="text/javascript" charset="utf-8"></script>--}}
    <script src="https://cdn.hcharts.cn/highcharts/highcharts.js"></script>
    <script src="https://img.hcharts.cn/highcharts/modules/exporting.js"></script>
    <script src="https://img.hcharts.cn/highcharts/modules/series-label.js"></script>
    <script src="https://img.hcharts.cn/highcharts/modules/oldie.js"></script>
    <script src="https://img.hcharts.cn/highcharts-plugins/highcharts-zh_CN.js"></script>
    <script src="{{ url('js/main.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ url('js/require.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ url('js/config.js') }}" type="text/javascript" charset="utf-8"></script>
@show

</body>
</html>