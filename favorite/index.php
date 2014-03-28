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
    <h2 class="module_title">收藏夹 favorite</h2>

	<div class="toolBar">
		<button class="btn icon icon-add" id="addFavor" type="button" value="">添加</button>

		<div class="filter" id="Filter">
			<button class="btn icon icon-filter filter_setBtn" id="setFilter" type="button" value="">过滤</button>
			<button class="btn icon icon-reset filter_resetBtn hidden" id="resetFilter" type="button" value="">重置</button>
			<div class="filter_tagArea" id="filterTagArea">
				<div class="filter_checked" id="filterChecked"></div>
				<div class="filter_all hidden" id="filterAll"></div>
			</div>
		</div>

		<div class="clearfix"></div>
	</div>

    <ul class="module_content list favor_list" id="favorList"></ul>

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

		<div class="form_group-btn">
			<input class="btn btn-submit" type="submit" value="添加收藏"/>
		</div>
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