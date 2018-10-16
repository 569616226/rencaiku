<div class="personal_show">
	<span>家庭档案</span>
</div>
<div class="personal_row row">
	<table class="table table-bordered">
		<thead>
		<tr>
			<th>姓名</th>
			<th>关系</th>
			<th>职业</th>
			<th>年龄（岁）</th>
			<th>生日</th>
			<th>生日祝福提醒</th>
			<th>住址</th>
		</tr>
		</thead>
		<tbody>
		@foreach($archive->families ?? $archive->families as $family)
			<tr>
				<th>{{ $family->name }}</th>
				<td>
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
				</td>
				<td>{{ $family->offer }}</td>
				<td>{{ $family->age }}</td>
				<td>{{ $family->birthday->toDateString() }}</td>
				<td>
					@if($family->birthday_type == 0)
						农历
					@elseif($family->birthday_type == 1)
						阳历
					@endif
				</td>
				<td>{{ $family->address }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
<div class="personal_show">
	<span>家庭情况记录</span>
</div>
<div class="personal_row row">
	<div class="col-xs-12">
		<p>{{ $archive->family_discrible }}</p>
	</div>
</div>
<div class="personal_show">
	<span>劳动合同</span>
</div>
<div class="personal_row row">
	<table class="table table-bordered">
		<thead>
		<tr>
			<th>合同类型</th>
			<th>签订情况</th>
			<th>合同编号</th>
			<th>生效时间</th>
			<th>到期时间</th>
		</tr>
		</thead>
		<tbody>
		@foreach($archive->agreements ?? $archive->agreements as $agree)
			<tr>
				<th>
					@if($agree->type == 0)
						非固定期限合同
					@elseif($agree->type == 1)
						固定期限合同
					@endif
				</th>
				<td>
					@if($agree->sign_type == 0)
						首签
					@elseif($agree->sign_type == 1)
						续签
					@endif
				</td>
				<td>{{ $agree->no }}</td>
				<td>{{ $agree->effect_at->toDateString() }}</td>
				<td>{{ $agree->expire_at->toDateString() }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
<div class="personal_show">
	<span>教育经历</span>
</div>
<div class="personal_row row">
	<table class="table table-bordered">
		<thead>
		<tr>
			<th>学历</th>
			<th>开始时间</th>
			<th>结束时间</th>
			<th>学校名称</th>
			<th>专业</th>
			<th>是否毕业</th>
		</tr>
		</thead>
		<tbody>
		@foreach($archive->educations ?? $archive->educations as $edu)
			<tr>
				<th>
					@if($edu->education == 0)
						初中
					@elseif($edu->education == 1)
						高中/中专
					@elseif($edu->education == 2)
						大专
					@elseif($edu->education == 3)
						大学
					@endif
				</th>
				<td>{{ $edu->start_at->toDateString() }}</td>
				<td>{{ $edu->end_at->toDateString() }}</td>
				<td>{{ $edu->name  }}</td>
				<td>{{ $edu->major  }}</td>
				<td>
					@if($edu->is_finish == 0)
						否
					@elseif($edu->is_finish == 1)
						是
					@endif
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
<div class="personal_show">
	<span>工作经历</span>
</div>
<div class="personal_row row">
	<table class="table table-bordered">
		<thead>
		<tr>
			<th>工作单位</th>
			<th>开始时间</th>
			<th>结束时间</th>
			<th>职位</th>
			<th>离职原因</th>
			<th>最终薪资（元）</th>
			<th>联系电话</th>
		</tr>
		</thead>
		<tbody>
		@foreach($archive->works ?? $archive->works as $work)
			<tr>
				<th>{{ $work->name }}</th>
				<td>{{ $work->start_at->toDateString() }}</td>
				<td>{{ $work->end_at->toDateString() }}</td>
				<td>{{ $work->position }}</td>
				<td>{{ $work->reason }}</td>
				<td>{{ $work->salary }}</td>
				<td>{{ $work->tel }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
<div class="personal_show">
	<span>奖惩记录</span>
</div>
<div class="personal_row row">
	<table class="table table-bordered">
		<thead>
		<tr>
			<th>奖惩类型</th>
			<th>执行时间</th>
			<th>记录名称</th>
			<th>备注</th>
		</tr>
		</thead>
		<tbody>
		@foreach($archive->sanctions ?? $archive->sanctions as $san)
			<tr>
				<th>
					@if($san->type == 0)
						奖励
					@elseif($san->type == 1)
						惩罚
					@elseif($san->type == 2)
						荣誉
					@endif
				</th>
				<td>{{ $san->execute_at->toDateString() }}</td>
				<td>{{ $san->name }}</td>
				<td>{{ $san->remark }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
<div class="personal_show">
	<span>岗位调整记录</span>
</div>
<div class="personal_row row">
	<table class="table table-bordered">
		<thead>
		<tr>
			<th>升迁类型</th>
			<th>调岗部门</th>
			<th>调岗职位</th>
			<th>调岗时间</th>
			<th>备注</th>
		</tr>
		</thead>
		<tbody>
		@foreach($archive->promotions ?? $archive->promotions as $pro)
			<tr>
				<th>
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
				</th>
				<td>{{ $pro->new_depart }}</td>
				<td>{{ $pro->new_offer }}</td>
				<td>{{ $pro->chang_at->toDateString() }}</td>
				<td>{{ $pro->remark }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>