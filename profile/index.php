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
#cloudTag span{
	float: left; margin: 5px;
	padding: 0 10px;
	color: #2ecc71;
	}
</style>
</head>
<body class="Container">
<?php require_once('../header.php');?>
<section class="module large module-main module-profile" id="profile">
	<h2 class="module_title">个人资料 profile</h2>

	<div class="module_content">
		<section class="profile_section section">
			<h3 class="section_title">基础资料
			    <span class="icon-CSS icon-minus"></span>
			</h3>

			<div class="" id="cloudTag" style="background: #fff; padding: 5px 10px 10px 5px; margin-bottom: -10px;overflow: hidden;
	color: #2ecc71;">
<!--				<span>-->
					<img style="float: left;margin: 5px;" src="../image/upload/1.jpg" width="180" height="180" alt="头像" />
<!--				</span>-->
<!--				<div id="avaterImg" class="cloudTags">-->
<!---->
<!--				</div>-->
				<span id="nickname" class="cloudTags code">十甫寸</span>
				<span id="sex" class="cloudTags code">男</span>
				<span id="email" class="cloudTags code">zw150026@163.com</span>
				<span id="age" class="cloudTags code">28</span>
<!--				<span id="birthday" class="cloudTags code">1986-11-07</span>-->
<!--				<span id="lv" class="cloudTags code">Lv.10</span>-->
				<span id="star" class="cloudTags code">天蝎座</span>
				<span id="blood" class="cloudTags code">O 型血</span>
				<span id="profession" class="cloudTags code">Web 前端工程师</span>
				<span class="cloudTags code">本科</span>
				<span class="cloudTags code">大连民族学院</span>
<!--				<div id="maxim" class="cloudTags" style="width:300px;">-->
<!--					和设计师一样细腻，和程序员一样严谨；游走在设计师和工程师之间，游刃于用户体验和技术实现之间，斡旋在用户利益和商业利益之间。-->
<!--				</div>-->
				<span class="cloudTags code">生于黑龙江哈尔滨</span>
				<span class="cloudTags code">现居辽宁大连</span>
			</div>
		</section>
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