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
<html lang="en">
<head>
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php echo isset($PAGE_TITLE) ? $PAGE_TITLE : '';?></title>
<?php require_once('../style.php');?>
<link rel="stylesheet" href="../script/plugin/artDialog/artDialog.css" />
<link rel="stylesheet" href="../script/plugin/codeMirror/codemirror.css" />
</head>
<body class="Container">
<?php require_once('../header.php');?>
<section class="module module-main module-large module-editor">
    <h2 class="module_title">前端实践 editor</h2>

	<div class="filter favor_filter" id="Filter">
		<div class="filter_checked" id="checked">
			<button class="btn icon icon-filter" id="setFilter" type="button" value="">过滤</button>
			<button class="btn icon icon-reset hidden" id="filterReset" type="button" value="">重置</button>
		</div>

		<div id="filterAll" class="filter_all hidden"></div>
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