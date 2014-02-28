<?php
/**
 * 获取 RSS 订阅
 */
header('Content-type:application/xml');
if( isset( $_GET['url'] ) ){
	$url = $_GET['url'];

//// 打开输出缓冲区
//	ob_start();
//
//// 初始化会话
//	$ch = curl_init();
//
//// 设定目标URL
//	curl_setopt($ch, CURLOPT_URL, $url);
//
//// 发送请求
//	curl_exec($ch);
//
//// 返回内部缓冲区的内容
////$content = ob_get_contents();
//
//// 删除内部缓冲区的内容并关闭内部缓冲区
////ob_end_clean();
//
//// 会话结束
//	curl_close($ch);

	$handle = fopen($_REQUEST['url'], "r");

	if ($handle) {
		while (!feof($handle)) {
			$buffer = fgets($handle, 4096);
			echo $buffer;
		}
		fclose($handle);
	}
}