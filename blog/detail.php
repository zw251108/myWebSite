<?php
require_once('../include/Blog.class.php');
/**
 *  查看文章详细页面 有 2 种访问方式
 * ajax 传入 id 返回文字详细内容
 * get  传入 id 显示文字详细页面
 *
 * 期望为 ajax 方式访问
 */
$blog = new Blog();
if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){// 判断是否为 ajax 访问

    $res = [];

    if( isset( $_GET['id'] ) ){
        $rs = $blog->selectContentById( filterReq( $_GET['id'] ) );

        if( $rs ){// 返回文字内容
            $res['content'] = $rs->content;
            $res['state'] = 'getContent';
        }
        else{// 未查到文章内容
            $res['error'] = 'E0004';
            $res['msg'] = errMsg('E0004');
        }
    }
    else{// 未传入 id
        $res['error'] = 'E0001';
        $res['msg'] = errMsg('E0001');
    }

    echo json_encode( $res );
}
else{// get 方式访问
    $PAGE_TITLE = '文章详细';

    if( isset( $_GET['id'] ) ){
        $rs = $blog->selectById( filterReq( $_GET['id'] ) );

        if( !$rs ){// 内容为空
            header('../error.php');
        }
    }
    else{// 未传入 id
        header('../error.php');
    }
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title><?php echo isset($PAGE_TITLE) ? $PAGE_TITLE : '';?></title>
<?php require_once('../style.php');?>
</head>
<body class="Container">
<?php require_once('../header.php');?>
<section class="module module-large module-main module-blog">
    <h2 class="module_title">博客 Blog</h2>
    <div class="module_content blog-detail" id="blogDetail">
        <article class="article">
            <h3 class="article_title">
                <?php echo isset($rs) ? $rs->title : '';?>
            </h3>

            <div class="article_content">
                <?php echo isset($rs) ? $rs->content : '';?>
            </div>

            <hr/>

            <div id="articleTags"></div>

            <span class="article_date">
                <?php echo isset($rs) ? $rs->datetime : '';?>
            </span>
        </article>
    </div>
</section>
<?php require_once('../footer.php');?>

<!--<script>var BLOG_DETAIL = --><?php //echo isset($rs) ? json_encode( $rs ) : '{}';?><!--;</script>-->
<!--<script data-main="../script/blog/detail" src="../script/lib/require/require.js"></script>-->
</body>
</html>
<?php }?>