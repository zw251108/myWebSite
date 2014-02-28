<?php
require_once('DB.class.php');

/**
 * @author  zhouwenbo
 *
 * @class   User    用户信息
 *
 */
class User extends DB{
    protected $TABLE_NAME = 'user';

    /**
     * @description 按照 email    查找用户
     * @param   string  $email  用户 email
     * @return  object  查询结果对象
     */
    public function selectByEmail( $email ){
//        $email = mysql_real_escape_string( $email );
        $result = $this->select( $this->TABLE_NAME, 'username,avatar,description', 'where email=\''. $email .'\'');
        return $result ? $result[0] : null;
    }

    /**
     * @description 按照 email 查找密码
     * @param   string  $email  用户 email
     * @return  string  用户密码
     */
    public function selectPwdByEmail( $email ){
//        $email = mysql_real_escape_string( $email );
        $result = $this->select( $this->TABLE_NAME, 'Id,password', 'where email=\''. $email .'\'');
        return $result ? $result[0] : null;
    }

    /**
     * @description 按照 id 查找用户
     * @param   string  $id 用户的 id
     * @return  object  查询结果对象
     */
    public function selectById( $id ){
//        $id = mysql_real_escape_string( $id );
        $result = $this->select( $this->TABLE_NAME, 'username,avatar,description', 'where Id='. $id);
        return $result ? $result[0] : null;
    }

    /**
     * @description 注册新用户
     * @param   string  $email  新注册用户 email
     * @param   string  $pwd    新用户密码
     * @return  number  新用户的 id
     */
    public function insertUser( $email, $pwd ){
//        $email = mysql_real_escape_string( $email );
//        $pwd = mysql_real_escape_string( $pwd );
        return $this->insert( $this->TABLE_NAME, '(email,password)', '\''. $email .'\',\''. $pwd .'\'');
    }
}