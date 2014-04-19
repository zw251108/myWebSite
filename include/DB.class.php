<?php
require_once('Config.inc.php');
/**
 *@class    DB  数据库操作基类
 *
 *@author   zhouwenbo
 */
class DB{
    private $_CONN;					// 数据库连接
	private $ACCESSIBLE = true;		// 是否可访问数据库

    protected $TABLE_NAME;			// 表名
    protected $TABLE_COL_TEXT;      // 列名说明
    protected $TABLE_COL_NAME;		// 列名数组

    /**
     * 预定义SQL语句
     * */
    //分页查询
    protected $SELECT   = 'select {tableColName} from {tableName} {where} {limit} {order}';
    //计数
    protected $COUNT    = 'select count({tableColName}) as count from {tableName} {where}';
    //插入数据
    protected $INSERT   = 'insert into {tableName}{tableColName} values({value})';
    //更新数据
    protected $UPDATE   = 'update {tableName} set {set} {where} ';
    //删除数据
    protected $DELETE   = 'delete from {tableName} {where}';

    /**
     * @description 初始化构造函数，连接数据库
     */
    public function __construct() {
        $connection = mysql_connect(DB_SERVER_NAME, DB_USER, DB_PASSWORD);
        if( $connection ){
            mysql_select_db(DB_NAME);
            mysql_query('SET NAMES \'UTF8\'');
        }
        else{
            echo '数据库链接失败';
            //exit();
            $this->ACCESSIBLE = false;
        }
        $this->_CONN = $connection;
    }

    /**
     * @description 析构函数
     */
    public function __destruct(){
//        mysql_close($this->_CONN);
    }

    public function transformToObj( $result ){
        $ResultArray = [];
        $i = 0;
        while( $row = mysql_fetch_object( $result ) ){
			$ResultArray[$i++] = $row;
		}
		return $ResultArray;
    }

    /**
     * @description 查询数据
     * @author  ZwB
     * @param   string  $tableName      表名
     * @param   string  $tableColName   列名
     * @param   string  $where          查询条件
     * @param   string  $limit          查询数量
     * @param   string  $order          排序
     * @return  object      查询结果集
     */
    public function select($tableName, $tableColName='*', $where='', $limit='', $order=''){
        $rs = null;
        if( $this->ACCESSIBLE ){
            $sql = $this->SELECT;

            //TODO  替换预定义的SQL语句中的变量
            $sql = str_replace('{tableName}', $tableName, $sql);
            $sql = str_replace('{tableColName}', $tableColName, $sql);
            $sql = str_replace('{where}', $where, $sql);
            $sql = str_replace('{limit}', $limit, $sql);
            $sql = str_replace('{order}', $order, $sql);
//                           echo $sql;
            $rs = $this->transformToObj( mysql_query( $sql, $this->_CONN ) );
        }
        return $rs;
    }

    /**
     * @description 统计数据
     * @author  ZwB
     * @param   string  $tableName      表名
     * @param   string  $tableColName   列名（默认为空）
     * @param   string  $where          统计条件条件（默认为空）
     * @return  number      统计出来的数量
     */
    public function count($tableName, $tableColName='*', $where=''){
        $result = array('count'=>0);
        if( $this->ACCESSIBLE ){
            $sql = $this->COUNT;

            //TODO  替换预定义的SQL语句中的变量
            $sql = str_replace('{tableName}', $tableName, $sql);
            $sql = str_replace('{tableColName}', $tableColName, $sql);
            $sql = str_replace('{where}', $where, $sql);

            $result = mysql_fetch_object( mysql_query( $sql, $this->_CONN ) );
        }

        return $result->count;
    }

    /**
     * @description 定义 SQL 语句查询
     * @author    ZwB
     * @param   string  $sql    自定义 SQL 语句
     * @return  array   返回查询结果数组
     */
    public function selectCustom($sql){
        $rs = null;
        if( $this->ACCESSIBLE ){
            $rs = $this->transformToObj( mysql_query( $sql, $this->_CONN) );
        }
        return $rs;
    }

