<?php
/**
 * 获取天气
 */
header("Content-type:text/html;charset=utf-8");
$url = 'http://m.weather.com.cn/data/101070201.html';
//$url = 'http://ext.weather.com.cn/101070201.json';

// 打开输出缓冲区
ob_start();

// 初始化会话
$ch = curl_init();

// 设定目标URL
curl_setopt($ch, CURLOPT_URL, $url);

// 发送请求
curl_exec($ch);

// 返回内部缓冲区的内容
//$content = ob_get_contents();

// 删除内部缓冲区的内容并关闭内部缓冲区
//ob_end_clean();

// 会话结束
curl_close($ch);

//echo json_encode( $content );
