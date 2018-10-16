
<li class="{{ active_class(if_route('archive.edit_archive')) }}">
    <a href="{{ isset($archive) ?  route('archive.edit_archive',[$archive->id]) : 'javascript:void(0);' }}" ><span><i class="iconfont">&#xe6b2;</i>档案信息</span></a>
</li>

<li class="{{ active_class(if_route('salary.edit' )) }} {{ isset($archive) && $archive->salaries ? '' : 'hide' }}">
    <a href="{{ isset($archive) ?  route('salary.edit',[$archive->id]) : 'javascript:void(0);'  }} " ><i class="iconfont">&#xe6d8;</i><span>薪资信息</span></a>
</li>

<li class="{{ active_class(if_route('clsoure.edit')) }}">
    <a href="{{ isset($archive) ?  route('clsoure.edit',[$archive->id]) : 'javascript:void(0);'  }}" ><i class="iconfont">&#xe6bb;</i><span>附件</span></a>
</li>
