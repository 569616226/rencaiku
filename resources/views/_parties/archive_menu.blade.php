<div class="left-side col-xs-12 col-sm-2 col-md-3 col-lg-2">
    <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="{{ active_class(if_route('archive')) }}">
            <a href="{{ url('archive') }}" > <span>人事档案主页</span></a>
        </li>
        <li class="{{ active_class(if_route('archive.on')) }}">
            <a href="{{ url('archive/on') }}" > <span>在职员工档案</span></a>
        </li>
        <li class="{{ active_class(if_route('archive.off') || if_route('archive.reOffer')) }}">
            <a href="{{ url('archive/off') }}" > <span>离职员工档案</span></a>
        </li>
    </ul>
</div>