
<nav class="navbar navbar-default hr-nav">
    <!--<div class="container">-->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="nav navbar-nav flex" style="float: none;">

            <li class="flex-1 {{ active_class(if_route('home')) }}">
                <a href="{{ url('/') }}" data-nav-section="home"><span>首页</span></a>
            </li>
            <li class="flex-1 {{ active_class(if_route('examine') || if_route('subscribe') || if_route('notice') || if_route('notice.show') || if_route('notice.create')) }}">
                <a href="{{ url('examine') }}" data-nav-section="about"><span>面试管理</span></a>
            </li>
            <li class="flex-1 {{ active_class(if_route('resume') || if_route('resume.black') ) }}">
                <a href="{{ url('resume') }}" data-nav-section="practice-areas"><span>人才库</span></a>
            </li>

            @inject('appPresenter','App\Presenters\AppPresenter')
            @if( in_array($appPresenter->getUserId(),config('system.admin_user')) )
                <li class="flex-1 {{ active_class(if_route('archive') || if_route('archive.on') || if_route('archive.show') || if_route('archive.off') || if_route('archive.edit_archive')
                || if_route('archive.notice.full')|| if_route('archive.notice.agree')|| if_route('archive.notice.birthday')|| if_route('archive.notice.year')
                || if_route('archive.notice.family_birthday') || if_route('archive.create') || if_route('salary.edit')|| if_route('clsoure.edit') ) }}">
                    <a href="{{ url('archive') }}" data-nav-section="practice-areas"><span>人事管理</span></a>
                </li>
                <li class="flex-1 {{ active_class(if_route('data') || if_route('data.off') ) }}">
                	<a href="{{ url('data') }}" data-nav-section="practice-areas"><span>数据统计</span></a>
            	</li>
                <li class="flex-1 {{ active_class(if_route('setting.notice') || if_route('setting.archive') || if_route('setting.resume')
                ||  if_route('setting') || if_route('setting.leader') || if_route('user') || if_route('setting.admin')|| if_route('setting.sync') ) }}">
                    <a href="{{ url('user') }}" data-nav-section="practice-areas"><span>系统设置</span></a>
                </li>
            @endif
        </ul>
    </div>

    <!--</div>-->
</nav>