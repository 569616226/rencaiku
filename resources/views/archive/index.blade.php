@extends('layouts.app')
<!--中间内容区域-->
@section('content')
    <!--中间内容区域-->
    <div class="container container-responsive">
        <div class="row hr-main-bg">
            @include('_parties.archive_menu')
            <div class="right-side col-xs-12 col-sm-10 col-md-9 col-lg-10">
                     <div class="row margin-top-lg">
                         <a href="{{ url('archive/on') }}" class="col-md-4">
                             <div class="tipsBox ping">
                                 <i class="iconfont">&#xe606;</i>
                                 <p class="num">{{ $archives['archive_counts'] }}</p>
                                 <p class="tip">员工人数</p>
                             </div>
                         </a>
                         <a href="{{ url('data') }}?time=1" class="col-md-4">
                             <div class="tipsBox green">
                                 <i class="iconfont">&#xe608;</i>
                                 <p class="num">{{ $archives['archive_on_counts'] }}</p>
                                 <p class="tip">本月入职</p>
                             </div>
                         </a>
                         <a href="{{ url('data/off') }}?time=1" class="col-md-4">
                             <div class="tipsBox org">
                                 <i class="iconfont">&#xea44;</i>
                                 <p class="num">{{ $archives['archive_off_counts'] }}</p>
                                 <p class="tip">本月离职</p>
                             </div>
                         </a>
                     </div>
                     <div class="row padding-top-lg">
                        <div class="col-xs-12">
                            {{-- <img src="{{ url('img/index.png') }}" alt="" />
                            <h4 class="margin-top-lg">欢迎使用东华人力资源管理系统</h4> --}}
                            <div class="home-wait">
                                <p class="home-wait-title afterboottom3">
                                    <i class="iconfont">&#xe65e;</i>
                                    <span> 待办提醒</span>
                                </p>
                                <div class="cl-box">
                                    <div class="cl-row">
                                        <div class="cl-td">
                                            <p class="num">{{ $archives['archive_full_counts'] }}</p>
                                            <p class="numtip">7天内待转正员工</p>
                                        </div>
                                        <div class="cl-td">
                                            {{ $archives['archive_full_names'] }}
                                        </div>
                                        <div class="cl-td">
                                            <a class="btn btn-default" href="{{ url('archive/full') }}">查看更多</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cl-box">
                                    <div class="cl-row">
                                        <div class="cl-td">
                                            <p class="num">{{ $archives['archive_agree_counts'] }}</p>
                                            <p class="numtip">7天内合同续签员工</p>
                                        </div>
                                        <div class="cl-td">
                                            {{ $archives['archive_agree_names'] }}
                                        </div>
                                        <div class="cl-td">
                                            <a class="btn btn-default" href="{{ url('archive/agree') }}">查看更多</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cl-box">
                                    <div class="cl-row">
                                        <div class="cl-td">
                                            <p class="num">{{ $archives['archive_year_counts'] }}</p>
                                            <p class="numtip">7天内员工周年提醒</p>
                                        </div>
                                        <div class="cl-td">
                                            {{ $archives['archive_year_names'] }}
                                        </div>
                                        <div class="cl-td">
                                            <a class="btn btn-default" href="{{ url('archive/year') }}">查看更多</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cl-box">
                                    <div class="cl-row">
                                        <div class="cl-td">
                                            <p class="num">{{ $archives['archive_quarter_counts'] }}</p>
                                            <p class="numtip">本季度员工生日</p>
                                        </div>
                                        <div class="cl-td">
                                            <div class="cl-child-row">
                                                {{--<div class="cl-child-td">员工生日：</div>--}}
                                                <div class="cl-child-td">{{ $archives['archive_quarter_names'] }}</div>
                                            </div>
                                        </div>
                                        <div class="cl-td">
                                            <a class="btn btn-default" href="{{ url('archive/birthday') }}">查看更多</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="cl-box">
                                    <div class="cl-row">
                                        <div class="cl-td">
                                            <p class="num">{{ $archives['familie_counts'] }}</p>
                                            <p class="numtip">本周亲属生日</p>
                                        </div>
                                        <div class="cl-td">
                                            <div class="cl-child-row">
                                                {{--<div class="cl-child-td">亲属生日：</div>--}}
                                                <div class="cl-child-td">{{$archives['familie_count_names'] }}</div>
                                            </div>
                                        </div>
                                        <div class="cl-td">
                                            <a class="btn btn-default" href="{{ url('archive/family_birthday') }}">查看更多</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    @parent
<script type="text/javascript">
    require(['DataTable','layer'], function (DataTable) {
     
    });

</script>
@endsection