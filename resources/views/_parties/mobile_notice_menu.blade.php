<div class="header">
    <div class="row wap-exa">
        <a href="{{ url( '/mobile/notice/full' ) }} ">
            <div class="col-xs-def-2 padding-0 {{ active_class(if_route('mobile.notice.full')) }}">
                <p class="exa-date">待转正</p>
                <p class="exa-num" id="full">{{ $archives['archive_full_counts'] }}</p>
            </div>
        </a>
        <a href="{{ url('/mobile/notice/agree') }} " >
            <div class="col-xs-def-2 padding-0 {{ active_class(if_route('mobile.notice.agree')) }}" >
                <p class="exa-date">合同续签</p>
                <p class="exa-num" id="agree">{{ $archives['archive_agree_counts'] }}</p>
            </div>
        </a>

        <a href="{{ url('/mobile/notice/year') }} " >
            <div class="col-xs-def-2 padding-0 {{ active_class(if_route('mobile.notice.year')) }}" >
                <p class="exa-date">周年提醒</p>
                <p class="exa-num" id="year">{{ $archives['archive_year_counts'] }}</p>
            </div>
        </a>

        <a href="{{ url('/mobile/notice/birthday') }} " >
            <div class="col-xs-def-2 padding-0 {{ active_class(if_route('mobile.notice.birthday')) }}" >
                <p class="exa-date">员工生日</p>
                <p class="exa-num">{{ $archives['archive_quarter_counts'] }}</p>
            </div>
        </a>
        
        <a href="{{ url('/mobile/notice/families') }} " >
            <div class="col-xs-def-2 padding-0 {{ active_class(if_route('mobile.notice.families')) }}" >
                <p class="exa-date">亲属生日</p>
                <p class="exa-num">{{ $archives['familie_counts'] }}</p>
            </div>
        </a>
    </div>
</div>