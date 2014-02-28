<?php
/**
 * todo
 * */
require_once('../include/Favorite.class.php');
require_once('../include/Tag.class.php');
$type = isset( $_GET['type'] ) ? $_GET['type'] : "";
$favor = new Favorite();
$rs = $favor->selectByType( filterReq( $type ) );

$tag = new Tag();
$allTag = $tag->selectTagByLevel();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title>网页收藏夹</title>
<?php require_once('../style.php');?>
<link rel="stylesheet" href="../script/plugin/artDialog/artDialog.css" />
</head>
<body class="Container">
<?php require_once('../header.php');?>
<section class="module module-main module-large module-favor">
    <h2 class="module_title">收藏夹 Favorite
        <span id="addFavor" class="icon-CSS icon-plus">
            <span class="icon1"></span>
            <span class="icon2"></span>
            <span class="icon3"></span>
        </span>
    </h2>

    <div class="filter favor_filter" id="Filter">
        <div class="filter_checked" id="checked">
			<button class="btn icon icon-filter" id="setFilter" type="button" value="">过滤</button>
			<button class="btn icon icon-reset hidden" id="filterReset" type="button" value="">重置</button>
        </div>

        <div id="filterAll" class="filter_all hidden"></div>
    </div>

    <ul class="module_content favor_list" id="favorList"></ul>

    <div class="pagination favor_page" id="Pagination"></div>
</section>

<section class="module module-popup module-normal hidden" id="favorAddPopup">
    <form id="favorAddForm" action="addFavor.php" method="post">

		<div class="form_group">
			<label class="tips tips-bottom hidden" for="title"></label>
			<input class="input" type="text" name="title" id="title" data-validator="title" placeholder="收藏标题"/>
		</div>

		<div class="form_group">
			<label class="tips tips-bottom hidden" for="url"></label>
			<input class="input" type="text" name="url" id="url" data-validator="url" placeholder="收藏 url"/>
		</div>

		<div class="form_group">
			<div id="Tag">
				<input type="hidden" name="tagsId" id="tagsId"/>
				<input type="hidden" name="tagsName" id="tagsName"/>
				<div class="tagsArea" id="selectTags">
					<label id="addNewTag">
						<input type="text" class="input" id="tagName" placeholder="创建新标签" />
						<button class="btn hidden" id="addTag" type="button" value="">添加</button>
					</label>
				</div>
				<hr/>
				<div class="tagsArea" id="allTags"></div>
			</div>
		</div>

        <input class="btn btn-submit" type="submit" value="添加收藏"/>
    </form>
</section>

<?php require_once('../footer.php');?>

<script>
var FAVOR_LIST = <?php echo isset($rs) ? json_encode( $rs ) : '[]';?>,
    TAG_DATA = <?php echo isset($allTag) ? json_encode($allTag) : '[]';?>;
</script>
<script data-main="../script/favorite/index" src="../script/lib/require/require.js"></script>
</body>
</html>