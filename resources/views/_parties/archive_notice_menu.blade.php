<div class="ToDoMent margin-top">
    <nav class="navbar navbar-default hr-nav" style="border: none">
        <!--<div class="container">-->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav flex" style="float: none; border-bottom: 1px solid #BBBBBB;">

                <li class="{{ active_class(if_route('archive.notice.full')) }}">
                    <a href="{{ url('archive/full') }}" ><span>7天内待转正员工 <span class="badge">{{ $archives['archive_full_counts'] }}</span></span></a>
                </li>
                <li class="{{ active_class(if_route('archive.notice.agree')) }}">
                    <a href="{{ url('archive/agree') }}" ><span>7天内合同续签员工 <span class="badge">{{ $archives['archive_agree_counts'] }}</span></span></a>
                </li>
                <li class="{{ active_class(if_route('archive.notice.birthday')) }}">
                    <a href="{{ url('archive/birthday') }}" ><span>本季度员工生日 <span class="badge">{{ $archives['archive_quarter_counts'] }}</span></span></a>
                </li>
                <li class="{{ active_class(if_route('archive.notice.family_birthday')) }}">
                    <a href="{{ url('archive/family_birthday') }}" ><span>本周员工亲属生日 <span class="badge">{{ $archives['familie_counts'] }}</span></span></a>
                </li>
                <li class="{{ active_class(if_route('archive.notice.year')) }}">
                    <a href="{{ url('archive/year') }}" ><span>7天内员工周年提醒 <span class="badge">{{ $archives['archive_year_counts'] }}</span></span></a>
                </li>

            </ul>
        </div>

        <!--</div>-->
    </nav>
</div>