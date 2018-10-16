
	<div style="margin: 0;font-family: 微软雅黑;font-size: 14px;">
		<div style="width: 660px; margin: 0 auto;margin-top: 30px;background: #fcfdff;font-family: 微软雅黑;font-size: 14px;">
			<img src="http://rencaiku.com/img/email_logo.png" />
			<div style="padding: 40px;">
				<div>
					<span style="color: #2a88fd;font-size: 18.0px;font-weight: bold;">{{ $name }}</span>
					<span style="margin-left: 15px;font-size: 18.0px;color: #101010;font-weight: bold;">先生/小姐：</span>
				</div>
				<p style="text-indent: 2em;margin-top: 35px;">感谢您应聘本公司<b style="color:#2a88fd;margin: 0 5px;">{{ $wechat_position }}</b>职位，经公司评审合格，现根据本公司员工录用规定给予录用，欢迎您加入本公司。有关报到事项如下，请参照办理。</p>
				<p>一、报到时间：</p>
				<p>报到日期：<b style="color:#2a88fd;">{{$offer_date->year}}年{{$offer_date->month}}月{{$offer_date->day}}日</b></p>
				<p>二、工作地点：松山湖中科创新广场A座1108</p>
				<p>三、工作时间，周一至周五，上午8:30-下午17:30（如公司举办活动或培训等事宜，星期六会临时安排上班）</p>
				<p>四、报到时请带日常生活用品及身份证</p>
				<p>五、根据公司的规定，新员工签劳动合同  3&nbsp;年，试用&nbsp;<b><font color="#2a88fd">{{ $shakedown_period }}</font></b> 个月</p>
				<p>六、试用期薪资&nbsp;<b><font color="#2a88fd">{{ $probation_salary }}</font></b>&nbsp;元/月，其中基本薪资为&nbsp;<b><font color="#2a88fd">{{ $basic_pay }}</font></b>&nbsp;元，转正后工资浮动范围按公司薪资制度执行。</p>
				<p>七、转正后购买社保</p>
				<p>八、公司免费提供中晚餐，每月享有200元住宿补贴（如公司提供宿舍则不享有此补助）</p>
				<p>九、以上事项若有疑问或困难，请与本公司人力资源部联系：张先生  0769-22898085</p>
				<p style="padding-bottom: 40px;border-bottom: 1px dotted #add3ff;">十、入职前须知：在入职前，请仔细阅读以下网址中的内容：  <a style="color: #0093e6;" href="{{ $link }}">{{ $link }}</a></p>
				<p style="margin-top: 40px;">广东东华供应链科技有限公司 行政部</p>
				<p><b>{{today()->year}}年{{today()->month}}月{{today()->day}}日</b></p>
			</div>
		</div>
	</div>
