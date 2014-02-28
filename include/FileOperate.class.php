<?php
require_once('Config.inc.php');

/**
 * @author  zhouwenbo
 *
 * @class   FileOperate 文件操作类
 */
class FileOperate{
    /**
     * @description 读取文件内容
     * @param   string  $path   文件路径
     * @return  string  该文件的内容
     */
    public function readFile($path){
        $result = '';
        if( is_file($path) ){
            $fileSize = filesize($path);

            if( $fileSize != 0 ){
                $file = fopen($path, 'r');
                $result = fread($file, $fileSize);
                fclose($file);
            }
        }
        return $result;
    }

    public function saveFile($file, $fileName){

    }

//    public function getFileType($fileName){
//        return $fileName;
//    }

    /**
     * @description 获取目录下的所有文件
     * @param   string  $dirName    目录名
     * @param   boolean $deep       是否深度递归
     * @return  array   该目录下的所有文件，以对象的形式，子文件夹为 children
     */
    public function getTreeStructByDir($dirName, $deep = false){
        $files = [];
        $dir = opendir( $dirName );
        $i = 0;
        while( false != ( $file=readdir($dir) ) ){
            if( $file != '.' && $file != '..' ){
                $temp = $dirName.$file;
                $files[$i] = [];
                $files[$i]['name'] = $file;
                if( $deep && is_dir( $temp ) ){
                    $files[$i]['nocheck'] = true;
                    $files[$i]['children'] = $this->getTreeStructByDir( $temp.'/', $deep );
                }

                $i++;
            }
        }
        return $files;
    }
}
