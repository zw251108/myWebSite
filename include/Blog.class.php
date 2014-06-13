<?php
require_once('DB.class.php');
require_once('Tag.class.php');

/**
 * @author  zhouwenbo
 *
 * @class   Blog    博客文章
 */
class Blog extends DB{
    protected $TABLE_NAME = 'blog';

    /**
     * @description 按照 id 查询文章全部信息
     * @param   string  $id 文章 id
     * @return  object  查询结果
     */
    public function selectById( $id ){
        $result = $this->select( $this->TABLE_NAME , 'Id,title,content,datetime,tagsId,tagsName', 'where id='. $id );
        return $result ? $result[0] : null;
    }

    /**
     * @description 按照 id 查询文章内容
     * @param   string  $id 文章 id
     * @return  object  查询结果
     */
    public function selectContentById( $id ){
        $result = $this->select( $this->TABLE_NAME, 'content', 'where id='. $id );
        return $result ? $result[0] : null;
    }

    /**
     * @description 按照 type 查找文章
     * @param   string  $type  所属类别
//     * @param string $limit 分页
     * @return  array   查询结果对象数组
     */
    public function selectByType( $type='' ){
//        $type = explode (',', $type);
//        if(  )
        return $this->select( $this->TABLE_NAME, 'Id,title,datetime,tagsId,tagsName', 'where status=1', '', ' order by Id desc' );
    }
}