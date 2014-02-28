<?php
require_once('../include/User.class.php');
/**
 *  获取用户信息
 */
if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){// 判断是否为 ajax 访问

    if( isset( $_GET['email'] ) ){
        $user = new User();

        $email = filterReq( $_GET['email'] );

        $userInfo = $user->selectByEmail( $email );

        echo json_encode( $userInfo );
    }
}
else die('访问出错！');