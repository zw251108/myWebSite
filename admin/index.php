<?php
require_once('../include/Message.class.php');
/**
 *
 */
$msg = new Message();
$rs = $msg->selectAll();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="shortcut icon" type="image/x-icon" href="../image/ten.ico"/>
<title></title>
<style type="text/css">
body{
    overflow: hidden;
    border: 0;
    margin: 0;
    padding: 0;

	font-family: "Consolas",Monaco,Andale,monospace;
}
aside{
	position: fixed;

	bottom: 0;
	left: 0;
	top: 0;

	width: 195px;

	border-right: 5px solid #c0c0c0;
}
h2{
    text-align:center;
}
.main{
	position: fixed;

	bottom: 0;
	left: 200px;
	right: 0;
	top: 0;

    border: none;
    margin: 0;
    padding: 0;
}
</style>
</head>
<body>
<h1 style="display: none;">后台管理系统</h1>
<aside>
    <h2>模块导航</h2>
    <ul>
        <li><a href="message.php" target="content">消息</a></li>
        <li><a href="palette.php" target="content">颜色库</a></li>
        <li><a href="tag.php" target="content">标签库</a></li>
    </ul>
</aside>
<iframe class="main" src="message.php" name="content"></iframe>
<script src="../script/lib/jQuery/jquery.min.js"></script>
<script>
$(function(){
    var doc = document.documentElement
		, h
		, w
		, $iframe = $('iframe')
		, resize = function(){
			var h = doc.clientHeight
				, w = doc.clientWidth
				;
			$iframe.height(h).width(w -200);
		}
		;

	resize();
	$(window).on('resize', resize);
});
</script>
</body>
</html>