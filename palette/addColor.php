<?php
/**
 *
 */
if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){// 判断是否为 ajax 访问

    require_once('../include/Color.class.php');

    $color = new Color();

    $colorValue = filterReq( $_POST['colorValue'] );
    $colorName = filterReq( $_POST['colorName'] );

    $regexp = '/^#([0-9a-f]{6})$/i';
    $res = [];
    $matches = [];

    if( $colorName && preg_match($regexp, $colorValue, $matches) ){

        $rs = $color->selectByValue( $matches[1] );
        $colorValue = $matches[1];

        if( $rs ){// 颜色已存在
            $res['error'] = 'E0006';
            $res['msg'] = errMsg('E0006');
        }
        else{
            $arr=array(
                '0'=>0,'1'=>1,'2'=>2,'3'=>3,
                '4'=>4,'5'=>5,'6'=>6,'7'=>7,
                '8'=>8,'9'=>9,'a'=>10,'b'=>11,
                'c'=>12,'d'=>13,'e'=>14,'f'=>15);
            $matches = str_split($colorValue);

            $r = $arr[$matches[0]] *16 + $arr[$matches[1]];
            $g = $arr[$matches[2]] *16 + $arr[$matches[3]];
            $b = $arr[$matches[4]] *16 + $arr[$matches[5]];

            if($r === $g && $r === $b){
                $type = 'gray';
            }
            else if($r >= $g && $g >= $b){
                $type = 'red';
            }
            else if($g > $r && $r >= $b){
                $type = 'yellow';
            }
            else if($g >= $b && $b > $r){
                $type = 'green';
            }
            else if($b > $g && $g > $r){
                $type = 'cyan';
            }
            else if($b > $r && $r >= $g){
                $type = 'blue';
            }
            else if($r >= $b && $b > $g){
                $type = 'magenta';
            }

            $rs = $color->insertColor($colorName, $colorValue, $r, $g, $b, $type);
            if( $rs ){
                $res['colorName'] = $colorName;
                $res['colorValue'] = $colorValue;
                $res['r'] = $r;
                $res['g'] = $g;
                $res['b'] = $b;
                $res['type'] = $type;
            }
            else{
                $res['error'] = 'E0000';
                $res['msg'] = errMsg('E0000');
            }
        }
    }
    else{
        $res['error'] = 'E0001';
        $res['msg'] = errMsg('E0001');
    }

    echo json_encode( $res );
}
else dir('访问出错！');