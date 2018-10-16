<div class="personal_show">
	<span>基本信息</span>
</div>
<div class="personal_row row">
	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>籍贯：</span>
			</div>
			<div class="col-xs-8">
				<span>{{ $archive->origin_address }}</span>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>身高(cm)：</span>
			</div>
			<div class="col-xs-8">
				<span>{{ $archive->height }}</span>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>身份证号码：</span>
			</div>
			<div class="col-xs-8">
				<span>{{ $archive->Id_card }}</span>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>现居住地址：</span>
			</div>
			<div class="col-xs-8">
				<span>{{ $archive->residence }}</span>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>出生年月：</span>
			</div>
			<div class="col-xs-8">
				<span>{{ $archive->birthday->toDateString() }}</span>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>婚姻状况：</span>
			</div>
			<div class="col-xs-8">
				<span>
					@if($archive->marriage == 0)
						未婚
					@elseif($archive->marriage == 1)
						已婚
					@elseif($archive->marriage == 2)
						离异
					@endif
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>家庭地址：</span>
			</div>
			<div class="col-xs-8">
				<span>{{ $archive->address }}</span>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>身体状况：</span>
			</div>
			<div class="col-xs-8">
				<span>{{ $archive->healthy }}</span>
			</div>
		</div>
	</div>
</div>
<div class="personal_show">
	<span>任职信息</span>
</div>
<div class="personal_row row">
	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>员工状态：</span>
			</div>
			<div class="col-xs-8">
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
				<div class="col-xs-4 personal_xs_text">
					<span>离职时间：</span>
				</div>
				<div class="col-xs-8">
					<span>{{ $archive->offer_off_date ? $archive->offer_off_date->toDateString() : '' }}</span>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4 personal_xs_text">
					<span>离职情况：</span>
				</div>
				<div class="col-xs-8">
					<span>
						@if($archive->offer_off_reason[0] == 0)
							正常离职
						@elseif($archive->offer_off_reason[0] == 1)
							自离
						@elseif($archive->offer_off_reason[0] == 2)
							辞退
						@elseif($archive->offer_off_reason[0] == 3)
							试用期不通过
						@endif
					</span>
				</div>
			</div>
		@endif

		<div class="row margin-top-bg">
			<div class="col-xs-4 personal_xs_text">
				<span>工作性质：</span>
			</div>
			<div class="col-xs-8">
				<span>
					@if($archive->offer_type == 0)
						全职
					@elseif($archive->offer_type == 1)
						兼职
					@elseif($archive->offer_type == 2)
						实习
					@endif
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>入职时间：</span>
			</div>
			<div class="col-xs-8">
				{{--需要多加一天才能算一个月--}}
				<span>{{  $archive->offer_on_date->toDateString() }}（试用期：{{ $archive->offer_date->addDay()->diffInMonths($archive->offer_on_date) }}个月）</span>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>职位：</span>
			</div>
			<div class="col-xs-8">
				<span>{{ $archive->offer_name }}</span>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>岗位职责：</span>
			</div>
			<div class="col-xs-8">
				<div class="text" style="padding: 0px;">
					<div>
						{!! html_entity_decode(stripslashes($archive->offer_des)) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="row"></div>
		<div class="row"></div>
		@if($archive->offer_status == 0)
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>离职原因：</span>
			</div>
			<div class="col-xs-8">
				<span>{{ $archive->offer_off_reason[1] }}</span>
			</div>
		</div>
		@endif

		<div class="row margin-top-bgg">
			<div class="col-xs-4 personal_xs_text">
				<span>转正时间：</span>
			</div>
			<div class="col-xs-8">
				<span>{{  $archive->offer_date ? $archive->offer_date->toDateString() : '' }}</span>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>部门：</span>
			</div>
			<div class="col-xs-8">
				<span>{{$archive->offer_depart }}</span>
			</div>
		</div>
	</div>
</div>
<div class="personal_show">
	<span>紧急联络人</span>
</div>
<div class="personal_row row">
	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>联系人姓名：</span>
			</div>
			<div class="col-xs-8">
				<span>{{ $archive->sos[0] }}</span>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>联系方式：</span>
			</div>
			<div class="col-xs-8">
				<span>{{ $archive->sos[2] }}</span>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>与本人关系：</span>
			</div>
			<div class="col-xs-8">
				<span>
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
				</span>
			</div>
		</div>
	</div>
</div>
<div class="personal_show">
	<span>能力水平</span>
</div>
<div class="personal_row row">
	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>语言能力：</span>
			</div>
			<div class="col-xs-8">
				<span>{{ $archive->lang }}</span>
			</div>
		</div>
	</div>
	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>计算机能力：</span>
			</div>
			<div class="col-xs-8">
				<span>
					@if($archive->ability[1] == 0)
						会
					@elseif($archive->ability[1] == 1)
						一般
					@elseif($archive->ability[1] == 2)
						好
					@elseif($archive->ability[1] == 3)
						强
					@endif
				</span>
			</div>
		</div>
	</div>
</div>
<div class="personal_show">
	<span>专长及能力</span>
</div>
<div class="personal_row row">
	<div class="col-xs-12">
		<p>{{ $archive->evalution }}</p>
	</div>
</div>
<div class="personal_show">
	<span>内部推荐</span>
</div>
<div class="personal_row row">
	<div class="col-xs-6">
		<div class="row">
			<div class="col-xs-4 personal_xs_text">
				<span>是否推荐：</span>
			</div>
			<div class="col-xs-8">
				<span>
					@if(isset($archive) && $archive->internal_user)
						是
					@else
						否
					@endif
				</span>
			</div>
		</div>

		@if(isset($archive) && $archive->internal_user )
			<div class="row">
				<div class="col-xs-4 personal_xs_text">
					<span>推荐人所在部门：</span>
				</div>
				<div class="col-xs-8">
					<span>{{ $archive->internal_departs  }}</span>
				</div>
			</div>
	</div>
	<div class="col-xs-6">
			<div class="row">
				<div class="col-xs-4 personal_xs_text">
					<span>推荐人姓名：</span>
				</div>
				<div class="col-xs-8">
					<span>{{ $archive->internal_user }}</span>
				</div>
			</div>
		@endif
	</div>
</div>