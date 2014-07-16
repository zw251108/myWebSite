<?php
require_once('../include/Editor.class.php');
/**
 * @module  在线编辑器
 * @fileOverview  代码列表
 */
$PAGE_TITLE = 'Web 前端实践';
$editor = new Editor();
$rs = $editor->selectAll();

require_once('../include/Tag.class.php');

$tag = new Tag();
$allTag = $tag->selectTagByLevel();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php echo isset($PAGE_TITLE) ? $PAGE_TITLE : '';?></title>
<?php require_once('../style.php');?>
<link rel="stylesheet" href="../script/plugin/artDialog/artDialog.css" />
<link rel="stylesheet" href="../script/plugin/codeMirror/lib/codemirror.css" />
</head>
<body class="Container">
<?php require_once('../header.php');?>
<section class="module module-main large module-editor">
    <h2 class="module_title">前端实践 editor</h2>

	<div class="toolBar">
		<a class="btn btn-link icon icon-add" href="edit.php?id=0">添加</a>

		<div class="filter" id="Filter">
			<button class="btn icon icon-filter filter_setBtn" id="setFilter" type="button" value="">过滤
				<span id="filterCd" class="countdown hidden">
					<span class="cd_quarter quarter_1"></span>
					<span class="cd_quarter quarter_2"></span>
					<span class="cd_quarter quarter_3"></span>
					<span class="cd_quarter quarter_4"></span>
					<span id="filterCdNum" class="cd_num">0</span>
				</span>
			</button>
			<button class="btn icon icon-reset filter_resetBtn hidden" id="resetFilter" type="button" value="">重置</button>
			<div class="filter_tagArea" id="filterTagArea">
				<div class="filter_checked" id="filterChecked"></div>
				<div class="filter_all hidden" id="filterAll"></div>
			</div>
		</div>

		<div class="clearfix"></div>
	</div>

    <div class="module_content editor_list" id="editorList"></div>
</section>
<?php require_once('../footer.php');?>

<script>
var EDITOR_LIST = <?php echo isset($rs) ? json_encode( $rs ) : '[]';?>,
    TAG_DATA = <?php echo isset($allTag) ? json_encode($allTag) : '[]';?>;
//var i = EDITOR_LIST.length,
//    d = {}, temp,
//    m, n;
//
//while( i-- ){
//    temp = EDITOR_LIST[i];
//    temp = temp.tagsId;
//
//    if( temp ){
//        temp = temp.split(',');
//        m = temp.length;
//
//        while( m-- ){
//            if( temp[m] in d ){
//                d[temp[m]] += 1;
//            }
//            else{
//                d[temp[m]] = 1;
//            }
//        }
//    }
//}
//var h = [];
//for( var k in d ){
//    h.push()
//}
//
//console.dir( d )
</script>
<script data-main="../script/editor/index" src="../script/lib/require/require.js"></script>
</body>
</html>