<?php
require_once('../include/Config.inc.php');
/**
 */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>个人资料</title>
<?php require_once('../style.php');?>
<style>
.module-profile{height:150px;}
</style>
</head>
<body>
<div id="Container" class="Container">
<?php require_once('../header.php');?>
    <section class="module module-large module-profile">
		<h2 class="module_title">个人档案</h2>

		<div class="module_content">
			<div id="charts"></div>
		</div>
    </section>
<?php require_once('../footer.php');?>
</div>

<script src="../script/lib/jQuery/jquery.min.js"></script>
<script src="../script/plugin/highcharts/highcharts.js"></script>
<script src="../script/plugin/highcharts/highcharts-more.js"></script>
<script src="../script/plugin/highcharts/modules/exporting.js"></script>
<script>
//$(function(){
//    var curr = 0,
//        section = $('section'),
//        sum = section.length;
//    $(document).on('click', 'section>h1', function(){
//        var self = section.has(this);
//        if( !self.hasClass('show') ){console.log(curr);
//            section.eq(curr).toggleClass('show');
//            curr = section.index(self);
//            self.toggleClass('show');
//        }
//        else{
//            self.toggleClass('show');
//            curr = (curr+1)%sum;
//            section.eq(curr).toggleClass('show');
//        }
//    });
//});
$(function () {
	$('#charts').highcharts({
		chart: {
			polar: true,
			type: 'area'    // area 区域
		},
		title: {
			text: '前端开发技能战斗力：',
			x: -80
		},
		credits: {	// 右下角网站 logo
			enabled: false
		},
		exporting:{	// 右上角扩展按钮
			enabled:false
		},
		pane: {
			size: '80%'
		},
		xAxis: {
			categories: ['HTML(5)', 'CSS(3)', 'JavaScript', 'Node.js',
				'设计', '创意'],
			tickmarkPlacement: 'on',
			lineWidth: 0
		},
		yAxis: {
			gridLineInterpolation: 'polygon',
			lineWidth: 0,
			min: 0
		},
		tooltip: {
			shared: true,
			pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
		},
		legend: {
			align: 'right',
			verticalAlign: 'top',
			y: 70,
			layout: 'vertical'
		},
		series: [{
			name: '战斗力',
			data: [9, 8, 8, 6, 5, 8],
			pointPlacement: 'on'
		}]
	});
});
</script>
</body>
</html>