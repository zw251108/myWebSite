<?php
require_once('../include/Config.inc.php');
/**
 *  todo
 * */
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>timeLine 时间轴插件（测试版） demo</title>
<?php require_once('../style.php');?>
</head>
<body>
<div class="Container" id="Container">
<?php require_once('../header.php');?>
    <div id="timeLine" class="module module-large module-timeLine">
        <h1 class="module_title">时光轴</h1>
    </div>
<?php require_once('../footer.php');?>
</div>
<script type="text/javascript" src="../script/lib/jQuery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../script/ui/jquery.timeLine.js"></script>
<script type="text/javascript">
$(function(){
    var $timeLine = $.timeLine({
        container:'#timeLine',
//        startTime:new Date(2012, 11, 13),
//        endTime:new Date(),
//        interval:'month',
//        order:true,
//        areaTmpl:function(){
//
//        },
//        eventTmpl:function(data, position){
//
//        },
        left:85,
        right:5,
        marginBottom:65,
        colWidth:90,
        lineHeight:10,
        showLine:true,
        data:[
            {date:'2013-04', title:'德辉科技（大连）有限公司', content:'任职 Web 前端工程师'},
            {date:'2012-03', title:'中科海云网络科技（大连）有限公司', content:'任职 Web 前端工程师，参与开发了 IM 系统。'},
            {date:'2009-10', title:'大连网景科技有限公司', content:'从事网站建设'},
            {date:'2009-06', title:'大连民族学院', content:'2009-06 毕业于大连民族学院，软件工程专业，对计算机进行了系统的学习，做了几个自己有兴趣的项目'}
        ]
    });

    var fillZero = function(num){
        return $.number.fillZero(num, 2);
    };
//    var order = true;
//    $('#order').on('click', function(){
//        //order = !order;
//        $timeLine.refresh();
//    });
//    $('#addNow').on('click', function(){
//        var date = new Date();
//        var y = date.getFullYear(),
//                m = fillZero( date.getMonth()+1 ),
//                d = fillZero( date.getDate()),
//                h = fillZero( date.getHours()),
//                min = fillZero( date.getMinutes()),
//                s = fillZero( date.getSeconds() );
//        var a = y+'-'+m+'-'+d+' '+h+':'+min+':'+s;
//        $timeLine.addEvent({date:a, title:a, content:'阿斯顿发撒旦法撒旦阿斯顿发撒旦法撒旦阿斯顿发撒旦法撒旦阿斯顿发撒旦法撒旦阿斯顿发撒旦法撒旦阿斯顿发撒旦法撒旦'});
//    });
//    $('#addRandom').on('click', function(){
//        var date = new Date();
//        date = new Date(date.getTime() - Math.floor(31536000000*Math.random()));
//        var y = date.getFullYear(),
//                m = fillZero( date.getMonth()+1 ),
//                d = fillZero( date.getDate()),
//                h = fillZero( date.getHours()),
//                min = fillZero( date.getMinutes()),
//                s = fillZero( date.getSeconds() );
//        var a = y+'-'+m+'-'+d+' '+h+':'+min+':'+s;
//        $timeLine.addEvent({date:a, title:a, content:'jkhkjhhjkhjkh'});
//    });
});
</script>
</body>
</html>