<?php
require_once('../include/Editor.class.php');
/**
 * @module  在线编辑器
 * @fileOverview  保存代码
 *
 * ajax post 方式访问
 */
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ){
    $editor = new Editor();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = filterReq( $_POST['id'] );
        $html = isset( $_POST['HTML'] ) ? filterReq( $_POST['HTML'] ) : '';
        $css = isset( $_POST['CSS'] ) ? filterReq( $_POST['CSS'] ) : '';
        $js = isset( $_POST['JS'] ) ? filterReq( $_POST['JS'] ) : '';
        $incFile = isset( $_POST['incFile'] ) ? filterReq( $_POST['incFile'] ) : '';
        $name = filterReq( $_POST['name'] );
//        $type = filterReq( $_POST['type'] );
        $tagsId = isset($_POST['tagsId']) ? filterReq( $_POST['tagsId'] ) : '';
        $tagsName = isset($_POST['tagsName']) ? filterReq( $_POST['tagsName'] ) : '';

        if ($id != '0') { // 更新 UI
            $flag = $editor->updateCode($id, $name, $html, $css, $js, $incFile, $tagsId, $tagsName);
        } else { // 创建新 UI
            $flag = $editor->insertCode($name, $html, $css, $js, $incFile, $tagsId, $tagsName);
        }

        $res = [];
        //判断数据更新状态
        if ($flag) {
            $res['succ'] = true;
            $res['id'] = $flag;
        } else {
            $res['error'] = 'E0000';
            $res['msg'] = errMsg('E0000');
        }

        echo json_encode($res);
    }
}
else die('非法访问');