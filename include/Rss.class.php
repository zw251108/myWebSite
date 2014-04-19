<?php
require_once('DB.class.php');

/**
 * @author  zhouwenbo
 *
 * @class   Rss
 */
class Rss extends DB{
	protected $TABLE_NAME = 'rss';

	/**
	 * @description	按照 type 查找 RSS Feed
	 * @param	string	$type	所属类别
	 * @return	array   查询结果对象数组
	 */
	public function selectByType( $type='' ){

		return $this->select( $this->TABLE_NAME, 'Id,name,xmlUrl,htmlUrl,tagsId,tagsName' );
	}

	/**
	 * @description	按照 id 查找 RSS Feed
	 * @param	string	$id	RSS 的 id
	 * @return	object	查询结果
	 */
	public function selectById( $id){

		$result = $this->select( $this->TABLE_NAME, 'xmlUrl', 'where id='. $id );
		return $result ? $result[0] : null;
	}
}