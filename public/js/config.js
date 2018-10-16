/**
 * 前端模块配置
 */
require.config({
    baseUrl: '/js',
    paths: {
    	'jquery':'jquery',
    	'bootstrap':'bootstrap.min',
    	'css': 'css/css.min',
        //icheck复选框，单选框
        'icheck':'icheck/icheck',
        //加载动画
        'loading':'loading/PerfectLoad',
        //下拉搜索框
        'select_search':'searchableSelect/jquery.searchableSelect',
        //富文本
       'wangEditor':'wangEditor/wangEditor.min',   //使用手册 https://www.kancloud.cn/wangfupeng/wangeditor3/332599
        //表单验证
        'validform':'validform/js/Validform_v5.3.2_min',
        'validform_Dtaatype':'validform/js/Validform_Datatype',
        //弹出框
        'layer':'layer/layer',
        //时间选择器
        'dataimepicker':'bootstrap-datetimepicker/js/bootstrap-datetimepicker',
        //树形组件
        'ztree':'ztree/js/jquery.ztree.all.min',
		//表格
        'DataTable':'datatables/dataTables-bootstrap',
        //下拉选框
        'bootstrap-select':'bootstrap-select/js/bootstrap-select.min',
		//上传插件
        'uploadifive':'uploadifive/jquery.uploadifive',
        // 裁剪图片
        'jcrop':'plugins/jquery.Jcrop.min',
         // form
        'form':'plugins/jquery.form',
        // server
        'server':'modules/server'

    },
    shim: {
    	'bootstrap':{
            exports: '$',
            deps: ['jquery']
		},
    	'icheck': {
    		deps: ['css!../js/icheck/skins/icheck-all']
    	},
		'select_search': {
			deps: ['css!../js/searchableSelect/jquery.searchableSelect']
		},
		'validform':{
			deps: ['css!../js/validform/css/validform','validform_Dtaatype']
		},
		'layer':{
			deps: ['css!../js/layer/skin/default/layer']
		},
		'dataimepicker':{
			deps: ['css!../js/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min','css!https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css']
		},
		'ztree':{
			exports: '',
			deps: ['jquery','css!../js/ztree/css/zTreeStyle/zTreeStyle','css!../js/ztree/css/zTreeStyle/tree_1']
		},
		'DataTable':{
			deps: ['bootstrap','css!../js/datatables/jquery.dataTables','datatables/jquery.dataTables.min','css!../js/datatables/table']
		},
        'bootstrap-select':{
            deps: ['bootstrap','css!../js/bootstrap-select/css/bootstrap-select.min']
        },
		'uploadifive': {
            deps: ['css!../js/uploadifive/uploadifive']
		},
        'jcrop': {
            deps: ['form','css!../js/plugins/jquery.Jcrop']
        }
    }
});







