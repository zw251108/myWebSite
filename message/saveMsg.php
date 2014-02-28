<?php
require_once('../include/Message.class.php');
/**
 * 保存留言
 */
$msg = new Message();

$flag = $msg->insertMsg( filterReq( $_GET['from'] ), filterReq( $_GET['content'] ) );

$res = [];
if( $flag ){
    $res['succ'] = true;
}
else{
    $res['error'] = 'E0001';
    $res['msg'] = errMsg('E0001');
}
echo json_encode($res);