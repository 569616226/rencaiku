<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="format-detection" content="telephone=no" />
    <meta name="keywords" content="发票抬头">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <!--<link rel="shortcut icon" href="#" type="image/png">-->
    <link href="https://www.jq22.com/jquery/font-awesome.4.6.0.css" rel="stylesheet">
    <title>发票抬头</title>
</head>

<body style="background: #EDEDED;">
<style>
* {
	margin: 0;
	padding: 0;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

body {
	background: #2d2c41;
	font-family: 'Open Sans', Arial, Helvetica, Sans-serif, Verdana, Tahoma;
}

ul {
	list-style-type: none;
}

a {
	color: #b63b4d;
	text-decoration: none;
}

/** =======================
 * Contenedor Principal
 ===========================*/
h1 {
 	color: #FFF;
 	font-size: 24px;
 	font-weight: 400;
 	text-align: center;
 	margin-top: 80px;
 }

h1 a {
 	color: #c12c42;
 	font-size: 16px;
 }

 .accordion {
 	width: 100%;
 	max-width: 360px;
 	margin: 0px auto 20px;
 	background: #FFF;
 	-webkit-border-radius: 4px;
 	-moz-border-radius: 4px;
 	border-radius: 4px;
 }

.accordion .link {
	cursor: pointer;
	display: block;
	padding: 15px 15px 15px 12px;
	color: #4D4D4D;
	font-size: 16px;
	border-bottom: 1px solid #CCC;
	position: relative;
	-webkit-transition: all 0.4s ease;
	-o-transition: all 0.4s ease;
	transition: all 0.4s ease;
}
.accordion .link span{
	font-size:14px;
    color: #8a8a8a;
    margin-top: 10px;
    display: inline-block;
}
.accordion li:last-child .link {
	border-bottom: 0;
}

.accordion li i {
	position: absolute;
	top: 30px;
	left: 12px;
	font-size: 18px;
	color: #595959;
	-webkit-transition: all 0.4s ease;
	-o-transition: all 0.4s ease;
	transition: all 0.4s ease;
}

.accordion li i.fa-chevron-down {
	right: 12px;
	left: auto;
	font-size: 16px;
}

.accordion li.open .link {
	color: #b63b4d;
}

.accordion li.open i {
	color: #b63b4d;
}
.accordion li.open i.fa-chevron-down {
	-webkit-transform: rotate(180deg);
	-ms-transform: rotate(180deg);
	-o-transform: rotate(180deg);
	transform: rotate(180deg);
}

/**
 * Submenu
 -----------------------------*/
 .submenu {
 	display: none;
 	background: #444359;
 	font-size: 14px;
 }

 .submenu li {
 	border-bottom: 1px solid #4b4a5e;
    text-align: center;
    padding: 10px;
 }
 .submenu li img{
 	width: 100%;
 }
 .submenu a {
 	display: block;
 	text-decoration: none;
 	color: #d9d9d9;
 	padding: 12px;
 	padding-left: 42px;
 	-webkit-transition: all 0.25s ease;
 	-o-transition: all 0.25s ease;
 	transition: all 0.25s ease;
 }

 .submenu a:hover {
 	background: #b63b4d;
 	color: #FFF;
 }

</style>
	<ul id="accordion" class="accordion">
		<li>
			<div class="link">广东瑞东华教育科技有限公司 <br/>
				<span>税号：9144 1900 5666 9342 44</span>
				<i class="fa fa-chevron-down"></i>
			</div>
			<ul class="submenu">
				<li><img src="{{ url('img/piao4.png') }}"/></li>
			</ul>
		</li>
		<li>
			<div class="link">广东东华供应链科技有限公司  <br/>
				<span>税号：9144 1900 0567 5262 3X</span>
				<i class="fa fa-chevron-down"></i>
			</div>
			<ul class="submenu">
				<li><img src="{{ url('img/piao3.png') }}"/></li>
			</ul>
		</li>
		<li>
			<div class="link">深圳市东华供应链科技有限公司 <br/>
				<span>税号：9144 0300 MA5D 872G 4T</span>
				<i class="fa fa-chevron-down"></i>
			</div>
			<ul class="submenu">
				<li><img src="{{ url('img/piao1.png') }}"/></li>
			</ul>
		</li>
		<li>
			<div class="link">东莞市东华报关服务有限公司 <br/>
				<span>税号：9144 1900 7962 2776 06</span>
				<i class="fa fa-chevron-down"></i>
			</div>
			<ul class="submenu">
				<li><img src="{{ url('img/piao2.png') }}"/></li>
			</ul>
		</li>
	</ul>
<script src="https://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	};

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this);
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		}
	};

	var accordion = new Accordion($('#accordion'), false);
});
</script>

</body>
</html>