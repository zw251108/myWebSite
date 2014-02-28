<?php
require_once('DB.class.php');

/**
 * @author  zhouwenbo
 *
 * @class   Tag 标签
 * @description 该类属于工具类，由其它类继承，配合其它类的功能来使用
 */
class Tag extends DB{
    protected $TAG = 'tag';

    /**
     * @description 为标签增加数量
     */
    public function addTagNum(){

    }

    /**
     * @description 为标签减少数量
     */
    public function subTagNum(){

    }

    /**
     * @description 按照 type 查找标签
     * @param   string  $level  标签级别
     * @return  array   查询结果对象数组
     */
    public function selectTagByLevel($level=''){
        return $this->select( $this->TAG, 'Id,tagName,tagTips');
    }

    /**
     * @description 查找全部标签的全部信息
     * @return  array   查询结果对象数组
     */
    public function selectTagsFullInfo(){
        return $this->select( $this->TAG, 'Id,tagName,tagNum,tagLevel,tagParent,tagTips');
    }

    /**
     * @description 按照名称查找标签
     * @param   string  $name   标签名称
     * @return  object  查询结果对象
     */
    public function selectTagByName($name){
        $result = $this->select( $this->TAG, 'Id', 'where tagName=\''. $name .'\'' );
        return $result ? $result[0] : null;
    }

    /**
     * @description 添加新标签
     * @param   string  $tagName    新标签名称
     * @return  number  新标签的 Id
     */
    public function insertTag($tagName){
        return $this->insert( $this->TAG, '(tagName)', '\''. $tagName .'\'');
    }
}
