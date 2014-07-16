<?php
/**
 *  首页
 */
require_once('include/Config.inc.php');
ini_set('date.timezone','Asia/Shanghai');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>个人小站（开发测试中...）</title>
<?php require_once('style.php');?>
</head>
<body class="Container index">
<?php require_once('header.php');?>

<a href="blog/">
    <section class="module module-metro big module-blog">
        <h2 class="module_title">
			博客 blog
		</h2>
        <span class="module_info"></span>
    </section>
</a>

<a href="profile/">
    <section class="module module-metro tiny module-user">
        <h2 class="module_title">
			我 me
		</h2>
    </section>
</a>

    <section class="module module-metro tiny module-watch">
        <h2 class="module_title">
			时间 time
		</h2>
        <div class="watch_wrap hidden" id="watch">
            <span class="watch_hourHand" id="hourHand"></span>
            <span class="watch_minuteHand" id="minuteHand"></span>
            <span class="watch_secondHand" id="secondHand"></span>
            <span class="watch_mark watch_mark-1"></span>
            <span class="watch_mark watch_mark-2"></span>
            <span class="watch_mark watch_mark-3"></span>
            <span class="watch_mark watch_mark-4"></span>
            <span class="watch_mark watch_mark-5"></span>
            <span class="watch_mark watch_mark-6"></span>
            <span class="watch_mark watch_mark-7"></span>
            <span class="watch_mark watch_mark-8"></span>
            <span class="watch_mark watch_mark-9"></span>
            <span class="watch_mark watch_mark-10"></span>
            <span class="watch_mark watch_mark-11"></span>
            <span class="watch_mark watch_mark-12"></span>
        </div>
    </section>

<!--<a href="calendar/">-->
    <section class="module module-metro small module-calendar" id="calendar">
        <h2 class="module_title">
			日历 calendar
		</h2>
        <span class="module_info"><?php echo date('Y');?> 年 <?php echo date('m');?> 月</span>
        <div class="calendar_today"><?php echo date('d');?></div>
    </section>
<!--</a>-->

	<section class="module module-metro small module-weather" id="weather">
		<h2 class="module_title">
			天气预报 weather
		</h2>
		<span class="module_info"></span>
	</section>

<a href="document/">
	<section class="module module-metro small module-document">
		<h2 class="module_title">
			前端文档 document
		</h2>
	</section>
</a>

<a href="editor/">
    <section class="module module-metro small module-editor">
        <h2 class="module_title">
			编辑器 editor
		</h2>
        <span class="module_info"></span>
    </section>
</a>

<a href="favorite">
	<section class="module module-metro normal module-favor">
		<h2 class="module_title">
			收藏夹 favorite
		</h2>
	</section>
</a>

<a href="palette/">
	<section class="module module-metro small module-palette">
		<h2 class="module_title">
			调色板 palette
		</h2>
	</section>
</a>

<a href="rss/">
	<section class="module module-metro normal module-rss">
		<h2 class="module_title">
			订阅 rss
		</h2>
	</section>
</a>

<!--
<a href="timeLine/">
    <section class="module module-metro small module-timeLine">
        <h2 class="module_title">时光轴 timeLine</h2>
    </section>
</a>
-->
<!--
    <section class="module module-metro tiny module-music">
        <h2 class="module_title">音乐 music</h2>
        <span class="module_info"></span>
    </section>
-->
<!--
    <section class="module module-metro tiny module-picture">
        <h2 class="module_title">相册 album</h2>
        <span class="module_info"></span>
        <img src="" alt="" />
    </section>
-->
<!--    <section class="module module-metro tiny module-rss"></section>-->
<!--    <section class="module module-metro tiny module-mail"></section>-->
<!--
    <section class="module module-metro tiny module-news">
        <h2 class="module_title">新闻 news</h2>
        <span class="module_info">123</span>
    </section>
-->
<!--    <section class="module module-metro tiny module-market"></section>-->
<?php require_once('footer.php');?>
<script data-main="script/index" src="script/lib/require/require.js"></script>
</body>
</html>