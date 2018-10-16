$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//普通post请求
function AjaxJson(url, postData, callBack) {
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
}
//普通get请求
function Ajaxget(url, callBack) {
    $.ajax({
        url:url,
        type: "get",
        // data: postData,
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
}
//删除数据请求方法
function Ajaxdelete(url, postData, callBack) {
    $.ajax({
        url:url,
        type: "get",
        data: postData,
        dataType: "json",
        async: true,
        success: function (data) {
            callBack(data);
        },
        error: function (data) {
            console.log(data);
            console.log('跳入了error');
        }
    });
}
//上传请求
function Ajaxupload(url,postData,callBack) {
    $.ajax({
        url:url,
        type:'POST',
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data:postData,
        cache: false,
        contentType: false,		//不可缺参数
        processData: false,		//不可缺参数
        success:function(data){
            callBack(data)
        },
        error:function(){
            alert('上传出错');

        }
    });
};
//获取地址栏参数
function GetQuery(key) {
    var search = location.search.slice(1); //得到get方式提交的查询字符串
    var arr = search.split("&");
    for (var i = 0; i < arr.length; i++) {
        var ar = arr[i].split("=");
        if (ar[0] == key) {
            if (unescape(ar[1]) == 'undefined') {
                return "";
            } else {
                return unescape(ar[1]);
            }
        }
    }
    return "";
}
//获取已经勾选上的复选框的值  name: 复选框的name值   返回一段以数组
function CheckboxValshu(name) {
    var reVal = [];
    $("input[name =" + name + "]:checked").each(function () {
        reVal.push($(this).val())
    });
    return reVal;
}
//判断设备代码
//url------如果是移动设备就跳转到对应的地址
function mobile_device_detect(url){
    var thisOS=navigator.platform;
    var os=new Array("iPhone","iPod","iPad","android","Nokia","SymbianOS","Symbian","Windows Phone","Phone","Linux armv71","MAUI","UNTRUSTED/1.0","Windows CE","BlackBerry","IEMobile");
    for(var i=0;i<os.length;i++){
        if(thisOS.match(os[i])){
            window.location=url;
        }
    }
    if(navigator.platform.indexOf('iPad') != -1){
        window.location=url;
    }
    var check = navigator.appVersion;
    if( check.match(/linux/i) ){
        if(check.match(/mobile/i) || check.match(/X11/i)) {
            window.location=url;
        }
    }
    Array.prototype.in_array = function(e){
        for(i=0;i<this.length;i++){
            if(this[i] == e)
                return true;
        }
        return false;
    }
}
// 自动获取页面控件值
function GetWebControls(element) {
    var reVal = "";
    $(element).find('input,textarea,select').each(function (r) {
        var name = $(this).attr('name');
        var value = $(this).val();
        if(name){
            reVal += '"' + name + '"' + ':' + '"' + $.trim(value) + '",'
        }
    });
    reVal = reVal.substr(0, reVal.length - 1);
    return jQuery.parseJSON('{' + reVal + '}');
}
// 自动给控件赋值
function SetWebControlshtml(data) {
    for (var key in data) {
        var id = $('#' + key);
        var value = $.trim(data[key]);
        id.html(value =='' ? value='&nbsp': value = value);
    }}
//Json拼接
function JsonInsert(json1, json2) {
    var a = json1;
    var b = json2;
    for (var tem in b) {
        a[tem] = b[tem];
    }
    return a;
}
function hiddenboxValshu(name) {
    var reVal = [];
    $("input[name =" + name + "]").each(function () {
        reVal.push($(this).val())
    });
    return reVal;
}
//模态框居中
function centerModals(){
    $('.modal').each(function(i){
        var $clone = $(this).clone().css('display', 'block').appendTo('body');
        var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
        top = top > 50 ? top : 0;
        $clone.remove();
        $(this).find('.modal-content').css("margin-top", top-50);
    });
}
//获取当前时间
function getNowFormatDate() {
    var date = new Date();
    var seperator1 = "-";
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var strDate = date.getDate();
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    var currentdate = year + seperator1 + month + seperator1 + strDate;
    return currentdate;
}
//禁止输入空格
function space_val(){
	if(event.keyCode == 32)event.returnValue = false;
}
//只能输入数字、字母
function number_letter(value,ele){
	value=value.replace(/[^\w\.\/]/ig,'')
	ele.val(value)
}
//只能输入数字
function number(value,ele){
	value=value.replace(/[^0-9]/g,'')
	ele.val(value)
}
//只能输入数字和横杠
function number_h(value,ele){
	value=value.replace(/[^0-9\-]/g,'')
	ele.val(value)
}
//  /转换成-
function convert(value,ele){
	value=value.replace(/[\/]/g,'-')
	ele.val(value)
}
// 去空格
function trim(s) { 
	return s.replace(/^\s+|\s+$/g, ""); 
}
// 身份证提取生日
function getBirthdatByIdNo(iIdNo) {
	var tmpStr = "";
	var idDate = "";
	var tmpInt = 0;
	var strReturn = "";
	
	iIdNo = trim(iIdNo);
	
	if ((iIdNo.length != 15) && (iIdNo.length != 18)) {
		strReturn = "输入的身份证号位数错误";
		return strReturn;
	}
	
	if (iIdNo.length == 15) {
		tmpStr = iIdNo.substring(6, 12);
		tmpStr = "19" + tmpStr;
		tmpStr = tmpStr.substring(0, 4) + "-" + tmpStr.substring(4, 6) + "-" + tmpStr.substring(6)
		
		return tmpStr;
	}
	else {
		tmpStr = iIdNo.substring(6, 14);
		tmpStr = tmpStr.substring(0, 4) + "-" + tmpStr.substring(4, 6) + "-" + tmpStr.substring(6)
		
		return tmpStr;
	}
}
// 身份证提取生日插入生日input
function check_birthday(dom){
	$("#birthday").val(getBirthdatByIdNo(dom.val()))
}
// 在需要的地方调用
// 在模态框出现的时候调用垂直居中函数
// $('.modal').on('show.bs.modal', centerModals);
// 在窗口大小改变的时候调用垂直居中函数
// $(window).on('resize', centerModals);