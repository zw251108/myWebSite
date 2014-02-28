<?php
require_once('../include/Favorite.class.php');
/**
 *  添加收藏夹
 */
if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){// 判断是否为 ajax 访问

    $res = [];

    if( isset( $_POST['url'] ) ){
        $favor = new Favorite();

        $url = filterReq( $_POST['url'] );

        $rs = $favor->selectByUrl( $url );
        if( $rs ){
            $res['error'] = 'E0006';
            $res['msg'] = errMsg('E0006');
        }
        else{
            $tagsId = isset($_POST['tagsId']) ? filterReq( $_POST['tagsId'] ) : '';
            $tagsName = isset($_POST['tagsName']) ? filterReq( $_POST['tagsName'] ) : '';
            $title = isset($_POST['title']) ? filterReq( $_POST['title'] ) : '';

            // todo 验证：标签 Id 与标签名称是否一一对应
            $favorId = $favor->insertFavor($url, $tagsId, $tagsName, $title);

            if( $favorId ){
                $res['Id'] = $favorId;
                $res['succ'] = true;
            }
            else{
                $res['error'] = 'E0000';
                $res['msg'] = errMsg('E0000');
            }
        }
    }
    else{
        $res['error'] = 'E0001';
        $res['msg'] = '信息不完整';
    }

    echo json_encode( $res );
}
else die('访问出错！');