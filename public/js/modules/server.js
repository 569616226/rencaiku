define([],function(){
    $.ajaxSetup({
        cache : false
    });
    return {
        //1.获取用户列表（从企业微信同步过来审核人），放到下拉搜索框中
        get_user_lists_modal :function(dom,name){
            $('#choose_spr_modal').on('show.bs.modal', centerModals);
            $(window).on('resize', centerModals);
            $("#choose_spr_modal").modal();
            $.get('/user/user_lists',function (data) {
                $("#selectpicker_spr").html(data.html);
                $("#choose_spr_modal .filter-option").html($("#selectpicker_spr option").eq(0).html());
                $('#selectpicker_spr').selectpicker({
                    liveSearch: true,
                    maxOptions: 1
                });
                btn_dom = dom
                dom_name = name
            });
        },
        //2.传user_id过去，请求个人信息
        get_user_msg: function (user_id,callback,name) {
        	if(name){
	            $.get('/user/data/'+ user_id+'/'+name,function(data){
	                callback(data);
	            });
        	}else{
        		$.get('/user/data/'+ user_id,function(data){
	                callback(data);
	            });
        	}
        },
        //3.传第一审核人和最终审核人的id过去，保存选择的这两个人
        save_setting_user: function (url,postData,callBack) {
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
                    callBack(data);
                },
                error: function (data) {
                    console.log(data);
                    console.log('跳入了error');
                }
            });
        },
        //4.请求同步申请单
         get_examine_sync : function() {
            $('.fakeloader').fadeIn(100);
            $.ajax({
                url:"/examine/sync",
                type: "get",
                dataType: "json",
                timeout:180000,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                async: true,
                success: function (data) {
                    $('.fakeloader').fadeOut(100);
                    layer.msg(data.msg);
                    if(data.status === 1){
                        setTimeout(function () {
                            window.location.reload();
                        },1000);
                    }else {
                        layer.msg(data.msg);
                    }
                },
                error: function (xhr,status,error) {
                    console.log(xhr)
                    console.log(status)
                    console.log('失败原因' + error)
                    $('.fakeloader').fadeOut(100);
                    layer.msg('哎呦，网络开了小差。是否重新同步吗？', {
                        time: 0 //不自动关闭
                        ,btn: ['重新同步', '稍后再试']
                        ,yes: function(index){
                            layer.close(index);
                            get_examine_sync()
                        }
                    });
                }
            });
        },
         //5.完成提醒
        fansh_msg: function (id,callBack) {
            $.ajax({
                url:'/archive/'+ id +'/complate',
                type: "get",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                async: true,
                success: function (data) {
                    callBack(data);
                },
                error: function (data) {
                    console.log(data);
                    console.log('跳入了error');
                }
            });
        },
    }
});





//例子
// createitem :function(data,callback){
//     alert(data);
//     callback();
// },