    /**
     * @description 插入数据
     * @author  ZwB
     * @param   string  $tableName      表名
     * @param   string  $tableColName   列名
     * @param   string  $value          表数据
     * @return  number      新插入的数据的 Id
     */
    public function insert($tableName, $tableColName, $value){
        $flag = 0;
        if( $this->ACCESSIBLE ){
            $sql = $this->INSERT;

            //TODO	替换预定义的SQL语句中的变量
            $sql = str_replace('{tableName}', $tableName, $sql);
            $sql = str_replace('{tableColName}', $tableColName, $sql);
            $sql = str_replace('{value}', $value, $sql);

            $flag = mysql_query( $sql, $this->_CONN );
        }
        return $flag ? mysql_insert_id() : 0;
    }

    /**
     * @description 更新数据
     * @author  ZwB
     * @param   string  $tableName  表名
     * @param   string  $set        更新的数据
     * @param   string  $where      更新条件
     * @return  number      更新所影响的行数
     */
    public function update($tableName, $set, $where){
        $flag = 0;
        if( $this->ACCESSIBLE ){
            $sql = $this->UPDATE;

            //TODO  替换预定义的SQL语句中的变量
            $sql = str_replace('{tableName}', $tableName, $sql);
            $sql = str_replace('{set}', $set, $sql);
            $sql = str_replace('{where}', $where, $sql);

            $flag = mysql_query( $sql, $this->_CONN );
        }
        return $flag;
    }

    /**
     * @description 删除数据
     * @author  ZwB
     * @param   string  $tableName      表名
     * @param   string  $where          条件
     * @return  number      删除的行数
     */
    public function delete($tableName, $where=''){
        $flag = 0;
        if( $this->ACCESSIBLE ){
            $sql = $this->DELETE;

            //TODO	替换预定义的SQL语句中的变量
            $sql = str_replace('{tableName}', $tableName, $sql);
            $sql = str_replace('{where}', $where, $sql);

            $flag = mysql_query( $sql, $this->_CONN );
        }
        return $flag;
    }
}

//class DB{
//    private $_CONN;					//数据库连接
//    protected $TABLE_NAME;			//表名
//    protected $TABLE_COL_TEXT;      //列名说明
//    protected $TABLE_COL_NAME;		//列名数组
//
//	/**
//	 * 预定义SQL语句
//	 * */
//	//分页查询
//	protected $SELECT   = <<<SQL
//		select {tableColName} from {tableName} {where} {limit} {order}
//SQL;
//
////		'select {tableColName} from {tableName} {where} {limit} {order}';
//	//计数
////	protected $COUNT    = 'select count({tableColName}) as count from {tableName} {where}';
////	//插入数据
////	protected $INSERT   = 'insert into {tableName}{tableColName} values({value})';
////	//更新数据
////	protected $UPDATE   = 'update {tableName} set {set} {where} ';
////	//删除数据
////	protected $DELETE   = 'delete from {tableName} {where}';
//
//	private $ACCESSIBLE = true;
//
//	/**
//     * @description 初始化构造函数，连接数据库
//     */
//    public function __construct() {
//		try{
//			$this->_CONN = new PDO('mysql:host='. DB_SERVER_NAME .';port=3306;dbname='. DB_NAME .';charset=UTF8',
//				DB_USER, DB_PASSWORD);
//		}
//		catch(PDOException $e){
//			die( $e );
//		}
//    }
//
//	public function transformToObj( $result ){
//		$ResultArray = [];
//		$i = 0;
//
//		foreach( $result->FetchAll() as $row ){
//			$ResultArray[$i++] = $row;
//		}
//
//		return $ResultArray;
//	}
//
//    /**
//     * @description 查询数据
//     * @author  ZwB
//     * @param   string  $tableName      表名
//     * @param   string  $tableColName   列名
//     * @param   string  $where          查询条件
//     * @param   string  $limit          查询数量
//     * @param   string  $order          排序
//     * @return  object      查询结果集
//     */
//	public function select($tableName, $tableColName='*', $where='', $limit='', $order=''){
//		$rs = null;
//		if( $this->ACCESSIBLE ){
//			$sql = $this->SELECT;
//
//			//TODO  替换预定义的SQL语句中的变量
//			$sql = str_replace('{tableName}', $tableName, $sql);
//			$sql = str_replace('{tableColName}', $tableColName, $sql);
//			$sql = str_replace('{where}', $where, $sql);
//			$sql = str_replace('{limit}', $limit, $sql);
//			$sql = str_replace('{order}', $order, $sql);
////                           echo $sql;
//			$rs = $this->transformToObj( $this->_CONN->query( $sql ) );
//		}
//		return $rs;
//	}
//
//}