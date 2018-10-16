<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>东华国际·人力资源</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('css/login.css') }}" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<style type="text/css">
	.impowerBox .qrcode {width: 200px !important;}
</style>
<body>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="hr_logo">
        	<div class="hr_img">
        		<img src="{{ url('img/donghua.png') }}" class="img-responsive"/>
        	</div>
        	<div class="hr_p">
        		<p class="p1">东华国际人力资源管理系统</p>
        		<p class="p2">HRMS MANAGEMENT SYSTEM</p>
        	</div>
        </div>
    <div class="panel-body">
        {{--微信登陆二维码--}}
        <div id="wx_reg"></div>
        
    </div>
    </div>
    

    
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<!-- 微信二维码 -->
<script src="https://rescdn.qqmail.com/node/ww/wwopenmng/js/sso/wwLogin-1.0.0.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    window.WwLogin({
        "id" : "wx_reg",
        "appid" : "wwf82e897ad9dc4859",
        "agentid" : "1000013",
        "redirect_uri" :"{{ urlencode('https://hr.elinkport.com/auth') }}",
        "state" : MathRand(),
        "href" : "{{ url('css/login.css') }}"
    });

    /*6位随机数*/
    function MathRand()
    {
        var Num=":web_login";

        for(var i=0;i<6;i++)
        {
            Num+=Math.floor(Math.random()*10);
        }

        return Num;
    }
</script>
</body>
</html>