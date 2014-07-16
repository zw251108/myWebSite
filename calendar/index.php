<?php
/**
 *
 */
require_once('../include/Config.inc.php');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>小站</title>
<?php require_once('../style.php');?>
</head>
<body class="Container">
<?php require_once('../header.php');?>

<section class="module module-main large module-calendar">
	<h2 class="module_title">日历 calendar</h2>

	<div class="module_content calendar_main" id="calendarMain">
		<ul class="week">
			<li class="allWeek"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
		</ul>
		<ul class="week">
			<li class="allWeek"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
		</ul>
		<ul class="week">
			<li class="allWeek"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
		</ul>
		<ul class="week">
			<li class="allWeek"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
		</ul>
		<ul class="week">
			<li class="allWeek"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
		</ul>
		<ul class="week">
			<li class="allWeek"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
			<li class="day"></li>
		</ul>
	</div>
</section>

<section class="module module-popup normal hidden"></section>

<?php require_once( '../footer.php');?>

<script>

</script>
<script data-main="../script/calendar/index" src="../script/lib/require/require.js"></script>
</body>
</html>