MODULE_CONFIG.shim.highcharts = shim;
MODULE_CONFIG.paths.highcharts = '../plugin/highcharts/highcharts';
MODULE_CONFIG.shim.highchartsMore = ['highcharts'];
MODULE_CONFIG.paths.highchartsMore = '../plugin/highcharts/highcharts-more';
MODULE_CONFIG.shim.highchartsExporting = ['highcharts'];
MODULE_CONFIG.paths.highchartsExporting = '../plugin/highcharts/modules/exporting';
MODULE_CONFIG.shim.timeLine = shim;
MODULE_CONFIG.paths.timeLine = '../ui/jquery.timeLine';
require.config(MODULE_CONFIG);
require(['jquery', 'global', 'highcharts', 'highchartsMore', 'highchartsExporting', 'timeLine'], function($, g){

	$('.timeLine_event-left').css('left', '+=20px').find('.timeLine_event_time').html('').css({width:'auto',height:'auto'})
	$('.timeLine_event-right').css('left', '-=20px').find('.timeLine_event_time').html('').css({width:'auto',height:'auto'})

	$('<style>' +
		'.timeLine_event-left .timeLine_event_time:before{content:"";position:absolute;top:0;right:40px;width:0;height:0;border:10px solid #3498db;border-radius:50%;}' +
		'.timeLine_event-left .timeLine_event_time:after{content:"";position:absolute;left:-70px;width:0;height:0;border:10px solid transparent;border-left-color:#3498db;}' +
		'.timeLine_event-right .timeLine_event_time:before{content:"";position:absolute;top:0;left:40px;width:0;height:0;border:10px solid #3498db;border-radius:50%;}' +
		'.timeLine_event-right .timeLine_event_time:after{content:"";position:absolute;right:-70px;width:0;height:0;border:10px solid transparent;border-right-color:#3498db;}' +
		'</style>').appendTo('head');
//		.hide()
//		.end().append('<span class="timeLine_time"></span>')
//			.find('.timeLine_time')

//		.css({
//			border: '10px solid transparent'
//			, 'border-left-color': '#3498db'
//			, width: 0
//			, height: 0
//			, position: 'absolute'
//			, 'top': '10px'
//			, right: '-20px'
//			, left: 'auto'
//		});
//		.hide()
//		.end().append('<span class="timeLine_time"></span>')
//			.find('.timeLine_time')

//		.css({
//			border: '10px solid transparent'
//			, 'border-right-color': '#3498db'
//			, width: 0
//			, height: 0
//			, position: 'absolute'
//			, 'top': '10px'
//			, left: '-20px'
//			, right: 'auto'
//		});

	/**
	 * 个人能力
	 * */
	$('#basicAttr').highcharts({    // 基础能力图表
		chart: {
			polar: true
			, type: 'area'
		}
		, title: {
			text: '基础能力：'
			, x: -80
		}
		, credits: {	// 右下角网站 logo
			enabled: false
		}
		, exporting:{	// 右上角扩展按钮
			enabled:false
		}
		, pane: {
			size: '80%'
		}
		, xAxis: {
			categories: ['学习能力', '创意', '团队协作', '应变能力', '责任心', '耐心']
			, tickmarkPlacement: 'on'
			, lineWidth: 0
		}
		, yAxis: {
			gridLineInterpolation: 'polygon'
			, lineWidth: 0
			, min: 0
		}
		, tooltip: {
			shared: true
			, pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b></span>'
		}
		, legend: {
			align: 'right'
			, verticalAlign: 'top'
			, y: 70
			, layout: 'vertical'
		}
		, series: [{
			name: '战斗力'
			, data: [9, 7, 9, 7, 8, 8]
			, pointPlacement: 'on'
		}]
	});
	$('#professionAttr').highcharts({   // 职业能力图表
		chart: {
			polar: true
			, type: 'area'    // area 区域
		}
		, title: {
			text: '职业能力：'
			, x: -80
		}
		, credits: {	// 右下角网站 logo
			enabled: false
		}
		, exporting:{	// 右上角扩展按钮
			enabled:false
		}
		, pane: {
			size: '80%'
		}
		, xAxis: {
			categories: ['HTML(5)', 'CSS(3)', 'JavaScript', 'Node.js', '设计能力', '用户体验']
			, tickmarkPlacement: 'on'
			, lineWidth: 0
		}
		, yAxis: {
			gridLineInterpolation: 'polygon'
			, lineWidth: 0
			, min: 0
		}
		, tooltip: {
			shared: true
			, pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b></span>'
		}
		, legend: {
			align: 'right'
			, verticalAlign: 'top'
			, y: 70
			, layout: 'vertical'
		}
		, series: [{
			name: '战斗力'
			, data: [9, 8, 9, 7, 5, 6]
			, pointPlacement: 'on'
		}]
	});

	/**
	 * 职业经历
	 * */
	$.timeLine({    // 时间轴
		container: '#timeLine'
		, interval: 'month'
		, data: [{
			date: '2013.04'
			, title: '德辉科技（大连）有限公司'
			, content: '<p>2013.04 - 现在&nbsp;&nbsp;任职：Web 前端工程师</p><p>主要负责前端 UI 开发，改善用户体验。</p>'
		}, {
			date: '2012.03'
			, title: '中科海云网络科技（大连）有限公司'
			, content: '<p>2012.03 - 2013.04&nbsp;&nbsp;任职：Web 前端工程师</p><p>参与开发了 IM 系统，后台信息管理系统。</p>'
		}, {
			date:'2009.10'
			, title:'大连网景科技有限公司'
			, content: '<p>2009.10 - 2012.01&nbsp;&nbsp;任职：开发工程师</p><p>主要使用 PHP 和 JavaScript 对 CMS 系统进行二次开发。</p>'
//		}, {
//			date:'2009-06'
//			, title:'大连民族学院'
//			, content:'2009.06 毕业于大连民族学院，软件工程专业，对计算机进行了系统的学习，做了几个自己有兴趣的项目'
		}]
	});
});