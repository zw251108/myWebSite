<?php
require_once('../include/Config.inc.php');

session_destroy();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title>退出登录</title>
<link rel="stylesheet" href="../style/style.css"/>
<style>
.logoutBox{
	position: absolute;
	bottom: 0;
	left: 0;
	right: 0;
	top: 0;

	height: 200px;
	width: 300px;

	border: 5px solid #C0C0C0;
	margin: auto;
	background: #efefef;
}
</style>
</head>
<body>
<div class="logoutBox">
	<p>您已退出登录</p>
</div>
</body>
</html>