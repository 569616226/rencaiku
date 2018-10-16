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
    <link rel="stylesheet" href="{{ url('js/icheck/skins/icheck-all.css') }}" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style="background: #F0F0F2;">
<div class="{{ isset($error_msg) ? '' : 'hide' }}">{{isset($error_msg) ?  $error_msg : ''  }}</div>
<div class="apprise-main">
    <form class="apprise-form form" action="{{ url('/mobile/appraise/'.$subscribe_id) }}" method="post">
        {{ csrf_field() }}
        <p>面试结果</p>
        <label class="radio-inline">
            <input type="radio" name="optionsRadiosinline" id="optionsRadios3" value="1" checked> 同意
        </label>
        <label class="radio-inline" style="margin-left: 3rem;">
            <input type="radio" name="optionsRadiosinline" id="optionsRadios4"  value="0"> 不同意
        </label>
        <div class="form-group" style="margin-top: 1.5rem;">
            <textarea name="content" class="form-control" rows="4" placeholder="请写下您对求职者的评价" style="color: #333333;"></textarea>
        </div>
        <div class="text-center {{ $is_appraise ? '' : 'hide' }}">
            <button type="submit" onclick="openload()" class="btnsp btn-primary" style="width: 90%;">提交评价</button>
        </div>
    </form>
</div>
<div class="fakeloader" style="position: fixed;width: 100%;height: 100%;top: 0px;left: 0px;background-color: rgba(134, 134, 134,0.2);z-index: 999; display: none; ">
    <div class="mop-css-2 wave" style="position: absolute; top: 0;left: 0;right: 0;bottom: 0;margin: auto;">
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ url('js/jquery.more.js?v=1') }}"></script>
<script type="text/javascript" src="{{ url('js/mobiscroll.2.13.2.min.js') }}" ></script>
<script type="text/javascript" src="{{ url('js/icheck/icheck.min.js') }}" ></script>
<script src="{{ url('js/list.js') }} "></script>
<script>
    $("input").iCheck({
        radioClass:'iradio_square-blue'
    });
    function openload() {
        $('.fakeloader').fadeIn(100);
    }
</script>
</body>
</html>