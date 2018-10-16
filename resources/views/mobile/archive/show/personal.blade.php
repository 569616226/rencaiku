<div class="wap_main">
	<div class="wap_basic_per">
		<div class="wap_basic_top">
			<span class="wap_basic_top_p">基础信息</span><!--<i class="iconfont icon-up"></i>-->
		</div>
		<div class="wap_basic_bottom">
			<div class="row">
				<div class="wap_col_xs_4">
					<p>内部编号：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{ $archive->local_no }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>手机号码：</p>
				</div>
				<div class="wap_col_xs_8">
					<p class="blue">{{ $archive->tel }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>邮箱：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{ $archive->email }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>籍贯：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{ $archive->origin_address }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>出生年月：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{ $archive->birthday->toDateString() }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>身高(cm)：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{ $archive->height }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>婚姻状况：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>
						@if($archive->marriage == 0)
							未婚
						@elseif($archive->marriage == 1)
							已婚
						@elseif($archive->marriage == 2)
							离异
						@endif
					</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>身份证号码：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{ $archive->Id_card }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>家庭地址：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{ $archive->address }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>现居住地址：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{ $archive->residence }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>身体状况：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{ $archive->healthy }}</p>
				</div>
			</div>
		</div>
	</div>
	<div style="height: 1.3rem;"></div>
	<div class="wap_basic_per">
		<div class="wap_basic_top">
			<span class="wap_basic_top_p">任职信息</span><!--<i class="iconfont icon-up"></i>-->
		</div>
		<div class="wap_basic_bottom">
			<div class="row">
				<div class="wap_col_xs_4">
					<p>员工状态：</p>
				</div>
				<div class="wap_col_xs_8">
					@if($archive->offer_status == 1)
						<p class="blue">在职（已转正）</p>
					@elseif($archive->offer_status == 2)
						<p class="yellow">在职（试用期）</p>
					@elseif($archive->offer_status == 0)
						<p class="yellow">
							@if($archive->offer_off_reason[0] == 0)
								正常离职
							@else
								自离
							@endif
						</p>
					@elseif($archive->offer_status == 3)
						<p class="pink">复职</p>
					@endif
				</div>
			</div>

			@if($archive->offer_status == 0)
			<div class="row">
				<div class="wap_col_xs_4">
					<p>离职时间：</p>
				</div>
				<div class="wap_col_xs_8">
					<p class="red">{{ $archive->offer_off_date ? $archive->offer_off_date->toDateString() : '' }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>离职原因：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>
						{{ $archive->offer_off_reason[1] }}

					</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>离职情况：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>	@if($archive->offer_off_reason[0] == 0)
							正常离职
						@elseif($archive->offer_off_reason[0] == 1)
							自离
						@elseif($archive->offer_off_reason[0] == 2)
							辞退
						@elseif($archive->offer_off_reason[0] == 3)
							试用期不通过
						@endif</p>
				</div>
			</div>
			@endif

			<div class="row">
				<div class="wap_col_xs_4">
					<p>工作性质：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>
						@if($archive->offer_type == 0)
							全职
						@elseif($archive->offer_type == 1)
							兼职
						@elseif($archive->offer_type == 2)
							实习
						@endif
					</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>入职时间：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{  $archive->offer_on_date->toDateString() }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>转正时间：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{  $archive->offer_date->toDateString() }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>部门：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{ $archive->offer_depart }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>职位：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{ $archive->offer_name }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>岗位职责：</p>
				</div>
				<div class="wap_col_xs_8">
					<div>{!! html_entity_decode(stripslashes( $archive->offer_des)) !!}</div>
				</div>
			</div>
		</div>
	</div>
	<div style="height: 1.3rem;"></div>
	<div class="wap_basic_per">
		<div class="wap_basic_top">
			<span class="wap_basic_top_p">紧急联系人</span><!--<i class="iconfont icon-up"></i>-->
		</div>
		<div class="wap_basic_bottom">
			<div class="row">
				<div class="wap_col_xs_4">
					<p>联系人姓名：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{ $archive->sos[0] }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>与本人关系：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>
						@if($archive->sos[1] == 1)
							父母
						@elseif($archive->sos[1] == 2)
							配偶
						@elseif($archive->sos[1] == 3)
							兄弟姐妹
						@elseif($archive->sos[1] == 4)
							子女
						@elseif($archive->sos[1] == 5)
							亲属
						@elseif($archive->sos[1] == 6)
							好友
						@endif
					</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>联系方式：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{ $archive->sos[2]  }}</p>
				</div>
			</div>
		</div>
	</div>
	<div style="height: 1.3rem;"></div>
	<div class="wap_basic_per">
		<div class="wap_basic_top">
			<span class="wap_basic_top_p">能力水平</span><!--<i class="iconfont icon-up"></i>-->
		</div>
		<div class="wap_basic_bottom">
			<div class="row">
				<div class="wap_col_xs_4">
					<p>语言能力：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>{{ $archive->lang }}</p>
				</div>
			</div>
			<div class="row">
				<div class="wap_col_xs_4">
					<p>计算机能力：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>
						@if($archive->ability[1] == 0)
							会
						@elseif($archive->ability[1] == 1)
							一般
						@elseif($archive->ability[1] == 2)
							好
						@elseif($archive->ability[1] == 3)
							强
						@endif
					</p>
				</div>
			</div>
		</div>
	</div>
	<div style="height: 1.3rem;"></div>
	<div class="wap_basic_per">
		<div class="wap_basic_top">
			<span class="wap_basic_top_p">专长及能力</span><!--<i class="iconfont icon-up"></i>-->
		</div>
		<div class="wap_basic_bottom">
			<div class="row">
				<div class="wap_col_xs_12">
					<p>{{ $archive->evalution }}</p>
				</div>
			</div>
		</div>
	</div>
	<div style="height: 1.3rem;"></div>
	<div class="wap_basic_per">
		<div class="wap_basic_top">
			<span class="wap_basic_top_p">内部推荐</span><!--<i class="iconfont icon-up"></i>-->
		</div>
		<div class="wap_basic_bottom">
			<div class="row">
				<div class="wap_col_xs_4">
					<p>是否推荐：</p>
				</div>
				<div class="wap_col_xs_8">
					<p>
						@if(isset($archive) && $archive->internal_user)
							是
						@else
							否
						@endif
					</p>
				</div>
			</div>

			@if(isset($archive) && $archive->internal_user)
				<div class="row">
					<div class="wap_col_xs_4">
						<p>亲朋姓名：</p>
					</div>
					<div class="wap_col_xs_8">
						<p>{{ $archive->internal_user }}</p>
					</div>
				</div>
				<div class="row">
					<div class="wap_col_xs_4">
						<p>亲朋部门：</p>
					</div>
					<div class="wap_col_xs_8">
						<p>{{ $archive->internal_departs }}</p>
					</div>
				</div>
			@endif

		</div>
	</div>
	<div style="height: 6rem;"></div>
</div>