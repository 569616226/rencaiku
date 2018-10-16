<div class="left-side col-xs-12 col-sm-2 col-md-3 col-lg-2">
    <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="{{ active_class(if_route('data')) }}">
            <a href="{{ url('data') }}" > <span>新入职员工分析</span></a>
        </li>
        <li class="{{ active_class(if_route('data.off')) }}">
            <a href="{{ url('data/off') }}" > <span>离职员工分析</span></a>
        </li>
    </ul>
</div>