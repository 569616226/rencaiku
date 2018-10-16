<div class="wap_main">
    <div class="wap_basic_per">
        <div class="wap_basic_top">
            <span class="wap_basic_top_p">家庭档案</span>
        </div>

        @foreach($archive->families as $family)
            <div class="wap_basic_bottom wap_padding iconfont">
            <div class="row">
                <div class="wap_col_xs_4">
                    <ap></ap>
                </div>
                <div class="wap_col_xs_8">
                    <p class="blue">
                        @if($family->relation == 1)
                            父亲
                        @elseif($family->relation == 2)
                            母亲
                        @elseif($family->relation == 3)
                            儿子
                        @elseif($family->relation == 4)
                            女儿
                        @elseif($family->relation == 5)
                            夫妻
                        @endif
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>姓名：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $family->name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>职业：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $family->offer }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>年龄（岁）：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $family->age }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>生日：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $family->birthday->toDateString() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>生日类型：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>
                        @if($family->birthday_type == 0)
                            农历
                        @elseif($family->birthday_type == 1)
                            阳历
                        @endif
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>住址：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $family->address }}</p>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <div style="height: 1.3rem;"></div>
	<div class="wap_basic_per">
		<div class="wap_basic_top">
			<span class="wap_basic_top_p">家庭情况记录</span>
		</div>
		<div class="wap_basic_bottom">
			<div class="row">
				<div class="wap_col_xs_12">
					<p>{{ $archive->family_discrible }}</p>
				</div>
			</div>
		</div>
	</div>
	<div style="height: 1.3rem;"></div>
	<div class="wap_basic_per">
        <div class="wap_basic_top">
            <span class="wap_basic_top_p">劳动合同</span>
        </div>
        @foreach($archive->agreements as $agree)
        <div class="wap_basic_bottom wap_padding iconfont">
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>合同类型：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>
                        @if($agree->type == 0)
                            非固定期限合同
                        @elseif($agree->type == 1)
                            固定期限合同
                        @endif
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>签订情况：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>
                        @if($agree->sign_type == 0)
                            首签
                        @elseif($agree->sign_type == 1)
                            续签
                        @endif
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>合同编号：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $agree->no }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>生效时间：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $agree->effect_at->toDateString() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>到期时间：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $agree->expire_at->toDateString() }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div style="height: 1.3rem;"></div>
    <div class="wap_basic_per">
        <div class="wap_basic_top">
            <span class="wap_basic_top_p">教育经历</span>
        </div>

        @foreach($archive->educations as $edu)
        <div class="wap_basic_bottom wap_padding iconfont">
            <div class="row">
                <div class="wap_col_xs_4">
                    <ap></ap>
                </div>
                <div class="wap_col_xs_8">
                    <p class="blue">
                        @if($edu->education == 0)
                            初中
                        @elseif($edu->education == 1)
                            高中/中专
                        @elseif($edu->education == 2)
                            大专
                        @elseif($edu->education == 3)
                            大学
                        @endif
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>开始时间：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $edu->start_at->toDateString() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>结束时间：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $edu->end_at->toDateString() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>学校名称：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $edu->name  }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>专业：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $edu->major  }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>是否毕业：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>
                        @if($edu->is_finish == 0)
                            否
                        @elseif($edu->is_finish == 1)
                            是
                        @endif
                    </p>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <div style="height: 1.3rem;"></div>
	<div class="wap_basic_per">
        <div class="wap_basic_top">
            <span class="wap_basic_top_p">工作经历</span>
        </div>

        @foreach($archive->works as $work)
        <div class="wap_basic_bottom wap_padding iconfont">
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>工作单位：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $work->name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>开始时间：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $work->start_at->toDateString() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>结束时间：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $work->end_at->toDateString() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>职位：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $work->position }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>离职原因：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $work->reason }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>最终薪资(元)：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $work->salary }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>联系电话：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $work->tel }}</p>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <div style="height: 1.3rem;"></div>
	<div class="wap_basic_per">
        <div class="wap_basic_top">
            <span class="wap_basic_top_p">奖惩记录</span>
        </div>
        @foreach($archive->sanctions as $san)
        <div class="wap_basic_bottom wap_padding iconfont">
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>奖惩类型：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>
                        @if($san->type == 0)
                            奖励
                        @elseif($san->type == 1)
                            惩罚
                        @elseif($san->type == 2)
                            荣誉
                        @endif
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>执行时间：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $san->execute_at->toDateString() }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>记录名称：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $san->name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>备注：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $san->remark }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div style="height: 1.3rem;"></div>
	<div class="wap_basic_per">
        <div class="wap_basic_top">
            <span class="wap_basic_top_p">岗位调整记录</span>
        </div>
        @foreach($archive->promotions as $pro)
        <div class="wap_basic_bottom wap_padding iconfont">
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>调整类型：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>
                        @if($pro->type == 0)
                            升职
                        @elseif($pro->type == 1)
                            降职
                        @elseif($pro->type == 2)
                            调岗
                        @elseif($pro->type == 3)
                            复职
                        @elseif($pro->type == 4)
                            入职
                        @endif
                    </p>
                </div>
            </div>
    {{--         <div class="row">
                <div class="wap_col_xs_4">
                    <p>原部门：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ \App\Helpers\Functions::getDepartName([$pro->old_depart]) }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>原职位：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $pro->old_offer }}</p>
                </div>
            </div> --}}
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>调岗部门：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $pro->new_depart }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>调岗职位：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $pro->new_offer }}</p>
                </div>
            </div>
            <div class="row">
                <div class="wap_col_xs_4">
                    <p>调岗时间：</p>
                </div>
                <div class="wap_col_xs_8">
                    <p>{{ $pro->chang_at->toDateString() }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div style="height: 6rem;"></div>
</div>