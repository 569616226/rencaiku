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
    <link rel="stylesheet" href="{{ url('/css/mobiscroll.2.13.2.min.css') }}"/>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="sideWrap" style="height: 667px; display: none; transform: translate3d(290px, 0px, 0px);">
    <div class="senior_search">
        <div class="SS_head">
            <div class="SS_colse"></div>
            <div class="SS_title">高级搜索</div>
        </div>
        <div class="SS_main" style="padding:0 0 0 15px;">
            <ul class="pt5" style="max-height: 550px;">
                <li>
                    <p>员工状态</p>
                    <select name="status" id="status" class="stage">
                        <option value="0">离职</option>
                    </select>
                </li>
                <li>
                    <p>部门</p>
                    <select name="depart" id="depart" class="stage">
                        @foreach($departs as $depart)
                            @if($depart_id == 1)
                                @if($depart->id == 1)
                                    <option value="{{ null }}">全部</option>
                                @else
                                    <option value="{{ $depart->id }}">{{ $depart->name }}</option>
                                @endif
                            @else
                                @if($depart->id == $depart_id)
                                    <option value="{{ $depart->id }}">{{ $depart->name }}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </li>
                <li><p>搜索</p><input id="word" name="word" type="text" value="" placeholder="可输入姓名/手机号/职位"></li>
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

<div id="wrap_main" class="wrap">
    <div class="search-box fixed">
        <div class="inner-search-box">
            <div class="search-box-o flexbox">
                <div class="flexItem">
                    <div class="search-input-box flexbox">
                        <div class="flexItem">
                            <input class="search-input pl30" type="text" placeholder="可输入姓名/手机号/职位" name="keyWord"
                                   id="keyWord">
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
            <div id="more">
                <div class="settings-item single_item info">
                </div>
                <a href="javascript:;" class="get_more"> </a>
            </div>
        </div>
    </div>
</div>

<div class="overlay" id="overlayImage" style="display: none;"></div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ url('/js/jquery.more.js?v=1') }}"></script>
<script src="{{ url('/js/main.js') }}"></script>
<script>

    /*
    * 根据传送数据确定 加载数据url
    * */
    var host = '{{ env('APP_URL') }}' ;
    var url = host + '/mobile/archive/search_all_off_data/'+'{{ $depart_id }}';
    var offer_depart = GetQuery('offer_depart');
    var offer_status = GetQuery('offer_status');
    var keyWord = GetQuery('keyWord');


    if(  offer_status !== null &&　offer_depart !== null　&& keyWord !== null ){
        url += '?offer_status='+offer_status+'&offer_depart='+offer_depart+'&keyWord='+keyWord;
    }else if( offer_status !== null &&　offer_depart !== null ){
        url =  '?offer_status='+offer_status+'&offer_depart='+offer_depart ;
    }else if( offer_status !== null &&　keyWord !== null ){
        url = '?offer_status='+offer_status+'&keyWord='+keyWord ;
    }else if( offer_depart !== null &&　keyWord !== null ){
        url = '?offer_depart='+offer_depart+'&keyWord='+keyWord ;
    }
    $(function () {
        $('#more').more({
            'address': url
        });
    })
    $('.sideWrap').height($(window).height());
    $('.sideWrap ul').css('max-height', $(window).height() - 117);
    $('.senior_search_btn').on('click', function () {
        $('.wrap_inner').css('overflow', 'hidden');
        $("#overlayImage").show();
        $('.sideWrap').show();
        setTimeout(function () {
            $('.sideWrap').css({
                'transform': 'translate3d(0,0,0)',
                '-webkit-transform': 'translate3d(0,0,0)'
            });
        }, 0);
    });
    $('.SS_colse').on('click', function () {
        $('.sideWrap').css({
            'display': 'block',
            'transform': 'translate3d(290px,0,0)',
            '-webkit-transform': 'translate3d(290px,0,0)'
        });

        setTimeout(function () {
            $("#overlayImage").hide();
            $('.sideWrap').hide();
            $('.wrap_inner')[0].style.removeProperty('overflow');
        }, 200);
    });

    $('#endTaskBtn').on('click', function () {
        let status = $('#status').val()
        let depart = $('#depart').val()
        let word = $('#word').val()
        window.location.href = '/mobile/archive/'+'{{ $depart_id }}'+'/search_all_off?offer_status='+status+'&offer_depart='+depart+'&keyWord='+encodeURI(encodeURI(word))
    });

    $('.search_letter_btn').on('click', function () {
        let keyWord = $('#keyWord').val()
        window.location.href = '/mobile/archive/'+'{{ $depart_id }}'+'/search_all_off?keyWord='+encodeURI(encodeURI(keyWord))
    });
</script>
</body>

</html>
