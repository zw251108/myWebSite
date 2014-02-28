<?php
require_once('../include/Blog.class.php');
/**
 *  todo
 * */
$PAGE_TITLE = '编辑文字';
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
<section class="module module-large module-main module-blog">
    <h2 class="module_title">博客 Blog</h2>

	<div class="module_content                                                                                                                                                                                                                                                            ">
		<form id="blogForm" action="save.php" method="post" enctype="multipart/form-data">

			<div class="form_group">
				<label class="hidden" for="title">标题或短消息</label>
				<textarea class="input" name="title" id="title" placeholder="标题或短消息"></textarea>
			</div>

			<div class="form_group">
				<label class="hidden" for="content">详细内容</label>
				<textarea class="input" name="content" id="content" placeholder="详细内容"></textarea>
			</div>

			<input class="btn btn-submit" type="submit" value="发布" />
			<input class="btn btn-submit right" type="submit" value="存草稿" />
		</form>
	</div>
</section>
<?php require_once('../footer.php');?>

<script data-main="../script/blog/write" src="../script/lib/require/require.js"></script>
</body>
</html>