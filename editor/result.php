<?php
/**
 * @module  在线编辑器
 * @fileOverview  运行结果显示页面
 */
require_once('../include/Editor.class.php');

$id = 0;
$html = '';
$css = '';
$js = '';
$inc = [];

if( $_SERVER['REQUEST_METHOD'] == 'GET' ){
    if ( isset($_GET['id']) ) {
        $editor = new Editor();

        $id = filterReq( $_GET['id'] );
        $rs = $editor->selectById( $id );

        if( $rs ){
            $inc = explode(',', $rs->includeFile);
            $html = $rs->html;
            $css = $rs->css;
            $js = $rs->js;
        }
    }
}
else if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    $html = isset( $_POST['html']) ? $_POST['html'] : '';
    $css = isset( $_POST['css']) ? $_POST['css'] : '';
    $js = isset( $_POST['js']) ? $_POST['js'] : '';
    $inc = isset( $_POST['incFile']) ?  explode(',', $_POST['incFile']) : '';
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>测试结果</title>
<link rel="shortcut icon" href="<?php echo projectRoot();?>image/favicon.ico" />
<style>
body{margin:0;padding:0;border:0;}
</style>
<?php
// 输出 CSS 引用文件
$cssExpr = '/\\.css$/';
for($i = 0, $j = count( $inc ); $i < $j; $i++ ){
    $temp = $inc[$i];
    if( preg_match($cssExpr, $temp, $matches) ){
         echo '<link rel="stylesheet" class="linkStyleSheet" href="'. $inc[$i] .'"/>';
    }
}

// 输出 CSS 代码
echo $css ? '<style>'. $css .'</style>' : '';
?>
<script>
// 加载用户输入的代码
function __addHJC(incFile, cssCode, jsCode, htmlCode){
    var doc = document
		, head = doc.head
		, body = doc.body
		, cssExpr = /\.css/
		, jsExpr = /\.js$/
		, i = 0
		, j = incFile.length
		, temp
		, css
		, jsCache = []
		, jsNum = 0
		, loadScript = function(){
			var script;
			if(jsNum < jsCache.length) {
				script = doc.createElement('script');

				script.src = jsCache[jsNum];

				script.onload = loadScript;

				body.appendChild( script );
				jsNum++;
			}
			else{
				script = eval;
				try{
					jsCode && script( jsCode );
				}
				catch(ex){
					var msg;
					if( ex instanceof EvalError ){
						msg = '您的代码在执行时发生错误';
					}
					else if( ex instanceof SyntaxError  ){
						msg = '您的代码中有语法错误';
					}
					else{
						msg = ex.message;
					}

					console.log( msg );
				}

                $(window).trigger('load');
			}
		}
		;

    // 加载 CSS 引用文件
    for(; i < j; i++ ){
        temp = incFile[i];
        if( cssExpr.test( temp ) ){
            css = doc.createElement('link');

            css.rel = 'stylesheet';
            css.href = temp;

            head.appendChild( css );
        }
        else if( jsExpr.test( temp ) ){ // 统计 JS 引用文件
            jsCache.push( temp );
        }
    }

    // 加载 CSS 代码
    if( cssCode ){
        css = doc.createElement('style');
        css.innerHTML = cssCode;
        head.appendChild( css );
    }

    // 添加 HTML 代码
    body.innerHTML = htmlCode;

    // 加载 JS 引用文件，加载 JS 代码
    loadScript();
}
</script>
</head>
<body>
<?php
// 输出 HTML 代码
echo $html;

// 输出 JS 引用文件
$jsExpr = '/\\.js$/';
for($i = 0, $j = count( $inc ); $i < $j; $i++ ){
    $temp = $inc[$i];
    if( preg_match($jsExpr, $temp, $matches) ){
        echo '<script src="'. $inc[$i] .'"></script>';
    }
}

// 输出 JS 代码
echo $js ? '<script>'. $js .'</script>' : '';
?>
</body>
</html>