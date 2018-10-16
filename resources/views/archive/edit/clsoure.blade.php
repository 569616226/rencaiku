@extends('layouts.app')
<!--中间内容区域-->
@section('content')
<div class="container container-responsive">
	 
	<div class="row" style="background: #ffffff;">
        <div class="archiveMenu">
            <nav class="navbar navbar-default hr-nav" style="border: none">
                <!--<div class="container">-->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav flex" style="float: none; border-bottom: 1px solid #BBBBBB;">
                        <li class="{{ active_class(if_route('archive.edit')) }}">
                            <a href="{{ route('archive.edit',[$archive->id]) }}" ><span><i class="iconfont">&#xe605;</i>个人信息</span></a>
                        </li>
                        @include('_parties.edit_archive_menu')
                    </ul>
                </div>

                <!--</div>-->
            </nav>
        </div>

        {!! Form::open(['url'=>route('archive.clsoure.upload',[$archive->id]),'files'=>true,'id'=>'clsoureForm']) !!}
        {!! Form::file('clsoure',['class'=>'avatar hide','id'=>'clsoure']) !!}
        {!! Form::close() !!}

		 <form class="form-horizontal margin-top add-order-form padding-top-lg" id="add_form" style="padding-left: 4rem;padding-right: 4rem;">
            {{-- 附件 --}}
            <div class="row margin-left-lg margin-right-lg ">
                <div class="padding-bottom" style="">
                     <a href="javascript:void(0);" class="btn btn-primary" id="uploadClsoure">上传附件</a>
                     <a href="/archive/on" class="btn btn-default">返回列表</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>文件名</th>
                                <th>上传者</th>
                                <th>上传时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        @if($archive->clsoures)
                        <tbody id="clsoureMain">
                            @foreach($archive->clsoures  as $clsoure)
                            <tr class="">
                            	<td>
                            		<span>{{ $clsoure->name }}</span>
                            	</td>
                            	<td>
                            		<span>{{ $clsoure->uploader }}</span>
                            	</td>
                            	<td>
                            		<time>{{ $clsoure->created_at->toDateString() }}</time>
                            	</td>
                            	<td>
                            		<a href="{{ url('/archive/clsoure/'.$clsoure->id.'/download') }}" target="_blank" class="btn btn-primary">下载</a>
                     				<a href="javascript:void(0);" class="btn btn-default destory" data-destory="{{ $clsoure->id }}">删除</a>
                            	</td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
         </form>
	</div>
</div>
 
    
<style type="text/css">
	.add-order-form .control-label {
		color: #101010;
	}
    .table>tbody>tr.main>td {
        border-top: none;
    }
    .afterboottom3 .table {
        border-bottom: none;
    }
    .table tbody tr td{
            vertical-align: middle;
        }
</style>
@endsection

@section('javascript')
	@parent
	<script>
		require(['bootstrap','dataimepicker','DataTable','layer','validform','ztree','jcrop','form'], function (DataTable) {

            /*上传附件*/
            $("#uploadClsoure").click(function () {
                $("#clsoure").click();
            });
            $(document).ready(function() {
                var options = {
                	beforeSubmit:  showRequest,
                    success:       showResponse,
                    dataType: 'json'
                };
                $('#clsoure').on('change', function(){
                    $('#clsoureForm').ajaxForm(options).submit();
                });
            });
            
            function showResponse(response){
            	if(response.status == true){
            		layer.msg(response.msg);
            		window.setTimeout(function(){
            			location.reload();
            		},1000);
            	}else if(response.status == false){
            		layer.msg(response.msg);
            	}
            }
            function showRequest() {
                $("#validation-errors").hide().empty();
                $("#output").css('display','none');
                return true;
            }
            $(".destory").on('click',function(){
            	let id = $(this).attr("data-destory")
            	let url = '/archive/clsoure/' + id + '/destory'
            	layer.msg('确定删除吗？', {
                    time: 0 //不自动关闭
                    ,btn: ['确定', '取消']
                    ,yes: function(){
						Ajaxget(url,showResponse)
                    }
                });
            })
// -------------------------------------------------------------------------------------------------------------------------------------


             $("#add_form").Validform({
                tiptype: function (msgs, o, cssctl) {
                    if (o.type != 2) {     //只有不正确的时候才出发提示，输入正确不提示
                        layer.msg(msgs);
                    }
                },
                ajaxPost: true,//true用ajax提交，false用form方式提交
                tipSweep: true,//true只在提交表单的时候开始验证，false每输入完一个输入框之后就开始验证
                beforeSubmit: function (curform) {
                    $('.fakeloader').fadeIn(100);
                    //给时间添加上秒的格式
                    var postData = {};
                    postData = GetWebControls('#add_form');
                    var url = '/subscribe/'+ examine_id +'/store';
                        $.ajax({
                            url:url,
                            type: "post",
                            data: postData,
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            async: true,
                            success: function (data) {
                                if(data.status === 1){
                                    $('.fakeloader').fadeOut(100);
                                    layer.msg(data.msg);
                                    setTimeout(function () {
                                        window.location.href = '/subscribe';
                                    },1000);

                                }else {
                                    $('.fakeloader').fadeOut(100);
                                    layer.msg(data.msg);
                                }
                            },
                            error: function (xhr,status,error) {
                                console.log(xhr);
                                console.log(status);
                                console.log(error);
                                $('.fakeloader').fadeOut(100);
                                layer.msg('网络开了小差，请重新提交');
                                if(error == 'Gateway Time-out'){
                                    setTimeout(function () {
                                        window.location.reload();
                                    },1000);
                                }
                            }
                        });
                    return false;
                }
            });



		})
	</script>
@endsection