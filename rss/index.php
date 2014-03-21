<?php
/**
 *  todo
 * */
require_once("../include/Rss.class.php");

$PAGE_TITLE = '订阅列表';
$rss = new Rss();
$rs = $rss->selectByType();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title><?php echo isset($PAGE_TITLE) ? $PAGE_TITLE : '';?></title>
<?php require_once('../style.php');?>

</head>
<body class="Container">
<?php require_once('../header.php');?>
<section class="module module-main module-large module-rss">
	<h2 class="module_title">订阅 rss</h2>
	<ul class="module_content list rss_list" id="rssList"></ul>
</section>
<?php require_once('../footer.php');?>

<script>var RSS_LIST = <?php echo isset($rs) ? json_encode( $rs ) : '[]';?>;</script>
<script data-main="../script/rss/index" src="../script/lib/require/require.js"></script>
</body>
</html>