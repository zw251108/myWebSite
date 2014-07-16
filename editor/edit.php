<?php
/**
 * 查看文章详细页面 有 2 种访问方式
 * ajax 传入 id 返回文字详细内容
 * get  传入 id 显示文字详细页面
 *
 * 期望为 ajax 方式访问，目前功能尚未实现
 */
require_once('../include/Editor.class.php');

if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){// 判断是否为 ajax 访问

}
else{
    $PAGE_TITLE = 'Web 前端代码在线编辑';

    $editor = new Editor();
    $id = isset( $_GET['id'] ) ? filterReq( $_GET['id'] ) : 0;

//    $edit = isset( $_GET['edit'] ) ? filterReq( $_GET['edit'] ) : 'h';

    if ($id != 0) {
        $rs = $editor->selectById( $id );

        if( $rs ){
            $name = $rs->name;
        }
    }

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
<link rel="stylesheet" href="../script/plugin/clippy/clippy.css" /><!-- 帮助 -->
<link rel="stylesheet" href="../script/plugin/artDialog/artDialog.css" /><!-- 弹窗 -->
<link rel="stylesheet" href="../script/plugin/codeMirror/lib/codemirror.css" /><!-- 代码编辑工具 -->
<link rel="stylesheet" href="../script/plugin/codeMirror/addon/fold/foldgutter.css" /><!-- 代码编辑折叠工具 -->
<link rel="stylesheet" href="../script/plugin/farbtastic/farbtastic.css" /><!-- 颜色选择器 -->
<link rel="stylesheet" href="../script/plugin/zTree/zTreeStyle.css" /><!-- 树结构 -->
</head>
<body class="Container">
<?php require_once("../header.php");?>

<form id="code" action="result.php" method="post" target="result">
<section class="module large module-main module-editor">
    <h2 class="module_title">前端实践 editor</h2>

	<div class="toolBar">
		<button class="btn icon icon-addFile" id="showFileList" type="button" value="">项目文件列表</button>
		<button class="btn" id="run" type="submit" value="">运行 Run</button>
		<button class="btn icon icon-save" id="save" type="button" value="">保存 Save</button>
		<button class="btn" id="showColorPicker" type="button" value="">颜色选择器</button>
		<button class="btn icon icon-fullScreen" id="fullScreen" type="button" value="">全屏显示</button>
		<a class="btn btn-link" id="goList" href="index.php">返回列表页</a>

		<div class="clearfix"></div>
	</div>

    <div class="module_content editor_detail">

		<h3 class="editor_title"><?php echo isset($name) ? $name : '新建页面';?></h3>

        <nav class="nav">
			<input id="incFileHidden" type="hidden" name="incFile" value="../script/lib/jQuery/jquery.min.js"/>

            <ul id="codeTabs" class="nav-tabs editor_tabs">
                <li class="current">HTML</li>
                <li>CSS</li>
                <li>JS</li>
                <li>运行结果</li>
            </ul>
        </nav>

        <div class="editor_container" id="editorContainer">
            <div class="editor_content" id="editorContent">

                <input type="hidden" id="id" name="id" value="<?php echo $id;?>"/>

                <label class="hidden" for="HTML">HTML 编码区</label>
                <textarea class="editor_area hidden" name="HTML" placeholder="请编写HTML代码" id="HTML">
<div class="case">
	<h3></h3>


</div></textarea>

                <label class="hidden" for="CSS">CSS 编码区</label>
                <textarea class="editor_area hidden" name="CSS" placeholder="请编写CSS代码" id="CSS">
.case{
	overflow: hidden;

	border: 5px solid #c0c0c0;
	margin: 10px;
	padding: 10px;
	font-family: "Consolas",Monaco,Andale,monospace;
}
.case h3{
	text-align: center;
}</textarea>

                <label class="hidden" for="JS">JS 编码区</label>
                <textarea class="editor_area hidden" name="JS" placeholder="请编写JS代码" id="JS">
$(function(){

});</textarea>

                <iframe class="editor_area" id="result" name="result"
                        src="result.php<?php echo isset($id) ? '?id='. $id : '';?>"></iframe>
            </div>
        </div>
    </div>
</section>
</form>

<div class="module big module-popup hidden" id="editorSavePopup">
    <form action="save.php" method="post" id="editorSaveForm">

	<div class="form_group">
		<label class="tips tips-bottom hidden" for="codeName"></label>
		<input type="text" id="codeName" class="input" name="name" data-validator="title"
			   value="<?php echo isset($name) ? $name : '';?>" placeholder="请输入 UI 标题" />
	</div>

	<div class="form_group">
		<label class="tips tips-bottom hidden" for="fileUpload"></label>
		<input class="input" type="file" name="fileUpload" id="fileUpload" />
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
<!--    <table>-->
<!--        <colgroup span="1" style="width:150px"></colgroup>-->
<!--        <tbody>-->
<!--        <tr>-->
<!--            <td class="text-center" colspan="2">你确定没问题吗？你要负责的哟，有问题的话后果很严重的哟！</td>-->
<!--        </tr>-->
<!--            <tr>-->
<!--                <td class="text-right"><label for="charge">留下你的大名：</label></td>-->
<!--                <td><input type="text" id="charge" class="input" name="charge" /></td>-->
<!--            </tr>-->
<!--        <tr>-->
<!--            <td class="text-right"><label for="codeName">起个名：</label></td>-->
<!--            <td>-->
<!--            </td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td class="text-right"><label for="fileUpload">留个图：</label></td>-->
<!--            <td></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>打标签：</td>-->
<!--            <td>-->
<!--               -->
<!--            </td>-->
<!--        </tr>-->
<!--            <tr class="hidden">-->
<!--                <td class="text-right">否生成页面</td>-->
<!--                <td>-->
<!--                    <label><input type="radio" name="create" value="1" />是</label>-->
<!--                    <label><input type="radio" name="create" value="0" checked="checked" />否</label>-->
<!--                </td>-->
<!--            </tr>-->
<!--        </tbody>-->
<!--    </table>-->
<!--    <table class="hidden">-->
<!--            <tr>-->
<!--                <td colspan="2" class="text-center">HTML 文件名为必填，其它项若不填则对应代码生成在 HTML 页面中</td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td class="text-right"><label for="htmlName">HTML 文件名：</label></td>-->
<!--                <td><input id="htmlName" type="text" name="htmlName" /></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td class="text-right"><label for="cssName">CSS 文件名：</label></td>-->
<!--                <td><input id="cssName" type="text" name="cssName" /></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td class="text-right"><label for="jsName">JS 文件名：</label></td>-->
<!--                <td><input id="jsName" type="text" name="jsName" /></td>-->
<!--            </tr>-->
<!--        </table>-->
    </form>
</div>

<div class="module normal module-popup hidden" id="directory">
	<ul class="ztree list list-left" id="selectedFile">
		<li class="level2">
			<span class="button chk checkbox_true_disable"></span><a class="level2"><span class="button ico_docu"></span><span>jquery.min.js</span></a>
		</li>
	</ul>
    <ul class="ztree list list-right" id="tree"></ul>
</div>

<div class="module small module-popup hidden" id="colorPicker">
    <label><input type="text" name="color" id="color" value="#ffffff" /></label>
    <div id="picker"></div>
</div>

<?php require_once('../footer.php');?>
<script>
var EDITOR_DETAIL = <?php echo isset($rs) ? json_encode( $rs ) : '{}';?>,
    TAG_DATA = <?php echo isset($allTag) ? json_encode($allTag) : '[]';?>;
</script>
<script data-main="../script/editor/edit" src="../script/lib/require/require.js"></script>
</body>
</html>
<?php }?>