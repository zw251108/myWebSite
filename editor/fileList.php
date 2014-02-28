<?php
require_once('../include/FileOperate.class.php');
/**
 * @module  在线编辑器
 * @fileOverview  获取文件列表
 *
 * ajax post 方式访问
 * */
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ){
    $visitDir = array(
//        'image/',
//        'media/',
        '',
        'script/lib',
        'script/plugin',
//        'script/test',
        'style'
    );
    $res = [];
    $fileOperate = new FileOperate();

    $res[0] = [
        'name' => 'script/jquery.extend.js'
    ];
    for( $i = 1, $j = count( $visitDir ); $i < $j; $i++ ){
        $res[$i] = [];
        $res[$i]['name'] = $visitDir[$i];
        $res[$i]['nocheck'] = true;
        $res[$i]['children'] = $fileOperate->getTreeStructByDir( '../'. $visitDir[$i] .'/', true );
    }

    echo json_encode( $res );
}
else die('非法访问');