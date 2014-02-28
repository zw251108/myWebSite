<?php
require_once('DB.class.php');

/**
 * @author  zhouwenbo
 *
 * @class   Message 留言信息
 */
class Message extends DB{
    protected $TABLE_NAME = 'message';

    /**
     * @description 将留用插入到数据库
     * @param string $from
     * @param string $content
     * @return number
     */
    public function insertMsg( $from, $content ){
        $from = mysql_real_escape_string( $from );
        $content = mysql_real_escape_string( $content );
        return $this->insert($this->TABLE_NAME, '(sendfrom,content,datetime)', '\''.$from.'\',\''.$content.'\',now()');
    }

    public function selectAll(){
        return $this->select($this->TABLE_NAME);
    }
}
