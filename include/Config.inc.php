<?php
header("Content-type:text/html; charset=utf-8");
session_start();
/**
 * @description 获取相对路径
 * @return  string  当前页面与根目录的相对路径
 */
function projectRoot(){
    $path = '';

/**
     * todo 发布时使用上一行
     */
//    for( $i = 2, $j = count(explode('/', $_SERVER['PHP_SELF'])); $i < $j; $i++ ){
    for( $i = 3, $j = count( explode('/', $_SERVER['PHP_SELF']) ); $i < $j; $i++ ){
        $path .= '../';
    }
    return $path;
}

/**
 * @description 过滤请求
 * @param   string  $req    请求数据
 * @return  string  过滤后的数据
 */
function filterReq($req){
    // todo 未来添加更多过滤条件
    return mysql_real_escape_string( $req );
}

/**
 * @description 根据错误 id 返回错误信息
 * @param   string  $errId 错误编号
 * @return  string  错误信息
 */
function errMsg($errId){
    $msg = '';
    switch( $errId ){
		case 'E1111':
			$msg = '很抱歉，您没有此权限';
			break;
        case 'E0000':
            $msg = '系统错误';
            break;
        case 'E0001':
            $msg = '信息不完整';
            break;
        case 'E0002':
            $msg = '密码错误';
            break;
        case 'E0003':
            $msg = '注册失败';
            break;
        case 'E0004':
            $msg = '所访问的内容不存在';
            break;
        case 'E0005':
            $msg = '很抱歉，目前尚未放注册';
            break;
        case 'E0006':
            $msg = '该数据已存在';
            break;
        default:
            $msg = '未知错误';
            break;
    }

    return $msg;
}

/**
 *  DataBase
 * todo 发布时使用下面的配置数据
 */
// localhost
define('DB_SERVER_NAME', 'localhost');
define('DB_NAME', 'Coding4fun');
define('DB_USER', 'root');
define('DB_PASSWORD', 'zw251108');

// domain
//define('DB_SERVER_NAME', 'sql310.xtreemhost.com');
//define('DB_NAME', 'xth_13555939_justfun');
//define('DB_USER', 'xth_13555939');
//define('DB_PASSWORD', 'zw251108');