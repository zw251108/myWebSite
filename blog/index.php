<?php
require_once('../include/Blog.class.php');
/**
 * @module  在线编辑器
 * @fileOverview  代码列表
 */
$PAGE_TITLE = '文章列表';
$type = isset( $_GET['type'] ) ? $_GET['type'] : "";
$blog = new Blog();
$rs = $blog->selectByType( filterReq( $type ) );
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title><?php echo isset($PAGE_TITLE) ? $PAGE_TITLE : '';?></title>
<?php require_once('../style.php');?>
</head>
<body class="Container">
<?php require_once('../header.php');?>
<section class="module module-main module-large module-blog">
    <h2 class="module_title">博客 blog</h2>
    <div class="module_content blog-list" id="blogList"></div>
</section>
<?php require_once('../footer.php');?>

<script>var BLOG_LIST = <?php echo isset($rs) ? json_encode( $rs ) : '[]';?>;</script>
<script data-main="../script/blog/index" src="../script/lib/require/require.js"></script>
</body>
</html>