<?php
require_once('DB.class.php');

/**
 * @author  zhouwenbo
 *
 * @class   Color   颜色库
 */
class Color extends DB{
    protected $TABLE_NAME = 'color';
//  INSERT INTO color(colorName, colorValue)
//      select '蔚蓝','70f3ff' from color where not exists (
//          select * from color where colorValue='70f3ff') limit 1

    /**
     * @description 按颜色值查找颜色
     * @param   string  $colorValue 颜色值
     * @return  object  返回查询到的数据
     */
    public function selectByValue($colorValue){
        $result = $this->select( $this->TABLE_NAME, 'colorValue', 'where colorValue=\''. $colorValue .'\'');
        return $result ? $result[0] : null;
    }

//    /**
//     * @description 查找所有颜色数据
//     * @return  array   返回所有颜色数据
//     */
//    public function selectAllColor(){
//        return $this->select( $this->TABLE_NAME, 'colorValue,colorName',
//            '', '', 'order by colorType, colorValue' );
//    }

    /**
     * @description 按类型查找颜色
     * @param   string  $type 颜色类型
     * @return  array   返回查询结果
     */
    public function selectColorByType($type=''){
        $where = '';
        if( $type){
            $where .= 'where colorType=\''. $type .'\'';
        }
        return $this->select( $this->TABLE_NAME, 'colorValue,colorName,colorType', $where, '',
            'order by colorType,colorValue');
    }

    /**
     * @description 查询所有颜色信息
     * @return  array   返回所有颜色数据的信息
     */
    public function selectInfoColor(){
        return $this->select( $this->TABLE_NAME,
            'colorValue,colorValueR as r,colorValueG as g,colorValueB as b,colorName,colorType',
            '', '', 'order by colorType,colorValue' );
    }

    /**
     * @description 插入颜色数据
     * @param   string  $colorName  颜色名称
     * @param   string  $colorValue 颜色值 16 进制
     * @param   number  $r  颜色值的 R 值
     * @param   number  $g  颜色值的 G 值
     * @param   number  $b  颜色值的 B 值
     * @param   string  $type   颜色的类型
     * @return  number  新颜色的 Id
     */
    public function insertColor($colorName, $colorValue, $r, $g, $b, $type){
        return $this->insert( $this->TABLE_NAME, '(colorName,colorValue,colorValueR,colorValueG,colorValueB,colorType)',
            '\''. $colorName .'\',\''. $colorValue .'\','. $r .','. $g .','. $b .',\''. $type .'\'');
    }
}