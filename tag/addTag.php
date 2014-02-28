<?php
require_once('../include/Tag.class.php');
/**
 *  添加标签
 * ajax 访问
 */
if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){// 判断是否为 ajax 访问

    if( isset( $_POST['tagName'] ) ){
        $tag = new Tag();

        $tagName = filterReq( $_POST['tagName'] );

        $res = [];

        $rs = $tag->selectTagByName( $tagName );
        if( $rs ){
            $res['Id'] = $rs->Id;
            $res['exit'] = true;
        }
        else{
            $res['Id'] = $tag->insertTag($tagName);
        }

        echo json_encode( $res );
    }
}
else die('访问出错！');