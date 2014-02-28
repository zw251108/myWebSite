<?php
require_once('../include/User.class.php');
/**
 * 用户登录或注册
 */
if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){// 判断是否为 ajax 访问

    $res = [];

    // 判断邮箱与密码是否都填写
    if( isset( $_POST['email'] ) && isset( $_POST['password'] ) ){
        $user = new User();

        $email = filterReq( $_POST['email'] );
        $pwd =  filterReq( $_POST['password'] );

        $userInfo = $user->selectPwdByEmail( $email );

        if( $userInfo ){// 用户名已存在
            if( $userInfo->password == $pwd ){
                $res['state'] = 'login';

                $_SESSION['userId'] = $userInfo->Id;
            }
            else{
                $res['error'] = 'E0002';
                $res['msg'] = errMsg('E0002');
            }
        }
        else{// 用户名不存在 注册
//            $userId = $user->insertUser( $email, $pwd );
//
//            if( $userId ){// 注册成功
//                $_SESSION['userId'] = $userId;
//
//                $res['state'] = 'register';
//            }
//            else{
//                $res['error'] = 'E0003';
//                $res['msg'] = errMsg('E0003');
//            }
            $res['error'] = 'E0005';
            $res['msg'] = errMsg('E0005');
        }
    }
    else{// 信息不全
        $res['error'] = 'E0001';
        $res['msg'] = errMsg('E0001');
    }

    echo json_encode( $res );
}
else dir('访问出错！');