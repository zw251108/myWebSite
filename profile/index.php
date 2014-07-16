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
/*text{font-family: Consolas, \5b8b\4f53;}*/
</style>
</head>
<body class="Container">
<?php require_once('../header.php');?>
<section class="module large module-main module-profile" id="profile">
	<h2 class="module_title">个人资料 profile</h2>

	<div class="module_content">
		<section class="profile_section section">
			<h3 class="section_title">个人能力
				<span class="icon-CSS icon-minus"></span>
			</h3>

			<div class="profile_chart" id="basicAttr"></div>

			<div class="profile_chart" id="professionAttr"></div>
		</section>
		<section class="profile_section section">
			<h3 class="section_title">职业经历
				<span class="icon-CSS icon-minus"></span>
			</h3>

			<div class="profile_timeLine" id="timeLine"></div>
		</section>
	</div>
</section>

<?php require_once('../footer.php');?>

<script data-main="../script/profile/index" src="../script/lib/require/require.js"></script>
</body>
</html>