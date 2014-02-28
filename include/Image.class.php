<?php
require_once('DB.class.php');

/**
 * @author  zhouwenbo
 * @class   Image	图片存储管理类
 * @description
 * 	公共图片处理类型，针对 image 表，没有任何业务处理
 *
 */
class Image extends DB{
	protected $TABLE_NAME = 'image';

	/**
	 * @description 按照 id 查询文章全部信息
	 * @param   string  $id 文章 id
	 * @return  object  查询结果
	 */
}