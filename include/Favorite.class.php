<?php
require_once('DB.class.php');
require_once('Tag.class.php');

/**
 * @author  zhouwenbo
 *
 * @class   Favorite    收藏夹
 */
class Favorite extends DB{
    protected $TABLE_NAME = 'favorite';

    /**
     * @description 按照 type 查找收藏
     * @param   string  $type  所属类别
     * @return  array   查询结果对象数组
     */
    public function selectByType( $type='' ){
//        $type = explode (',', $type);
//        if(  )
        return $this->select( $this->TABLE_NAME, 'Id,title,url,tagsId,tagsName,datetime', '', '', 'order by datetime desc' );
    }

    /**
     * @description 按照 url 查找收藏
     * @param   string  $url    收藏的 url
     * @return  array   查询结果
     */
    public function selectByUrl( $url ){
        $result = $this->select( $this->TABLE_NAME, 'Id', 'where url=\''. $url .'\'' );
        return $result ? $result[0] : null;
    }

    /**
     * @description 添加收藏
     * @param   string  $url    收藏链接
     * @param   string  $tagsId 标签 Id
     * @param   string  $tagsName   标签 名称
     * @param   string  $title  文章标题
     * @param   string  $content    文章内容
     * @return  number  新添加收藏的 Id
     */
    public function insertFavor($url, $tagsId='', $tagsName='', $title='', $content=''){
        return $this->insert($this->TABLE_NAME, '(url,tagsId,tagsName,title,content,datetime)',
            '\''. $url .'\',\''. $tagsId .'\',\''. $tagsName .'\',\''. $title . '\',\''. $content .'\',now()');
    }
}