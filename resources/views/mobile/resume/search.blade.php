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
    <link rel="stylesheet" href="{{ url('/css/mobiscroll.2.13.2.min.css') }}" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<form action="{{ url('/mobile/resume/search') }}" method="post" id="searchForm">
    {{ csrf_field() }}
    <div class="sideWrap" style="height: 667px; display: none; transform: translate3d(290px, 0px, 0px);">
        <div class="senior_search">
            <div class="SS_head">
                <div class="SS_colse"></div>
                <div class="SS_title">高级搜索</div>
            </div>
            <div class="SS_main" style="padding:0 0 0 15px;">
                <ul class="pt5" style="max-height: 550px;">
                    <li>
                        <p>简历来源</p>
                        <select name="origin" id="origin" class="stage">
                            <option value=""></option>
                            <option value="0">智通</option>
                            <option value="1">卓博</option>
                            <option value="2">内部推荐</option>
                            <option value="3">人才市场</option>
                        </select>
                    </li>
                    <li>
                        <p>性别</p>
                        <select name="sex" id="sex" class="stage">
                            <option value=""></option>
                            <option value="男">男</option>
                            <option value="女">女</option>
                        </select>
                    </li>
                    <li>
                        <p>学历</p>
                        <select name="educationLevel" id="educationLevel" class="stage">
                            <option value=""></option>
                            <option value="初中及以下">初中及以下</option>
                            <option value="高中">高中</option>
                            <option value="中技">中技</option>
                            <option value="中专">中专</option>
                            <option value="大专">大专</option>
                            <option value="本科">本科</option>
                            <option value="硕士">硕士</option>
                            <option value="MBA">MBA</option>
                            <option value="EMBA">EMBA</option>
                            <option value="博士">博士</option>
                            <option value="博士后">博士后</option>
                        </select>
                    </li>
                    <li>
                        <p>工作年限</p>
                        <select name="workingYears" id="workingYears" class="stage">
                            <option value=""></option>
                            {{--<option value="在读学生">在读学生</option>--}}
                            {{--<option value="应届毕业">应届毕业</option>--}}
                            <option value="1年">1年</option>
                            <option value="2年">2年</option>
                            <option value="3年">3年</option>
                            <option value="4年">4年</option>
                            <option value="5年">5年</option>
                            <option value="6年">6年</option>
                            <option value="7年">7年</option>
                            <option value="8年">8年</option>
                            <option value="9年">9年</option>
                            <option value="10年">10年</option>
                            <option value="10年及以上">10年及以上</option>
                        </select>
                    </li>
                    <li><p>期望职位</p><input id="position" name="position" type="text" value=""></li>
                </ul>
                <div class="form_btns mt10" id="btn_div_per1" style="">
                    <div class="inner_form_btns">
                        <div class="fbtns flexbox">
                            <a class="fbtn btn" id="endTaskBtn" style=" line-height: 39px; pointer-events: auto;">搜索</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="{{ url('/mobile/resume/search') }}" id="orginfo_search" method="post">
    {{ csrf_field() }}
    <div id="wrap_main" class="wrap">
        <div class="search-box fixed">
            <div class="inner-search-box">
                <div class="search-box-o flexbox">
                    <div class="flexItem">
                        <div class="search-input-box flexbox">
                            <div class="flexItem">
                                <input class="search-input pl30" type="text" placeholder="可输入职位/姓名" name="keyWord" id="keyWord">
                            </div>
                        </div>
                    </div>
                    <div class="search_more">
                        <a class="search_letter_btn"><i class="iconfont fa-search"></i></a>
                    </div>
                    <div class="senior_search_solid"></div>
                    <div class="iconfont senior_search_btn"></div>
                </div>
            </div>
        </div>

        <div id="main" class="wrap_inner">
            <div class="address_list">
                <div class="search-box-height"></div>
                <!-- 模板数据 -->
                @if(!$resumes->isEmpty())
                    @foreach($resumes as $resume)
                        <a href="{{url('/mobile/resume/'.$resume->id.'/show')}}">
                            <div class="settings-item single_item info">
                                <div class="inner-settings-item flexbox">
                                    <div class="avator">
                                        <img src="{{ $resume->sex === '男' ? url('img/boy.png') : url('img/girl.png') }}" class="img-responsive" />
                                    </div>
                                    <div class="title description_title flexItem">
                                        <p class="name">{{ $resume->name }}-{{ $resume->wechat_position }}</p>
                                        <p class="description description_ellipsis">
                                <span>来源：@if($resume->origin_id == 0)
                                        智通
                                    @elseif($resume->origin_id == 1)
                                        卓博
                                    @elseif($resume->origin_id == 2)
                                        内部推荐
                                    @else
                                        人才市场
                                    @endif丨年限：{{ $resume->work_experience }}丨 学历：{{ $resume->education }} </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="text-center">
                        <img style="max-width: 80%" src="{{ url('img/raw_1501664235.png') }}" alt="">
                        <p>没有找到简历哦！</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</form>

<div class="overlay" id="overlayImage" style="display: none;"></div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ url('/js/jquery.more.js?v=1') }}"></script>
<script type="text/javascript" src="{{ url('/js/mobiscroll.2.13.2.min.js') }}"></script>
<script>
    {{--var url = '{{ url('/mobile/resume/all_data') }}';--}}
    {{--$(function() {--}}
        {{--$('#more').more({--}}
            {{--'address': url--}}
        {{--});--}}
    {{--})--}}
    opt.preset = 'date'; //调用日历显示  日期时间
    $("#startTime").mobiscroll(opt); //直接调用日历 插件
    $("#endTime").mobiscroll(opt); //直接调用日历 插件
    $("#startTime").on("focus", function() {
        //关闭输入法
        $("#title").css("ime-mode", "disabled");
        $("#content").css("ime-mode", "disabled");
    });
    $("#endTime").on("focus", function() {
        //关闭输入法
        $("#title").css("ime-mode", "disabled");
        $("#content").css("ime-mode", "disabled");
    });
    $('.sideWrap').height($(window).height());
    $('.sideWrap ul').css('max-height', $(window).height() - 117);
    $('.senior_search_btn').on('click', function() {
        $('.wrap_inner').css('overflow', 'hidden');
        $("#overlayImage").show();
        $('.sideWrap').show();
        setTimeout(function() {
            $('.sideWrap').css({
                'transform': 'translate3d(0,0,0)',
                '-webkit-transform': 'translate3d(0,0,0)'
            });
        }, 0);
    });
    $('.SS_colse').on('click', function() {
        $('.sideWrap').css({
            'display': 'block',
            'transform': 'translate3d(290px,0,0)',
            '-webkit-transform': 'translate3d(290px,0,0)'
        });

        setTimeout(function() {
            $("#overlayImage").hide();
            $('.sideWrap').hide();
            $('.wrap_inner')[0].style.removeProperty('overflow');
        }, 200);
    });

    $('#endTaskBtn').on('click', function() {
        $("#searchForm").submit();
    });
    $('.search_letter_btn').on('click', function() {

        $("#orginfo_search").submit();
    });
</script>
</body>

</html>