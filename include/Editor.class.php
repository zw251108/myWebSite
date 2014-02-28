<?php
require_once('DB.class.php');
require_once('Tag.class.php');

/**
 * @author zhouwenbo
 *
 * @class   Code  代码片段
 */
class Editor extends DB{
    protected $TABLE_NAME = 'editor';

    /**
     * @description 按照 type 查找页面代码
     * @return array    查询结果对象数组
     */
    public function selectAll(){
        $where = 'where editor.preview=image.src';

        return $this->select( $this->TABLE_NAME .',image',
            'editor.Id,name,content,preview,tagsId,tagsName,width,height', $where, '', 'order by editor.Id' );
    }

    /**
     * @description 按照 Id 查找页面代码
     * @param   number  $id 查询的编号
     * @param   string  $col    列名
     * @return  object  查询结果对象
     */
    public function selectById( $id, $col = 'Id,html,css,js,includeFile,name,tagsId,tagsName' ){
        $result = $this->select( $this->TABLE_NAME, $col, 'where Id='. $id );
        return $result ? $result[0] : null;
    }

    /**
     * @description 创建新页面代码
     * @param   string  $name   新页面代码名称
     * @param   string  $html   HTML代码
     * @param   string  $css    CSS代码
     * @param   string  $js     JS代码
     * @param   string  $incFile    引用的文件
     * @param   string  $tagsId     标签 Id 集合
     * @param   string  $tagsName   标签名称集合
     * @param   string  $preview    代码预览图
     * @return  number  创建的页面代码的 Id
     */
    public function insertCode( $name, $html, $css, $js, $incFile='', $tagsId='', $tagsName='',
                                $preview='../image/default/no-pic.png' ){
        return $this->insert( $this->TABLE_NAME,
            '(html,css,js,name,includeFile,createTime,preview,tagsId,tagsName)',
            '\''. $html .'\',\''. $css .'\',\''. $js .'\',\'' .$name .'\',\''. $incFile
            .'\',now(),\''. $preview .'\',\'' . $tagsId .'\',\''. $tagsName .'\'');
    }

    /**
     * @description 更新页面代码
     * @param   string  $id     要更新的页面代码的Id
     * @param   string  $name   更新页面代码名称
     * @param   string  $html   更新的HTML代码
     * @param   string  $css    更新的CSS代码
     * @param   string  $js     更新的JS代码
     * @param   string  $incFile    引用的文件
     * @param   string  $tagsId     标签 Id 集合
     * @param   string  $tagsName   标签名称集合
     * @return  number  更新影响的行数
     */
    public function updateCode( $id, $name, $html, $css, $js, $incFile='', $tagsId='', $tagsName='' ){
        return $this->update( $this->TABLE_NAME,
            'name=\''. $name .'\',html=\''. $html .'\',css=\''. $css .'\',js=\''. $js
                .'\',includeFile=\''. $incFile .'\',tagsId=\''. $tagsId .'\',tagsName=\''. $tagsName .'\'',
            'where Id='. $id);
    }
}
