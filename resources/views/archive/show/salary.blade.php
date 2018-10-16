<div class="personal_show">
	<span>薪资调整记录</span>
</div>
<div class="personal_row row">

	<table class="table table-bordered">
        <thead>
        	<tr>
            	{{-- <th>调整前薪资（元）</th>
            	<th>调整后薪资（元）</th>
            	<th>开始时间</th>
            	<th>备注</th> --}}
              <th>薪资状态</th>
              <th>基本工资（元）</th>
              <th>绩效</th>
              <th>合计（元）</th>
              <th>生效时间</th>
              <th>备注</th>
        	</tr>
      	</thead>
        @if($archive->salaries)
      	<tbody>
            @foreach($archive->salaries as $salary)
                <tr>
                    <td>
              @if( $salary->status == 0)
                    入职
              @elseif( $salary->status == 1)
                    转正
              @elseif( $salary->status == 2)
                    加薪
              @elseif( $salary->status == 3)
                    减薪
              @endif
            </td>
            <td>{{ $salary->basic }}</td>
            <td>{{ $salary->added }}</td>
            <td>{{ $salary->total }}</td>
                    <th>{{ $salary->start_at->toDateString() }}</th>
                    <td>{{ $salary->remark }}</td>
                </tr>
            @endforeach
      	</tbody>
        @endif
    </table>
</div>