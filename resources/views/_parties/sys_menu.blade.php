 <div class="left-side col-xs-12 col-sm-2 col-md-3 col-lg-2">
    <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="{{ active_class(if_route('user')) }}">
            <a href="{{ url('user') }}" > <span>通信录管理</span></a>
        </li>
        <li class="{{ active_class(if_route('setting.notice') || if_route('setting.archive') || if_route('setting.resume') ||  if_route('setting') || if_route('setting.leader')|| if_route('setting.sync')) }}">
            <a href="{{ url('setting/leader') }}" ><span>通用设置</span></a>
        </li>
        <li class="{{ active_class(if_route('setting.admin')) }}">
            <a href="{{ url('setting/admin') }}" ><span>管理员设置</span></a>
        </li>
    </ul>
</div>