<?php
require_once('../include/Color.class.php');
$color = new Color();
/**
 *  按类别获取颜色数据 有 2 种访问方式
 * ajax 传入 type 返回颜色数据
 * get  传入 type 显示该类别的颜色数据
 *
 * 期望为 ajax 方式访问
 */
if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){// 判断是否为 ajax 访问

    $res = [];

    if( isset( $_GET['type'] ) ){
        $rs = $color->selectColorByType( filterReq( $_GET['type'] ) );

        if( $rs ){// 返回文字内容
            $res['data'] = $rs;
            $res['state'] = 'getColor';
        }
        else{// 未查到文章内容
            $res['error'] = 'E0004';
            $res['msg'] = errMsg('E0004');
        }
    }
    else{// 未传入 id
        $res['error'] = 'E0001';
        $res['msg'] = errMsg('E0001');
    }

    echo json_encode( $res );
}
else{
    $type = '';
    $rs = [];

    if( isset( $_GET['type'] ) ){
        $type = filterReq( $_GET['type'] );
        $rs = $color->selectColorByType( $type );
    }
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>颜色库</title>
<?php require_once('../style.php');?>
</head>
<body class="Container">
<?php require_once('../header.php');?>
<section class="module module-large module-main module-palette" id="paletteList">
    <h2 class="module_title">调色板 palette</h2>
    <div class="module_content">
        <section class="palette_section-gray section">
            <a href="index.php?type=gray" <?php if( $type == 'gray' ) echo 'data-deploy="true"';?>>
            <h3 class="section_title">灰色系（gray）
                <span class="icon <?php echo $type == 'gray' ? 'icon-minus' : 'icon-plus';?>">
                    <span class="icon1"></span>
                    <span class="icon2"></span>
                    <span class="icon3"></span>
                </span>
            </h3>
            </a>
            <ul>
<?php
if( $type == 'gray' ) for($i = 0, $j = count( $rs ); $i < $j; $i++){
    echo '<li style="background: #'. $rs[$i]->colorValue .';">'.$rs[$i]->colorName .' #'. $rs[$i]->colorValue .'</li>';
}
?>
            </ul>
        </section>
        <section class="palette_section-red section">
            <a href="index.php?type=red" <?php if( $type == 'red' ) echo 'data-deploy="true"';?>>
            <h3 class="section_title">红色系（red）
                <span class="icon <?php echo $type == 'red' ? 'icon-minus' : 'icon-plus';?>">
                    <span class="icon1"></span>
                    <span class="icon2"></span>
                    <span class="icon3"></span>
                </span>
            </h3>
            </a>
            <ul>
<?php
if( $type == 'red' ) for($i = 0, $j = count( $rs ); $i < $j; $i++){
    echo '<li style="background: #'. $rs[$i]->colorValue .';">'.$rs[$i]->colorName .' #'. $rs[$i]->colorValue .'</li>';
}
?>
            </ul>
        </section>
        <section class="palette_section-yellow section">
            <a href="index.php?type=yellow" <?php if( $type == 'yellow' ) echo 'data-deploy="true"';?>>
            <h3 class="section_title">黄色系（yellow）
                <span class="icon <?php echo $type == 'yellow' ? 'icon-minus' : 'icon-plus';?>">
                    <span class="icon1"></span>
                    <span class="icon2"></span>
                    <span class="icon3"></span>
                </span>
            </h3>
            </a>
            <ul>
<?php
if( $type == 'yellow' ) for($i = 0, $j = count( $rs ); $i < $j; $i++){
    echo '<li style="background: #'. $rs[$i]->colorValue .';">'.$rs[$i]->colorName .' #'. $rs[$i]->colorValue .'</li>';
}
?>
            </ul>
        </section>
        <section class="palette_section-green section">
            <a href="index.php?type=green" <?php if( $type == 'green' ) echo 'data-deploy="true"';?>>
            <h3 class="section_title">绿色系（green）
                <span class="icon <?php echo $type == 'green' ? 'icon-minus' : 'icon-plus';?>">
                    <span class="icon1"></span>
                    <span class="icon2"></span>
                    <span class="icon3"></span>
                </span>
            </h3>
            </a>
            <ul>
<?php
if( $type == 'green' ) for($i = 0, $j = count( $rs ); $i < $j; $i++){
    echo '<li style="background: #'. $rs[$i]->colorValue .';">'.$rs[$i]->colorName .' #'. $rs[$i]->colorValue .'</li>';
}
?>
            </ul>
        </section>
        <section class="palette_section-cyan section">
            <a href="index.php?type=cyan" <?php if( $type == 'cyan' ) echo 'data-deploy="true"';?>>
            <h3 class="section_title">青色系（cyan）
                <span class="icon <?php echo $type == 'cyan' ? 'icon-minus' : 'icon-plus';?>">
                    <span class="icon1"></span>
                    <span class="icon2"></span>
                    <span class="icon3"></span>
                </span>
            </h3>
            </a>
            <ul>
<?php
if( $type == 'cyan' ) for($i = 0, $j = count( $rs ); $i < $j; $i++){
    echo '<li style="background: #'. $rs[$i]->colorValue .';">'.$rs[$i]->colorName .' #'. $rs[$i]->colorValue .'</li>';
}
?>
            </ul>
        </section>
        <section class="palette_section-blue section">
            <a href="index.php?type=blue" <?php if( $type == 'blue' ) echo 'data-deploy="true"';?>>
            <h3 class="section_title">蓝色系（blue）
                <span class="icon <?php echo $type == 'blue' ? 'icon-minus' : 'icon-plus';?>">
                    <span class="icon1"></span>
                    <span class="icon2"></span>
                    <span class="icon3"></span>
                </span>
            </h3>
            </a>
            <ul>
<?php
if( $type == 'blue' ) for($i = 0, $j = count( $rs ); $i < $j; $i++){
    echo '<li style="background: #'. $rs[$i]->colorValue .';">'.$rs[$i]->colorName .' #'. $rs[$i]->colorValue .'</li>';
}
?>
            </ul>
        </section>
        <section class="palette_section-magenta section">
            <a href="index.php?type=magenta" <?php if( $type == 'magenta' ) echo 'data-deploy="true"';?>>
            <h3 class="section_title">紫色系（magenta）
                <span class="icon <?php echo $type == 'magenta' ? 'icon-minus' : 'icon-plus';?>">
                    <span class="icon1"></span>
                    <span class="icon2"></span>
                    <span class="icon3"></span>
                </span>
            </h3>
            </a>
            <ul>
<?php
if( $type == 'magenta' ) for($i = 0, $j = count( $rs ); $i < $j; $i++){
    echo '<li style="background: #'. $rs[$i]->colorValue .';">'.$rs[$i]->colorName .' #'. $rs[$i]->colorValue .'</li>';
}
?>
            </ul>
        </section>
    </div>
</section>

<?php require_once('../footer.php');?>

<!--
<script>var COLOR_LIST = <?php echo isset($rs) ? json_encode( $rs ) : '[]';?>;
var temp = COLOR_LIST, t,
    i = 0, j = temp.length,
    html = [],
    v, max, min,
    r, g, b;
for( ; i<j; i++ ){
    t = temp[i];

    r = parseInt(t.r);
    g = parseInt(t.g);
    b = parseInt(t.b);

//    max = Math.max( r, g, b );

    if( r === g && r === b ){
        t.colorType = 'gray';
    }
    else if( r > g && g === b ){
        t.colorType = 'red';
    }
    else if( g > r && r === b ){
        t.colorType = 'green';
    }
    else if( b > g && r === g ){
        t.colorType = 'blue';
    }
    else if( g < r && r === b ){
        t.colorType = 'magenta';
    }
    else if( r < g && g === b ){
        t.colorType = 'cyan';
    }
    else if( b < g && r === g ){
        t.colorType = 'yellow';
    }
    else if( r >= g && g>= b ){
        t.colorType = 'red';
    }
    else if( g > r && r >= b ){
        t.colorType = 'yellow';
    }
    else if( g >= b && b > r){
        t.colorType = 'green';
    }
    else if( b > g && g > r ){
        t.colorType = 'cyan';
    }
    else if( b> r && r >= g ){
        t.colorType = 'blue';
    }
    else if( r >= b && b > g ){
        t.colorType = 'magenta';
    }

html.push('insert into color(colorValue, colorValueR, colorValueG, colorValueB, colorName, colorType) value(\'',
        t.colorValue, '\',',
        t.r, ',',
        t.g, ',',
        t.b, ',\'',
        t.colorName, '\',\'',
        t.colorType, '\');\n');
}
console.log( html.join('') );
</script>
-->

<script data-main="../script/palette/index" src="../script/lib/require/require.js"></script>
</body>
</html>
<?php }?>