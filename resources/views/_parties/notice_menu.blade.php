<div class="left-side col-xs-12 col-sm-2 col-md-3 col-lg-2">
    <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="{{ active_class(if_route('examine')) }}">
            <a href="{{ url('examine') }}" > <span>人员增补申请单</span></a>
        </li>
        <li class="{{ active_class(if_route('subscribe')) }}">
            <a href="{{ url('subscribe') }}" > <span>面试预约</span><span class="badge">{{ \App\Helpers\Functions::getCounts() }}</span></a>
        </li>
        <li class="{{ active_class(if_route('notice') || if_route('notice.show') || if_route('notice.create') ) }}">
            <a href="{{ url('notice') }}" > <span>录取通知管理</span></a>
        </li>
    </ul>
</div>