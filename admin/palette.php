<?php
/**
 *  todo
 * */
require_once('../include/Color.class.php');
$color = new Color();
$rs = $color->selectInfoColor();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<link rel="stylesheet" href="../style/style.css" />
<link rel="stylesheet" href="../script/plugin/farbtastic/farbtastic.css" />
<link rel="stylesheet" href="../script/plugin/artDialog/artDialog.css" />

<!--<link rel="stylesheet" href="../script/lib/jQueryUI/jquery-ui-1.10.3.custom.min.css" />-->
<!--<link rel="stylesheet" href="../script/plugin/jqGrid/ui.jqgrid.css" />-->

<style type="text/css">
body{
    color: #000;
	font-family: "Consolas",Monaco,Andale,monospace;
}
.icon{
    float:left;
    height: 40px;
    width: 40px;
    border: 5px solid #c0c0c0;
    border-radius: 50%;
    background: #c0c0c0;
}
.colorTable{
	margin: 10px;
}
.colorTable tr{
    /*text-align:center;*/
    border: 1px solid #c0c0c0;
}
.colorTable th{
    text-align:left;
}
.colorTable td{
    padding:5px;
}
.colorView{
    float:left;
    width: 40px;
    height:40px;
}
</style>
<title>添加颜色</title>
</head>
<body>

<table class="colorTable" id="colorTable">
    <caption>颜色列表
        <span id="addColor" class="icon icon-plus" title="添加颜色">
            <span class="icon1"></span>
            <span class="icon2"></span>
            <span class="icon3"></span>
        </span>
    </caption>
    <thead>
    <tr>
        <th></th>
        <th>颜色名称</th>
        <th>颜色值（HEX）</th>
        <th>颜色值（R）</th>
        <th>颜色值（G）</th>
        <th>颜色值（B）</th>
        <th>所属类别</th>
    </tr>
    </thead>
    <tbody>
<!--	<tr id="gray">-->
<!--		<td class="textCenter" colspan="7">灰色系</td>-->
<!--	</tr>-->
<!--    <tr id="red">-->
<!--        <td class="textCenter" colspan="7">红色系</td>-->
<!--    </tr>-->
<!--    <tr id="yellow">-->
<!--        <td class="textCenter" colspan="7">黄色系</td>-->
<!--    </tr>-->
<!--    <tr id="green">-->
<!--        <td class="textCenter" colspan="7">绿色系</td>-->
<!--    </tr>-->
<!--    <tr id="cyan">-->
<!--        <td class="textCenter" colspan="7">青色系</td>-->
<!--    </tr>-->
<!--    <tr id="blue">-->
<!--        <td class="textCenter" colspan="7">蓝色系</td>-->
<!--    </tr>-->
<!--    <tr id="purple">-->
<!--        <td class="textCenter" colspan="7">紫色系</td>-->
<!--    </tr>-->
<?php for($i = 0, $j = count( $rs ); $i < $j; $i++){?>
    <tr>
        <td><span class="colorView" style="background:#<?php echo $rs[$i]->colorValue;?>;"></span></td>
        <td><?php echo $rs[$i]->colorName;?></td>
        <td>#<?php echo $rs[$i]->colorValue;?></td>
        <td><?php echo $rs[$i]->r;?></td>
        <td><?php echo $rs[$i]->g;?></td>
        <td><?php echo $rs[$i]->b?></td>
        <td><?php echo $rs[$i]->colorType?></td>
    </tr>
<?php }?>
    </tbody>
</table>

<div class="hidden" id="colorPicker">
    <form id="addColorForm" action="">
        <label>选择颜色：
            <input type="text" name="colorValue" id="color" data-validator="" value="#ffffff" />
        </label>
        <div id="picker"></div>
        <label>颜色名称：
            <input type="text" name="colorName" id="colorName" data-validator=""/>
        </label>
    </form>
</div>

<script src="../script/lib/jQuery/jquery.min.js"></script>
<script src="../script/plugin/farbtastic/farbtastic.js"></script>
<script src="../script/plugin/artDialog/artDialog.min.js"></script>
<script src="../script/plugin/artDialog/artDialog.plugins.min.js"></script>

<script src="../script/ui/jquery.template.js"></script>

<!--<script src="../script/lib/jQueryUI/jquery-ui-1.10.3.custom.min.js"></script>-->
<!--<script src="../script/plugin/jqGrid/i18n/grid.locale-en.js"></script>-->
<!--<script src="../script/plugin/jqGrid/jquery.jqGrid.min.js"></script>-->

<script>
var COLOR_DATA = <?php echo json_encode($rs);?>;
$(function(){
    var $colorPicker = $('#colorPicker'),

		colorTmpl = $.template({
			template: 'tr>td>span.colorView[style=background:#%colorValue%]^td{%colorName%}' +
				'+td{#%colorValue%}+td{%r%}+td{%g%}+td{%b%}+td{%colorType%}'
		}),

        $addColorForm = $('#addColorForm'),
        $colorValue = $('#color'),
        $colorName = $('#colorName'),
        okFunc = function(){
//            var colorValue = $colorValue.val(),
//                colorName = $colorName.val();
//            if( /^#[0-9a-f]{6}$/i.test( colorValue ) && colorName ){
//                $.ajax({
//                    url:'../palette/addColor.php',
//                    data:'colorValue='+ colorValue +'&colorName='+ colorName,
//                    type:'POST',
//                    dataType:'json',
//                    success:function(data){
//                        if( 'error' in data ){
//                            alert(data.msg);
//                        }
//                        else{
//                            $('table.colorTable tbody').append('<tr><td><span class="colorView" style="background:#'+
//                                    data.colorValue +';"></span></td><td>'+ data.colorName +'</td><td>'+
//                                    data.colorValue +'</td><td>'+ data.r +'</td><td>' + data.g +'</td><td>' + data.b +
//                                    '</td><td>'+ data.type +'</td><td></tr>');
//                        }
//                    }
//                });
//            }
//            else{
//                alert( '请选择颜色并填写颜色名称' );
//            }
        };

//	$('#colorTable').find('tbody').html( colorTmpl(COLOR_DATA).join('') );

    $('#picker').farbtastic('#color');

    $('#addColor').on('click', function(){
        art.dialog({
            id:'colorPicker', title:'选择颜色', content:$colorPicker[0], follow:this,
            okValue:'添加', ok:okFunc,
            cancelValue:'关闭', cancel:function(){}
        });
    });

//    $('#colorTable').jqGrid({
//        data: COLOR_DATA,
//        datatype: 'local',
//        height: 1000,
//        colNames:['', '颜色名称', '颜色值（HEX）', '颜色值（R）','颜色值（G）','颜色值（B）','所属类别'],
//        colModel:[
//            {name:'id',index:'id', width:60, sorttype:"int"},
//            {name:'colorName',index:'colorName', width:150, sortable:false},
//            {name:'colorValue',index:'colorValue', width:90, sortable:false},
//            {name:'r',index:'r', width:80, align:"right", sorttype:"int"},
//            {name:'g',index:'g', width:80, align:"right", sorttype:"int"},
//            {name:'b',index:'b', width:80, align:"right", sorttype:"int"},
//            {name:'colorType',index:'colorType', width:150, sortable:false}
//        ],
//        multiselect: true,
//        caption: '颜色列表<span id="addColor" class="icon icon-plus" title="添加颜色">' +
//                '<span class="icon1"></span>' +
//                '<span class="icon2"></span>' +
//                '<span class="icon3"></span></span>'
//    });
});
</script>
</body>
</html>