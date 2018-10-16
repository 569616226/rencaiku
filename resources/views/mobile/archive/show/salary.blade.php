<div class="wap_main">
    <div class="wap_basic_per">
        <div class="wap_basic_top">
            <span class="wap_basic_top_p">薪资调整</span>
        </div>
        @if($archive->salaries )
            @foreach( $archive->salaries as $salary)
            <div class="wap_basic_bottom wap_padding iconfont">
                <div class="row">
                    <div class="wap_col_xs_4">
                        <ap></ap>
                    </div>
                    <div class="wap_col_xs_8">
                        <p class="blue">{{ $salary->start_at->toDateString() }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="wap_col_xs_4">
                        <p>薪资状态</p>
                    </div>
                    <div class="wap_col_xs_8">
                        <p>
                            @if( $salary->status == 0)
                                入职
                            @elseif( $salary->status == 1)
                                转正
                            @elseif( $salary->status == 2)
                                加薪
                            @elseif( $salary->status == 3)
                                减薪
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="wap_col_xs_4">
                        <p>基本工资（元）：</p>
                    </div>
                    <div class="wap_col_xs_8">
                        <p>{{ $salary->basic }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="wap_col_xs_4">
                        <p>绩效：</p>
                    </div>
                    <div class="wap_col_xs_8">
                        <p>{{ $salary->added }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="wap_col_xs_4">
                        <p>合计（元）：</p>
                    </div>
                    <div class="wap_col_xs_8">
                        <p>{{ $salary->total }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="wap_col_xs_4">
                        <p>备注：</p>
                    </div>
                    <div class="wap_col_xs_8">
                        <p>{{ $salary->remark }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
    <div style="height: 6rem;"></div>
</div>