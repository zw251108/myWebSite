<?php
/**
 * 获取天气
 */
header("Content-type:text/html;charset=utf-8");

$url = 'http://www.weather.com.cn/data/cityinfo/101070201.html';
//$url = 'http://www.weather.com.cn/data/sk/101070201.html';	//
//$url = 'http://www.weather.com.cn/data/zs/101070201.html';	//

ob_start();	// 打开输出缓冲区

$ch = curl_init();	// 初始化会话

curl_setopt($ch, CURLOPT_URL, $url);	// 设定目标URL

curl_exec($ch);	// 发送请求

// 返回内部缓冲区的内容
//$content = ob_get_contents();

// 删除内部缓冲区的内容并关闭内部缓冲区
//ob_end_clean();


curl_close($ch);	// 会话结束

//echo json_encode( $content );