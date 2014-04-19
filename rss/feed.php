<?php
/**
 */

include_once('../include/DB.class.php');

$db = new DB();

$res = [];
if( isset( $_GET['feed'] ) ){
	$url = $_GET['feed'];

//	$url = 'http://feed.feedsky.com/programmer';
//	$url = 'http://www.huxiu.com/rss/0.xml';
//	$url = 'http://feeds.geekpark.net/';
	$xml = file_get_contents( $url );

	$parser = xml_parser_create();

//echo $xml;

// xml_parser_set_option -- 为指定 XML 解析进行选项设置
	xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
// xml_parse_into_struct -- 将 XML 数据解析到数组$values中
	xml_parse_into_struct($parser, $xml, $value, $index);
// xml_parser_free -- 释放指定的 XML 解析器
	xml_parser_free($parser);

// print_r( $value );

	$data = [];
	for($i = 0, $j = count( $value ); $i < $j; $i++){
		$val = $value[$i];

		$tag = strtolower( $val['tag'] );
		$type = strtolower( $val['type'] );

		if( $tag != 'item' ){
			continue;
		}
		$temp = array();

		for(;;){
			$val = $value[++$i];

			if( strtolower( $val['tag'] ) == 'item' && strtolower( $val['type'] ) == 'close' ){
				break;
			}

			if( isset( $val['value'] ) ){	// 保证不是空标签
				$temp[strtolower( $val['tag'] )] = $val['value'];
			}
		}
		$data[] = $temp;
	}
	$res['data'] = $data;
}
else{

}
//输出结果
echo json_encode( $res );