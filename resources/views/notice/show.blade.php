@extends('layouts.app')
<!--中间内容区域-->
@section('content')
    <!--中间内容区域-->
    <div class="container container-responsive">
        <div class="row hr-main-bg">
            @include('_parties.notice_menu')
            <div class="right-side col-xs-12 col-sm-10 col-md-9 col-lg-10">
                   <div class="row margin-top-lg padding-left-lg padding-right-lg">
                   		<div class="text-center afterboottom3 padding-bottom-lg">
                   			<h3>查看录取通知书</h3>
               				<p>发送到：{{ $notice->email }}</p>
                   		</div>
                     	<div class="margin-top-lg">
                     		<p>
                     			<b>{{ $notice->subscribe->resumes->name }}</b>
                     			<span class="margin-left">先生/小姐</span>
                     		</p>
                     		<p class="padding-left-xl">感谢您应聘本公司 <b>{{ $notice->subscribe->examines->position }}</b> 职位，经公司评审合格，现根据本公司员工录用规定给予录取，欢迎您加入本公司行列。有关报到事项如下，请参照办理。</p>
                     		<p>一、报到时间：</p>
                     		<p>报到日期：<b>{{ $notice->entry_at->year }}年{{ $notice->entry_at->month }}月{{ $notice->entry_at->day }}日</b> </p>
                     		<p>二、工作地点：松山湖中科创新广场A座1108</p>
                     		<p>三、工作时间，周一至周五，上午8:30-下午17:30（如公司举办活动或培训等事宜，星期六会临时安排上班）</p>
                     		<p>四、报到时请带日常生活用品及身份证</p>
                     		<p>五、根据公司的规定，新员工签劳动合同  3&nbsp;年，试用&nbsp;<b>{{ $notice->training }}</b> 个月</p>
                     		<p>六、试用期薪资&nbsp;&nbsp;<b>{{ $notice->trial_salary }}</b>&nbsp;&nbsp;元/月，其中基本薪资为&nbsp;&nbsp;<b>{{ $notice->salary }}</b>&nbsp;&nbsp;元，转正后工资浮动范围按公司薪资制度执行。</p>
                     		<p>七、转正后购买社保</p>
                     		<p>八、公司免费提供中晚餐，每月享有200元住宿补贴（如公司提供宿舍则不享有此补助）</p>
                     		<p>九、以上事项若有疑问或困难，请与本公司人力资源部联系：张先生  0769-22898085</p>
                     		<p>十、入职前须知：在入职前，请仔细阅读以下网址中的内容：  <a href="{{ $notice->notice_url }}">{{ $notice->notice_url }}</a></p>
                     	</div>
                     	<div class="margin-top-lg">
                     		<p>广东东华供应链科技有限公司 行政部</p>
                     		<p><b>{{ $notice->created_at->year }}年{{ $notice->created_at->month }}月{{ $notice->created_at->day }}日</b></p>
                     	</div>
                     	<div class="text-center">
                     		<a class="btn btn-default" href="{{ back()->getTargetUrl() }}" >返回</a>
                     	</div>
                   </div>
            </div>
        </div>
    </div>
@endsection